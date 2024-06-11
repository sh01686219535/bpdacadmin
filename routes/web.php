<?php

use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DefaultController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\OurTeamController;
use App\Http\Controllers\QuestionnairesController;
use Illuminate\Support\Facades\Route;


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

Route::redirect('/','dashboard');
Route::match(['get','post'],'/register',[AdminAuthController::class,'register'])->name('register');
Route::match(['get','post'],'/login',[AdminAuthController::class,'login'])->name('login');
Route::match('get','/logout',[AdminAuthController::class,'logout'])->name('admin.logout');



Route::group(['middleware' => ['adminAuth']], function () {
    Route::match(['get'],'/dashboard',[DashboardController::class,'dashboard'])->name('admin.dashboard');
    //user
    Route::match(['get'],'/user_all',[UserController::class,'userAll'])->name('user_all');
    Route::match(['get'],'/user_create',[UserController::class,'user_create'])->name('user_create');
    Route::match(['get'],'/user_approve',[UserController::class,'userApprove'])->name('user_approve');
    Route::match(['get','post'],'/user_delete/{id}',[UserController::class,'userDelete'])->name('user_delete');
    Route::match(['get','post'],'/user_approve_details/{id}',[UserController::class,'userApproveDetails'])->name('user_approve_details');
    Route::match(['post'],'/add-user',[UserController::class,'addUser'])->name('add.user');
    Route::match(['post'],'/user/disable/{id}',[UserController::class,'userDisable'])->name('user.disable');
    Route::match(['post'],'/user/enable/{id}',[UserController::class,'userEnable'])->name('user.enable');
    Route::match(['get','post'],'/user/edit/{id}',[UserController::class,'userEdit'])->name('user_edit');

    //event
    Route::match(['get','post'],'/eventCreate',[EventController::class,'eventCreate'])->name('eventCreate');
    Route::match(['get'],'/event',[EventController::class,'event'])->name('event');
    Route::match(['get'],'/event_user',[EventController::class,'event_user'])->name('event_user');
    Route::match(['get'],'/event_delete/{id}',[EventController::class,'event_delete'])->name('event_delete');
    Route::match(['get','post'],'/event_edit/{id}',[EventController::class,'eventEdit'])->name('event_edit');

    //Attendance

    Route::match(['get'],'attendance/form',[AttendanceController::class,'showForm'])->name('attendance.form');
    Route::post('/store.attendance',[AttendanceController::class,'storeAttendance'])->name('store.attendance');

    // Route::post('present-user/{id}', [AttendanceController::class, 'presentUser'])->name('present-user');
    // Route::post('absent-user/{id}', [AttendanceController::class, 'absentUser'])->name('absent-user');
    Route::get('attendance-list', [AttendanceController::class, 'attendanceList'])->name('attendance.list');




    //ajax default controller
    Route::post('user-get', [DefaultController::class, 'userGet'])->name('user-get');
    Route::post('/get-user', [DefaultController::class, 'getUserData']);
    // contact us
    Route::match(['get'],'contactList',[ContactController::class,'contactList'])->name('contact.list');
    Route::match(['get','post'],'ourTeam',[OurTeamController::class,'ourTeam'])->name('ourTeam.create');
    Route::match(['get'],'ourTeamList',[OurTeamController::class,'ourTeamList'])->name('ourTeam.list');
    Route::match(['get','post'],'/ourTeam_edit/{id}',[OurTeamController::class,'ourTeam_edit'])->name('ourTeam_edit');
    Route::match(['get'],'/ourTeam_delete/{id}',[OurTeamController::class,'ourTeam_delete'])->name('ourTeam_delete');
    //questionaries
    Route::match(['get'],'questionnaires',[QuestionnairesController::class,'questionnaires'])->name('questionnaires.list');
    Route::match(['get'],'questionnairesDelete/{id}',[QuestionnairesController::class,'questionnairesDelete'])->name('questionnairesDelete.list');
    //user's Event
    Route::match(['get','post'],'/user-event-list',[EventController::class,'userEventList'])->name('user.event.list');
    Route::match(['get'],'/user-event-delete/{id}',[EventController::class,'userEventDelete'])->name('user_event_delete');
    Route::post('/getevent', [DefaultController::class, 'getevent']);
    Route::post('/getUserEvent', [DefaultController::class, 'getUserEvent']);
});
