<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Auth\AuthenticationException;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
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
    public function report(Exception $exception)
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
    public function render($request, Exception $exception)
    {
        return parent::render($request, $exception);
    }

    protected function unauthenticated($request, AuthenticationException $exception)
    {
//        dd($request->expectsJson());
        if($request->expectsJson()){
//            return response(['code'=>'001','msg'=>'没权限']);
            return response()->json(['message' => $exception->getMessage()], 401);
        }else{
            switch ($exception->guards()[0]){
                case 'admin':
                    return redirect()->guest('/admin/login');
                case 'university':
//                    return response(['code'=>'001','msg'=>'没权限']);
                    if ($request->source){
                        return redirect()->guest('/university/quickLogin?source='.$request->source.'&yid='.$request->id);
                    }else{
                        return redirect()->guest('/university/quickLogin');
                    }

//                    break;
                default:
                    return redirect()->guest('login');
            }
//            dd($exception->guards());
//            return in_array('admin', $exception->guards()) ? redirect()->guest('/admin/login') : redirect()->guest('login');
//            echo '1 <br>';
//            return redirect()->guest('admin/login');
        }
    }
}
