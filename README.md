# Indodax-API-BOT

<p align="center">
  <img src="https://piensa3d.com/wp-content/uploads/2017/10/telegram_logo_bot.jpg" width="478" height="224">
</p>

## Deskripsi

BOT Telegram untuk mengakses API Indodax, nama bot: [@indodax_api_bot](https://t.me/indodax_api_bot)

**NOTE:** Anda perlu memasukan token BOT TELEGRAM anda pada file 'TOKEN.txt'

## Langkah-langkah menjalankan untuk testing, via bash/git bash
Link video turtorial bisa ditemukan [disini](https://www.youtube.com/watch?v=pTGRpH2dvRM)
1. php -S localhost:[PORT]
2. ngrok http [PORT] <br>(ngrok bisa didownload di [sini](https://ngrok.com/download))
3. curl -d url=[GENERATED_LINK_HTTPS] -X POST ```https://api.telegram.org/bot[TOKEN]/setWebhook```

## Langkah-langkah jika sudah naruh di hosting
1. Upload ke hosting
2. Set webhook melalui url browser<br>```https://api.telegram.org/bot[TOKEN]/setWebhook?url=https://[DOMAIN]/[LOKASI_FILE]```
3. Done

## Menghapus Webhook
Untuk menghapus webhook bisa dengan input url berikut di browser:

```https://api.telegram.org/bot[TOKEN]/setWebhook```
