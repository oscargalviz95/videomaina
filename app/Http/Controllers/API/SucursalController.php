<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as BaseController;
use App\Http\Resources\SucursalResource;
use App\Models\Sucursal;
use Illuminate\Http\Request;
use Validator;


class SucursalController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sucursales = Sucursal::all();

        return $this->sendResponse(new SucursalResource($sucursales),'Sucursales encontradas');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $inputs = $request->all();

        $validator = Validator::make($inputs,[
            'id' => 'required',
            'direccion' => 'required',
            'telefono' => 'required',
            'nombreAdministrador' => 'required',
            'cedulaAdministrador' => 'required'
        ]);

        if($validator->fails()){
            return $this->sendError($validator->errors());       
        }

        $sucursal = Sucursal::create($inputs);

        $sucursal->id = $sucursal->id;

        return $this->sendResponse(new SucursalResource($sucursal),'Sucursal creada');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $sucursal = Sucursal::find($id);

        if(is_null($sucursal)){
            return $this->sendError("Sucursal no existe.");
        }

        return $this->sendResponse(new SucursalResource($sucursal),'Sucursal encontrada');
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $sucursal = Sucursal::find($id);

        if(is_null($sucursal)){
            return $this->sendError("Sucursal no existe.");
        }

        $inputs = $request->all();

        $validator = Validator::make($inputs,[
            'direccion' => 'required',
            'telefono' => 'required',
            'nombreAdministrador' => 'required',
            'cedulaAdministrador' => 'required'
        ]);

        if($validator->fails()){
            return $this->sendError($validator->errors());       
        }

    
       $sucursal->update($inputs);

        return $this->sendResponse(new SucursalResource($sucursal), 'Sucursal actualizada.');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        $sucursal = Sucursal::find($id);

        if(is_null($sucursal)){
            return $this->sendError("Sucursal no existe.");
        }

        $sucursal->delete();

        return $this->sendResponse([],'Sucursal eliminada.');

    }
}
