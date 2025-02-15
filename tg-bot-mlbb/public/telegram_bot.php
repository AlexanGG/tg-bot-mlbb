<?php

require __DIR__ . '/../vendor/autoload.php';

$app = require_once __DIR__ . '/../bootstrap/app.php';

// Создаем экземпляр бота и запускаем его
use App\Bot\TelegramBot;

$bot = new TelegramBot();
$bot->run();
