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
             $responses .= "Data Koin $this->coin\n";

         }
     }
}