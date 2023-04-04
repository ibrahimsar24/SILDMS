<?php

use App\Http\Controllers\BranchController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\MarksController;
use App\Http\Controllers\RailwayController;
use App\Http\Controllers\SemesterController;
use App\Http\Controllers\StreamController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\PermissionController;

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
Route::get('/', function () { return view('homepage'); });
Route::get('/homepage', function () { return view('homepage'); });

Route::get('login', [LoginController::class,'showLoginForm'])->name('login');
Route::post('login', [LoginController::class,'login']);
Route::post('register', [RegisterController::class,'register']);

Route::get('password/forget',  function () {
	return view('pages.forgot-password');
})->name('password.forget');
Route::post('password/email', [ForgotPasswordController::class,'sendResetLinkEmail'])->name('password.email');
Route::get('password/reset/{token}', [ResetPasswordController::class,'showResetForm'])->name('password.reset');
Route::post('password/reset', [ResetPasswordController::class,'reset'])->name('password.update');


Route::group(['middleware' => 'auth'], function(){
	// logout route
	Route::get('/logout', [LoginController::class,'logout']);
	Route::get('/clear-cache', [HomeController::class,'clearCache']);
    Route::get('/profile', [UserController::class,'myProfile']);
    Route::post('/profile/edit', [UserController::class,'updateMyProfile'])->name('update-profile');

	// dashboard route
	Route::get('/dashboard', function () {
	    if (Auth::user()->hasRole('Super Admin')) {
            return view('pages.dashboard');
	    }
	    if (Auth::user()->hasRole('Student')) {
	        return view('pages.studentdashboard');
	    }
		return view('pages.dashboard');
	})->name('dashboard');

    Route::get('student/dashboard', function () {
		return view('pages.studentdashboard');
	})->name('studentdashboard');

	//only those have manage_user permission will get access
	Route::group(['middleware' => 'can:manage_user'], function(){
	    Route::get('/users', [UserController::class,'index']);
	    Route::get('/user/get-list', [UserController::class,'getUserList']);
		Route::get('/user/create', [UserController::class,'create']);
		Route::post('/user/create', [UserController::class,'store'])->name('create-user');
		Route::get('/user/{id}', [UserController::class,'edit']);
		Route::post('/user/update', [UserController::class,'update']);
		Route::get('/user/delete/{id}', [UserController::class,'delete']);
        Route::post('/user/upload', [UserController::class,'uploadUsers'])->name('users.upload');
	});
    Route::group(['middleware' => 'can:manage_profile'], function(){
        Route::get('/profile/{id}', [UserController::class,'profile']);
    });

	//only those have manage_role permission will get access
	Route::group(['middleware' => 'can:manage_role|manage_user'], function(){
		Route::get('/roles', [RolesController::class,'index']);
		Route::get('/role/get-list', [RolesController::class,'getRoleList']);
		Route::post('/role/create', [RolesController::class,'create']);
		Route::get('/role/edit/{id}', [RolesController::class,'edit']);
		Route::post('/role/update', [RolesController::class,'update']);
		Route::get('/role/delete/{id}', [RolesController::class,'delete']);
	});


	//only those have manage_permission permission will get access
	Route::group(['middleware' => 'can:manage_permission|manage_user'], function(){
		Route::get('/permission', [PermissionController::class,'index']);
		Route::get('/permission/get-list', [PermissionController::class,'getPermissionList']);
		Route::post('/permission/create', [PermissionController::class,'create']);
		Route::get('/permission/update', [PermissionController::class,'update']);
		Route::get('/permission/delete/{id}', [PermissionController::class,'delete']);
	});

    Route::group(['middleware' => 'can:manage_stream|manage_user'], function(){
        Route::get('/stream', [StreamController::class,'index']);
        Route::get('/stream/get-list', [StreamController::class,'getStreamList']);
        Route::post('/stream/create', [StreamController::class,'create']);
        Route::get('/stream/update', [StreamController::class,'update']);
        Route::get('/stream/delete/{id}', [StreamController::class,'delete']);
    });

    Route::group(['middleware' => 'can:manage_branch|manage_user'], function(){
        Route::get('/branch', [BranchController::class,'index']);
        Route::get('/branch/get-list', [BranchController::class,'getBranchList']);
        Route::post('/branch/create', [BranchController::class,'create']);
        Route::get('/branch/update', [BranchController::class,'update']);
        Route::get('/branch/delete/{id}', [BranchController::class,'delete']);
    });

    Route::group(['middleware' => 'can:manage_course|manage_user'], function(){
        Route::get('/course', [CourseController::class,'index']);
        Route::get('/course/get-list', [CourseController::class,'getCourseList']);
        Route::post('/course/create', [CourseController::class,'create']);
        Route::get('/course/update', [CourseController::class,'update']);
        Route::get('/course/delete/{id}', [CourseController::class,'delete']);
        Route::post('/course/upload', [CourseController::class,'uploadCourses'])->name('course.upload');
    });

    Route::group(['middleware' => 'can:manage_semester|manage_user'], function(){
        Route::get('/semester', [SemesterController::class,'index']);
        Route::get('/semester/view/{id}', [SemesterController::class,'getSemesterInfo']);
        Route::get('/semester/{id}/course/view/{code}', [SemesterController::class,'getCourseInfo']);
        Route::get('/semester/get-list', [SemesterController::class,'getSemesterList']);
        Route::get('/semester/get-course-list/{id}', [SemesterController::class,'getCoursesList']);
        Route::get('/semester/view/get-courses/{id}', [SemesterController::class,'getCourses']);
        Route::get('/semester/view/get-students/{id}', [SemesterController::class,'getStudents']);
        Route::get('/semester/{id}/get-student-marks/{code}', [SemesterController::class,'getStudentMarks']);
        Route::post('/semester/create', [SemesterController::class,'create']);
        Route::get('/semester/update', [SemesterController::class,'update'])->name('semester.prof.update');
        Route::get('/semester/delete/{id}', [SemesterController::class,'delete']);
        Route::get('/semester/student/delete/{id}', [SemesterController::class,'deleteStudent']);
        Route::post('/semester/student/upload', [SemesterController::class,'uploadStudentList'])->name('semester.student.upload');
        Route::post('/semester/student/add', [SemesterController::class,'addStudent']);
        Route::get('/semester/result/update', [SemesterController::class,'updateResult'])->name('semester.result.update');
//        Route::get('/semester/course/{id}', [SemesterController::class,'index']);
//        Route::get('/semester/course/get-list', [SemesterController::class,'getSemesterList']);
//        Route::get('/semester/get-course-list/{id}', [SemesterController::class,'getCoursesList']);
//        Route::get('/semester/view/get-courses/{id}', [SemesterController::class,'getCourses']);
//        Route::post('/semester/create', [SemesterController::class,'create']);
//        Route::get('/semester/update', [SemesterController::class,'update'])->name('semester.prof.update');
//        Route::get('/semester/delete/{id}', [SemesterController::class,'delete']);
    });

    Route::group(['middleware' => 'can:manage_result|manage_user'], function(){
        Route::get('/result', [MarksController::class,'index']);
        Route::get('/result/get-list', [MarksController::class,'getResultList']);
        Route::get('/result/upload', [MarksController::class,'uploadContent']);
        Route::post('/result/create', [MarksController::class,'create']);
        Route::get('/result/update', [MarksController::class,'update']);
        Route::get('/result/delete/{id}', [MarksController::class,'delete']);
    });

    Route::get('/railway', [RailwayController::class,'index']);
    Route::get('/railway/get-list', [RailwayController::class,'getRailwayList']);
    Route::post('/railway/create', [RailwayController::class,'create']);
    Route::get('/railway/update', [RailwayController::class,'update']);
    Route::get('/railway/delete/{id}', [RailwayController::class,'delete']);
    Route::group(['middleware' => 'can:manage_railway'], function(){
        Route::get('/railway/verify', [RailwayController::class,'checkIndex']);
        Route::get('/railway/view/{id}', [RailwayController::class,'viewIndex']);
        Route::get('/railway/accept/{id}', [RailwayController::class,'acceptApplication']);
        Route::get('/railway/verify/get-active-list', [RailwayController::class,'getActiveRailwayApplicationsList']);
        Route::get('/railway/verify/get-accepted-list', [RailwayController::class,'getAcceptedRailwayApplicationsList']);
    });

	// get permissions
	Route::get('get-role-permissions-badge', [PermissionController::class,'getPermissionBadgeByRole']);

	// permission examples
    Route::get('/permission-example', function () {
    	return view('permission-example');
    });
    // API Documentation
    Route::get('/rest-api', function () { return view('api'); });
    // Editable Datatable
	Route::get('/table-datatable-edit', function () {
		return view('pages.datatable-editable');
	});

    Route::get('/semesters', [SemesterController::class,'studentIndex']);
    Route::get('/semesters/get-list', [SemesterController::class,'getStudentSemesterList']);
    Route::get('/semesters/view/{id}', [SemesterController::class,'getStudentSemesterInfo']);

    // Themekit demo pages
	Route::get('/calendar', function () { return view('pages.calendar'); });
	Route::get('/charts-amcharts', function () { return view('pages.charts-amcharts'); });
	Route::get('/charts-chartist', function () { return view('pages.charts-chartist'); });
	Route::get('/charts-flot', function () { return view('pages.charts-flot'); });
	Route::get('/charts-knob', function () { return view('pages.charts-knob'); });
	Route::get('/forgot-password', function () { return view('pages.forgot-password'); });
	Route::get('/form-addon', function () { return view('pages.form-addon'); });
	Route::get('/form-advance', function () { return view('pages.form-advance'); });
	Route::get('/form-components', function () { return view('pages.form-components'); });
	Route::get('/form-picker', function () { return view('pages.form-picker'); });
	Route::get('/invoice', function () { return view('pages.invoice'); });
	Route::get('/layout-edit-item', function () { return view('pages.layout-edit-item'); });
	Route::get('/layouts', function () { return view('pages.layouts'); });

	Route::get('/navbar', function () { return view('pages.navbar'); });
	Route::get('/profiles', function () { return view('pages.profile'); });
	Route::get('/project', function () { return view('pages.project'); });
	Route::get('/view', function () { return view('pages.view'); });

	Route::get('/table-bootstrap', function () { return view('pages.table-bootstrap'); });
	Route::get('/table-datatable', function () { return view('pages.table-datatable'); });
	Route::get('/taskboard', function () { return view('pages.taskboard'); });
	Route::get('/widget-chart', function () { return view('pages.widget-chart'); });
	Route::get('/widget-data', function () { return view('pages.widget-data'); });
	Route::get('/widget-statistic', function () { return view('pages.widget-statistic'); });
	Route::get('/widgets', function () { return view('pages.widgets'); });

	// themekit ui pages
	Route::get('/alerts', function () { return view('pages.ui.alerts'); });
	Route::get('/badges', function () { return view('pages.ui.badges'); });
	Route::get('/buttons', function () { return view('pages.ui.buttons'); });
	Route::get('/cards', function () { return view('pages.ui.cards'); });
	Route::get('/carousel', function () { return view('pages.ui.carousel'); });
	Route::get('/icons', function () { return view('pages.ui.icons'); });
	Route::get('/modals', function () { return view('pages.ui.modals'); });
	Route::get('/navigation', function () { return view('pages.ui.navigation'); });
	Route::get('/notifications', function () { return view('pages.ui.notifications'); });
	Route::get('/range-slider', function () { return view('pages.ui.range-slider'); });
	Route::get('/rating', function () { return view('pages.ui.rating'); });
	Route::get('/session-timeout', function () { return view('pages.ui.session-timeout'); });
	Route::get('/pricing', function () { return view('pages.pricing'); });
});


Route::get('/register', function () { return view('pages.register'); });
Route::get('/login-1', function () { return view('pages.login'); });

