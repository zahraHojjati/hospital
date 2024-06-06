<?php

namespace App\Exceptions;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Exceptions\ThrottleRequestsException;
use Illuminate\Validation\UnauthorizedException;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response as ResponseCode;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

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

    public function render($request, Throwable $e)
    {
        if ($request->wantsJson()) {
            if ($e instanceof NotFoundHttpException) {
                return response()->error('آدرس درخواست شده وجود ندارد!', ['message' => $e->getMessage()], ResponseCode::HTTP_NOT_FOUND);
            } elseif ($e instanceof ModelNotFoundException) {
                return response()->error('آیتم درخواست شده یافت نشد!', ['message' => $e->getMessage()], ResponseCode::HTTP_NOT_FOUND);
            } elseif ($e instanceof ValidationException) {
                return response()->error('خطاهای زیر رخ داده است:', $e->errors(), ResponseCode::HTTP_UNPROCESSABLE_ENTITY);
            } elseif ($e instanceof ThrottleRequestsException) {
                return response()->error('!درخواست های شما بیش از حد مجاز است', ['message' => $e->getMessage()], ResponseCode::HTTP_TOO_MANY_REQUESTS);
            } elseif ($e instanceof UnauthorizedException) {
                return response()->error('شما مجوز لازم برای این درخواست را ندارید!', ['message' => $e->getMessage()], ResponseCode::HTTP_UNAUTHORIZED);
            }
        }

        return parent::render($request, $e);
    }

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }
}
