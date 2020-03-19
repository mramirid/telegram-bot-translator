<?php 

class CoinBTC
{
    private $coin = '';
    private $tickers = array();

    /**
     * Konstruktor
     * Menyiapkan data dengan merequest ke API sesuai dengan koin yang diminta
     * Koin di IDR Markets / koin di BTC Markets
     */

     public function __construct($coin)
     {
         global $coin_btc_markets;
         $this->coin = $coin;

         // Request tickers
         if (in_array($this->coin, $coin_btc_markets)) {
             $response = json_decode(file_get_contents("https://indodax.com/api/$coin/ticker"), true);
             if(!isset($response['error'])) {   // Koin error skip waeee
                $this->tickers[$coin] = $response['ticker'];
             }
         }
     }

     public function getResponses()
     {
         $responses = "";
         global $coin_btc_markets;

         if(in_array($this->coin, $coin_btc_markets)) {
            $name = strtoupper(substr($this->coin, 0, 3));
            $responses .= "Data Koin $name\n";
            
            $responses .= 'Harga Terakhir'. ' ' . $this->tickers[$this->coin]['last'] . PHP_EOL;
            $responses .= 'Harga Tertinggi'. ' ' . $this->tickers[$this->coin]['high'] . PHP_EOL;
            $responses .= 'Harga Terendah'. ' ' . $this->tickers[$this->coin]['low'] . PHP_EOL;

            return $responses;
         } else {
             $responses = "Saya tidak mengenali maksud anda";
             return $responses;
         }
         
     }
}