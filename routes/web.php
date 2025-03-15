<?php



use App\Http\Controllers\ticketController;
use App\Http\Controllers\UserAuthController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\CustomAuth;
use App\Http\Middleware\EnsureTokenIsValid;
use App\Http\Middleware\loginAuth;
use Illuminate\Support\Facades\Route;





// Auth Routes

Route::get('/', [UserAuthController::class, 'index'])->name('login');
Route::get('/register-users', [UserAuthController::class, 'show'])->name('user.register');
Route::post('/registered-users', [UserAuthController::class, 'create'])->name('user.registered');
Route::post('/ticket-managements', [UserAuthController::class, 'authenticate'])->name('user.authenticate');
Route::post('log-out', [UserAuthController::class, 'logOut'])->name('logout');
Route::get('unauthorized',[UserAuthController::class,'unauthorized'])->name('unauthorized');




Route::middleware(loginAuth::class)->group(function () {

    // Users Routes

    Route::group(['prefix' => 'users', 'as' => 'user.'], function () {
        Route::get('all-users', [UserController::class, 'index'])->name('view');
        Route::get('user_detail/{id}', [UserController::class, 'show'])->name('show');

        Route::middleware(AdminMiddleware::class)->group(function () {
            Route::get('user-edit/{id}', [UserController::class, 'edit'])->name('edit');
            Route::post('user-update/{id}', [UserController::class, 'update'])->name('update');
            Route::post('user-delete/{id}', [UserController::class, 'destroy'])->name('destroy');
        });
    });


    // Ticket Routes
    Route::group(['prefix' => 'tickets', 'as' => 'ticket.'], function () {
        Route::get('/view-ticket', [ticketController::class, "showTickets"])->name("view");
        Route::get('/ticket-detail/{id}', [ticketController::class, "ticketDetails"])->name("detail");

        Route::middleware(AdminMiddleware::class)->group(function () {
            Route::get('/ticket-generate', [ticketController::class, "index"])->name('generate');
            Route::post('/ticket-delete/{id}', [ticketController::class, "destroy"])->name("destroy");
            Route::get('/ticket-update/{id}', [ticketController::class, "editTicket"])->name("edit");
            Route::post('/update-ticket/{id}', [ticketController::class, "storeTicket"])->name("update");
            Route::post('/generate-ticket', [ticketController::class, "create"])->name("create");
            Route::get('assign-tickets/{id}', [ticketController::class, "selectAgent"])->name("agent");
            Route::post('assigned-tickets/{id}', [ticketController::class, "assignedTicket"])->name("assigned");
        });
    });
});
