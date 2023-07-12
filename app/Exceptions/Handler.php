<?php

namespace App\Exceptions;

use Throwable;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */

    public function register(): void
    {
        $this->reportable(function (Throwable $e) {

        });
    }
    public function render($request, Throwable $exception)
    {
        if ($request->wantsJson()) {
            // if ($exception instanceof AuthorizationException) {
            //     return response()->json(['error' => true, 'status' => 403, 'meta' => []]);
            //     //    return response()->error('user not authorization',403);

            // }

            // if ($exception instanceof ModelNotFoundException) {
            //     // return response()->json(['error' => true, 'status' => 404, 'meta' => []]);
            //     return response()->error('No query results for model [App\\Models\\Project]',404);
            // }
        } else {

            if ($exception instanceof ModelNotFoundException) {
                return response()->view('Exceptions.403');
            }
            if ($exception instanceof AuthorizationException) {
                return response()->view('Exceptions.403');
            }
        }

        return parent::render($request, $exception);
    }
}
