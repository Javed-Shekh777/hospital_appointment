<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * Register the exception handling callbacks for the application.
     */
    public function register()
    {
        $this->renderable(function (\Illuminate\Database\Eloquent\ModelNotFoundException $e, $request) {
            return response()->view('errors.404', [], 404);
        });

        $this->renderable(function (\Symfony\Component\HttpKernel\Exception\NotFoundHttpException $e, $request) {
            return response()->view('errors.404', [], 404);
        });

        $this->renderable(function (\Symfony\Component\HttpKernel\Exception\HttpException $e, $request) {
            return response()->view('errors.500', [], 500);
        });
    }
}
