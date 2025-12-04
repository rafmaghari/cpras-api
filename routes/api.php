<?php

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ManageOrganizationController;
use App\Http\Controllers\OrganizationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/register', [RegisterController::class, 'register']);

Route::middleware(['auth:sanctum', 'tenant'])->group(function () {

    Route::apiResource('organizations', OrganizationController::class);

    Route::prefix('/my-organizations')->group(function () {
        Route::get('/users', [ManageOrganizationController::class, 'index']);
        Route::post('/add-user', [ManageOrganizationController::class, 'addUserToOrganization']);
        Route::post('/remove-user', [ManageOrganizationController::class, 'removeUserFromOrganization']);
    });

    Route::get('/user', function (Request $request) {
        return $request->user()->load('organization');
    });
});
