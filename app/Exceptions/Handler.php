<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Lang;
use Inertia\Inertia;
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
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    protected $errorMessages = [
        400 => 'Bad Request',
        401 => 'Unauthorized',
        403 => 'Forbidden',
        404 => 'Not Found',
        405 => 'Method Not Allowed',
        408 => 'Request Timeout',
        422 => 'Unprocessable Entity',
        429 => 'Too Many Requests',
        500 => 'Internal Server Error',
        502 => 'Bad Gateway',
        503 => 'Service Unavailable',
        504 => 'Gateway Timeout',
    ];

    public function render($request, Throwable $exception)
    {
        $response = parent::render($request, $exception);

        $statusCode = $response->getStatusCode();
        $locale = $request->input('locale', App::currentLocale());

        $status = $this->isHttpException($exception) ? $response->getStatusCode() : 500;

        if (!$request->isMethod('GET')) {
            return back()
                ->withErrors([
                    'errorMessage' => $this->getErrorMessage($status, $locale),
                    'locale' => $locale,
                    'errorCode' => $statusCode,
                ]);
        }

        return parent::render($request, $exception);
    }

    protected function getErrorMessage($status, $locale)
    {
        return Lang::get("http.{$status}", [], $locale);
    }
}
