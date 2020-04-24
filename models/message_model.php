<?php

use BotMan\BotMan\Interfaces\UserInterface;

/**
 * Fungsi ini mengambil response dari database berdasarkan pesan dari pengguna
 * Fungsi ini juga mencatat berapa kali suatu pengguna menggunakan suatu pesan
 */
function getResponse(UserInterface $user, $message)
{
    // Ambil message
    $queryMessage = "SELECT * FROM messages WHERE message = '$message' LIMIT 1";
    global $mysqli; $resultMessage = $mysqli->query($queryMessage)->fetch_row();

    if ($resultMessage == null) return "Maaf /say $message tidak dikenali";

    // Catat berapa kali message digunakan oleh user ini
    $userId     = $user->getId();
    $messageId  = $resultMessage[0];  // Kolom id_message
    $queryCountMessage  = "SELECT * FROM count_messages 
                           WHERE id_message = $messageId AND id_user = $userId";
    $resultCountMessage = $mysqli->query($queryCountMessage)->fetch_row();
   
    if ($resultCountMessage == null):
        $queryAction = "INSERT INTO count_messages (id_user, id_message)
                        VALUES ($userId, $messageId)";
    else:
        $newCountUsage = intval($resultCountMessage[3]) + 1;
        $queryAction = "UPDATE count_messages
                        SET count_usage = $newCountUsage, updated_at = CURRENT_TIMESTAMP()
                        WHERE id_user = $userId AND id_message = $messageId";
    endif;
    $mysqli->query($queryAction);

    return $resultMessage[2]; // Kolom response
}