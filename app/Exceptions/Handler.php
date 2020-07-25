<?php

namespace App\Exceptions;

use App\Traits\ApiResponse;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Response;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Laravel\Lumen\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */

    use ApiResponse;
    protected $dontReport = [
        AuthorizationException::class,
        HttpException::class,
        ModelNotFoundException::class,
        ValidationException::class,
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Throwable  $exception
     * @return void
     *
     * @throws \Exception
     */
    public function report(Throwable $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Throwable  $exception
     * @return \Illuminate\Http\Response|\Illuminate\Http\JsonResponse
     *
     * @throws \Throwable
     */
    public function render($request, Throwable $exception)
    {

        if($exception instanceof  HttpException){
            $code = $exception->getStatusCode();
            $message = Response::$statusTexts[$code];
            return $this->errorResponse($message,Response::HTTP_NOT_ACCEPTABLE);
        }

        if($exception instanceof  ModelNotFoundException){
            $model = strtolower(class_basename($exception->getModel()));
            return $this->errorResponse("instance of {$model} not found with given id ",
                                        Response::HTTP_NOT_ACCEPTABLE);
        }

        if($exception instanceof  AuthorizationException){

            return $this->errorResponse($exception->getMessage(),
                                        Response::HTTP_NOT_ACCEPTABLE);
        }

        if($exception instanceof  AuthenticationException){
            return $this->errorResponse($exception->getMessage(),
                                        Response::HTTP_NOT_ACCEPTABLE);
        }

        if($exception instanceof  ClientException){
            return $this->errorResponse($exception->getResponse()->getBody(),
                                        Response::HTTP_NOT_ACCEPTABLE);
        }


        if(env('APP_DEBUG',false)){
            return parent::render($request, $exception);
        }
        return $this->errorResponse('Please try later',Response::HTTP_UNPROCESSABLE_ENTITY);

    }
}
