<?php

use App\Http\Controllers\Admin\IndexController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\BreastfeedingAppointmentController;
use App\Http\Controllers\BreastfeedingWomanController;
use App\Http\Controllers\ChildController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DoctorBreastfeedingController;
use App\Http\Controllers\DoctorChildRecordController;
use App\Http\Controllers\DoctorChildrenController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\DoctorPregnantController;
use App\Http\Controllers\PregnantWomanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DoctorAppointmentController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\PregnantDashboardController;
use App\Http\Controllers\DoctorDashboardController;
use App\Http\Controllers\BreastfeedingDashboardController;
use App\Http\Controllers\AdminDashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChatController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
Route::middleware(['auth', 'verified', 'role:admin']) // Only for authenticated, verified, and admin role
    ->name('admin.')                                // Route names will be like admin.index, admin.roles.index
    ->prefix('admin')                               // URL will be like /admin/roles
    ->group(function () {
        Route::get('/', [IndexController::class, 'index'])->name('index'); // admin.index => /admin
        Route::get('/user-role-counts', [IndexController::class, 'getUserRoleCounts'])->name('user-role-counts');
        Route::resource('roles', RoleController::class);                   // admin.roles.*
        Route::resource('permissions', PermissionController::class);       // admin.permissions.*

        Route::post('/roles/{role}/permissions', [RoleController::class, 'givePermission'])->name('roles.permissions');
        Route::delete('/roles/{role}/permissions/{permission}', [RoleController::class, 'revokePermission'])->name('roles.permissions.revoke');
        Route::get('/users', [UserController::class, 'index'])->name('users.index');
        Route::get('users/{user}', [UserController::class, 'show'])->name('users.show');
        Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
        Route::post('permissions/{permission}/roles', [PermissionController::class, 'assignrole'])->name('permissions.roles');
        Route::delete('permissions/{permission}/roles/{role}', [PermissionController::class, 'removeRole'])->name('permissions.remove');
        Route::post('/users/{user}/roles', [UserController::class, 'assignRole'])->name('users.roles');
        Route::delete('/users/{user}/roles/{role}', [UserController::class, 'removeRole'])->name('users.roles.remove');
        Route::post('/users/{user}/permissions', [UserController::class, 'givePermission'])->name('users.permissions');
        Route::delete('/users/{user}/permissions/{permission}', [UserController::class, 'RevokePermission'])->name('users.permissions.revoke');
    });

// Add-User routes and the routes are
Route::get('/users/create', [UserController::class, 'create'])->name('admin.users.create');
Route::post('/users', [UserController::class, 'store'])->name('admin.users.store');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


// route zote za doctor na pregnant woman. hizi doctor ana manage pregnant details
Route::middleware('auth')->group(function () {
    Route::get('/doctor/pregnants', [DoctorPregnantController::class, 'index'])->name('doctor.pregnant.index');
    Route::get('/doctor/pregnant/create/{user_id}', [DoctorPregnantController::class, 'create'])->name('doctor.pregnant.create');
    Route::post('/doctor/pregnant/store/{user_id}', [DoctorPregnantController::class, 'store'])->name('doctor.pregnant.store');
    Route::get('/doctor/pregnant/show/{user_id}', [DoctorPregnantController::class, 'show'])->name('doctor.pregnant.show');
    Route::get('/doctor/pregnant/{id}/edit', [DoctorPregnantController::class, 'edit'])->name('doctor.pregnant.edit');
    Route::put('/doctor/pregnant/{id}', [DoctorPregnantController::class, 'update'])->name('doctor.pregnant.update');
    Route::delete('/doctor/pregnant/{id}', [DoctorPregnantController::class, 'destroy'])->name('doctor.pregnant.destroy');
});

// route zote za doctor na breastfeeding woman. hizi doctor ana manage breastfeeding  details
Route::middleware('auth')->group(function () {
    // hii inampeleka kwa doctor.pregnant-woman index
    Route::get('/doctor.breastfeeding', [DoctorBreastfeedingController::class, 'index'])->name('doctor.breastfeeding.index');
    Route::get('/doctor.breastfeeding/create/{user_id}', [DoctorBreastfeedingController::class, 'create'])->name('doctor.breastfeeding.create');
    Route::post('/doctor.breastfeeding/store/{user}', [DoctorBreastfeedingController::class, 'store'])->name('doctor.breastfeeding.store');
    Route::get('/doctor.breastfeeding/show/{user_id}', [DoctorBreastfeedingController::class, 'show'])->name('doctor.breastfeeding.show');
    Route::delete('/doctor.breastfeeding/delete/{id}', [DoctorBreastfeedingController::class, 'destroy'])->name('doctor.breastfeeding.destroy');
    Route::get('/doctor.breastfeeding/edit/{id}', [DoctorBreastfeedingController::class, 'edit'])->name('doctor.breastfeeding.edit');
    Route::put('/doctor.breastfeeding/update/{id}', [DoctorBreastfeedingController::class, 'update'])->name('doctor.breastfeeding.update');
});


// route zote za doctor na children. hizi doctor ana manage children details
Route::middleware('auth')->group(function () {
    // hii inampeleka kwa doctor.children index
    Route::get('/doctor.children', [DoctorChildrenController::class, 'index'])->name('doctor.children.index');
    Route::get('/children/create', [DoctorChildrenController::class, 'create'])->name('doctor.children.create');
    Route::post('/store', [DoctorChildrenController::class, 'store'])->name('doctor.children.store');
});


// hizi routes za doctor kuwezeshwa kupita kwenye dashboard za kila patient
Route::middleware('auth')->group(function () {
    // hii inampeleka kwenye doctor index (Dashboard)
    Route::get('/doctor.index', [DoctorController::class, 'index'])->name('doctor.index');
});


// and the system of the authoried user can the be related by  the authorized people of the system that cant  be manipulated by the authorized people  of the system it self


// Doctor Appointment Controller
Route::get('/doctor/appointments', [DoctorAppointmentController::class, 'index'])->name('doctor.appointments.index');




// route za pregnant woman kufikia view yake na kuona dashboard
Route::middleware('auth')->group(function () {
    Route::get('/pregnant.index', [PregnantWomanController::class, 'index'])->name('pregnant.index');
    Route::get('/pregnant.show', [PregnantWomanController::class, 'show'])->name('pregnant.show');
});


// route za breastfeeding woman kufikia view yake na kuona dashboard
Route::middleware(['auth'])->group(function () {
    Route::get('/breastfeeding/health-record', [BreastfeedingWomanController::class, 'index'])->name('breastfeeding.index');
    Route::get('/breastfeeding/show', [BreastfeedingWomanController::class, 'show'])->name('breastfeeding.show');
    Route::get('/breastfeeding/child', [BreastfeedingWomanController::class, 'childshow'])->name('breastfeeding.child.show');
});



// hii route inamanage records za mtoto wa kila pregnant woman
Route::middleware('auth')->group(function () {
    Route::get('/children/{child}/add-record', [DoctorChildRecordController::class, 'create'])->name('doctor.children.records.create');
    Route::post('/children/add-record', [DoctorChildRecordController::class, 'store'])->name('doctor.children.records.store');
    Route::get('/children/{child}/records', [DoctorChildRecordController::class, 'show'])->name('doctor.children.records.show');
    Route::get('/children/records/{id}/edit', [DoctorChildRecordController::class, 'edit'])->name('doctor.children.records.edit');
    Route::put('/children/records/{id}', [DoctorChildRecordController::class, 'update'])->name('doctor.children.records.update');
    Route::delete('/children/records/{id}', [DoctorChildRecordController::class, 'destroy'])->name('doctor.children.records.destroy');
});




Route::middleware('auth')->group(function(){
    Route::get('/appointments', [BreastfeedingAppointmentController::class, 'index'])->name('appointments.index');
    Route::get('/appointments/create', [BreastfeedingAppointmentController::class, 'create'])->name('appointments.create');
    Route::post('/appointments/store', [BreastfeedingAppointmentController::class, 'store'])->name('appointments.store');
    Route::get('/appointments/{appointment}', [BreastfeedingAppointmentController::class, 'show'])->name('appointments.show');
    Route::delete('/appointments/{appointment}', [BreastfeedingAppointmentController::class, 'destroy'])->name('appointments.destroy');
});
// dashboard routes
Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
Route::get('/admin/user-stats', [DashboardController::class, 'getUserStats']);

Route::middleware('auth')->group(function () {
    Route::get('/children.index', [ChildController::class, 'index'])->name('children.index');
});

//Feedback Controller
Route::middleware(['auth'])->group(function () {
    Route::get('/feedbacks', [FeedbackController::class, 'index'])->name('feedback.index');
    Route::delete('/feedbacks/{id}', [FeedbackController::class, 'destroy'])->name('feedback.destroy');
    Route::post('/feedback/store', [FeedbackController::class, 'store'])->name('feedback.store');
});


//Route zinazo peleka users kwenye index page zao baada ya kulogin
Route::middleware(['auth'])->group(function () {
Route::middleware(['auth', 'role:admin'])->get('/admindashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
Route::middleware(['auth', 'role:pregnant-woman'])->get('/pregnantdashboard', [PregnantDashboardController::class, 'index'])->name('pregnant.dashboard');
Route::middleware(['auth', 'role:doctor'])->get('/doctordashboard', [DoctorDashboardController::class, 'index'])->name('doctor.dashboard');
Route::middleware(['auth', 'role:breastfeeding-woman'])->get('/breastfeedingdashboard', [BreastfeedingDashboardController::class, 'index'])->name('breastfeeding.dashboard');
});



// Inapeleka Doctor kwenye index after login yake
Route::middleware(['auth', 'role:doctor'])->get('/doctordashboard', [DoctorController::class, 'index'])->name('doctor.dashboard');


//Chats Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/chats', [ChatController::class, 'index'])->name('chats.index');
    Route::post('/chats', [ChatController::class, 'store'])->name('chats.store');
});

require __DIR__ . '/auth.php';
