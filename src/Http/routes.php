<?php

Route::group(['middleware' => ['web']], function () {
    Route::prefix(config('app.admin_path'))->group(function () {

        // Admin Routes
        Route::group(['middleware' => ['user']], function () {

            // Activities Routes
            Route::group([
                'prefix'    => 'activities',
                'namespace' => 'Webkul\CalendarApp\Http\Controllers\Activity',
            ], function () {
                Route::post('download-ics', 'ActivityController@downloadICS')->name('admin.activities.download-ics');
            });
        });
    });
});