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
