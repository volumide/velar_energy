<?php

use Illuminate\Http\Request;

use App\Http\Invertercontroller;
use App\Http\Kvacontroller;
use App\Http\Loadscontroller;
use App\Http\Hourscontroller;
use App\Http\mailcontroller;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('allinverter', 'Invertercontroller@getinverter');
Route::get('allinverter/{kva}/{hour}/{email}', 'Invertercontroller@getkva');
Route::post('addproduct', 'Invertercontroller@saveinverter');

Route::get('allkva', 'Kvacontroller@getkva');
Route::get('addkva', 'Kvacontroller@savekva');

Route::get('allload', 'Loadcontroller@getload');
Route::post('addadd', 'Loadcontroller@saveload');

Route::get('allautonomy', 'Hourscontroller@getautonomy');
Route::get('addautonomy', 'Hourscontroller@saveautonomy');

Route::get('allcategory', 'Loadcategories@getload');
Route::get('addcategory', 'Loadcategories@getload');

Route::get('allcustomer', 'Customercontroller@getcustomer');
Route::post('addcustomer', 'Customercontroller@savecustomer');

Route::get('testmail', 'mailcontroller@mail');
Route::get('sendpdf', 'Generatepdf@generatePDF');

Route::post('check', 'formcontroller@savedata');
