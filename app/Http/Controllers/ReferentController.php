<?php

namespace App\Http\Controllers;

use App\Models\Referent;
use Illuminate\Http\Request;

class ReferentController extends Controller
{
    public function index() {
        $models = Referent::orderBy('city', 'ASC')
                            ->get();
        return response()->json(['models' => $models], 200);
    }

    public function store(Request $request) {
        $model = Referent::create([
            'position'      => $request->position,
            'city'          => $request->city,
            'name'          => $request->name,
            'whatsapp_link' => $request->whatsapp_link,
        ]);
        return response()->json(['model' => $model], 201);
    }

    public function update(Request $request, $id) {
        $model = Referent::find($id);
        $model->position        = $request->position;
        $model->city            = $request->city;
        $model->name            = $request->name;
        $model->whatsapp_link   = $request->whatsapp_link;
        $model->save();
        return response()->json(['model' => $model], 200);
    }

    function updateImage(Request $request, $id) {
        $model = Referent::find($id);
        $model->image_url = $request->image_url;
        $model->save();
        return response()->json(['model' => $model], 200);
    } 

    public function destroy($id) {
        $model = Referent::find($id);
        $model->delete();
        return response(null, 200);
    }
}
