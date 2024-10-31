<?php

use App\Http\Controllers\AdoptResearchController;
use App\Http\Controllers\Dashboard\DepartmentsController;
use App\Http\Controllers\Dashboard\HomeController;
use App\Http\Controllers\Dashboard\KeysController;
use App\Http\Controllers\Dashboard\ProfileController;
use App\Http\Controllers\Dashboard\ProgramsController;
use App\Http\Controllers\Dashboard\ResearchesController;
use App\Http\Controllers\Dashboard\UsersController;
use App\Models\User;
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

Route::get('/', HomeController::class)->name('home');
Route::post('/',[ProfileController::class , 'complete'])->name('complete');

//Users Routes
Route::group(['prefix' => 'users' , 'as' => 'users.', 'controller' => UsersController::class], function()
{
    Route::get('/', 'index')->name('index');
    Route::get('create', 'create')->name('create');
    Route::post('create', 'store')->name('store');
    Route::get('import' , 'import')->name('import');
    Route::post('import' , 'importStore')->name('importStore');
    Route::get('{user}/edit', 'edit')->name('edit');
    Route::put('{user}/edit', 'update')->name('update');
    Route::delete('{user}/delete', 'destroy')->name('destroy');
    Route::get('export', 'export')->name('export');
});

//Programs Routes
Route::group(['prefix' => 'programs' , 'as' => 'programs.', 'controller' => ProgramsController::class], function()
{
    Route::get('/', 'index')->name('index');
    Route::get('create', 'create')->name('create');
    Route::post('create', 'store')->name('store');
    Route::get('{program}/edit', 'edit')->name('edit');
    Route::put('{program}/edit', 'update')->name('update');
    Route::delete('{program}/delete', 'destroy')->name('destroy');
});

//Departments Routes
Route::group(['prefix' => 'departments' , 'as' => 'departments.', 'controller' => DepartmentsController::class], function()
{
    Route::get('/', 'index')->name('index');
    Route::get('create', 'create')->name('create');
    Route::post('create', 'store')->name('store');
    Route::get('{department}/edit', 'edit')->name('edit');
    Route::put('{department}/edit', 'update')->name('update');
    Route::delete('{department}/delete', 'destroy')->name('destroy');

});

//Researches Routes
Route::group(['prefix' => 'researches' , 'as' => 'researches.', 'controller' => ResearchesController::class], function()
{
    Route::get('/', 'index')->name('index');
    Route::get('create', 'create')->name('create');
    Route::post('create', 'store')->name('store');
    Route::get('{research}/show', 'show')->name('show');
    Route::get('{research}/revoke', 'revoke')->name('revoke');
    Route::get('{research}/approve', 'approve')->name('approve');
    Route::get('{research}/edit', 'edit')->name('edit');
    Route::put('{research}/edit', 'update')->name('update');
    Route::delete('{research}/delete', 'destroy')->name('destroy');
    Route::get('researches/{research}/export', 'export')->name('export');
    Route::get('exportall', 'exportall')->name('exportall');

});

//Adopt Options
Route::group(['prefix' => 'adopt', 'as' => 'adopt.', 'controller' => AdoptResearchController::class], function()
{
    Route::get('', 'index')->name('index');
    Route::post('', 'saveHints')->name('saveHints');

    Route::post('statuses', 'store')->name('statuses')->defaults('model', 'status');
    Route::delete('statuses/{id}', 'delete')->name('deleteStatus')->defaults('model', 'status');

    Route::post('types', 'store')->name('types')->defaults('model', 'type');
    Route::delete('types/{id}', 'delete')->name('deleteType')->defaults('model', 'type');

    Route::post('languages', 'store')->defaults('model', 'language')->name('languages');
    Route::delete('languages/{id}', 'delete')->name('deleteLanguage')->defaults('model', 'language');

    Route::post('indexings', 'store')->name('indexings')->defaults('model', 'indexing');
    Route::delete('indexings/{id}', 'delete')->name('deleteIndexing')->defaults('model', 'indexing');

    Route::post('documentaion_periods', 'store')->name('documentaion_periods')->defaults('model', 'DocumentaionPeriod');
    Route::delete('documentaion_periods/{id}', 'delete')->name('deleteDocumentationPeriod')->defaults('model', 'DocumentaionPeriod');

    Route::post('academic_years', 'store')->name('academic_years')->defaults('model', 'AcademicYear');
    Route::delete('academic_years/{id}', 'delete')->name('deleteAcademicYear')->defaults('model', 'AcademicYear');
});

Route::get('users-activities' , [ProfileController::class , 'usersActivities'])->name('users-activities');




//Key Routes
Route::get('keys' ,[KeysController::class , 'index'])->name('keys');
Route::post('keys' ,[KeysController::class , 'generate'])->name('generate');

//Profile Routes
Route::get('settings',[ProfileController::class , 'settings'])->name('settings');
Route::post('settings',[ProfileController::class , 'update'])->name('update');
Route::get('logout' , [ProfileController::class , 'logout'])->name('logout');

Route::get('activities' , [ProfileController::class, 'activities'])->name('activities');
