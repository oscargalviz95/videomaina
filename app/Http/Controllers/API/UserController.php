<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as BaseController;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Validator;

class UserController extends BaseController
{
   /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();

        return $this->sendResponse(new UserResource($users),'Usuarios encontrados');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $inputs = $request->all();

        $validator = Validator::make($inputs,[
            'id' => 'required',
            'name' => 'required',
            'estado' => 'required',
            'nombre' => 'required',
            'direccion' => 'required',
            'telefono' => 'required',
            'numTarjeta' => 'required',
            'tipoSocio' => 'required'
        ]);

        if($validator->fails()){
            return $this->sendError($validator->errors());       
        }

        $user = User::create($inputs);

        $user->id = $user->id;

        return $this->sendResponse(new UserResource($user),'Usuario creado');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $usuario = User::find($id);

        if(is_null($usuario)){
            return $this->sendError("Usuario no existe.");
        }

        return $this->sendResponse(new UserResource($usuario),'Usuario encontrado');
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $usuario = User::find($id);

        if(is_null($usuario)){
            return $this->sendError("Usuario no existe.");
        }

        $inputs = $request->all();

        $validator = Validator::make($inputs,[
            'name' => 'required',
            'estado' => 'required',
            'nombre' => 'required',
            'direccion' => 'required',
            'telefono' => 'required',
            'numTarjeta' => 'required',
            'tipoSocio' => 'required'
        ]);

        if($validator->fails()){
            return $this->sendError($validator->errors());       
        }

    
       $usuario->update($inputs);

        return $this->sendResponse(new UserResource($usuario), 'Usuario actualizado.');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        $usuario = User::find($id);

        if(is_null($usuario)){
            return $this->sendError("Usuario no existe.");
        }

        $usuario->delete();

        return $this->sendResponse([],'Usuario eliminado.');

    }
}
