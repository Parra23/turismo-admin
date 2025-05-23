<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InsertController;
use App\Http\Controllers\EditController;
use App\Http\Controllers\UpdateController;
use App\Http\Controllers\ShowController;
use App\Http\Controllers\DestroyController;
use App\Http\Controllers\ApiAuthController;
use Illuminate\Support\Facades\Auth;


// Mostrar formulario login
Route::get('/login', function() {
    return view('auth.login'); // crea esta vista si no la tienes
})->name('login');

// Procesar login con tu controlador
Route::post('/login', [ApiAuthController::class, 'login']);

// Procesar logout
Route::post('/logout', function() {
    Auth::logout();
    session()->flush();
    return redirect('/login');
})->name('logout');

// Mostrar formulario registro (opcional)
Route::get('/register', function() {
    return view('auth.register'); // crea esta vista si no la tienes
})->name('register');

// Procesar registro con tu controlador
Route::post('/register', [ApiAuthController::class, 'register']);

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        $user = session('user'); // o Auth::user()
        return view('dashboard', compact('user'));
    })->name('dashboard');
});

// Crear un nuevo recurso (antes que /{resource}/{id})
Route::get('/{resource}/insert', [InsertController::class, 'insert'])
    ->name('general.insert');
    Route::post('/{resource}', [InsertController::class, 'store'])
    ->name('general.store');

// Mostrar el formulario de edición (antes que /{resource}/{id})
Route::get('/{resource}/{id}/edit', [EditController::class, 'edit'])
    ->name('general.edit');

// Mostrar un recurso individual
Route::get('/{resource}/{id}', [ShowController::class, 'showOne'])
    ->name('general.showOne');

// Mostrar todos los recursos
Route::get('/{resource}', [ShowController::class, 'show'])
    ->name('general.show');

// Procesar la actualización
Route::put('/{resource}/{id}', [UpdateController::class, 'update'])
    ->name('general.update');

// Eliminar
Route::delete('/{resource}/{id}', [DestroyController::class, 'destroy'])
    ->name('general.destroy');