<?php

namespace App\Exceptions;

use App\Exceptions\ProjectUser\ProjectOwnerCanNotBeAMember;
use App\Exceptions\ProjectUser\ShouldBeTheProjectOwner;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var string[]
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var string[]
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Throwable  $exception
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Throwable
     */
    public function render($request, Throwable $exception)
    {
        if ($exception instanceof ValidationException) {
            return response()->json([
                'message' => 'Validation Error',
                'errors' => [$exception->errors()],
            ], Response::HTTP_BAD_REQUEST);
        }
        if (
            $exception instanceof AuthenticationException ||
            $exception instanceof ProjectOwnerCanNotBeAMember ||
            $exception instanceof ShouldBeTheProjectOwner 
            ) {
            return response()->json([
                'message' => 'Token Error',
                'errors' => [$exception->getMessage()],
            ], Response::HTTP_UNAUTHORIZED);
        }

        return response()->json([
            'message' => 'Api Error',
            'errors' => [$exception->getMessage()],
        ], Response::HTTP_BAD_REQUEST);
    }
}
