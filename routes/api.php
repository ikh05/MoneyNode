<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IcABotTelegramController;

Route::apiResource('bot/telegram', IcABotTelegramController::class);
