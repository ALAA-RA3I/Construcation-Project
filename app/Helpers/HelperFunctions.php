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
            foreach ($project->projectParticipant ?? [] as $participant) {
                if (
                    $participant->participant &&
                    method_exists($participant->participant, 'specialization')
                ) {
                    $participant->participant->load('specialization');
                }
            }
        });

        return $projects;
    }
}
