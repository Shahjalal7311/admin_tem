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

Route::get('',function () {return view('font_view');});

Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');
Route::group(['prefix' => 'admin'], function() {
  Auth::routes();
	Route::group( ['middleware' => ['auth']], function() {
    Route::get('/dashboard', 'HomeController@index')->name('dashboard');
    Route::resource('/users', 'Admin\UserController');
    Route::resource('/roles', 'Admin\RoleController');
    Route::resource('/posts', 'Admin\PostController');
    Route::resource('/articals', 'Admin\ArticalController');
    Route::post('/slug-create', 'Admin\ArticalController@slugCreate')->name('slug-create');
    Route::get('/password_change', 'Admin\UserController@password_change')->name('password_change');
    Route::post('/password_update', 'Admin\ArticalController@postCredentials')->name('password_update');
    Route::get('/add', 'PostController@csvupload')->name('add');
    Route::post('/import', 'PostController@import')->name('import');
    //file manager
    Route::get('/laravel-filemanager', '\UniSharp\LaravelFilemanager\Controllers\LfmController@show');
  	Route::post('/laravel-filemanager/upload', '\UniSharp\LaravelFilemanager\Controllers\UploadController@upload');

    //Dropzone file return route
    Route::post('dropzone/store', ['as'=>'dropzone.store','uses'=>'Admin\DropZoneController@storeMedia']);
    //thum image
    Route::get('resizeImage', 'ImageController@resizeImage');
    Route::post('resizeImagePost',['as'=>'resizeImagePost','uses'=>'ImageController@resizeImagePost']);
    Route::get('/print_pdf', 'Admin\PostController@printPDF')->name('print_pdf');
	});
});
