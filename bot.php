<?php

use BotMan\BotMan\BotMan;
use BotMan\BotMan\BotManFactory;
use BotMan\BotMan\Drivers\DriverManager;
use BotMan\Drivers\Telegram\TelegramDriver;
use BotMan\BotMan\Messages\Attachments\Image;
use BotMan\BotMan\Messages\Attachments\Video;
use BotMan\BotMan\Messages\Outgoing\OutgoingMessage;

require_once "vendor/autoload.php";
require_once "models/user_model.php";

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
    $user = $bot->getUser();
    insertUserIfNecessary($user);
    $message = "/say hai - Menyapa bot" . PHP_EOL . "/say kenalan - Info mengenai bot";
    $bot->reply($message);
});

$botman->hears("/say {message}", function (BotMan $bot, $message) {
    $bot->reply("Anda mengirim $message");
});

// Fallback (balasan invalid command)
$botman->fallback(function (BotMan $bot) {
    $user = $bot->getUser();
    insertUserIfNecessary($user);
    $message = $bot->getMessage()->getText();
    $bot->reply("Invalid command for '$message'");
});

// Regex, input salah = masuk fallback
$botman->hears("request nilai ([0-9]+) di matkul (API|RPL)", function (BotMan $bot, $qty, $item) {
    $bot->reply("Yomann, ntar matkul $item mu dapet $qty");
});

// Send image
$botman->hears("/berangkat_ke_upn", function (BotMan $bot) {
    $attachment = new Image("https://s.kaskus.id/r540x540/images/2014/03/23/6590730_20140323042249.png");

    $message = OutgoingMessage::create("Nenek moyang menggunakannya bermil-mil jauhnya")->withAttachment($attachment);

    $bot->reply($message);
});

// Send video
$botman->hears("kirim video", function (BotMan $bot) {
    $attachment = new Video("https://www.w3schools.com/html/mov_bbb.mp4");

    $message = OutgoingMessage::create("Sample video")->withAttachment($attachment);

    $bot->reply($message);
});

$botman->listen();