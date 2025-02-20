<?php
namespace App\Bot\Commands;

use App\Bot\Interfaces\CommandInterface;
use App\Bot\Services\TelegramService;

class StartCommand implements CommandInterface
{
    private TelegramService $telegramService;

    public function __construct(TelegramService $telegramService)
    {
        $this->telegramService = $telegramService;
    }

    public function handle(array $message): void
    {
        $chatId = $message['chat']['id'];
        $text = "Привет! Добро пожаловать в бота по МЛББ.\n" .
            "Используйте /meta для получения меты и /build для получения сборки героя.";
        $this->telegramService->sendMessage($chatId, $text);
    }
}
