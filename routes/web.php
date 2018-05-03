<?php

Route::get('/', 'TopController@show');

Route::post('/display-permissions', 'DisplayPermissionController@create');

Route::get('/incentives/search', 'SearchController@show');

Route::get('/incentives/{id}', 'IncentiveController@show')
    ->where('id', '[0-9]+');
