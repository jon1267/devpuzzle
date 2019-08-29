<?php

Route::get('/', function () {
    return view('welcome');
});

Route::get('/start', 'CalendarController@index')->name('index.home');

Route::post('/add-day', 'CalendarController@store');

Route::get('/calendar', 'CalendarController@show');

Route::get('/good-days', 'CalendarController@goodDays');

