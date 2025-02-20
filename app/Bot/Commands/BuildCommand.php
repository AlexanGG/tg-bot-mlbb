<?php
namespace App\Bot\Commands;

use App\Bot\Interfaces\CommandInterface;
use App\Bot\Services\TelegramService;

class BuildCommand implements CommandInterface
{
    private TelegramService $telegramService;

    public function __construct(TelegramService $telegramService)
    {
        $this->telegramService = $telegramService;
    }

    public function handle(array $message): void
    {
        $chatId = $message['chat']['id'];
        $text = "Выберите героя для получения сборки:";
        $keyboard = [
            'inline_keyboard' => [
                [
                    ['text' => 'Герой 1', 'callback_data' => 'build_hero_1'],
                    ['text' => 'Герой 2', 'callback_data' => 'build_hero_2']
                ],
                [
                    ['text' => 'Герой 3', 'callback_data' => 'build_hero_3'],
                    ['text' => 'Герой 4', 'callback_data' => 'build_hero_4']
                ]
            ]
        ];
        $this->telegramService->sendMessage($chatId, $text, $keyboard);
    }
}
