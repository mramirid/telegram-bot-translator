<?php

$token = file_get_contents('TOKEN.txt');

$updates = json_decode(file_get_contents("https://api.telegram.org/bot$token/getUpdates"), TRUE);

$message = $updates["result"][0]["message"];
print_r($message["text"]); exit;

// Buat beberapa variabel untuk identifikasi chatid dan text yang akan dikirim
$chatId = $message["chat"]["id"];
$text = $message["text"];

// Buat Koneksi ke database
// $server = "localhost"; //ganti sesuai server Anda
// $username = "  "; //ganti sesuai username Anda
// $password = "   "; //ganti sesuai password Anda
// $db_name = "  "; //ganti sesuatu nama database Anda

//Buat Koneksi ke MySQLi di Hosting
// $conn=mysqli_connect($server,$username,$password,$db_name);

// // Melakukan Pengecekan Koneksi
// if (mysqli_connect_error()) { 
//     echo "gagal masuk ke MySQLL: " . mysqli_connect_error();
// }

// mengambil isi pesan dari tabel pesan lalu mengirimkannya ke variabel $text
// $query = mysqli_query($conn,"select pesan from reply where keyword='".$text."'";

// pengecekan bila data yang dicari tidak ada, memberikan pesan balasan
// if (mysqli_num_rows($query)>0) {
//     while ($hasilbalasan = mysqli_fetch_row($query)) {
//         $balas = $hasilbalasan['0'];
//     }
// } else {
//     $balas = "Maaf, saya tidak tahu maksud anda";
// }

// Request ke API


file_get_contents("$website/sendmessage?chat_id=$chatId&text=$balas");

//https://api.telegram.org/bot[masukkan api key]/setWebhook?url=https://[posisi file]