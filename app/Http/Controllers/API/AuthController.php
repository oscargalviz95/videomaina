<?php
   
namespace App\Http\Controllers\API;
   
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Support\Facades\Auth;
use Validator;
use App\Models\User;
use Illuminate\Support\Facades\Password;

class AuthController extends BaseController
{
    public function signin(Request $request)
    {
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){ 
            $authUser = Auth::user(); 
            $success['token'] =  $authUser->createToken('MyAuthApp')->plainTextToken; 
            $success['name'] =  $authUser->name;
   
            return $this->sendResponse($success, 'Usuario login');
        } 
        else{ 
            return $this->sendError('No autorizado.', ['error'=>'No autorizado']);
        } 
    }
    public function signup(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'confirm_password' => 'required|same:password',
            'estado' => 'required',
            'nombre' => 'required',
            'direccion' => 'required',
            'telefono' => 'required',
            'numTarjeta' => 'required',
            'tipoSocio' => 'required'
        ]);
   
        if($validator->fails()){
            return $this->sendError('Error de validación', $validator->errors());       
        }
   
        $input = $request->all();
        
        $input['password'] = bcrypt($input['password']);

        $user = User::create($input);
        $success['token'] =  $user->createToken('MyAuthApp')->plainTextToken;
        $success['name'] =  $user->name;
   
        return $this->sendResponse($success, 'Usuario creado.');
    }

    public function signout(Request $request)
    {
        
        $request->user()->currentAccessToken()->delete();

        return $this->sendResponse(null, 'Sesión cerrada correctamente.');
    }

    public function forgotPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Error de validación', $validator->errors());
        }

        $status = Password::sendResetLink(
            $request->only('email')
        );

        if ($status === Password::RESET_LINK_SENT) {
            return $this->sendResponse([], 'Correo de recuperación de contraseña enviado.');
        } else {
            return $this->sendError('Error al enviar el correo de recuperación de contraseña.', [], 500);
        }
    }
   
}