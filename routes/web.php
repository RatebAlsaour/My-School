<?php

use Illuminate\Support\Facades\Auth;
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
Route::get('/', [App\Http\Controllers\Auth\AuthAdmin::class,'show'])->middleware('auth');
Route::get('/home', [App\Http\Controllers\Auth\AuthAdmin::class,'show'])->middleware('auth')->name('home');

Route::get('/loggin', [App\Http\Controllers\Auth\LoginController::class, 'loggin'])->name('loggin');
Route::post('/login', [App\Http\Controllers\Auth\LoginController::class, 'login'])->name('login');
Route::get('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');


//just super admin
Route::controller(App\Http\Controllers\Auth\AuthAdmin::class)->middleware('BossAdmin')->group(function () {
    Route::get('/create-admin', 'register')->name('create-admin');
    Route::post('/create-Admin', 'createAdmin')->name('create-Admin');
    Route::get('/all-admin', 'allAdmin')->name('all-admin');
    Route::delete('/delete-admin', 'deleteAdmin')->name('delete-admin');
});


//create route
Route::controller(App\Http\Controllers\admin\AdminFunctionController::class)->middleware('auth')->group(function () {

    Route::get('/create-master', function () {
        return view('admin.master.createMaster');
    })->name('create-master');
    Route::post('/create-Master', 'createMaster')->name('create-Master');

    Route::get('/create-teacher', function () {
        return view('admin.teacher.createTeacher');
    })->name('create-teacher');
    Route::post('/create-Teacher', 'createTeacher')->name('create-Teacher');

    Route::get('/create-student', function () {
        return view('admin.student.createStudent');
    })->name('create-student');
    Route::post('/create-Student', 'createStudent')->name('create-Student');

    Route::get('/create-class', function () {
        return view('admin.class.createClass');
    })->name('create-class');
    Route::post('/create-class', 'createClass')->name('create-Class');
});

//update route
Route::controller(App\Http\Controllers\admin\AdminFunctionController::class)->group(function () {
    Route::get('/edite-student', 'editeStudent')->name('edite-student');
    Route::post('/update-student', 'updateStudent')->name('update-student');

    Route::get('/edite-master', 'editeMaster')->name('edite-master');
    Route::post('/update-master', 'updateMaster')->name('update-master');

    Route::get('/edite-teacher', 'editeTeacher')->name('edite-teacher');
    Route::post('/update-teacher', 'updateTeacher')->name('update-teacher');
});

// delete route
Route::controller(App\Http\Controllers\admin\AdminFunctionController::class)->group(function () {

    Route::delete('/delete-student', 'deleteStudent')->name('delete-student');
    Route::delete('/delete-master', 'deleteMaster')->name('delete-master');
    Route::delete('/delete-teacher', 'deleteTeacher')->name('delete-teacher');
    Route::delete('/delete-class', 'deleteClass')->name('delete-class');
});


//query route
Route::controller(App\Http\Controllers\admin\AdminQueryController::class)->group(function () {

    //student
    Route::get('/all-students', 'all_students')->name('all-students')->middleware('auth');
    Route::get('/show-student', 'showStudent')->name('show-student');
    Route::post('/find-student', 'findStudent')->name('find-student');

    //master
    Route::get('/all-masters', 'all_masters')->name('all-masters');
    Route::get('/show-master', 'showMaster')->name('show-master');

    //teatcher
    Route::get('/all-teachers', 'all_teachers')->name('all-teachers');
    Route::get('/show-teacher', 'showTeacher')->name('show-teacher');

    Route::post('/find-employee', 'findEmployee')->name('find-employee');

    //class
    Route::get('/all-classes', 'all_classes')->name('all-classes');
    Route::get('/show-class', 'showClass')->name('show-class');
    Route::get('/class-students', 'classStudents')->name('class-students');

    //affiliation
    Route::get('/affiliation-employee', 'affiliationEmployee')->name('affiliation-employee');
    Route::get('/affiliation-student', 'affiliationStudent')->name('affiliation-student');
});


Route::get('/add-schedule-teacher', [App\Http\Controllers\admin\AdminFunctionController::class, 'addTeacherSchedule'])->name('add-schedule-teacher');
Route::post('/add-schedule-teacher', [App\Http\Controllers\admin\AdminFunctionController::class, 'addScheduleteacher'])->name('add-schedule-teacher');

Route::get('/add-schedule-class', [App\Http\Controllers\admin\AdminFunctionController::class, 'addSchedule'])->name('add-schedule-class');
Route::post('/add-schedule-class', [App\Http\Controllers\admin\AdminFunctionController::class, 'addScheduleClass'])->name('add-schedule-class');

Route::get('/add-teacher-class', [App\Http\Controllers\admin\AdminFunctionController::class, 'addTeacher'])->name('add-teacher-class');
Route::post('/add-teacher-class', [App\Http\Controllers\admin\AdminFunctionController::class, 'addTeacherClass'])->name('add-teacher-class');

Route::post('/end-service', [App\Http\Controllers\admin\AdminFunctionController::class, 'endService'])->name('end-service');


//change password
Route::post('/new-password-student', [App\Http\Controllers\admin\AdminFunctionController::class, 'changeStudentPassword'])->name('new-password-student');
Route::post('/new-password-employee', [App\Http\Controllers\admin\AdminFunctionController::class, 'changeEmployeePassword'])->name('new-password-employee');
