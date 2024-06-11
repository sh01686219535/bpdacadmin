<?php

use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::post('/eventRegister',[ApiController::class,'eventRegister'])->name('eventRegister');
Route::get('/getEventRegister',[ApiController::class,'getEventRegister'])->name('getEventRegister');
Route::post('/userRegister',[ApiController::class,'userRegister'])->name('userRegister');
Route::post('/userLogin',[ApiController::class,'userLogin'])->name('userLogin');
Route::get('/eventData',[ApiController::class,'eventData'])->name('eventData');

//email verification
Route::match('get','/verify/{email}/{code}',[ApiController::class,'verify'])->name('user.verify');
Route::get('/event_user_counts',[ApiController::class,'event_user_counts']);
Route::get('/userData',[ApiController::class,'userData'])->name('userData');
Route::group(['middleware' => ['jwtAuth']], function () {
    Route::get('profileProgress',[ApiController::class,'profileProgress']);
    Route::post('userUpdate',[ApiController::class,'userUpdate']);
});

Route::post('sendPasswordResetLink','App\Http\Controllers\ApiController@sendEmail');
Route::post('resetPassword', 'App\Http\Controllers\ApiController@passwordResetProcess');
Route::post('/contact',[ApiController::class,'contact'])->name('contact');
Route::get('/ourTeam',[ApiController::class,'ourTeam'])->name('ourTeam');

Route::post('/Questionnaire',[ApiController::class,'Questionnaire'])->name('Questionnaire');
Route::get('/getQuestionnaire',[ApiController::class,'getQuestionnaire'])->name('getQuestionnaire');
Route::get('/userEvent',[ApiController::class,'userEvent'])->name('userEvent');
