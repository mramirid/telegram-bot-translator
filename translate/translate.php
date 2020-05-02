<?php 

function http_request($json)
{
    $ch = curl_init();
    $URL = file_get_contents('./private/ibm_watson/URL.txt');
    $TOKEN = file_get_contents('./private/ibm_watson/TOKEN.txt');

    curl_setopt($ch, CURLOPT_URL, $URL);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
    curl_setopt($ch, CURLOPT_USERPWD, 'apikey' . ':' . $TOKEN);

    $headers = array();
    $headers[] = 'Content-Type: application/json';
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    $result = curl_exec($ch);
    if (curl_errno($ch)) {
        echo 'Error:' . curl_error($ch);
    }
    curl_close($ch);
    
    return $result;
}

function startTranslation($text)
{
    $json = "{\"text\": [\"$text\"], \"model_id\":\"en-nl\"}";
    $result = json_decode(http_request($json));

    return $result->translations[0]->translation;

    // Log
    // file_put_contents('./log_'.date("j.n.Y").'.log', print_r($result, true), FILE_APPEND);
}