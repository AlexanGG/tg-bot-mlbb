<?php

namespace App\Bot;

use App\Bot\Commands\StartCommand;
use App\Bot\Commands\MetaCommand;
use App\Bot\Commands\BuildCommand;
use App\Bot\Admin\EditMetaCommand;
use App\Bot\Admin\EditBuildCommand;

class TelegramBot
{
    protected mixed $update;
    protected array $commands = [];

    public function __construct()
    {
        $this->update = $this->getUpdate();
        $this->initCommands();
    }

    /**
     * Получаем обновление от Telegram (webhook)
     */
    protected function getUpdate()
    {
        $content = file_get_contents("php://input");
        return json_decode($content, true);
    }

    /**
     * Инициализируем список команд
     */
    protected function initCommands(): void
    {
        // Основные команды
        $this->commands = [
            '/start' => StartCommand::class,
            '/meta'  => MetaCommand::class,
            '/build' => BuildCommand::class,
            // Админские команды
            'edit_meta'  => EditMetaCommand::class,
            'edit_build' => EditBuildCommand::class,
        ];
    }

    /**
     * Запускаем обработку обновления
     */
    public function run(): void
    {
        if (!$this->update) {
            echo "Нет обновления";
            return;
        }

        // Если это callback_query (при нажатии inline кнопок), можно обработать отдельно
        if (isset($this->update['callback_query'])) {
            $callback = $this->update['callback_query'];
            $message  = $callback['message'];
            $data     = $callback['data']; // данные, отправленные в callback_data
            $command  = $this->parseCommand($data);
            $this->handleCommand($command, $message);
            return;
        }

        // Обработка обычного текстового сообщения
        if (isset($this->update['message'])) {
            $message = $this->update['message'];
            $text = $message['text'] ?? '';
            $command = $this->parseCommand($text);
            if ($command) {
                $this->handleCommand($command, $message);
            } else {
                $this->sendMessage($message['chat']['id'], "Команда не распознана. Попробуйте /start");
            }
        }
    }

    /**
     * Извлекаем команду из текста сообщения
     */
    protected function parseCommand($text): string
    {
        $parts = explode(" ", trim($text));
        return $parts[0];
    }

    /**
     * Вызываем обработчик для команды
     */
    protected function handleCommand($command, $message): void
    {
        $chat_id = $message['chat']['id'];
        if (isset($this->commands[$command])) {
            $commandClass = $this->commands[$command];
            $instance = new $commandClass();
            $instance->handle($message);
        } else {
            $this->sendMessage($chat_id, "Команда не найдена");
        }
    }

    /**
     * Отправка сообщения через Telegram API
     */
    public function sendMessage($chat_id, $text, $reply_markup = null): void
    {
        $token = env('TELEGRAM_BOT_TOKEN');
        $url = "https://api.telegram.org/bot{$token}/sendMessage";

        $data = [
            'chat_id'    => $chat_id,
            'text'       => $text,
            'parse_mode' => 'HTML',
        ];
        if ($reply_markup) {
            $data['reply_markup'] = $reply_markup;
        }

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_exec($ch);
        curl_close($ch);
    }
}
