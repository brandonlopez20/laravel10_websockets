<?php

namespace App\Http\Controllers;

use App\Events\TestEvent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class TestController extends Controller
{
    
    
    public function TestEvent(Request $request){
        $queryData = $request->query('data');
        broadcast(new TestEvent($queryData));
        return Inertia::render('TestEvent', [
            'queryData' => $queryData,
        ]);
    }

    public function index(){
        event(new TestEvent('test'));
        return Inertia::render('TestEvent');
    }
    public function store(Request $request){
        $message = $request->message;
        $user = $request->user;
        broadcast(new TestEvent([
            'user' => $user,
            'message' => $message,
            'id' => date('Y-m-d H:i:s')
        ]));
        return response()->json(['status' => 'Message Sent!']);
    }
    


    public function LoginStore(Request $request){
        $credentials = $request->only('email', 'password');
    
        if (Auth::attempt($credentials)) {
            return response()->json(['message' => 'Inicio de sesión exitoso']);
        }
    
        return response()->json(['message' => 'Credenciales incorrectas'], 401);
    }

    public function LoginView(Request $request){
        return Inertia::render('Login');
    }
}
