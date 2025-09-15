<?php

use Illuminate\Http\Request;

if (!function_exists('getRequestFilters')) {
    function getRequestFilters(Request $request)
    {
        return [
            'filters' => $request->input('filters', []),
            'search' => $request->input('search'),
            'perPage' => $request->input('perPage', 15),
        ];
    }
}
if (!function_exists('loadSpecializationsForProjects')) {
    /**
     * Conditionally loads the specialization relationship for valid participant types.
     *
     * @param mixed $projects Collection, Paginator, or single Project
     * @return mixed Same type as input
     */
    function loadSpecializationsForProjects($projects)
    {
        $projectsCollection = $projects instanceof \Illuminate\Pagination\AbstractPaginator
            ? $projects->getCollection()
            : ($projects instanceof \Illuminate\Support\Collection ? $projects : collect([$projects]));

        $projectsCollection->each(function ($project) {
            $filteredParticipants = $project->projectParticipant->filter(function ($participant) {
                return in_array($participant->role, [
                    \App\Domain\Enums\ProjectRoleEnum::ProjectManager,
                    \App\Domain\Enums\ProjectRoleEnum::Engineer,
                ]);
            });

            $filteredParticipants->each(function ($participant) {
                if ($participant->role !== \App\Domain\Enums\ProjectRoleEnum::ProjectManager) {
                    if ($participant->participant && method_exists($participant->participant, 'specialization')) {
                        $participant->participant->load('specialization');
                    }
                }
            });

            $project->setRelation('projectParticipant', $filteredParticipants->values());
        });

        return $projects;
    }
}
