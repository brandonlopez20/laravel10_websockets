<?php

use App\Http\Controllers\TestController;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Welcome');
})->name('home');

Route::get('/about', function () {
    return Inertia::render('About');
});

Route::get('/usa', function () {
    return Inertia::render('Usa');
});

Route::get('/hight', function () {
    return Inertia::render('HightGuate');
});

Route::get('/socket', function () {
    return Inertia::render('Socket');
});

Route::get('/form', function () {
    return Inertia::render('Form', [
        'title' => 'Formulario',
        'description' => 'This is the form page',
    ]);
});


Route::post('/formulario', function (UserRequest $request) {
    return to_route('home')->with('message', 'Sección Flash de '.$request->name);
})->name('form');



Route::get('/event',[TestController::class, 'TestEvent']);

//LOGIN
Route::get('/login',[TestController::class, 'LoginView']);
Route::post('/login',[TestController::class, 'LoginStore']);