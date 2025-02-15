<?php

namespace App\Bot\Commands;

class BuildCommand
{
    public function handle($message): void
    {
        $chat_id = $message['chat']['id'];
        $parts = explode(" ", $message['text']);

        // Если имя героя передано сразу, например, "/build Joy"
        if (isset($parts[1])) {
            $hero = trim($parts[1]);
            $buildInfo = $this->getBuildForHero($hero);
            $this->sendPhoto($chat_id, $buildInfo['photo'], $buildInfo['caption']);
        } else {
            // Если имя героя не указано — показываем inline-клавиатуру с вариантами (заглушка)
            $text = "Выберите героя:";
            $keyboard = [
                'inline_keyboard' => [
                    [
                        ['text' => 'Joy',     'callback_data' => '/build Joy'],
                        ['text' => 'Hero2',   'callback_data' => '/build Hero2']
                    ],
                    [
                        ['text' => 'Hero3',   'callback_data' => '/build Hero3'],
                        ['text' => 'Hero4',   'callback_data' => '/build Hero4']
                    ]
                ]
            ];
            $this->sendMessage($chat_id, $text, json_encode($keyboard));
        }
    }

    protected function getBuildForHero($hero): array
    {
        // Заглушка: в реальности данные будут из БД
        return [
            'photo'   => 'https://via.placeholder.com/300', // Заглушка для изображения
            'caption' => "Сборка для героя <b>{$hero}</b>:\nПредметы: Item1, Item2\nЭмблемы: Emblem1\nСпеллы: Spell1, Spell2"
        ];
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

    protected function sendPhoto($chat_id, $photoUrl, $caption): void
    {
        $token = env('TELEGRAM_BOT_TOKEN');
        $url = "https://api.telegram.org/bot{$token}/sendPhoto";

        $data = [
            'chat_id'    => $chat_id,
            'photo'      => $photoUrl,
            'caption'    => $caption,
            'parse_mode' => 'HTML'
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_exec($ch);
        curl_close($ch);
    }
}
