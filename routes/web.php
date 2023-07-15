<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use JeffGreco13\FilamentBreezy\Http\Controllers\EmailVerificationController;

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


Route::get('/', function () {
    return redirect()->route('filament.auth.login');
});
// Route::get('/', function () {
//         return view('welcome');
//     });

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});





// Route::domain(config("filament.domain"))
//     ->middleware(config("filament.middleware.base"))
//     ->name(config('filament-breezy.route_group_prefix'))
//     ->prefix(config("filament.path"))
//     ->group(function () {
//         // Login will be replaced in the Filament config.
//         if (config("filament-breezy.enable_registration")) {
//             Route::get("/register", config('filament-breezy.registration_component_path'))->name("register");
//         }
//         Route::get("/password/reset", config('filament-breezy.password_reset_component_path'))->name(
//             "password.request"
//         );

//         Route::get("/password/reset/{token}", config('filament-breezy.password_reset_component_path'))->name(
//             "password.reset"
//         );

//         Route::get("email/verify", config('filament-breezy.email_verification_component_path'))
//             ->middleware(["throttle:6,1", "auth:" . config('filament.auth.guard')])
//             ->name("verification.notice");

//         Route::get("email/verify/{id}/{hash}", [
//             config('filament-breezy.email_verification_controller_path') ?? EmailVerificationController::class,
//             "__invoke",
//         ])
//             ->middleware(["signed"])
//             ->name("verification.verify");

//         Route::middleware(config("filament.middleware.auth"))->group(
//             function (): void {
//                 //
//                 // TODO: Route::get('password/confirm', Confirm::class)
//                 //
//             }
//         );
//     });










require __DIR__.'/auth.php';
