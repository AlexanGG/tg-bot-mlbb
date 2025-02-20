<?php

namespace App\Bot\Interfaces;

interface CommandInterface
{
    /**
     * Обработка входящего сообщения от Telegram.
     *
     * @param array $message
     */
    public function handle(array $message): void;
}
