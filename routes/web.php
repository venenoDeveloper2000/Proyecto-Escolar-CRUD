<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PruebaController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\LibroController;
use App\Http\Controllers\EstudiantesController;
// infodocentes
use App\Http\Controllers\infodocentesController;
// Evaluaciones
use App\Http\Controllers\EvaluacionesController;
// materias
use App\Http\Controllers\materiasController;
// archivos
use App\Http\Controllers\archivosController;
//reporte
use App\Http\Controllers\ReporteController;
//reporte de informacion de docentes
use App\Http\Controllers\infoReporteController;
// materias carreras
use App\Http\Controllers\materiaCarreraController;


/**
 * Correr el siguiente comando en la consola para ver las rutas
 *
 * php artisan route:list
 */

Route::get('/', function () {
    return redirect()->route('infodocentes.index');
})->name('index')->middleware(['auth:root']);


/**
 * Auth biblioteca
 */
Route::prefix('auth')->group(function () {
    Route::get('login', [AuthController::class, 'login'])->name('login');
    Route::post('authenticate', [AuthController::class, 'authenticate'])->name('authenticate');
});

Route::post('logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth:root');

/**
 * Documentacion de la Ruta y Controller resource
 *
 * https://laravel.com/docs/8.x/controllers#resource-controllers
 */

Route::resource('prueba', PruebaController::class)->except('show')->parameters([
    'prueba' => 'item'
    ])->middleware('auth:root');
Route::put('prueba/togglestatus/{item}', [PruebaController::class, 'toggleStatus'])->name('prueba.toggle.status')->middleware(['auth:root']);

Route::resource('libro', LibroController::class)->except('show')->middleware('auth:root');
Route::put('libro/togglestatus/{libro}', [LibroController::class, 'toggleStatus'])->name('libro.toggle.status')->middleware(['auth:root']);

/*Route::resource('estudiantes', EstudiantesController::class)->except('show')->middleware('auth:root');
Route::put('estudiantes/togglestatus/{estudiantes}', [EstudiantesController::class, 'toggleStatus'])->name('estudiantes.toggle.status')->middleware(['auth:root']);*/
Route::resource('estudiantes', EstudiantesController::class)->except('show')->
parameters([
    'estudiantes' => 'estudiantes'
    ])->middleware('auth:root');
Route::put('estudiantes/togglestatus/{estudiantes}', [EstudiantesController::class, 'toggleStatus'])->name('estudiantes.toggle.status')->middleware(['auth:root']);

    Route::get('usuario/perfil', [AdminController::class, 'perfil'])->middleware('auth:root')->name('perfil');
    Route::put('updatepassword/{id}', [AdminController::class, 'updatepassword'])->name('updatepassword');
    Route::put('updatefoto/{id}', [AdminController::class, 'updatefoto'])->name('updatefoto');

// ------------------------------------------------------------------
// **********************   UPMP    *********************************
// ------------------------------------------------------------------

/**
 * ///////////////////////////////////////////////
 * Informacion de docentes controller
 * ///////////////////////////////////////////////
 */

Route::resource('infodocentes', infodocentesController::class)->except('show')->parameters(['infodocentes' => 'infodocentes'])->middleware('auth:root');


Route::put('infodocentes/togglestatus/{infodocentes}', [infodocentesController::class, 'toggleStatus'])->name('infodocentes.toggle.status')->middleware(['auth:root']);

/**
 * ///////////////////////////////////////////////
 * End of Informacion de docentes controller
 * ///////////////////////////////////////////////
 */

// ------------------------------------------------------------------
// **********************   UPMP    *********************************
// ------------------------------------------------------------------


/**
 * ///////////////////////////////////////////////
 * Evaluaciones controller
 * ///////////////////////////////////////////////
 */
Route::resource('Evaluaciones', EvaluacionesController::class)->except('show')->parameters(['Evaluaciones' => 'Evaluaciones'])->middleware('auth:root');

Route::put('Evaluaciones/togglestatus/{Evaluaciones}', [EvaluacionesController::class, 'toggleStatus'])->name('Evaluaciones.toggle.status')->middleware(['auth:root']);

/**
 * ///////////////////////////////////////////////
 * End of Evaluaciones controller
 * ///////////////////////////////////////////////
 */

// ------------------------------------------------------------------
// **********************   UPMP    *********************************
// ------------------------------------------------------------------


/**
 * ///////////////////////////////////////////////
 * Materias controller
 * ///////////////////////////////////////////////
 */
Route::resource('materias', materiasController::class)->except('show')->parameters(['materias' => 'materias'])->middleware('auth:root');

Route::put('materias/togglestatus/{materias}', [materiasController::class, 'toggleStatus'])->name('materias.toggle.status')->middleware(['auth:root']);

/**
 * ///////////////////////////////////////////////
 * End of Materias controller
 * ///////////////////////////////////////////////
 */

// ------------------------------------------------------------------
// **********************   UPMP    *********************************
// ------------------------------------------------------------------
/**
 * ///////////////////////////////////////////////
 * Archivos controller
 * ///////////////////////////////////////////////
 */
//


Route::resource('archivos', archivosController::class)->except('show')->parameters(['archivos' => 'archivos'])->middleware('auth:root');

Route::put('archivos/togglestatus/{archivos}', [archivosController::class, 'toggleStatus'])->name('archivos.toggle.status')->middleware(['auth:root']);




/**
 * ///////////////////////////////////////////////
 * End of Archivos controller
 * ///////////////////////////////////////////////
 */

 //-------------------------------------Reportes Docentes----------------------------------------------
 Route::get('consulta', [ReporteController::class, 'consulta'])->name('consulta')->middleware('auth:root');
 Route::get('contenido', [ReporteController::class, 'contenido'])->name('contenido')->middleware('auth:root');
 Route::get('detalle_carreras/{id}/{idce}',[ReporteController::class, 'detalle_carreras'])->name('detalle_carreras')->middleware('auth:root');
 Route::get('detalle_grupos/{id}',[ReporteController::class, 'detalle_grupos'])->name('detalle_grupos')->middleware('auth:root');
 Route::get('regresar/{idce}', [ReporteController::class, 'regresar'])->name('regresar')->middleware('auth:root');

// ------------------------------------------------------------------
// **********************   UPMP    *********************************
// ------------------------------------------------------------------


 //-------------------------------------Reportes infoDocentes----------------------------------------------
 Route::get('consultaInfo', [infoReporteController::class, 'consulta'])->name('consultaInfo')->middleware('auth:root');
 Route::get('contenidoInfo', [infoReporteController::class, 'contenido'])->name('contenidoInfo')->middleware('auth:root');
 Route::get('detalle_carrerasInfo/{id}/{idce}',[infoReporteController::class, 'detalle_carreras'])->name('detalle_carrerasInfo')->middleware('auth:root');
 Route::get('detalle_gruposInfo/{id}',[infoReporteController::class, 'detalle_grupos'])->name('detalle_gruposInfo')->middleware('auth:root');
 Route::get('regresarInfo/{idce}', [infoReporteController::class, 'regresar'])->name('regresarInfo')->middleware('auth:root');


/**
 * ///////////////////////////////////////////////
 * Materias Carreras controller
 * ///////////////////////////////////////////////
 */
Route::resource('materiasCarreras', materiaCarreraController::class)->except('show')->parameters(['materiasCarreras' => 'materiasCarreras'])->middleware('auth:root');

Route::put('materiasCarreras/togglestatus/{materiasCarreras}', [materiaCarreraController::class, 'toggleStatus'])->name('materiasCarreras.toggle.status')->middleware(['auth:root']);

/**
 * ///////////////////////////////////////////////
 * End of Materias Carreras controller
 * ///////////////////////////////////////////////
 */
