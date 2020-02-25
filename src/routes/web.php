<?php

Route::group(['prefix' => 'yonetim/statistics', 'namespace' => 'ayzamodul\statistics\Http\Controllers','middleware' => ['web','auth']], function () {
    Route::match(['get', 'post'], '/', 'StatisticController@index')->name('yonetim.statistics');







});

