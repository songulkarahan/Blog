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

Route::get('/', function () {
   // return view('welcome');
    return redirect()->route('blogs.index');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/havadurumu', 'HomeController@showWeather')->name('showWeather');

Route::get('/blogs' , 'BlogController@index')->name('blogs.index');
Route::get('/blogs/new' , 'BlogController@create')->name('blogs.create')->middleware('auth','checkage:100');//name rotanın ismi nerde blogs.create varsa onu blogs/new uzantısna getirir adres değiştirsem de akış bozulmaması için
Route::post('/blogs' , 'BlogController@store')->name('blogs.store')->middleware('auth');//auth middlewareden getir verileri öyle gel diyor
Route::get('/blogs/{blog}' , 'BlogController@detail')->name('blogs.detail');

Route::get('/blogs' , 'BlogController@index')->name('blogs.index');
Route::get('/blogs/new' , 'BlogController@create')->name('blogs.create')->middleware('auth');//name rotanın ismi nerde blogs.create varsa onu blogs/new uzantısna getirir adres değiştirsem de akış bozulmaması için
Route::post('/blogs' , 'BlogController@store')->name('blogs.store')->middleware('auth');//auth middlewareden getir verileri öyle gel diyor
Route::get('/blogs/{blog}' , 'BlogController@detail')->name('blogs.detail');

//middleware kısmını sadece ekle ve kaydet alanlarına eklemesinin sebebi okusun görebilsin ama kullanıcı değilse işlem yapamasın mantığına yardımcı
//middleware uygulamanın önüne katman oluşturmamıza yarar, talepler oluşturabiliriz örneğin
//Route::get('/blogs/{id}' , 'BlogController@delete')->name('blogs.delete');

Route::get('/blogs/{blog}/edit' , 'BlogController@edit')->name('blogs.edit')->middleware('auth');
Route::post('/blogs/{blog}' , 'BlogController@update')->name('blogs.update')->middleware('auth');
Route::post('/blogs/{blog}/comments' , 'BlogController@addComment')->name('blogs.addComment')->middleware('auth');
Route::get('/tags/{tag}' , 'BlogController@tagBlogs')->name('tag.blogs')->middleware('auth');
Route::get('/users/{user}/blogs' , 'BlogController@userBlogs')->name('user.blogs')->middleware('auth');

Route::post('profile', 'ProfileController@update')->name('profile.update')->middleware('auth');
Route::post('{user}/follow', 'ProfileController@follow')->name('follow');
Route::post('{user}/unfollow', 'ProfileController@unfollow')->name('unfollow');
Route::get('{user}', 'ProfileController@profile')->name('profile');
