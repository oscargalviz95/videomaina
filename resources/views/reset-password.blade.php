<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        *{
            font-family: 'Calibri';
        }
    </style>
</head>
<body style="padding-top: 5%;">
    <h1 style="text-align: center;">Reset tu contraseña:</h1>
    @if (session('status'))
        <div style="text-align: center">
            {{ session('status') }}
        </div>
    @endif

    @if($errors->any())
        <div style="text-align: center">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('password.update') }}" style="width: 50%; margin:auto;">
        @csrf
    
        <input type="hidden" name="token" value="{{ $token }}">
        <input type="hidden" name="email" value="{{ $email }}">
    
        <div style="margin-bottom: 1rem;">
            <label for="password" style="display: block; font-weight: bold;">Nueva Contraseña</label>
            <input id="password" type="password" name="password" required style="padding: 0.5rem; border-radius: 4px; border: 1px solid #ccc; width: 100%;">
        </div>
    
        <div style="margin-bottom: 1rem;">
            <label for="password_confirmation" style="display: block; font-weight: bold;">Confirmar Contraseña</label>
            <input id="password_confirmation" type="password" name="password_confirmation" required style="padding: 0.5rem; border-radius: 4px; border: 1px solid #ccc; width: 100%;">
        </div>
    
        <div>
            <button type="submit" style="padding: 0.5rem 1rem; background-color: #007bff; color: #fff; border: none; border-radius: 4px; cursor: pointer;">Restablecer Contraseña</button>
        </div>
    </form>
</body>
</html>