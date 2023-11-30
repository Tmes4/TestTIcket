<?php
use App\Http\Controllers\EventController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use  App\Models\User;


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

// Route::get('/', function () {
//     return view('home');
// });
Route::get('/', [EventController::class, 'index'])->name('home');


// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function (){
        if (auth()->user()->isAdmin()) {
            return view('dashboard');
        } else {
            return redirect()->route('home');
        }
    })->name('dashboard');
    Route::get('/admin/events/index', [EventController ::class, 'adminIndex'])->name('admin.index');
    Route::get('/admin/events/create', [EventController::class, 'create'])->name('create.event');
    Route::post('/admin/events/create', [EventController::class, 'store'])->name('save.event');
    Route::get('/admin/events/{event}/edit', [EventController::class, 'edit'])->name('edit.event');
    Route::PUT('/admin/events/{event}', [EventController::class, 'update'])->name('update.event');
    Route::delete('/admin/index/{event}', [EventController::class, 'destroy'])->name('delete.event');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::get('/event/index/{event}', [EventController::class, 'show'])->name('event.index');
