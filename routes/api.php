<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/health', function () {
    return $request->user();
})->middleware('auth:sanctum');
use Illuminate\Support\Facades\DB;

Route::get('/health', function () {
    try {
        DB::select('select 1');
        $dbOk = true;
    } catch (\Throwable $e) {
        $dbOk = false;
    }

    return response()->json([
        'app'      => config('app.name'),
        'time'     => now()->toIso8601String(),
        'database' => $dbOk ? 'ok' : 'unavailable',
    ], $dbOk ? 200 : 503);
});