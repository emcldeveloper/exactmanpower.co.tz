<?php

namespace App\Modules\Permissions\app\Controllers;

class Controller extends \App\Http\Controllers\Controller
{
    public $api = false;

    public function __construct() {
        $this->middleware([\App\Modules\Permissions\app\Middleware\PermissionsMiddleware::class]);

        view()->addNamespace('permissions', app_path('Modules/Permissions/app/views'));

        $request = request();

        if($request->is('api/*') || $request->is('mobile-api/*')) {
            $this->api = true;
        }
    }
}
