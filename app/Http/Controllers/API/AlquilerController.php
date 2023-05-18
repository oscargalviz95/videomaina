<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as BaseController;
use App\Http\Resources\AlquilerResource;
use App\Models\Alquiler;
use Illuminate\Http\Request;
use Validator;

class AlquilerController extends BaseController
{
    public function index()
    {
        $alquilar= Alquiler::with('usuario','pelicula','sucursal')->get();

        return $this->sendResponse(new AlquilerResource($alquilar),'Alquileres encontrados');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $inputs = $request->all();

        $validator = Validator::make($inputs,[
            'fechaAlquiler' => 'required',
            'fechaDevolucion' => 'required',
            'pelicula_id' => 'required',
            'sucursal_id' => 'required',
            'user_id' => 'required'
        ]);

        if($validator->fails()){
            return $this->sendError($validator->errors());       
        }

        $alquiler = Alquiler::create($inputs);

        $alquiler->id = $alquiler->id;

        return $this->sendResponse(new AlquilerResource($alquiler),'Alquiler creado');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $alquiler = Alquiler::find($id);

        if(is_null($alquiler)){
            return $this->sendError("Alquiler no existe.");
        }

        return $this->sendResponse(new AlquilerResource($alquiler),'Alquiler encontrada');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $alquiler = Alquiler::find($id);

        if(is_null($alquiler)){
            return $this->sendError("Alquiler no existe.");
        }

        $inputs = $request->all();

        $validator = Validator::make($inputs,[
            'fechaAlquiler' => 'required',
            'fechaDevolucion' => 'required',
            'pelicula_id' => 'required',
            'sucursal_id' => 'required',
            'user_id' => 'required'
        ]);

        if($validator->fails()){
            return $this->sendError($validator->errors());       
        }

    
       $alquiler->update($inputs);

        return $this->sendResponse(new AlquilerResource($alquiler), 'Alquiler actualizada.');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        $alquiler = Alquiler::find($id);

        if(is_null($alquiler)){
            return $this->sendError("Alquiler no existe.");
        }

        $alquiler->delete();

        return $this->sendResponse([],'Alquiler eliminada.');

    }
}
