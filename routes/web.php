<?php


use App\Http\Controllers\docente\CrearJuegoController;
use App\Http\Controllers\docente\ConfigurarJuegoController;
use App\Http\Controllers\estudiante\ResultadoController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RegistroController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/redirects',[HomeController::class,"index"]);


Route::controller(RegistroController::class)->group(function(){
    #Route::get('/tipo_cuenta','first_step_register')->name('tipo_cuenta');
    
    Route::any('/tipo_cuenta','formulario_usuario')->name('tipo_cuenta');
});


Route::controller(ConfigurarJuegoController::class)->group(function(){
    /*
    Route::get('get-especialidades','view_especialidades')->name('getEspecialidades');
    Route::get('get-cursos','view_cursos')->name('getCursos');
    Route::get('get-ciclos','view_ciclos')->name('getCiclos');
    Route::get('get-modulos','view_modulos')->name('getModulos');
    */
    Route::get('/configuracion','configurar_juego');
    Route::post('banco_preguntas','seleccionar_preguntas')->name('banco_preguntas');


    
});

Route::post('/juego', [CrearJuegoController::class, 'crear_juego'])->name('crear_juego');

Route::post('/resultado',[ResultadoController::class,'resultado_juego'])->name('resultado');

Route::post('/calcular_puntaje',[ResultadoController::class,'calcular_puntaje'])->name('calcular_puntaje');


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});