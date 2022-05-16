<?php

Route::get('/', HomeController::class);
Route::get('/home', function () {
    if (session('status')) {
        return redirect()->route('admin.home')->with('status', session('status'));
    }

    return redirect()->route('admin.home');
});

Auth::routes();

Route::group(['prefix' => 'dashboard', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth']], function () {
    Route::get('/', 'HomeController@index')->name('home');
    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::post('users/parse-csv-import', 'UsersController@parseCsvImport')->name('users.parseCsvImport');
    Route::post('users/process-csv-import', 'UsersController@processCsvImport')->name('users.processCsvImport');
    Route::resource('users', 'UsersController');

    // School
    Route::delete('schools/destroy', 'SchoolController@massDestroy')->name('schools.massDestroy');
    Route::post('schools/media', 'SchoolController@storeMedia')->name('schools.storeMedia');
    Route::post('schools/ckmedia', 'SchoolController@storeCKEditorImages')->name('schools.storeCKEditorImages');
    Route::post('schools/parse-csv-import', 'SchoolController@parseCsvImport')->name('schools.parseCsvImport');
    Route::post('schools/process-csv-import', 'SchoolController@processCsvImport')->name('schools.processCsvImport');
    Route::resource('schools', 'SchoolController');

    // Major
    Route::delete('majors/destroy', 'MajorController@massDestroy')->name('majors.massDestroy');
    Route::post('majors/media', 'MajorController@storeMedia')->name('majors.storeMedia');
    Route::post('majors/ckmedia', 'MajorController@storeCKEditorImages')->name('majors.storeCKEditorImages');
    Route::post('majors/parse-csv-import', 'MajorController@parseCsvImport')->name('majors.parseCsvImport');
    Route::post('majors/process-csv-import', 'MajorController@processCsvImport')->name('majors.processCsvImport');
    Route::resource('majors', 'MajorController');
});
Route::group(['prefix' => 'profile', 'as' => 'profile.', 'namespace' => 'Auth', 'middleware' => ['auth']], function () {
    // Change password
    if (file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php'))) {
        Route::get('password', 'ChangePasswordController@edit')->name('password.edit');
        Route::post('password', 'ChangePasswordController@update')->name('password.update');
        Route::post('profile', 'ChangePasswordController@updateProfile')->name('password.updateProfile');
        Route::post('profile/destroy', 'ChangePasswordController@destroy')->name('password.destroyProfile');
    }
});