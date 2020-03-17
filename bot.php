<?php

use BotMan\BotMan\BotMan;
use BotMan\BotMan\BotManFactory;
use BotMan\BotMan\Drivers\DriverManager;
use BotMan\Drivers\Telegram\TelegramDriver;
use BotMan\BotMan\Messages\Attachments\Image;
use BotMan\BotMan\Messages\Attachments\Video;
use BotMan\BotMan\Messages\Outgoing\OutgoingMessage;

require "vendor/autoload.php";

$configs = [
    "telegram" => [
        "token" => file_get_contents("private/TOKEN.txt")
    ]
];

DriverManager::loadDriver(TelegramDriver::class);

$botman = BotManFactory::create($configs);

// Command
$botman->hears("/start", function (BotMan $bot) {
    $bot->reply("Willkommen 😊");
});

// Message parameter
$botman->hears("nama saya {nama}", function (BotMan $bot, $nama) {
    $bot->reply("Salam kenal $nama, saya temennya bot anjaymabar");
});

// Fallback (balasan invalid command)
$botman->fallback(function (BotMan $bot) {
    $message = $bot->getMessage()->getText();
    $bot->reply("Invalid command for '$message'");
});

// Regex, input salah = masuk fallback
$botman->hears("request nilai ([0-9]+) di matkul (API|RPL)", function (BotMan $bot, $qty, $item) {
    $bot->reply("Yomann, ntar matkul $item mu dapet $qty");
});

// Send image
$botman->hears("kirim gambar", function (BotMan $bot) {
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