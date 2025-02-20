<?php
namespace App\Bot\Core;

use App\Bot\Commands\StartCommand;
use App\Bot\Commands\MetaCommand;
use App\Bot\Commands\BuildCommand;
use App\Bot\Services\TelegramService;

class TelegramBot
{
    private array $update;
    private TelegramService $telegramService;
    private array $commands = [];

    public function __construct(TelegramService $telegramService)
    {
        // Получаем данные обновления от Telegram через webhook
        $this->update = json_decode(file_get_contents("php://input"), true) ?? [];
        $this->telegramService = $telegramService;
        $this->initCommands();
    }

    private function initCommands(): void
    {
        // Регистрируем команды. Для добавления новых команд достаточно создать новый класс,
        // реализующий CommandInterface.
        $this->commands = [
            '/start' => new StartCommand($this->telegramService),
            '/meta'  => new MetaCommand($this->telegramService),
            '/build' => new BuildCommand($this->telegramService),
        ];
    }

    public function run(): void
    {
        if (empty($this->update)) {
            echo "Нет обновлений";
            return;
        }

        // Обработка callback-запросов (например, от inline-кнопок)
        if (isset($this->update['callback_query'])) {
            $callback = $this->update['callback_query'];
            $chatId = $callback['message']['chat']['id'];
            $data = $callback['data'];
            $this->telegramService->sendMessage($chatId, "Вы выбрали: {$data}");
            return;
        }

        // Обработка текстовых сообщений
        if (isset($this->update['message'])) {
            $message = $this->update['message'];
            $chatId = $message['chat']['id'];
            $text = trim($message['text'] ?? '');
            $command = explode(" ", $text)[0];

            if (isset($this->commands[$command])) {
                $this->commands[$command]->handle($message);
            } else {
                $this->telegramService->sendMessage($chatId, "Неизвестная команда. Попробуйте /start");
            }
        }
    }
}
