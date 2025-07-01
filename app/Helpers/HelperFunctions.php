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
                // Only allow 'project_manager' and 'engineer'
                return in_array($participant->role, [
                    \App\Domain\Enums\ProjectRoleEnum::ProjectManager,
                    \App\Domain\Enums\ProjectRoleEnum::Engineer,
                ]);
            });

            // Eager load specializations only for 'engineer' role
            $filteredParticipants->each(function ($participant) {
                if ($participant->role !== \App\Domain\Enums\ProjectRoleEnum::ProjectManager) {
                    // Check if participant is an object and supports 'specializations' relationship
                    if ($participant->participant && method_exists($participant->participant, 'specializations')) {
                        $participant->participant->load('specializations');
                    }
                }
            });

            // Overwrite original relation with filtered participants
            $project->setRelation('projectParticipant', $filteredParticipants->values());
        });

        return $projects;
    }
}
