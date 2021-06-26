<?php

use Illuminate\Support\Facades\Route;
use Auth0\Login\Auth0Controller;
use App\Http\Controllers\Auth\Auth0IndexController;
use App\Http\Controllers\SessionsController;
use App\Http\Controllers\PreformatoController;
use App\Http\Controllers\FichaController;

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

/*Route::get('/', function () {
    return view('welcome');
});*/
Route::get('/', [SessionsController::class,'index']);
Route::get('/preregistro', [SessionsController::class,'pre']);
/*Route::get('/login', [SessionsController::class,'create'])->name('login');
Route::post('/login', [SessionsController::class,'store']);
Route::get('/logout', [SessionsController::class,'destroy']);*/
Route::get('/auth0/callback',[Auth0Controller::class,'callback'])->name('auth0-callback');
Route::get('/login', [Auth0IndexController::class, 'login'])->name('login');
Route::get('/logout', [Auth0IndexController::class, 'logout'])->name('logout');
Route::get('/profile', [Auth0IndexController::class, 'profile'])->name('profile');

Route::post('/preformato',[PreformatoController::class,'store']);
Route::get('/gracias', [PreformatoController::class,'registrado']);
Route::group(['prefix'=>'ficha','middleware'=>'auth'],function (){
    Route::get('/', [FichaController::class,'index'])->name('ficha.inicio');
    Route::get('/pers',[FichaController::class,'create1']);
    Route::get('/prepa',[FichaController::class,'create2'])->name('ficha.prepa');
    Route::get('/muni_prepas',[FichaController::class,'muni_prepas'])->name('fichas.municipios.estados');
    //Route::post('/pers/captura1', 'AspiranteController@create1')->middleware('auth');
    Route::get('/datos',[FichaController::class,'create3'])->name('ficha.socio');
    Route::get('/emergencia',[FichaController::class,'create4'])->name('ficha.emer');
    Route::get('/verifica', [FichaController::class,'verificar']);
    Route::put('/actualiza',[FichaController::class,'update'])->name('ficha.modifica');
    Route::post('/personales',[FichaController::class,'alta1'])->name('ficha.create1');
    Route::post('/preparatoria',[FichaController::class,'alta2'])->name('ficha.create2');
    Route::post('/socioeconomico',[FichaController::class,'alta3'])->name('ficha.create3');
    Route::post('/emergencia',[FichaController::class,'alta4'])->name('ficha.create4');
    Route::get('/convocatoria',[FichaController::class,'convocatoria']);
    Route::get('/requisitos',[FichaController::class,'requisitos']);
    Route::get('/pagos',[FichaController::class,'pagos']);
    Route::get('/info',[FichaController::class,'error'])->name('ficha.error');
    Route::get('/info2',[FichaController::class,'error2'])->name('ficha.error2');
    Route::post('/recibos.pdf.php',[FichaController::class,'imprimir']);
});

/*
Route::get('/login', 'SessionsController@create');
Route::group(['middleware'=>'App\Http\Middleware\MemberMiddleware'],function (){
    Route::match(['get','post'],'/ficha','FichaController@index');
});
Route::get('/register', 'RegistrationController@create');
Route::get('/convocatoria', 'ConvocatoriaController@index');
Route::post('register', 'RegistrationController@store');

*/
