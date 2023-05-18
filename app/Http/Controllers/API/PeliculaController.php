<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as BaseController;
use App\Http\Resources\PeliculaResource;
use App\Models\Pelicula;
use Illuminate\Http\Request;
use Validator;

class PeliculaController extends BaseController{
   
    public function index()
    {
        $peliculas= Pelicula::all();

        return $this->sendResponse(new PeliculaResource($peliculas),'Peliculas encontradas');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $inputs = $request->all();

        $validator = Validator::make($inputs,[
            'codigoInventario' => 'required',
            'titulo' => 'required',
            'formato' => 'required',
            'precio' => 'required',
            'cantidad' => 'required'
        ]);

        if($validator->fails()){
            return $this->sendError($validator->errors());       
        }

        $pelicula = Pelicula::create($inputs);

        $pelicula->id = $pelicula->id;

        return $this->sendResponse(new PeliculaResource($pelicula),'Pelicula creada');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $pelicula = Pelicula::find($id);

        if(is_null($pelicula)){
            return $this->sendError("Pelicula no existe.");
        }

        return $this->sendResponse(new PeliculaResource($pelicula),'Pelicula encontrada');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $pelicula = Pelicula::find($id);

        if(is_null($pelicula)){
            return $this->sendError("Pelicula no existe.");
        }

        $inputs = $request->all();

        $validator = Validator::make($inputs,[
            'codigoInventario' => 'required',
            'titulo' => 'required',
            'formato' => 'required',
            'precio' => 'required',
            'cantidad' => 'required'
        ]);

        if($validator->fails()){
            return $this->sendError($validator->errors());       
        }

    
       $pelicula->update($inputs);

        return $this->sendResponse(new PeliculaResource($pelicula), 'Pelicula actualizada.');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        $pelicula = Pelicula::find($id);

        if(is_null($pelicula)){
            return $this->sendError("Pelicula no existe.");
        }

        $pelicula->delete();

        return $this->sendResponse([],'Pelicula eliminada.');

    }
}
