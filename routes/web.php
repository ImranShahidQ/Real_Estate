<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AgentController;
use App\Http\Controllers\Backend\PropertyTypeController;
use App\Http\Controllers\Backend\AmenitiesController;
use App\Http\Controllers\Backend\RoleController;

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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

Route::get('/admin/login', [AdminController::class, 'AdminLogin'])->name('admin.login');

Route::middleware(['auth', 'roles:admin'])->group(function () {
    // Admin Route
    Route::get('/admin/dashboard', [AdminController::class, 'AdminDashboard'])->name('admin.dashboard');
    Route::get('/admin/profile', [AdminController::class, 'AdminProfile'])->name('admin.profile');
    Route::post('/admin/profile/store', [AdminController::class, 'AdminProfileStore'])->name('admin.profile.store');
    Route::get('/admin/change/password', [AdminController::class, 'AdminChangePassword'])->name('admin.change.password');
    Route::post('/admin/password/store', [AdminController::class, 'AdminPasswordStore'])->name('admin.password.store');
    Route::get('/admin/logout', [AdminController::class, 'AdminLogout'])->name('admin.logout');
    // Admin User Route
    Route::get('/all/admin', [AdminController::class, 'AllAdmin'])->name('all.admin');
    Route::get('/add/admin', [AdminController::class, 'AddAdmin'])->name('add.admin');
    Route::post('/store/admin', [AdminController::class, 'StoreAdmin'])->name('store.admin');
    Route::get('/edit/admin/{id}', [AdminController::class, 'EditAdmin'])->name('edit.admin');
    Route::post('/update/admin/{id}', [AdminController::class, 'UpdateAdmin'])->name('update.admin');
    Route::get('/delete/admin/{id}', [AdminController::class, 'DeleteAdmin'])->name('delete.admin');

    // property route
    Route::controller(PropertyTypeController::class)->group(function () {
        Route::get('/show/property', 'ShowProperty')->name('show.property')->middleware('permission:show.property');
        Route::get('/add/property', 'AddProperty')->name('add.property')->middleware('permission:add.property');;
        Route::post('/store/property', 'StoreProperty')->name('store.property')->middleware('permission:store.property');;
        Route::get('/edit/property/{id}', 'EditProperty')->name('edit.property')->middleware('permission:edit.property');;
        Route::post('/update/property', 'UpdateProperty')->name('update.property')->middleware('permission:update.property');;
        Route::get('/delete/property/{id}', 'DeleteProperty')->name('delete.property')->middleware('permission:delete.property');;
    });
    // Amenties route
    Route::controller(AmenitiesController::class)->group(function () {
        Route::get('/show/amenitie', 'ShowAmenitie')->name('show.amenitie')->middleware('permission:show.amenitie');
        Route::get('/add/amenitie', 'AddAmenitie')->name('add.amenitie')->middleware('permission:add.amenitie');
        Route::post('/store/amenitie', 'StoreAmenitie')->name('store.amenitie')->middleware('permission:store.amenitie');
        Route::get('/edit/amenitie/{id}', 'EditAmenitie')->name('edit.amenitie')->middleware('permission:edit.amenitie');
        Route::post('/update/amenitie', 'UpdateAmenitie')->name('update.amenitie')->middleware('permission:update.amenitie');
        Route::get('/delete/amenitie/{id}', 'DeleteAmenitie')->name('delete.amenitie')->middleware('permission:delete.amenitie');
    });
    // Role And Permission Route
    Route::controller(RoleController::class)->group(function () {
        // Permission Route
        Route::get('/all/permission', 'AllPermission')->name('all.permission');
        Route::get('/add/permission', 'AddPermission')->name('add.permission');
        Route::post('/store/permission', 'StorePermission')->name('store.permission');
        Route::get('/edit/permission/{id}', 'EditPermission')->name('edit.permission');
        Route::post('/update/permission', 'UpdatePermission')->name('update.permission');
        Route::get('/delete/permission/{id}', 'DeletePermission')->name('delete.permission');
        // Excel Route
        Route::get('/import/permission', 'ImportPermission')->name('import.permission');
        Route::get('/download', 'Download')->name('download');
        Route::post('/import', 'Import')->name('import');
        // Role Route
        Route::get('/all/role', 'AllRole')->name('all.role');
        Route::get('/add/role', 'AddRole')->name('add.role');
        Route::post('/store/role', 'StoreRole')->name('store.role');
        Route::get('/edit/role/{id}', 'EditRole')->name('edit.role');
        Route::post('/update/role', 'UpdateRole')->name('update.role');
        Route::get('/delete/role/{id}', 'DeleteRole')->name('delete.role');
        // Role in permission route
        Route::get('/add/role/permission', 'AddRoleInPermission')->name('add.role.permission');
        Route::post('/store/role/permission', 'StoreRolePermission')->name('store.role.permission');
        Route::get('/all/role/permission', 'AllRoleInPermission')->name('all.role.permission');
        Route::get('/edit/role/permission/{id}', 'EditRoleInPermission')->name('edit.role.permission');
        Route::post('/update/role/permission/{id}', 'UpdateRoleInPermission')->name('update.role.permission');
        Route::get('/delete/role/permission/{id}', 'DeleteRoleInPermission')->name('delete.role.permission');
    });
});


Route::middleware(['auth', 'roles:agent'])->group(function () {
    // Agent Route
    Route::get('/agent/dashboard', [AgentController::class, 'AgentDashboard'])->name('agent.dashboard');
});
