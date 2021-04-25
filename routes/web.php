<?php

use Illuminate\Support\Facades\Route;

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
define('MAINASSETS', URL::asset('public/dist'));
define('MAINUPLOADS', URL::asset('public/uploads'));

Auth::routes();
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('frontend.index');
Route::post('front/datatable/courses',[App\Http\Controllers\HomeController::class,'frontendDatatable'])->name('frontend.course.datatable');

Route::get('/home', [App\Http\Controllers\Admin\AdminController::class, 'index'])->name('home');
Route::get('/backend/home', [App\Http\Controllers\Admin\AdminController::class, 'index'])->name('backend.index');

Route::group(['middleware' => 'auth','prefix'=>'admin'], function (){
    //delete any element
    Route::post('delete-element', [App\Http\Controllers\Admin\AdminController::class, 'delete'])->name('element.delete');

    //courses
    Route::get('/courses',[App\Http\Controllers\Admin\CourseController::class,'index'])->name('course.index');
    Route::get('/course/create',[App\Http\Controllers\Admin\CourseController::class,'create'])->name('course.create');
    Route::post('/course/create',[App\Http\Controllers\Admin\CourseController::class,'store'])->name('course.store');
    Route::get('/course/edit/{id}',[App\Http\Controllers\Admin\CourseController::class,'edit'])->name('course.edit');
    Route::put('/course/{id}',[App\Http\Controllers\Admin\CourseController::class,'update'])->name('course.update');
    Route::post('datatable/courses',[App\Http\Controllers\Admin\CourseController::class,'datatable'])->name('course.datatable');
    //categories
    Route::get('/categories',[App\Http\Controllers\Admin\CategoryController::class,'index'])->name('category.index');
    Route::get('/category/create',[App\Http\Controllers\Admin\CategoryController::class,'create'])->name('category.create');
    Route::post('/category/create',[App\Http\Controllers\Admin\CategoryController::class,'store'])->name('category.store');
    Route::get('/category/edit/{id}',[App\Http\Controllers\Admin\CategoryController::class,'edit'])->name('category.edit');
    Route::put('/category/{id}',[App\Http\Controllers\Admin\CategoryController::class,'update'])->name('category.update');
    Route::post('datatable/categories',[App\Http\Controllers\Admin\CategoryController::class,'datatable'])->name('category.datatable');
});
