<?php

use BotMan\BotMan\BotMan;
use BotMan\BotMan\BotManFactory;
use BotMan\BotMan\Drivers\DriverManager;
use BotMan\Drivers\Telegram\TelegramDriver;

require_once 'vendor/autoload.php';
require_once 'translate/translate.php';

$configs = [
    'telegram' => [
        'token' => file_get_contents('private/telegram/TOKEN.txt')
    ]
];

DriverManager::loadDriver(TelegramDriver::class);

$botman = BotManFactory::create($configs);

$botman->hears('/start', function (BotMan $bot) {
    $user = $bot->getUser();
    $bot->reply('Hello ' . $user->getFirstName() . ' 😊');
    $bot->reply('Perkenalkan, saya bot translator bahasa inggris ke bahasa jerman');
    $bot->reply('Silahkan cek /help untuk melihat perintah');
});

$botman->hears('/help', function (BotMan $bot) {
    $message  = '/start - greeting' . PHP_EOL . PHP_EOL;
    $message .= '/translate {text} - Mulai percakapan translasi' . PHP_EOL . PHP_EOL;
    $message .= 'Tap & tahan perintah selama 2 detik untuk menulis perintah secara instan';
    $bot->reply($message);
});

$botman->hears('/translate {text}', function (BotMan $bot, $text) {
    $message  = 'Teks:' . PHP_EOL . $text . PHP_EOL . PHP_EOL;
    $message .= 'Translasi:' . PHP_EOL . startTranslation($text);
    $bot->reply($message);
});

$botman->fallback(function (BotMan $bot) {
    if ($bot->getMessage()->getText() == '/translate') {
        $message  = 'Harap ulangi, yang benar adalah:' . PHP_EOL . $bot->getMessage()->getText() . ' {text}';
    } else {
        $message  = 'Perintah ' . $bot->getMessage()->getText() . ' tidak dikenali' . PHP_EOL;
        $message .= 'Cek /help untuk melihat list perintah';
    }
    $bot->reply($message);
});

/**
 * Grup tujuan
 */
$botman->group(['recipient' => '-1001307666764'], function (Botman $innerBotman) {
    $innerBotman->hears('/start@api_2020_bot', function (BotMan $bot) {
        $user = $bot->getUser();
        $bot->reply('Hello ' . $user->getFirstName() . ' 😊');
        $bot->reply('Perkenalkan, saya bot translator bahasa inggris ke bahasa jerman');
        $bot->reply('Silahkan cek /help@api_2020_bot untuk melihat perintah');
    });
    
    $innerBotman->hears('/help@api_2020_bot', function (BotMan $bot) {
        $message  = '/start@api_2020_bot - greeting' . PHP_EOL . PHP_EOL;
        $message .= '/translate@api_2020_bot {text} - Mulai percakapan translasi' . PHP_EOL . PHP_EOL;
        $message .= 'Tap & tahan perintah selama 2 detik untuk menulis perintah secara instan';
        $bot->reply($message);
    });
    
    $innerBotman->hears('/translate@api_2020_bot {text}', function (BotMan $bot, $text) {
        $message  = 'Teks:' . PHP_EOL . $text . PHP_EOL . PHP_EOL;
        $message .= 'Translasi:' . PHP_EOL . startTranslation($text);
        $bot->reply($message);
    });
    
    $innerBotman->fallback(function (BotMan $bot) {
        if ($bot->getMessage()->getText() == '/translate@api_2020_bot') {
            $message  = 'Harap ulangi, yang benar adalah:' . PHP_EOL . $bot->getMessage()->getText() . ' {text}';
        } else {
            $message  = 'Perintah ' . $bot->getMessage()->getText() . ' tidak dikenali' . PHP_EOL;
            $message .= 'Cek /help@api_2020_bot untuk melihat list perintah';
        }
        $bot->reply($message);
    });
});

$botman->listen();
