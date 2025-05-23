<?php

use App\Exceptions\EntityNotFoundException;
use App\Helpers\ApiResponse;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        //
    })
    ->withExceptions(function (Exceptions $exceptions) {
        // Custom Entity Not Found Exception
        $exceptions->renderable(function (EntityNotFoundException $e, Request $request) {
            return ApiResponse::error($e->getMessage(), [], 404);
        });

        // Laravel's ModelNotFoundException (e.g. Model::findOrFail)
        $exceptions->renderable(function (\Illuminate\Database\Eloquent\ModelNotFoundException $e, Request $request) {
            return ApiResponse::error('Resource not found.', [], 404);
        });

        // Validation Errors (optional: these are already nicely formatted by Laravel)
        $exceptions->renderable(function (\Illuminate\Validation\ValidationException $e, Request $request) {
            return ApiResponse::error('Validation failed.', $e->errors(), 422);
        });

        // Authentication failure
        $exceptions->renderable(function (\Illuminate\Auth\AuthenticationException $e, Request $request) {
            return ApiResponse::error('Unauthenticated.', [], 401);
        });

        // Authorization failure
        $exceptions->renderable(function (\Illuminate\Auth\Access\AuthorizationException $e, Request $request) {
            return ApiResponse::error('You are not authorized to perform this action.', [], 403);
        });

        // Fallback for unexpected exceptions
        $exceptions->renderable(function (\Throwable $e, Request $request) {
            return ApiResponse::error('Internal server error.', [], 500);
        });
    })->create();
