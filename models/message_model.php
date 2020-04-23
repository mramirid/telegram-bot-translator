<?php

function getResponse($message)
{
    global $mysqli; 
    $queryMessage = "SELECT * FROM messages WHERE message = '$message' LIMIT 1";
    $resultRow = $mysqli->query($queryMessage)->fetch_row();

    if ($resultRow != null) return $resultRow[2]; // Kolom response
    return "Maaf /say $message tidak dikenali";
}