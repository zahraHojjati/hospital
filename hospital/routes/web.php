<?php

use App\Http\Controllers\Admin\Auth\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Models\Notification;
use App\Models\Payment;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\OperationController;
use App\Http\Controllers\Admin\DoctorRoleController;
use App\Http\Controllers\Admin\SpecialitiesController;
use App\Http\Controllers\Admin\DoctorController;
use App\Http\Controllers\Admin\InsuranceController;
use App\Http\Controllers\Admin\SurgeryController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\LogActivityController;
use App\Http\Controllers\Admin\DoctorSurgeryController;
use App\Http\Controllers\Admin\InvoiceController;
use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\Admin\NotificationController;
use App\Http\Controllers\Admin\ReportController;
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

//login
Route::middleware(['guest'])->name('admin.')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login.form');
    Route::post('/login', [AuthController::class, 'login'])->name('login');
});

//logout
Route::middleware(['auth'])->name('admin.')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

//dashboard
Route::middleware(['auth'])->name('admin.')->prefix("/admin")->group(function () {
    Route::get('/', [DashboardController::class, "index"])->name('dashboard.index');
    //users
//    Route::middleware(['role:super-admin'])->group(function (){
        //users
        Route::resource('/users',UserController::class);
        //operations
        Route::resource('/operations',OperationController::class)->except('show');
        //doctorRole
        Route::resource('/doctorRoles',DoctorRoleController::class)->except('show');
        //specialities
        Route::resource('/specialities',SpecialitiesController::class)->except('show');
        //doctors
        Route::resource('/doctors',DoctorController::class);
        //insurances
        Route::resource('/insurances',InsuranceController::class)->except('show');
        //surgeries
        Route::resource('/surgeries',SurgeryController::class);
        //LogActivity
        Route::get('/LogActivity',[LogActivityController::class, 'index'])->name('LogActivity.index');
        //paymentDoctor
        Route::resource('/paymentDoctor',DoctorSurgeryController::class);
        //invoice
        Route::resource('/invoices',InvoiceController::class);
        //payment
        Route::get('/payments',[PaymentController::class, 'index'])->name('payments.index');
        Route::get('/payments/{payment}',[PaymentController::class, 'show'])->name('payments.show');
        Route::get('/invoices/{invoice}/payment/create',[PaymentController::class ,'create'])->name('payments.create');
        Route::post('/invoices/{invoice}/payment', [PaymentController::class, 'store'])->name('payments.store');
        Route::get('/payments/{payment}/edit',[PaymentController::class, 'edit'])->name('payments.edit');
        Route::patch('/payments/{payment}',[PaymentController::class,'update'])->name('payments.update');
        Route::delete('/payments/{payment}', [PaymentController::class, "delete"])->name('payments.destroy');
//        Route::resource('/payments',PaymentController::class);
        //setting
        Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');
        Route::get('/settings/{setting}', [SettingController::class, 'edit'])->name('settings.edit');
        Route::patch('/settings', [SettingController::class, 'update'])->name('settings.update');
        Route::delete('/settings/{setting}/file', [SettingController::class, 'destroyFile'])->name('settings.destroy.file');
        //notifications
        Route::get('/notifications',[NotificationController::class,'index'])->name('notifications.index');
        Route::get('/notifications/{notification}',[NotificationController::class,'show'])->name('notifications.show');
        //reportsDoctor
        Route::get('/doctorReports',[ReportController::class,'index'])->name('doctorReports.index');
        Route::get('/doctorReport',[ReportController::class,'show'])->name('doctorReport.show');
        //reportInsurance
        Route::get('/insuranceReports',[ReportController::class,'insuranceIndex'])->name('insuranceReports.index');
        Route::get('/insuranceReport',[ReportController::class,'insuranceShow'])->name('insuranceReports.show');
        Route::post('/get-insurances',[ReportController::class,'getInsurances'])->name('get.insurances');
        //doctorSurgery
//        Route::get('/doctorsFilter',[DoctorSurgeryController::class, 'filter'])->name('doctorFilter.index');
//        Route::get('/paymentDoctorShow/{id}',[DoctorSurgeryController::class, 'show'])->name('paymentDoctor.show');
//        Route::get('/paymentDoctorCreate',[DoctorSurgeryController::class, 'create'])->name('paymentDoctor.create');
//        Route::post('/paymentDoctorStore',[DoctorSurgeryController::class, 'store'])->name('paymentDoctor.store');

        //operation
//        Route::get('/',[OperationController::class, 'index'])->middleware(['can:view operations'])->name('operations.index');
//        Route::get('/create',[OperationController::class ,'create'])->name('operations.create');
//        Route::post('/', [OperationController::class, 'store'])->middleware('can:create operations')->name('operations.store');
//        Route::get('/{operation_id}/edit',[OperationController::class, 'edit'])->name('operations.edit');
//        Route::put('/{operation_id}',[OperationController::class,'update'])->middleware('can:update operations')->name('operations.update');
//        Route::delete('/{operation_id}', [OperationController::class, "delete"])->middleware('can:delete operations')->name('operations.destroy');
//    });
//
});

Route::get('/test',function (){
    $cheques = Payment::query()
        ->where('pay_type', '=','cheque')
        ->where('due_date', '<=', Carbon::now()->addDays(3))
        ->where('status','=',1)
//            ->whereNull('notified_at')
        ->where('notified_at', '=' ,null)
        ->get();

    foreach ($cheques as $cheque)
    {
        Notification::create([
            'title' => "موعد پرداخت چک با شناسه $cheque->id",
            'body' => "چک با شناسه پرداخت $cheque->id در تاریخ $cheque->due_date تاریخ سررسید آن است  ",
            'viewed_at' => null,
        ]);
        $cheque->update([
            'notified_at'
        ]);
    }
});
