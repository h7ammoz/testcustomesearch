<?php

// MyVendor\search\src\routes\web.php
Route::group(['namespace' => 'MyVendor\Search\Http\Controllers', 'middleware' => ['web']], function() {
    Route::get('search', 'CustomSearchController@index');
    //Route::get('search/results', 'CustomSearchController@results');
    Route::post('search/results_save', 'CustomSearchController@results_save');
    Route::get('search/all_results', 'CustomSearchController@all_results');
    Route::post('search/delete/{id}/', 'CustomSearchController@delete');
    Route::post('search/edit/{id}/', 'CustomSearchController@edit');
});
