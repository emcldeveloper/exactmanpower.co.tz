<?php

namespace App\Exceptions;

use Throwable;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response as ResponseMessage;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        \Illuminate\Auth\AuthenticationException::class,
        \Illuminate\Auth\Access\AuthorizationException::class,
        \Symfony\Component\HttpKernel\Exception\HttpException::class,
        \Illuminate\Database\Eloquent\ModelNotFoundException::class,
        \Illuminate\Session\TokenMismatchException::class,
        \Illuminate\Validation\ValidationException::class,
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Throwable $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Throwable  $exception)
    {
        // return parent::render($request, $exception);
        Log::channel('error')->error($exception);
        // Log::channel('error')->error($exception->getMessage());

        if(config('app.env') != 'production'){
            if($this->ajax($request)){
                $code = (method_exists($exception, 'getStatusCode'))? $exception->getStatusCode(): 500;
                $message = (!empty($exception->getMessage()))? $exception->getMessage(): "Not found";

                return response()->json([
                    "code" => $code, 
                    "message" => $message
                ], $code);
            }

            return parent::render($request, $exception);
        } else {
            $layout = 'website';

            if($request->is('admin/*')) {
                $layout = 'admin';
            }

            if($exception instanceof \ErrorException){
                
                $responce_data = [
                    "code" => "Maintenance", 
                    "message" => "Minor maintenance for this page will be back soon"
                ];

                if($this->ajax($request)){
                    $responce_data['code'] = 500;
                    $responce_data['message'] = "Minor maintenance for this request, will be ready soon";
                    return response()->json($responce_data, 500);
                }

                $responce_data['layout'] = $layout;

                return new Response(view('error.400', $responce_data));
            } elseif ($this->isHttpException($exception)) {
                if($this->ajax($request)){
                    $message = "Not accessible";
                    return response()->json([
                        "code" => $exception->getStatusCode(), 
                        "message" => $message
                    ], $exception->getStatusCode());
                }

                switch ($exception->getStatusCode()) {
                    // not authorized
                    case '403':
                        return new Response(view('error.403', ['layout'=>$layout]));
                        break;
        
                    // not found
                    case '404':
                        return new Response(view('error.404', ['layout'=>$layout]));
                        break;
        
                    // internal error
                    case '500':
                        return new Response(view('error.500', ['layout'=>$layout]));
                        break;
    
                    default:
                        return new Response(view('error.400', [
                            'layout'=>$layout,
                            "code"=>$exception->getStatusCode(),
                            "message"=>""
                        ]));
                }
            } 
        }

        return parent::render($request, $exception);
    }

    /**
     * Convert an authentication exception into an unauthenticated response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Illuminate\Auth\AuthenticationException  $exception
     * @return \Illuminate\Http\Response
     */
    protected function unauthenticated($request, AuthenticationException $exception)
    {
        if ($this->ajax($request)) {
            return response()->json(['error' => 'Unauthenticated.'], 401);
        }

        return redirect()->guest(route('login'));
    }

    private function ajax($request){
        if($request->expectsJson() || $request->is('api/*') || $request->is('mobile-api/*')) {
            return true;
        } elseif($request->isJson()) {
            return true;
        }

        return false;
    }
}
