<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\JobsController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/Signup' , [UserController::class , 'store']);
Route::post('/Login' , [UserController::class , 'login']);
Route::post('/verifyemail' , [UserController::class , 'verifyemail']);
Route::post('/Jobproposal' , [JobsController::class , 'storeproposal']);
Route::post('/Jobposting' , [JobsController::class , 'storepost']);

Route::get('/Getjobsbyuserskills' , [JobsController::class , 'showbyskills']);
Route::get('/Gettalentsbyuserskills' , [JobsController::class , 'showtalentsbyskills']);



Route::get('/Getjobsbysearch' , [JobsController::class , 'showbysearch']);
Route::get('/Getjobsproposals' , [JobsController::class , 'showjobsproposal']);
Route::get('/Getjobspostedbyhirer' , [JobsController::class , 'showjobsbyhirerid']);

Route::get('/Getproposalsbyfreelancerid' , [JobsController::class , 'showjobsbyfreelancerid']);

Route::get('/Setstatus' , [JobsController::class , 'updateStatus']);

Route::get('/Deletepostjob' , [JobsController::class , 'Deletepostjob']);

//when click on a job
Route::get('/Getjobs/{index}' , [JobsController::class , 'show_precise']);
Route::get('/GetTalent/{index}' , [JobsController::class , 'show_talented']);



 
// http://127.0.0.1:8000/api/Getjobsbyuserskills