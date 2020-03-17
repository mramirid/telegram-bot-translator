# Indodax-API-BOT

<p align="center">
  <img src="https://piensa3d.com/wp-content/uploads/2017/10/telegram_logo_bot.jpg" height=300>
</p>

## Deskripsi

BOT Telegram untuk mengakses API Indodax

**NOTE:** Anda perlu memasukan token BOT TELEGRAM anda pada file 'TOKEN.txt'

## Steps via bash/git bash
Link video turtorial bisa ditemukan [disini](https://www.youtube.com/watch?v=pTGRpH2dvRM)
1. php -S localhost:[PORT]
2. ngrok http [PORT] <br>(ngrok bisa didownload di website resminya)
3. curl -d url=[GENERATED_LINK_HTTPS] -X POST https://api.telegram.org/bot[TOKEN]/setWebhook
