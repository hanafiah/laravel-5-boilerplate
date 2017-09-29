<?php

/**
 * All route names are prefixed with 'admin.auth'.
 */
Route::group([
    'prefix'     => 'auth',
    'as'         => 'auth.',
    'namespace'  => 'Auth',
], function () {
    Route::group([
        'middleware' => 'role:administrator',
    ], function () {
        /*
         * User Management
         */
        Route::group(['namespace' => 'User'], function () {

			/*
			 * User Status'
			 */
			Route::get('user/deactivated', 'UserStatusController@getDeactivated')->name('user.deactivated');
			Route::get('user/deleted', 'UserStatusController@getDeleted')->name('user.deleted');


			/*
			 * User CRUD
			 */
            Route::resource('user', 'UserController');

            /*
             * Specific User
             */
            Route::group(['prefix' => 'user/{user}'], function () {
                // Confirmation
                Route::get('confirm', 'UserConfirmationController@confirm')->name('user.confirm');
                Route::get('unconfirm', 'UserConfirmationController@unconfirm')->name('user.unconfirm');
            });
        });

        /*
         * Role Management
         */
        Route::group(['namespace' => 'Role'], function () {
        });
    });
});
