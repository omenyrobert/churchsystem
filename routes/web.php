<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\PaymentsController;
use App\Http\Controllers\ExpenseTypesController;
use App\Http\Controllers\ExpensesController;
use App\Http\Controllers\IncomeTypesController;
use App\Http\Controllers\IncomesController;
use App\Http\Controllers\ReportsController;
use App\Http\Controllers\MinistryController;
use App\Http\Controllers\MinistryPositionController;
use App\Http\Controllers\PasswordResetController;

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


Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout')->middleware('check.auth');

Route::post('/send-mail', [PasswordResetController::class, 'send_mail'])->name('send.mail');
Route::get('/password/{email}/{token}', [PasswordResetController::class, 'display_form'])->name('password.display');
Route::get('/password-reset/{email}/{token}', [PasswordResetController::class, 'submitResetPasswordForm'])->name('password.reset');

// members routes
Route::prefix('members')->group(function () {
    Route::group(['middleware' => 'check.auth'], function () {
        Route::get('/', [MemberController::class, 'index'])->name('member.index');
        Route::post('/store', [MemberController::class, 'store'])->name('member.store');
        Route::post('/print', [MemberController::class, 'print'])->name('member.print');
        Route::get('/show/{id}', [MemberController::class, 'show'])->name('member.show');
        Route::get('/edit/{id}', [MemberController::class, 'edit'])->name('member.edit');
        Route::put('/update/{id}', [MemberController::class, 'update'])->name('member.update');
        Route::post('/destroy/{member}', [MemberController::class, 'destroy'])->name('member.destroy');
        Route::get('/create', [MemberController::class, 'create'])->name('member.create');
        Route::post('/position', [MemberController::class, 'filter_position'])->name('member.position');
        Route::post('/ministry', [MemberController::class, 'filter_ministry'])->name('member.ministry');
    }
    );
});



Route::prefix('expense_type')->group(function () {
    Route::group(['middleware' => 'check.auth'], function () {
        Route::get('/', [ExpenseTypesController::class, 'index'])->name('expense_type.index');
        Route::post('/', [ExpenseTypesController::class, 'store'])->name('expense_type.store');
        Route::put('/update', [ExpenseTypesController::class, 'update'])->name('expense_type.update');
        Route::post('/destroy/{expense_type}', [ExpenseTypesController::class, 'destroy'])->name('expense_type.destroy');
    }
    );
});


Route::prefix('income_type')->group(function () {
    Route::group(['middleware' => 'check.auth'], function () {
        Route::get('/', [IncomeTypesController::class, 'index'])->name('income_type.index');
        Route::post('/', [IncomeTypesController::class, 'store'])->name('income_type.store');
        Route::put('/update', [IncomeTypesController::class, 'update'])->name('income_type.update');
        Route::post('/destroy/{income_type}', [IncomeTypesController::class, 'destroy'])->name('income_type.destroy');
    }
    );
});

Route::prefix('income')->group(function () {
    Route::group(['middleware' => 'check.auth'], function () {
        Route::get('/', [IncomesController::class, 'index'])->name('income.index');
        Route::post('/', [IncomesController::class, 'store'])->name('income.store');
        Route::put('/update', [IncomesController::class, 'update'])->name('income.update');
        Route::post('/destroy/{income}', [IncomesController::class, 'destroy'])->name('income.destroy');
    }
    );
});

Route::prefix('expense')->group(function () {
    Route::group(['middleware' => 'check.auth'], function () {
        Route::get('/', [ExpensesController::class, 'index'])->name('expense.index');
        Route::post('/', [ExpensesController::class, 'store'])->name('expense.store');
        Route::put('/update', [ExpensesController::class, 'update'])->name('expense.update');
        Route::post('/destroy/{expense}', [ExpensesController::class, 'destroy'])->name('expense.destroy');
    }
    );
});

Route::prefix('report')->group(function () {
    Route::group(['middleware' => 'check.auth'], function () {
        Route::get('/', [ReportsController::class, 'index'])->name('report.index');
        Route::post('/filter', [ReportsController::class, 'filter'])->name('report.filter');
        Route::post('/print', [ReportsController::class, 'print'])->name('report.print');

    }
    );
});


// end of members routes

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard')->middleware('check.auth');


Route::get('/ministry-positions', [MinistryPositionController::class, 'ministry_positions']);