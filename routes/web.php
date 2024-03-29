<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\Doctors_roleController;
use App\Http\Controllers\Admin\DoctorsController;
use App\Http\Controllers\Admin\DoctorSurgeryController;
use App\Http\Controllers\Admin\InsuranceController;
use App\Http\Controllers\Admin\InvoiceController;
use App\Http\Controllers\Admin\logActivityController;
use App\Http\Controllers\Admin\NotifyController;
use App\Http\Controllers\Admin\OperationsController;
use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\Admin\ReportDoctorsController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\SpecialtiesController;
use App\Http\Controllers\Admin\SurguriesController;
use App\Http\Controllers\Admin\UserController;
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

Route::get('/', function () {
    return view('welcome');
});

      //auth
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login.form');
    Route::post('/login', [AuthController::class, 'login'])->name('login');

    Route::middleware('auth')->name('admin.')->prefix('admin')->group(function () {
    
        //auth
        Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
        
        //Dashboard
        
        //settings
        Route::get('/settings',[SettingController::class,'edit'])->name('edit-setting');
        Route::patch('/settings/{setting}',[SettingController::class,'update'])->name('update-setting');
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
        
        //doctorSurgeries
        Route::get('/doctorSurgeries/filter', [DoctorSurgeryController::class, 'show'])->name('filter-doctor');
        Route::get('/doctorSurgeries/index', [DoctorSurgeryController::class, 'index'])->name('filter-index-surgeries');
        Route::post('/doctorSurgeries/index', [DoctorSurgeryController::class, 'store'])->name('invoice.store');
        
        //invoices
        Route::get('/invoices', [InvoiceController::class, 'index'])->name('invoice.index');
        Route::patch('/invoices/update/{invoice}', [InvoiceController::class, 'update'])->name('invoices.update');
        Route::get('/invoices/show/{id}', [InvoiceController::class, 'show'])->name('invoices.show');
        Route::delete('/invoices/destroy', [InvoiceController::class, 'destroy'])->name('invoices.destroy');
        
        //paymens
        Route::resource('/payments', PaymentController::class);
        
        //doctors
        Route::resource('/doctors', DoctorsController::class);

        //logActivitys
        Route::get('/logActivitys', [logActivityController::class, 'index'])->name('logActivitys');
        
        //surguries
        Route::resource('/surgeries', SurguriesController::class);
        
        //insurances
        Route::resource('/insurances', InsuranceController::class);
        
        //doctor_roles
        Route::get('/role_doctors', [Doctors_roleController::class, 'index'])->name('roles-doctor');
        Route::get('/role_doctors/create', [Doctors_roleController::class, 'create'])->name('role_doctors.create');
        Route::post('/role_doctors/create', [Doctors_roleController::class, 'store'])->name('role_doctors.store');
        Route::patch('/role_doctors/update/{id}', [Doctors_roleController::class, 'update'])->name('update-role_doctors');
        Route::delete('/role_doctors/destroy', [Doctors_roleController::class, 'destroy'])->name('destroy-role_doctors');
        
        //operations
        Route::get('/operations', [OperationsController::class, 'index'])->name('operations');
        Route::get('/operations/create', [OperationsController::class, 'create'])->name('operations.create');
        Route::post('/operations/create', [OperationsController::class, 'store'])->name('operations.store');
        Route::patch('/operations/update/{operation}', [OperationsController::class, 'update'])->name('operations.update');
        Route::delete('/operations/destroy', [OperationsController::class, 'destroy'])->name('operations.delete');
        
        //specialitys
        Route::get('/specialties', [SpecialtiesController::class, 'index'])->name('specialties');
        Route::post('/specialtie/create', [SpecialtiesController::class, 'create'])->name('create-specialties');
        Route::post('/specialties/create', [SpecialtiesController::class, 'store'])->name('add-specialties');
        Route::patch('/specialties/update/{specialtie}', [SpecialtiesController::class, 'update'])->name('update-specialties');
        Route::delete('/specialties/destroy', [SpecialtiesController::class, 'destroy'])->name('destroy-specialties');
        
        //reports
        Route::get('/report/doctors/filter', [ReportDoctorsController::class, 'show'])->name('filter-reports-doctor');
        Route::get('/report/doctors/index', [ReportDoctorsController::class, 'index'])->name('filter-index-reports');
        
        //notify
        Route::get('/notifications', [NotifyController::class, 'index'])->name('notify.index');
        Route::get('/notifications/show/{notification}', [NotifyController::class, 'show'])->name('notify.show');
        //users
        Route::middleware(['role:super_admin'])->group(function () {
            Route::resource('/users', UserController::class);
        });
    });