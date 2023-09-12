<?php

namespace App\Http\Controllers\CommonLaravel;

use App\Http\Controllers\Controller;
use App\Http\Controllers\CommonLaravel\Helpers\GeneralHelper;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;

class ImageController extends Controller
{

    function uploadImage(Request $request) {
        $image_url = $request->file('image')->store('public');
        $image_url = substr($image_url, 7);
        $image_url = $this->getFullImageUrl($image_url);
        $image_model = $this->setModelProp($request, $image_url);
        return response()->json(['image_url' => $image_url, 'image_model' => $image_model]);
    }

    function setImage(Request $request, $prop_name) {
        $manager = new ImageManager();
        $croppedImage = $manager->make($request->image_url);              
        $croppedImage->crop($request->width, $request->height, $request->left, $request->top);
        if ($request->model_name == 'user') {
            $image_url = time().rand(1, 100000).'.png';
        } else {
            $image_url = time().rand(1, 100000).'.webp';
        }
        $croppedImage->save(storage_path().'/app/public/'.$image_url);

        // $model_name = GeneralHelper::getModelName($request->model_name);
        
        $image_url = $this->getFullImageUrl($image_url);

        $image_model = $this->setModelProp($request, $image_url);

        if (isset($request->image_url_to_delete)) {
            Self::deleteImage($request->image_url_to_delete);
        }
        
        return response()->json(['model' => $this->fullModel($request->model_name, $request->model_id), 'image_url' => $name, 'image_model' => $image_model], 200);
    }

    function getFullImageUrl($image_url) {
        if (env('APP_ENV') == 'local') {
            $image_url = env('APP_URL').'/storage/'.$image_url;
        } else {
            $image_url = env('APP_URL').'/public/storage/'.$image_url;
        }
        return $image_url;
    }

    function setModelProp($request, $image_url) {
        $model_name = GeneralHelper::getModelName($request->model_name);
        $model = $model_name::find($request->model_id);
        $image_model = null;
        if ($request->prop_name == 'has_many') {
            $image_model = Image::create([
                env('IMAGE_URL_PROP_NAME', 'image_url')     => $image_url,
                'imageable_id'                              => !is_null($model) ? $request->model_id : null,
                'imageable_type'                            => $request->model_name,
                'temporal_id'                               => $this->getTemporalId($request),
            ]);
        } else {
            if (!is_null($request->model_id)) {
                $this->deleteImageProp($request->model_name, $request->model_id, $request->prop_name);
                if (!is_null($model)) {
                    $model->{$request->prop_name} = $image_url;
                    $model->save();
                }
            } 
        }
        return $image_model;
    }

    function deleteImageProp($_model_name, $id, $prop_name = 'image_url') {
        $model_name = GeneralHelper::getModelName($_model_name);
        $model = $model_name::find($id);
        if (!is_null($model) && !is_null($model->{$prop_name})) {
            Self::deleteImage($model->{$prop_name});
            $model->{$prop_name} = null;
            $model->save();
        }
        return response()->json(['model' => $this->fullModel($_model_name, $id)], 200);
    }

    function deleteImageModel($model_name, $model_id, $image_id) {
        $image = Image::find($image_id);
        $image_name = $image->{env('IMAGE_URL_PROP_NAME', 'image_url')};
        $array = explode('/', $image_name);
        $image_name = $array[count($array)-1];
        Log::info('Eliminando imagen: '.$image_name);
        Storage::disk('public')->delete($image_name);
        $image->delete();
        return response()->json(['model' => $this->fullModel($model_name, $model_id)], 200);
    }

    static function deleteModelImages($model) {
        foreach ($model->getAttributes() as $prop => $_prop) {
            if (substr($prop, 0, 4) == 'foto' || substr($model->{$prop}, 0, 5) == 'image') {
                Self::deleteImage($model->{$prop});
            }
        }
    }

    static function deleteImage($prop_value) {
        $storage_name = explode('/', $prop_value);
        $storage_name = $storage_name[count($storage_name)-1];
        Storage::disk('public')->delete($storage_name);
    }
}
