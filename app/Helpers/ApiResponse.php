<?php

namespace App\Helpers;

 use Illuminate\Http\Resources\Json\ResourceCollection;
 use Illuminate\Pagination\LengthAwarePaginator;

 class ApiResponse
{
     public static function success($data = null, $message = 'success', $status = 200)
     {
         $meta = null;

         // Check if this is a ResourceCollection wrapping a paginator
         if ($data instanceof ResourceCollection && $data->resource instanceof LengthAwarePaginator) {
             $paginator = $data->resource;

             $meta = [
                 'current_page' => $paginator->currentPage(),
                 'last_page'    => $paginator->lastPage(),
                 'per_page'     => $paginator->perPage(),
                 'total'        => $paginator->total(),
             ];

             // Replace $data with resolved collection to get the actual transformed items
             $data = $data->resolve();
         }

         // Handle pure paginator (not wrapped in ResourceCollection)
         if ($data instanceof LengthAwarePaginator) {
             $meta = [
                 'current_page' => $data->currentPage(),
                 'last_page'    => $data->lastPage(),
                 'per_page'     => $data->perPage(),
                 'total'        => $data->total(),
             ];

             $data = $data->items(); // Return only the paginated items
         }

         $response = [
             'status'  => true,
             'message' => $message,
             'data'    => $data,
         ];

         if ($meta) {
             $response['meta'] = $meta;
         }

         return response()->json($response, $status);
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
