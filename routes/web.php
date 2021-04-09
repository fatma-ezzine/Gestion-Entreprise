<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FullCalenderController;
use App\Http\Controllers\DemandeController;
use App\Http\Controllers\MailController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('full-calender', [FullCalenderController::class, 'index']);
Route::post('full-calender/action', [FullCalenderController::class, 'action']);
Route::get('send-mail','MailSend@mailsend');
Route::get('/send-email',[MailController::class,'sendEmail']);
//Route::get('/demande', [DemandeController::class, 'show']);
