<?php

namespace App\Domain\Services;

use App\Criteria\WithRelationsCriteria;
use App\Domain\Enums\ProjectRoleEnum;
use App\Domain\Services\Contracts\ConsultingCompanyServiceInterface;
use App\Domain\Services\Contracts\ConsultingEngineerServiceInterface;
use App\Infrastructure\Repositories\Contracts\ProjectParticipantRepositoryInterface;
use App\Infrastructure\Repositories\Contracts\ProjectRepositoryInterface;
use App\Domain\Services\Contracts\ProjectServiceInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Exceptions\EntityNotFoundException;
use Illuminate\Support\Facades\DB;

class ProjectService implements ProjectServiceInterface
{
    protected $projectRepo;
    protected $projectParticipantRepo ;
    protected $consultingEngineer ;

    public function __construct(ProjectRepositoryInterface $projectRepo ,
                                ProjectParticipantRepositoryInterface $projectParticipantRepo,
                                ConsultingEngineerServiceInterface $consultingEngineer
    )
    {
        $this->projectRepo = $projectRepo;
        $this->projectParticipantRepo = $projectParticipantRepo;
        $this->consultingEngineer = $consultingEngineer;
    }

    public function getAll()
    {
        $this->projectRepo->pushCriteria(new WithRelationsCriteria(['owners', 'consultingCompany','projectParticipant.participant.user']));
        $projects = $this->projectRepo->all();
        return loadSpecializationsForProjects($projects);
    }

    public function paginate()
    {
        $this->projectRepo->pushCriteria(new WithRelationsCriteria(['owners', 'consultingCompany','projectParticipant.participant.user']));

        $projects = $this->projectRepo->paginate();
        return loadSpecializationsForProjects($projects);
    }

    public function create(array $data)
    {
        DB::beginTransaction();
        try {
            $projectManagerId = $data['project_manager_id'];
            $consultingCompanyId = $data['consulting_company_id'];
            unset($data['project_manager_id']);
            $project = $this->projectRepo->create($data);

            $this->assignParticipant($project->id, 'project_manager', $projectManagerId, ProjectRoleEnum::ProjectManager);

            $engineers = $this->consultingEngineer
                ->getEngineersByCompany($consultingCompanyId);
            foreach ($engineers as $engineer) {
                $this->assignParticipant($project->id, 'consulting_engineer', $engineer->id, ProjectRoleEnum::StudyEngineer);
            }

            DB::commit();
            return $project->load(['owners', 'consultingCompany','projectParticipant']);
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }


    public function show($id)
    {

        $project = $this->projectRepo->pushCriteria(new WithRelationsCriteria(['owners', 'consultingCompany','projectParticipant.participant.user']))->find($id);

        return loadSpecializationsForProjects($project);
    }

    public function update($id, array $data)
    {
        try {
            $project = $this->projectRepo->find($id);
        } catch (ModelNotFoundException $e) {
            throw new EntityNotFoundException('Project not found');
        }

        $this->projectRepo->update($data, $id);
        return $project->fresh()->load(['owners', 'consultingCompany']);
    }

    public function delete($id)
    {
        DB::beginTransaction();
        try {
            $project = $this->projectRepo->find($id);

            if (!$project) {
                return false;
            }

            // Soft delete related participants
                // Soft delete related files
            $project->projectFiles()->delete();
            $project->projectStage()->delete();
            $project->projectBills()->delete();
            $project->projectContainer()->delete();
            $project->media()->delete();
            $project->projectParticipant()->delete();

            // Soft delete the project
            $project->delete();

            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            return false;
        }
    }
     function assignParticipant( $projectId,  $type,  $id,  $role)
    {
        $this->projectParticipantRepo->create([
            'project_id' => $projectId,
            'participant_type' => $type,
            'participant_id' => $id,
            'role' => $role,
        ]);
    }
}
