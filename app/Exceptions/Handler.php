<?php

namespace App\Exceptions;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of exception types with their corresponding custom log levels.
     *
     * @var array<class-string<\Throwable>, \Psr\Log\LogLevel::*>
     */
    protected $levels = [
        //
    ];

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<\Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed to the session on validation exceptions.
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
     *
     * @return void
     */
    public function register()
    {
        $this->renderable(function (Throwable $e, $request) {
            if ($request->is('api/*')) {
                return $this->handleApiException($request, $e);
            }
        });
    }

    /**
     * @param $request
     * @param Throwable $e
     * @return JsonResponse
     */
    private function handleApiException($request, Throwable $e): JsonResponse
    {
        $e = $this->prepareException($e);

        if ($e instanceof HttpResponseException) {
            $e = $e->getResponse();
        }

        if ($e instanceof AuthenticationException) {
            $e = $this->unauthenticated($request, $e);
        }

        return $this->customApiResponse($e);
    }

    /**
     * @param $e
     * @return JsonResponse
     */
    private function customApiResponse($e): JsonResponse
    {
        if (method_exists($e, 'getStatusCode')) {
            $statusCode = $e->getStatusCode();
        } else {
            $statusCode = 500;
        }

        $response = [];

        switch ($statusCode) {
            case 401:
                $response['message'] = 'Unauthorized';
                break;
            case 403:
                $response['message'] = 'Forbidden';
                break;
            case 404:
                $response['message'] = 'Not Found';
                break;
            case 405:
                $response['message'] = 'Method Not Allowed';
                break;
            case 422:
                $response['message'] = $e->original['message'];
                $response['errors'] = $e->original['errors'];
                break;
            default:
                $response['message'] = $e->getMessage() ?? 'Whoops, looks like something went wrong';
                break;
        }

        if (config('app.debug')) {
            $response['trace'] = $e->getTrace();
            $response['code'] = $e->getCode();
            $response['sql'] = method_exists($e, 'getSql') ? $e->getSql() : null;
        }

        $response['status'] = false;

        return response()->json($response, $statusCode);
    }
}
