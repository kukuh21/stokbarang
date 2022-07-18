<?php
Auth::routes();
Route::get('/login','Auth\LoginController@showLoginForm');
Route::get('/register','Auth\LoginController@showRegisterForm')->name('registerform');
Route::post('/register','Auth\LoginController@register');
Route::post('/login','Auth\LoginController@login')->name('login');
Route::post('/logout','Auth\LoginController@logout')->name('logout');

Route::get('/','HomeController@index')->middleware(['web','role:Admin|User']);
Route::get('/home','HomeController@index')->middleware(['web','role:Admin|User']);

Route::resource('profile', 'ProfileController')->middleware(['web','role:Admin|User']);

Route::get('/json/getperpustakaan/{id}','JsonController@getperpustakaan')->name('json.getperpustakaan');



Route::group(['middleware' => ['web' , 'role:Admin']], function () {
  Route::namespace('Master')->group(function() {

    Route::get('/bidang/data','BidangController@data')->name('bidang.data');
    Route::resource('/bidang','BidangController');

    Route::get('/satuan/data','SatuanController@data')->name('satuan.data');
    Route::resource('/satuan','SatuanController');

    Route::get('/barang/data','BarangController@data')->name('barang.data');
    Route::post('/barang/import','BarangController@import')->name('barang.import');
    Route::get('/barang/print','BarangController@print')->name('barang.print');
    Route::resource('/barang','BarangController');

  });

  Route::namespace('Admin')->group(function() {

    Route::get('/barangmasuk/data','BarangMasukController@data')->name('barangmasuk.data');
    Route::resource('/barangmasuk','BarangMasukController');

    Route::get('/manajemenuser/data','ManajemenUserController@data')->name('manajemenuser.data');
    Route::resource('/manajemenuser','ManajemenUserController');
  });
});

Route::group(['middleware' => ['web' , 'role:Admin|User']], function () {

  Route::namespace('Admin')->group(function() {

    Route::get('/order/orderdetail/{id}','OrderController@orderdetail')->name('order.orderdetail');
    Route::post('/order/orderdetailStore','OrderController@orderdetailStore')->name('order.orderdetailStore');
    Route::get('/order/dataOrderDetail/{id}','OrderController@dataOrderDetail')->name('order.dataOrderDetail');
    Route::patch('/order/orderdetailUpdate/{id}','OrderController@orderdetailUpdate')->name('order.orderdetailUpdate');
    Route::delete('/order/orderdetailHapus/{id}','OrderController@orderdetailHapus')->name('order.orderdetailHapus');
    Route::get('/order/simpanTransaksi/{id}','OrderController@simpanTransaksi')->name('order.simpanTransaksi');

    Route::get('/order/create/{id}','OrderController@create')->name('order.create');
    Route::get('/order/data','OrderController@data')->name('order.data');

    // print order
    Route::get('/order/orderprint/{id}','OrderController@orderprint')->name('order.orderprint');
    Route::post('/order/orderprintpertanggal','OrderController@orderprintpertanggal')->name('order.orderprintpertanggal');

    Route::resource('order','OrderController');
  });
});


Route::group(['middleware' => ['web', 'role:User']], function () {
  Route::namespace('User')->group(function() {

    Route::get('/stokbarang/data','StokBarangController@data')->name('stokbarang.data');
    Route::resource('/stokbarang','StokBarangController');
  });
});