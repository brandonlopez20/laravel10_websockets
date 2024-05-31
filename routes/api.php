<?php

use App\Http\Controllers\TestController;
use App\Http\Requests\UserRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\ValidationException;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


// Route::post('/formulario', function (Request $request) {
//     try {
//         $request->validate([
//             'name' => 'required|min:5',
//         ]);

//         return response()->json(['success' => 'Form submitted successfully!']);
//     } catch (ValidationException $e) {
//         return back()->withErrors(['name' => 'The name is invalid']);
//     }
// })->name('form');


Route::post('/formulario', function (UserRequest $request) {

    return response()->json(['success' => 'Form submitted successfully!']);

})->name('form');


// Route::get('/messages', [TestController::class, 'index']);
Route::post('/messages', [TestController::class, 'store']);