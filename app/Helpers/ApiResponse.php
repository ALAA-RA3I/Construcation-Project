<?php

namespace App\Helpers;

 use Illuminate\Pagination\LengthAwarePaginator;

 class ApiResponse
{
     public static function success($data = null, $message = 'succes',  $status = 200)
     {
         if ($data instanceof LengthAwarePaginator) {
             return response()->json([
                 'status'  => true,
                 'message' => $message,
                 'data'    => $data->items(),
                 'meta'    => [
                     'current_page' => $data->currentPage(),
                     'last_page'    => $data->lastPage(),
                     'per_page'     => $data->perPage(),
                     'total'        => $data->total(),
                 ],
             ], $status);
         }

         return response()->json([
             'status'  => true,
             'message' => $message,
             'data'    => $data,
         ], $status);
     }

     public static function error( $message = 'Something went wrong', $errors = [],  $status = 400)
     {
         return response()->json([
             'status'  => false,
             'message' => $message,
             'errors'  => $errors,
         ], $status);
     }

     public static function custom(array $responseData = [],  $status = 200)
     {
         return response()->json($responseData, $status);
     }
}
