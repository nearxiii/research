<?php

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

// Route::get('/', function () {
//     return view('index');
// });

Route::get('/research/create',array('as'=>'create','uses'=>'ResearchController@index'));
Route::get('/findPrice',array('as'=>'findPrice','uses'=>'ResearchController@findPrice'));
Route::post('/store',array('as'=>'store','uses'=>'ResearchController@store'));
Route::get('/research', 'ResearchController@show');
Route::get('/research/search', 'ResearchController@show');
Route::get('/research/edit/{id}', 'ResearchController@edit')->name('research.edit');
Route::get('/print/{id}', 'ResearchController@print')->name('research.result');
Route::delete('/research/destroy/{id}', 'ResearchController@destroy');
Route::patch('/research/update/{id}', 'ResearchController@update');

