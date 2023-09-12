<?php

namespace App\Http\Controllers;

use App\Http\Controllers\CommonLaravel\ImageController;
use App\Models\Departament;
use Illuminate\Http\Request;

class DepartamentController extends Controller
{

    public function index() {
        $models = Departament::orderBy('name', 'ASC')
                            ->withAll()
                            ->get();
        return response()->json(['models' => $models], 200);
    }

    public function store(Request $request) {
        $model = Departament::create([
            'name'                  => $request->name,
        ]);
        // $this->sendAddModelNotification('Departament', $model->id);
        return response()->json(['model' => $this->fullModel('Departament', $model->id)], 201);
    }  

    public function show($id) {
        return response()->json(['model' => $this->fullModel('Departament', $id)], 200);
    }

    public function update(Request $request, $id) {
        $model = Departament::find($id);
        $model->name                = $request->name;
        $model->save();
        // $this->sendAddModelNotification('Departament', $model->id);
        return response()->json(['model' => $this->fullModel('Departament', $model->id)], 200);
    }

    public function destroy($id) {
        $model = Departament::find($id);
        ImageController::deleteModelImages($model);
        $model->delete();
        $this->sendDeleteModelNotification('Departament', $model->id);
        return response(null);
    }
}
