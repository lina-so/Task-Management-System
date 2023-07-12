<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Response;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrap();

        // macro
        Response::macro('success',function($data,$massage){
            return response()->json([
                'success'=>true,
                'code' => 200,
                'data'=>$data,
                'message' => $massage,
                // 'meta' => $data->links()
            ]);
        });

        Response::macro('error',function($message, $status_code = 400){
            return response()->json([
                'success'=>false,
                'error' => [
                    'message' => $message,
                    'status_code' => $status_code
                ]
            ], $status_code);
        });


    }




}
