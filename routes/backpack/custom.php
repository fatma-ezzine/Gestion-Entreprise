<?php

// --------------------------
// Custom Backpack Routes
// --------------------------
// This route file is loaded automatically by Backpack\Base.
// Routes you generate using Backpack\Generators will be placed here.

Route::group([
    'prefix'     => config('backpack.base.route_prefix', 'admin'),
    'middleware' => array_merge(
        (array) config('backpack.base.web_middleware', 'web'),
        (array) config('backpack.base.middleware_key', 'admin')
    ),
    'namespace'  => 'App\Http\Controllers\Admin',
], function () { // custom admin routes
    Route::crud('salarie', 'SalarieCrudController');
    Route::crud('ville', 'VilleCrudController');
    Route::crud('gouvernorat', 'GouvernoratCrudController');
    Route::crud('manager', 'ManagerCrudController');
    Route::crud('conge', 'CongeCrudController');
    Route::crud('typeconge', 'TypeCongeCrudController');
    Route::get('conge/{id}/valider', 'CongeCrudController@valider');
    Route::get('conge/{id}/refuser', 'CongeCrudController@refuser');
    Route::get('api/ville', 'App\Http\Controllers\Api\VilleController@index');


    //Route::get('full-calender', [FullCalenderController::class, 'index']);
    //Route::post('full-calender/action', [FullCalenderController::class, 'action']);
}); // this should be the absolute last line of this file
