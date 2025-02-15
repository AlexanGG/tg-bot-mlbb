<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TelegramBotController extends Controller
{
    public function handleWebhook(Request $request): JsonResponse
    {
        // Получаем данные, отправленные Telegram
        $update = $request->all();

        // Логируем данные для отладки
        \Log::info('Received update: ', $update);

        // Можно здесь обрабатывать команду или сообщение, которое пришло
        // Например, если это текстовое сообщение, отвечаем на него
        if (isset($update['message']['text'])) {
            $messageText = $update['message']['text'];
            $chatId = $update['message']['chat']['id'];

            // Отправляем ответ через Telegram API
            $this->sendMessage($chatId, "Вы написали: $messageText");
        }

        return response()->json(['status' => 'ok']);
    }

    private function sendMessage($chatId, $text): void
    {
        $token = env('TELEGRAM_BOT_TOKEN');
        $url = "https://api.telegram.org/bot$token/sendMessage";

        $params = [
            'chat_id' => $chatId,
            'text' => $text
        ];

        // Отправляем POST-запрос к API Telegram
        file_get_contents($url . '?' . http_build_query($params));
    }
}
