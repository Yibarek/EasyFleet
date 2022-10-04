<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers;
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
    return view('wellcome');
});

Auth::routes();

Route::get('/home', [Controllers\HomeController::class, 'index'])->name('home');

Route::get('/users', [Controllers\userController::class, 'list']);
Route::get('/addUser', function () {return view('user.addUser');});
Route::post('/addDriverInfo', function () {return view('user.addDriverInfo');});
Route::post('/addNewUser', [Controllers\userController::class, 'add']);
Route::post('/addDriver/{id}/{password}', [Controllers\userController::class, 'addDriver']);
Route::get('/editUser/{id}', [Controllers\userController::class, 'editUser']);
Route::post('/updateUser/{id}', [Controllers\userController::class, 'updateUser']);
Route::get('/deleteUser/{id}', [Controllers\userController::class, 'delete']);
Route::get('/searchUser/{input?}', [Controllers\userController::class, 'searchUser']);

Route::get('/vehicles', [Controllers\vehicleController::class, 'list']);
Route::get('/addVehicle', function () {return view('vehicle.addVehicle');});
Route::post('/addNewVehicle', [Controllers\vehicleController::class, 'add']);
Route::get('/editVehicle/{id}', [Controllers\vehicleController::class, 'editVehicle']);
Route::post('/updateVehicle/{id}', [Controllers\vehicleController::class, 'updateVehicle']);
Route::get('/deleteVehicle/{id}', [Controllers\vehicleController::class, 'delete']);
Route::get('/searchVehicle/{input?}', [Controllers\vehicleController::class, 'searchVehicle']);

Route::get('/schedules', [Controllers\scheduleController::class, 'list']);
Route::get('/addSchedule', [Controllers\scheduleController::class, 'addSchedule']);
Route::post('/addNewSchedule', [Controllers\scheduleController::class, 'add']);
Route::get('/editSchedule/{id}', [Controllers\scheduleController::class, 'editSchedule']);
Route::post('/updateSchedule/{id}', [Controllers\scheduleController::class, 'updateSchedule']);
Route::get('/deleteSchedule/{id}', [Controllers\scheduleController::class, 'delete']);
Route::get('/searchSchedule/{input?}', [Controllers\scheduleController::class, 'searchSchedule']);

Route::get('/maintenance', [Controllers\maintenanceController::class, 'list']);
Route::get('/requestMaintenance', function () {return view('maintenance.requestMaintenance');});
Route::post('/addMaintenance', [Controllers\maintenanceController::class, 'add']);
Route::get('/editMaintenance/{id}', [Controllers\maintenanceController::class, 'editMaintenance']);
Route::post('/updateMaintenance/{id}', [Controllers\maintenanceController::class, 'update']);
Route::get('/deleteMaintenance/{id}', [Controllers\maintenanceController::class, 'delete']);
Route::get('/acceptMaintenance/{id}', [Controllers\maintenanceController::class, 'accept']);
Route::get('/rejectMaintenance/{id}', [Controllers\maintenanceController::class, 'reject']);
Route::get('/countPendingMaintenance', [Controllers\maintenanceController::class, 'countPendingMaintenance']);
Route::get('/searchMaintenance/{input?}', [Controllers\maintenanceController::class, 'searchMaintenance']);

Route::get('/exitRequest', [Controllers\requestController::class, 'list']);
Route::get('/requestExit', function () {return view('exitRequest.addRequest');});
Route::post('/addRequest', [Controllers\requestController::class, 'add']);
Route::get('/editRequest/{id}', [Controllers\requestController::class, 'editRequest']);
Route::post('/updateRequest/{id}', [Controllers\requestController::class, 'update']);
Route::get('/deleteRequest/{id}', [Controllers\requestController::class, 'delete']);
Route::get('/acceptRequest/{id}', [Controllers\requestController::class, 'accept']);
Route::get('/rejectRequest/{id}', [Controllers\requestController::class, 'reject']);
Route::get('/countPendingRequest', [Controllers\requestController::class, 'countPendingRequest']);
Route::get('/searchRequest/{input?}', [Controllers\requestController::class, 'searchRequest']);

Route::get('/feedbacks', [Controllers\feedbackController::class, 'list']);
Route::post('/sendFeedback', [Controllers\feedbackController::class, 'sendFeedback']);
Route::get('/readFeedback/{id}', [Controllers\feedbackController::class, 'readFeedback']);
Route::get('/countUncheckedFeedback', [Controllers\feedbackController::class, 'countUncheckedFeedback']);
Route::get('/searchFeedback/{input?}', [Controllers\feedbackController::class, 'searchFeedback']);

Route::get('/profile', function () {return view('user.profile');});
Route::get('/password', function () {return view('user.password');});
Route::post('/changePassword', [Controllers\userController::class, 'changePassword']);
Route::get('/userProfile/{id}', [Controllers\userController::class, 'userProfile']);

Route::post('/generateReport', [Controllers\reportController::class, 'generateReport']);
