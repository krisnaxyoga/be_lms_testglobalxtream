<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\Auth\LoginController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function ($router) {
       Route::post('/login', [LoginController::class, 'login'])->name('login');
  });

  Route::middleware(['auth:api'])->group(function () {
    Route::get('/leads', [\App\Http\Controllers\Api\Lead\LeadController::class, 'index'])->name('leads');
    Route::post('/leads', [\App\Http\Controllers\Api\Lead\LeadController::class, 'store'])->name('leads.store');
    Route::get('/leads/{lead}', [\App\Http\Controllers\Api\Lead\LeadController::class, 'show'])->name('leads.show');
    Route::put('/leads/{lead}', [\App\Http\Controllers\Api\Lead\LeadController::class, 'update'])->name('leads.update');
    Route::delete('/leads/{lead}', [\App\Http\Controllers\Api\Lead\LeadController::class, 'destroy'])->name('leads.destroy');

    Route::get('/lead_types', [\App\Http\Controllers\Api\Master\LeadTypeController::class, 'index'])->name('lead_types.index');
    Route::post('/lead_types', [\App\Http\Controllers\Api\Master\LeadTypeController::class, 'store'])->name('lead_types.store');
    Route::get('/lead_types/{lead_type}', [\App\Http\Controllers\Api\Master\LeadTypeController::class, 'show'])->name('lead_types.show');
    Route::put('/lead_types/{lead_type}', [\App\Http\Controllers\Api\Master\LeadTypeController::class, 'update'])->name('lead_types.update');
    Route::delete('/lead_types/{lead_type}', [\App\Http\Controllers\Api\Master\LeadTypeController::class, 'destroy'])->name('lead_types.destroy');
    Route::get('/lead_channels', [\App\Http\Controllers\Api\Master\LeadChannelController::class, 'index'])->name('lead_channels.index');
    Route::post('/lead_channels', [\App\Http\Controllers\Api\Master\LeadChannelController::class, 'store'])->name('lead_channels.store');
    Route::get('/lead_channels/{lead_channel}', [\App\Http\Controllers\Api\Master\LeadChannelController::class, 'show'])->name('lead_channels.show');
    Route::put('/lead_channels/{lead_channel}', [\App\Http\Controllers\Api\Master\LeadChannelController::class, 'update'])->name('lead_channels.update');
    Route::delete('/lead_channels/{lead_channel}', [\App\Http\Controllers\Api\Master\LeadChannelController::class, 'destroy'])->name('lead_channels.destroy');
    Route::get('/lead_sources', [\App\Http\Controllers\Api\Master\LeadSourcesController::class, 'index'])->name('lead_sources.index');
    Route::post('/lead_sources', [\App\Http\Controllers\Api\Master\LeadSourcesController::class, 'store'])->name('lead_sources.store');
    Route::get('/lead_sources/{lead_source}', [\App\Http\Controllers\Api\Master\LeadSourcesController::class, 'show'])->name('lead_sources.show');
    Route::put('/lead_sources/{lead_source}', [\App\Http\Controllers\Api\Master\LeadSourcesController::class, 'update'])->name('lead_sources.update');
    Route::delete('/lead_sources/{lead_source}', [\App\Http\Controllers\Api\Master\LeadSourcesController::class, 'destroy'])->name('lead_sources.destroy');
    Route::get('/lead_probabilities', [\App\Http\Controllers\Api\Master\LeadProbabilitiesController::class, 'index'])->name('lead_probabilities.index');
    Route::post('/lead_probabilities', [\App\Http\Controllers\Api\Master\LeadProbabilitiesController::class, 'store'])->name('lead_probabilities.store');
    Route::get('/lead_probabilities/{lead_probability}', [\App\Http\Controllers\Api\Master\LeadProbabilitiesController::class, 'show'])->name('lead_probabilities.show');
    Route::put('/lead_probabilities/{lead_probability}', [\App\Http\Controllers\Api\Master\LeadProbabilitiesController::class, 'update'])->name('lead_probabilities.update');
    Route::delete('/lead_probabilities/{lead_probability}', [\App\Http\Controllers\Api\Master\LeadProbabilitiesController::class, 'destroy'])->name('lead_probabilities.destroy');
    Route::get('/lead_statuses', [\App\Http\Controllers\Api\Master\LeadStatusesController::class, 'index'])->name('lead_statuses.index');
    Route::post('/lead_statuses', [\App\Http\Controllers\Api\Master\LeadStatusesController::class, 'store'])->name('lead_statuses.store');
    Route::get('/lead_statuses/{lead_status}', [\App\Http\Controllers\Api\Master\LeadStatusesController::class, 'show'])->name('lead_statuses.show');
    Route::put('/lead_statuses/{lead_status}', [\App\Http\Controllers\Api\Master\LeadStatusesController::class, 'update'])->name('lead_statuses.update');
    Route::delete('/lead_statuses/{lead_status}', [\App\Http\Controllers\Api\Master\LeadStatusesController::class, 'destroy'])->name('lead_statuses.destroy');
    Route::get('/lead_medias', [\App\Http\Controllers\Api\Master\LeadMediasController::class, 'index'])->name('lead_medias.index');
    Route::post('/lead_medias', [\App\Http\Controllers\Api\Master\LeadMediasController::class, 'store'])->name('lead_medias.store');
    Route::get('/lead_medias/{lead_media}', [\App\Http\Controllers\Api\Master\LeadMediasController::class, 'show'])->name('lead_medias.show');
    Route::put('/lead_medias/{lead_media}', [\App\Http\Controllers\Api\Master\LeadMediasController::class, 'update'])->name('lead_medias.update');
    Route::delete('/lead_medias/{lead_media}', [\App\Http\Controllers\Api\Master\LeadMediasController::class, 'destroy'])->name('lead_medias.destroy');
});
