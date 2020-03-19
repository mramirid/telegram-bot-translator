<?php 

class CoinIDR
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
         global $coin_idr_markets;
         $this->coin = $coin;

         // Request tickers
         if (in_array($this->coin, $coin_idr_markets)) {
             $response = json_decode(file_get_contents("https://indodax.com/api/$coin/ticker"), true);
             if(!isset($response['error'])) {   // Koin error skip waeee
                $this->tickers[$coin] = $response['ticker'];
             }
         }
     }

     public function getResponses()
     {
         $responses = "";
         global $coin_idr_markets;

         if(in_array($this->coin, $coin_idr_markets)) {
            $name = strtoupper(substr($this->coin, 0, 3));
            $responses .= "Data Koin $name\n";
            
            $responses .= 'Harga Terakhir'. ' Rp.' . number_format($this->tickers[$this->coin]['last'], 0, ',', '.') . PHP_EOL;
            $responses .= 'Harga Tertinggi'. ' Rp.' . number_format($this->tickers[$this->coin]['high'], 0, ',', '.') . PHP_EOL;
            $responses .= 'Harga Terendah'. ' Rp.' . number_format($this->tickers[$this->coin]['low'], 0, ',', '.') . PHP_EOL;
         }
         return $responses;
     }
}