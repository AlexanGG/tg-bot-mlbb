<?php

namespace App\Bot\Commands;

class MetaCommand
{
    public function handle($message): void
    {
        $chat_id = $message['chat']['id'];
        $parts = explode(" ", $message['text']);

        // Если роль передана сразу, например, "/meta Мидер"
        if (isset($parts[1])) {
            $role = trim($parts[1]);
            $metaInfo = $this->getMetaForRole($role);
            $text = "Мета для роли <b>{$role}</b>:\n" . $metaInfo;
            $this->sendMessage($chat_id, $text);
        } else {
            // Если роль не указана — показываем inline-клавиатуру с вариантами
            $text = "Выберите роль:";
            $keyboard = [
                'inline_keyboard' => [
                    [
                        ['text' => 'Роумер', 'callback_data' => '/meta Роумер'],
                        ['text' => 'Адк',    'callback_data' => '/meta Адк']
                    ],
                    [
                        ['text' => 'Мидер', 'callback_data' => '/meta Мидер'],
                        ['text' => 'Эксп',  'callback_data' => '/meta Эксп']
                    ],
                    [
                        ['text' => 'Лесник', 'callback_data' => '/meta Лесник']
                    ]
                ]
            ];
            $this->sendMessage($chat_id, $text, json_encode($keyboard));
        }
    }

    protected function getMetaForRole($role): string
    {
        // Заглушка: в реальности данные будут из БД
        $meta = [
            'Роумер' => "S+: Роумер_Легенда, S: Роумер_Мастер, A: Роумер_Профи, B: Роумер_Норм",
            'Адк'    => "S+: Адк_Легенда, S: Адк_Мастер, A: Адк_Профи, B: Адк_Норм",
            'Мидер'  => "S+: Мидер_Легенда, S: Мидер_Мастер, A: Мидер_Профи, B: Мидер_Норм",
            'Эксп'   => "S+: Эксп_Легенда, S: Эксп_Мастер, A: Эксп_Профи, B: Эксп_Норм",
            'Лесник' => "S+: Лесник_Легенда, S: Лесник_Мастер, A: Лесник_Профи, B: Лесник_Норм",
        ];

        return $meta[$role] ?? "Информация отсутствует.";
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
