<?php

use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});
Route::get('/home', 'StikerController@index')->name('home')->middleware('auth');

Auth::routes();

Route::get('/index', 'IndexStikerController@index')->name('stiker.index')->middleware('auth');
Route::get('/index/{org}/{$rng}', 'IndexStikerController@index')->middleware('auth');
Route::get('/topdf','IndexStikerController@toPDF')->name('topdf')->middleware('auth');
Route::get('/test','IndexStikerController@test')->name('test')->middleware('auth');



// Route::get('/home', 'HomeController@index')->name('home')->middleware('auth');

// Route::get('/stiker', 'StikerController@index')->name('home');
// Route::get('/stiker/search', 'StikerController@searchData')->name('search.stiker');

// Route::get('/search-stiker/{organisasi}/{ruang}', 'SearchstikerController@searchData')->name('stiker.search')->middleware('auth');
// Route::get('stiker/{organisasi}/{ruang}', function ($organisasi, $ruang) {
//     $data = DB::table('kib')->join('masterruang', 'masterruang.kodebidang', '=', 'kib.kodebidang')
//     ->whereRaw("uraiorganisasi =  '$organisasi' and ruang = '$ruang' and statusdata='aktif' ")->get();
//     print_r($data);
// })->name('stiker.data');

// Route::get('/stiker', 'StikerController@index')->name('stiker.index')->middleware('auth');
// Route::get('/stiker-list', 'StikerController@stikerList')->name('stiker.list')->middleware('auth'); 
// Route::get('/stiker/getkode/{kode_barang}', 'StikerController@getKode')->middleware('auth');
// Route::post('/stiker/store', 'StikerController@StoreintoChart')->name('stiker.store')->middleware('auth');

// Route::get('/stiker/chart', 'ChartController@index')->name('stiker.chart')->middleware('auth');

// Route::get('/truncate','ChartController@truncateCharts')->name('truncate')->middleware('auth');

// Route::get('/foobar','ChartController@foobar'); //testing function

// Route::get('qrcode', function () {
//     return QrCode::size(300)->generate('PAKETANMU SIDO KON NGEWANGI NGENTEKE ORA? :-) ');
// });
