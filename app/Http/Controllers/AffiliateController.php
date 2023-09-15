<?php

namespace App\Http\Controllers;

use App\Models\Affiliate;
use Illuminate\Http\Request;

class AffiliateController extends Controller
{

    function index() {
        $models = Affiliate::orderBy('created_at', 'DESC')
                                ->get();
        return response()->json(['models' => $models], 200);
    }

    function store(Request $request) {
        $model = Affiliate::create([
            'name'          => ucwords(strtolower($request->name)),
            'dni'           => $request->dni,
            'sex'           => $request->sex,
            'birth_year'    => $request->birth_year,
            'birth_place'   => ucwords(strtolower($request->birth_place)),
            'dni_address'   => ucwords(strtolower($request->dni_address)),
            'dni_city'      => ucwords(strtolower($request->dni_city)),
            'phone'         => $request->phone,
            'email'         => $request->email,
            'estado_civil'  => $request->estado_civil,
            'profesion'     => $request->profesion,
            'contacto'      => $request->contacto,
            'departament_id'=> $request->departament_id,
        ]);
        return response()->json(['model' => $model], 201); 
    }

    function update(Request $request) {
        $model = Affiliate::find($request->id);
        $model->name           = ucwords(strtolower($request->name));
        $model->dni            = $request->dni;
        $model->sex            = $request->sex;
        $model->birth_year     = $request->birth_year;
        $model->birth_place    = ucwords(strtolower($request->birth_place));
        $model->dni_address    = ucwords(strtolower($request->dni_address));
        $model->dni_city       = ucwords(strtolower($request->dni_city));
        $model->phone          = $request->phone;
        $model->email          = $request->email;
        $model->estado_civil   = $request->estado_civil;
        $model->profesion      = $request->profesion;
        $model->contacto       = $request->contacto;
        $model->departament_id = $request->departament_id;
        $model->save();
        return response()->json(['model' => $model], 201); 
    }

    function destroy($id) {
        $affiliate = Affiliate::find($id);
        $affiliate->delete();
        return response(null, 200);
    }

}


