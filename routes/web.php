<?php
ini_set('max_execution_time', 43200); // 12h

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;

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

Route::get('/', [MainController::class, 'form']);
Route::get('/export', [MainController::class, 'export']);
Route::post('/import', [MainController::class, 'import']);
