<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use LaravelJsonApi\Laravel\Facades\JsonApiRoute;
use LaravelJsonApi\Laravel\Http\Controllers\JsonApiController;
use LaravelJsonApi\Laravel\Routing\ResourceRegistrar;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

JsonApiRoute::server('v1')
    ->prefix('v1')
    ->resources(function (ResourceRegistrar $server) {
        $server->resource('sponsors', JsonApiController::class)->readOnly();
        $server->resource('events', JsonApiController::class)
            ->readOnly()
            ->relationships(function ($relations) {
                $relations->hasOne('car')->readOnly();
            });
        $server->resource('news-items', JsonApiController::class)->readOnly();
        $server->resource('cars', JsonApiController::class)
            ->readOnly()
            ->relationships(function ($relations) {
                $relations->hasMany('events')->readOnly();
            });
    });
