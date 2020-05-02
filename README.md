# Telegram BOT - Translator

<p align="center">
  <img src="https://i.ibb.co/yYjbBHz/68747470733a2f2f7069656e736133642e636f6d2f77702d636f6e74656e742f75706c6f6164732f323031372f31302f74656c656772616d5f6c6f676f5f626f742e6a7067.jpg" alt="Telegram & BotFather">
</p>

## Deskripsi

BOT Telegram untuk melakukan translasi dari bahasa Inggris ke bahasa Jerman dengan menggunakan IBM Watson

**NOTE:** Anda perlu memasukan token BOT TELEGRAM anda pada file 'private/telegram/TOKEN.txt'

**NOTE:** Anda perlu memasukan url service translator IBM Watson anda pada file 'private/ibm_watson/URL.txt'

**NOTE:** Anda perlu memasukan token service translator IBM Watson anda pada file 'private/ibm_watson/TOKEN.txt'

## Instalasi
1. Install Composer
2. Melalui command line di root folder project jalankan perintah<br>```$ composer install```

## Langkah-langkah menjalankan untuk testing, via bash/git bash
Link video turtorial bisa ditemukan [disini](https://www.youtube.com/watch?v=pTGRpH2dvRM)
1. ```php -S localhost:[PORT]```
2. ```ngrok http [PORT]```  <br>(ngrok bisa didownload di [sini](https://ngrok.com/download))
3. ```curl -d url=[GENERATED_LINK_HTTPS]/file_bot.php -X POST https://api.telegram.org/bot[TOKEN]/setWebhook```

## Langkah-langkah jika sudah naruh di hosting
1. Upload ke hosting
2. Set webhook melalui url browser<br>```https://api.telegram.org/bot[TOKEN]/setWebhook?url=https://[DOMAIN]/[LOKASI_FILE]```
3. Done

## Menghapus Webhook
Untuk menghapus webhook bisa dengan input url berikut di browser:

```https://api.telegram.org/bot[TOKEN]/setWebhook```
