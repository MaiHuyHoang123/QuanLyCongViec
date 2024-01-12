<?php

use App\Http\Controllers\ExcelController;
use Illuminate\Support\Facades\Route;
use TCG\Voyager\Facades\Voyager;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\NotifyController;
use App\Http\Controllers\RemindController;
use App\Http\Controllers\ReportJob;
use App\Http\Controllers\ReportJobController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\TeamController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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

Route::get('clear-cache', function () {
//        Artisan::call('schedule:run');
//        Artisan::call('config:clear');
         Artisan::call('cache:clear');
    //    Artisan::call('view:clear');
//    Artisan::call('storage:link');
    return 'xong';
});

Route::get('/', [IndexController::class, 'home'])->name('/')->middleware('auth.staff');

Route::get('/chi-tiet/{id}', [IndexController::class, 'getJobDetail'])->name('job.details');
Route::get('/sua/{id}', [IndexController::class, 'jobEdit']);
Route::get('/bao-cao/{id}', [IndexController::class, 'getReport'])->name('job.report');
Route::get('/nhan-vien', [IndexController::class, 'staff'])->name('staff');
Route::get('/nhom', [IndexController::class, 'team'])->name('team');
Route::get('/loc/{value}', [IndexController::class, 'filter'])->name('filter')->middleware('auth.staff');



Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});


Route::resource('/job', JobController::class);

// nhân viên
Route::get('staffs/{id?}',[StaffController::class,'show'])->name('staffs.show')->middleware('auth.staff');

// lấy danh sách công việc nhân viên đã hoàn thành
Route::get('job-complete/staff',[StaffController::class,'jobCompleteByStaff'])->name('job_complete')->middleware('auth.staff');
// báo cáo công việc
Route::get('/report-job', [ReportJobController::class, 'index'])->name('report_job.index')->middleware('auth.staff');

// nhắc hẹn
Route::get('/reminders', [RemindController::class, 'index'])->name('reminds.index')->middleware('auth.staff');
Route::get('/reminders/{id?}', [RemindController::class, 'show'])->name('reminds.show')->middleware('auth.staff');
Route::post('/reminders/create', [RemindController::class, 'store'])->name('reminds.store')->middleware('auth.staff');
Route::post('/reminders/update', [RemindController::class, 'update'])->name('reminds.update')->middleware('auth.staff');
Route::get('/reminders/delete/{id?}', [RemindController::class, 'delete'])->name('reminds.delete')->middleware('auth.staff');

// thông báo
Route::get('notifications',[NotifyController::class,'index'])->name('notifications.index')->middleware('auth.staff');
Route::get('notifications/clear',[NotifyController::class,'clear'])->name('notifications.clear')->middleware('auth.staff');

Route::get('/jobs/team', [IndexController::class, 'filterJobByTeam'])->name('job-by-team')->middleware('auth.staff');
// sửa thông tin job
Route::post('/job/update-job',[JobController::class,'updateJob'])->name('update-job');
// hoàn thành job
Route::post('/job/complete-job', [JobController::class,'completeJob'])->name('job.complete');

// lấy thông tin nhân viên thực hiện job
Route::get('/staff/implement-job/{id?}',[StaffController::class,'getStaffImplementJob'])->name('staff.implement-job');

//lấy thông tin team thực hiện job
Route::get('/team/implement-job/{id?}',[TeamController::class,'getTeamImplementJob'])->name('team.implement-job');

// hiển thị form đăng nhập
Route::get('/login',function() {
    return view('login');
})->name('login');

Route::post('/login',function(Request $request){
    $credentials = $request->validate([
        'phone' => ['required'],
        'password' => ['required'],
    ]);
    if (Auth::guard('staff')->attempt($credentials)) {
        $request->session()->regenerate();
        return redirect()->intended('/');
    }

    return back()->withErrors([
        'message' => 'The provided credentials do not match our records.',
    ]);
})->name('login.post');

Route::get('/logout',function(){
    Auth::guard('staff')->logout();
    return redirect('/login');
})->name('logout');

// tải file excel
Route::post('/excel',[ExcelController::class,'index'])->name('excel');
Route::get('/excel/{file_name?}',[ExcelController::class,'getExcel'])->name('excel.export');





