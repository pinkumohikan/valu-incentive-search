<?php

Route::get('/', 'TopController@show');

Route::get('/incentives/search', 'SearchController@search');

Route::get('/incentives/{id}', 'IncentiveController@show')
    ->where('id', '[0-9]+');
