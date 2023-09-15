<?php

namespace App\Http\Controllers;

use App\Http\Controllers\CommonLaravel\ImageController;
use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{

    public function index() {
        $models = Blog::orderBy('created_at', 'DESC')
                        ->withAll()
                        ->get();
        return response()->json(['models' => $models], 200);
    }

    public function store(Request $request) {
        $model = Blog::create([
            'title'                 => $request->title,
            'image_url'             => $request->image_url,
            'content'               => $request->content,
            'read_time'             => $request->read_time,
            'facebook'              => $request->facebook,
            'twitter'               => $request->twitter,
            'instagram'             => $request->instagram,
        ]);
        // $this->sendAddModelNotification('Blog', $model->id);
        return response()->json(['model' => $model], 201);
    }  

    public function show($id) {
        return response()->json(['model' => $this->fullModel('Blog', $id)], 200);
    }

    public function update(Request $request, $id) {
        $model = Blog::find($id);
        $model->title                 = $request->title;
        $model->image_url             = $request->image_url;
        $model->content               = $request->content;
        $model->read_time             = $request->read_time;
        $model->facebook              = $request->facebook;
        $model->twitter               = $request->twitter;
        $model->instagram             = $request->instagram;
        $model->save();
        // $this->sendAddModelNotification('Blog', $model->id);
        return response()->json(['model' => $model], 200);
    }

    public function destroy($id) {
        $model = Blog::find($id);
        ImageController::deleteModelImages($model);
        $model->delete();
        // $this->sendDeleteModelNotification('Blog', $model->id);
        return response(null);
    }
}
