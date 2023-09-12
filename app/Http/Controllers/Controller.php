<?php

namespace App\Http\Controllers;

use App\Http\Controllers\CommonLaravel\Helpers\GeneralHelper;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    function userId() {
        if (Auth::check()) {
            return Auth::id();
        } 
        return null;
    }

    function fullModel($model_name, $id) {
        $model_name = GeneralHelper::getModelName($model_name);
        $model = $model_name::where('id', $id)
                        ->withAll()
                        ->first();
        return $model;
    }

    function getTemporalId($request) {
        if (is_null($request->model_id)) {
            return time().rand(0, 9999);
        }
        return null;
    }
}
