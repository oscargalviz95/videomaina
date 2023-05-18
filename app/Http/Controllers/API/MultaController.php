<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as BaseController;
use App\Http\Resources\MultaResource;
use App\Models\Multa;
use Illuminate\Http\Request;
use Validator;

class MultaController extends BaseController
{
    public function index()
    {
        $multas= Multa::with('usuario','pelicula')->get();

        return $this->sendResponse(new MultaResource($multas),'Multas encontradas');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $inputs = $request->all();

        $validator = Validator::make($inputs,[
            'fechaMulta' => 'required',
            'valor' => 'required',
            'saldo' => 'required',
            'pelicula_id' => 'required',
            'user_id' => 'required'
        ]);

        if($validator->fails()){
            return $this->sendError($validator->errors());       
        }

        $multa = Multa::create($inputs);

        $multa->id = $multa->id;

        return $this->sendResponse(new MultaResource($multa),'Multa creada');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $multa = Multa::find($id);

        if(is_null($multa)){
            return $this->sendError("Multa no existe.");
        }

        return $this->sendResponse(new MultaResource($multa),'Multa encontrada');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $multa = Multa::find($id);

        if(is_null($multa)){
            return $this->sendError("Multa no existe.");
        }

        $inputs = $request->all();

        $validator = Validator::make($inputs,[
            'fechaMulta' => 'required',
            'valor' => 'required',
            'saldo' => 'required',
            'pelicula_id' => 'required',
            'user_id' => 'required'
        ]);

        if($validator->fails()){
            return $this->sendError($validator->errors());       
        }

    
       $multa->update($inputs);

        return $this->sendResponse(new MultaResource($multa), 'Multa actualizada.');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        $multa = Multa::find($id);

        if(is_null($multa)){
            return $this->sendError("Multa no existe.");
        }

        $multa->delete();

        return $this->sendResponse([],'Multa eliminada.');

    }
}
