<?php

namespace App\Http\Controllers;

use App\Bot\Core\TelegramBot;
use App\Bot\Services\TelegramService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class TelegramController extends Controller
{
    public function handle(Request $request): JsonResponse
    {
        Log::info('Telegram update received:', $request->all());

        $botToken = config('telegram.bot_token');
        $telegramService = new TelegramService($botToken);
        $bot = new TelegramBot($telegramService);
        $bot->run();

        return response()->json(['status' => 'ok']);
    }
}
