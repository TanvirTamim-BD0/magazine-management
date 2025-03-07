<?php

Route::redirect('/', '/login');
Route::get('/home', function () {
    if (session('status')) {
        return redirect()->route('admin.home')->with('status', session('status'));
    }

    return redirect()->route('admin.home');
});

Auth::routes(['register' => false]);

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth']], function () {
    Route::get('/', 'HomeController@index')->name('home');
    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::resource('users', 'UsersController');
    Route::resource('category', 'CategoryController');
    Route::resource('company', 'CompanyController');
    Route::resource('designation', 'DesignationController');

    Route::resource('client', 'ClientController');
    Route::resource('magazine', 'MagazineController');
    Route::resource('magazine-send', 'MagazineSendController');
    
    Route::get('client-magazine/{id}', [App\Http\Controllers\Admin\MagazineSendController::class, 'clientMagazine'])->name('client.magazine');
    Route::get('magazine-send-status/{id}', [App\Http\Controllers\Admin\MagazineSendController::class, 'magazineSendStatus'])->name('magazine-send-status');
    Route::get('magazine-receive-status/{id}', [App\Http\Controllers\Admin\MagazineSendController::class, 'magazineReceiveStatus'])->name('magazine-receive-status');

    Route::get('client-data-export', [App\Http\Controllers\Admin\ClientController::class, 'clientDataExport'])->name('client.data.export');
    Route::post('client-data-export-area-filter', [App\Http\Controllers\Admin\ClientController::class, 'areaFilter'])->name('area.filter');
    

    Route::resource('task', 'TaskController');
    Route::get('task-completed/{id}', [App\Http\Controllers\Admin\TaskController::class, 'taskCompleted'])->name('task.completed');

    Route::get('task-monthly', [App\Http\Controllers\Admin\TaskController::class, 'monthly'])->name('task.monthly');
    Route::get('task-today', [App\Http\Controllers\Admin\TaskController::class, 'today'])->name('task.today');
    Route::get('task-pending', [App\Http\Controllers\Admin\TaskController::class, 'pending'])->name('task.pending');
    Route::get('tasks-completed', [App\Http\Controllers\Admin\TaskController::class, 'completed'])->name('tasks.completed');

    Route::put('admin-comment/{id}', [App\Http\Controllers\Admin\TaskController::class, 'adminComment'])->name('admin.comment');

    Route::resource('notice', 'NoticeController');

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
