<?php

use BotMan\BotMan\BotMan;
use BotMan\BotMan\BotManFactory;
use BotMan\BotMan\Drivers\DriverManager;
use BotMan\Drivers\Telegram\TelegramDriver;

require_once "vendor/autoload.php";
require_once "database/config.php";
require_once "models/user_model.php";
require_once "models/message_model.php";

$configs = [
    "telegram" => [
        "token" => file_get_contents("private/TOKEN.txt")
    ]
];

DriverManager::loadDriver(TelegramDriver::class);

$botman = BotManFactory::create($configs);

$botman->hears("/start", function (BotMan $bot) {
    $user = $bot->getUser();
    insertUserIfNecessary($user);   // Daftarkan user
    $bot->reply("Willkommen " . $user->getFirstName() . " 😊 (id: " . $user->getId() . ")");
});

$botman->hears("/start@api_2020_bot", function (BotMan $bot) {
    $user = $bot->getUser();
    insertUserIfNecessary($user);   // Daftarkan user
    $bot->reply("Willkommen " . $user->getFirstName() . " 😊 (id: " . $user->getId() . ")");
});

$botman->hears("/help", function (BotMan $bot) {
    insertUserIfNecessary($bot->getUser());
    $message  = "/say@api_2020_bot hai - Menyapa bot" . PHP_EOL . PHP_EOL;
    $message .= "/say@api_2020_bot kenalan - Info mengenai bot" . PHP_EOL . PHP_EOL;
    $message .= "Tekan perintah selama 1-3 detik untuk memilih perintah";
    $bot->reply($message);
});

$botman->hears("/help@api_2020_bot", function (BotMan $bot) {
    insertUserIfNecessary($bot->getUser());
    $message  = "/say@api_2020_bot hai - Menyapa bot" . PHP_EOL . PHP_EOL;
    $message .= "/say@api_2020_bot kenalan - Info mengenai bot" . PHP_EOL . PHP_EOL;
    $message .= "Tekan perintah selama 1-3 detik untuk memilih perintah";
    $bot->reply($message);
});

$botman->hears("/say {message}", function (BotMan $bot, $message) {
    insertUserIfNecessary($bot->getUser());
    $bot->reply(getResponse($bot->getUser(), $message));
});

$botman->hears("/say@api_2020_bot {message}", function (BotMan $bot, $message) {
    insertUserIfNecessary($bot->getUser());
    $bot->reply(getResponse($bot->getUser(), $message));
});

$botman->hears("/hola", function (BotMan $bot) {
    insertUserIfNecessary($bot->getUser());
    $bot->reply("/cek_data@BitValueBot");
});

$botman->hears("/hola@api_2020_bot", function (BotMan $bot) {
    insertUserIfNecessary($bot->getUser());
    $bot->reply("/cek_data@BitValueBot");
});

// Fallback (balasan invalid command)
$botman->fallback(function (BotMan $bot) {
    insertUserIfNecessary($bot->getUser());
    $message  = "Invalid command for " . $bot->getMessage()->getText() . PHP_EOL . PHP_EOL;
    $message .= "Mungkin anda kurang input argumen perintah? Cek /help atau /help@api_2020_bot";
    $bot->reply($message);
});

$botman->listen();