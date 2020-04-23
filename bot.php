<?php

use BotMan\BotMan\BotMan;
use BotMan\BotMan\BotManFactory;
use BotMan\BotMan\Drivers\DriverManager;
use BotMan\Drivers\Telegram\TelegramDriver;
use BotMan\BotMan\Messages\Attachments\Image;
use BotMan\BotMan\Messages\Attachments\Video;
use BotMan\BotMan\Messages\Outgoing\OutgoingMessage;

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

$botman->hears("/help", function (BotMan $bot) {
    insertUserIfNecessary($bot->getUser());
    $message = "/say hai - Menyapa bot" . PHP_EOL . "/say kenalan - Info mengenai bot";
    $bot->reply($message);
});

$botman->hears("/say {message}", function (BotMan $bot, $message) {
    insertUserIfNecessary($bot->getUser());
    $bot->reply(getResponse($bot->getUser(), $message));
});

// Fallback (balasan invalid command)
$botman->fallback(function (BotMan $bot) {
    insertUserIfNecessary($bot->getUser());
    $message = $bot->getMessage()->getText();
    $bot->reply("Invalid command for '$message'");
});

$botman->listen();