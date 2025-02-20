<?php
namespace App\Bot\Commands;

use App\Bot\Interfaces\CommandInterface;
use App\Bot\Services\TelegramService;

class MetaCommand implements CommandInterface
{
    private TelegramService $telegramService;

    public function __construct(TelegramService $telegramService)
    {
        $this->telegramService = $telegramService;
    }

    public function handle(array $message): void
    {
        $chatId = $message['chat']['id'];
        $metaText = "Мета героев по ролям:\n" .
            "<b>Роумер:</b> S+, S, A, B\n" .
            "<b>Адк:</b> S+, A, B, C\n" .
            "<b>Мидер:</b> S+, S, A\n" .
            "<b>Эксп:</b> S+, A, B\n" .
            "<b>Лесник:</b> S+, S, A, B";
        $this->telegramService->sendMessage($chatId, $metaText);
    }
}
