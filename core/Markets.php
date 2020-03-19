<?php

class Markets
{
    private $market  = '';
    private $tickers = array();

    /**
     * Konstruktor
     * Menyiapkan data dengan merequest ke API sesuai dengan koin yang diminta
     * Koin di IDR Markets / koin di BTC Markets
     */
    public function __construct($market)
    {
        global $IDR_MARKETS;
        global $coin_idr_markets;
        global $coin_btc_markets;
        
        $this->market = $market;
        
        // Request tickers
        if ($this->market == $IDR_MARKETS) {
            foreach ($coin_idr_markets as $coin) {
                $response = json_decode(file_get_contents("https://indodax.com/api/$coin/ticker"), true);
                if (!isset($response['error'])) {   // Koin error skip waeee
                    $this->tickers[$coin] = $response['ticker'];
                }
            }
        } else {
            foreach ($coin_btc_markets as $coin) {
                $response = json_decode(file_get_contents("https://indodax.com/api/$coin/ticker"), true);
                if (!isset($response['error'])) {   // Koin error skip waeee
                    $this->tickers[$coin] = $response['ticker'];
                }
            }
        }
    }

    /**
     * Fungsi ini mengekstrak json menjadi output 
     * Output koin dipisahkan, IDR Markets sendiri, BTC Markets sendiri
     * Output berupa:
     * NAMA_KOIN HARGA_KOIN...
     */
    public function getResponses()
    {
        $responses = "";
        global $IDR_MARKETS;

        if ($this->market == $IDR_MARKETS) {
            $responses .= "IDR Markets\n";
            foreach ($this->tickers as $key => $value) {
                $responses .= strtoupper(explode('_', $key)[0]) . ' Rp.' . number_format($value['last'], 0, ',', '.') . " /$key" . PHP_EOL;
            }
        } else {
            $responses .= "BTC Markets\n";
            foreach ($this->tickers as $key => $value) {
                $responses .= strtoupper(explode('_', $key)[0]) . ' ' . $value['last'] . PHP_EOL;
            }
        }

        return $responses;
    }
}

