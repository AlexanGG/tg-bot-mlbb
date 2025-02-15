<?php

namespace App\Bot\Admin;

class EditBuildCommand
{
    public function handle($message): void
    {
        $chat_id = $message['chat']['id'];
        // Логика перехода в режим редактирования сборки.
        $text = "Режим редактирования сборки активирован. Отправьте новые данные для обновления.";
        $this->sendMessage($chat_id, $text);
    }

    protected function sendMessage($chat_id, $text, $reply_markup = null): void
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
