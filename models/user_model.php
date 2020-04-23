<?php

use BotMan\BotMan\Interfaces\UserInterface;

/**
 * Fungsi ini menginsert user baru (ketika pertama kali chat)
 * Jika user sudah terdaftar, maka abaikan
 * Jika user merubah nama depan & username, maka update
 */
function insertUserIfNecessary(UserInterface $user)
{
    $id       = $user->getId();
    $username = $user->getUsername();
    $nickname = $user->getFirstName();

    global $mysqli; 
    $queryCheckUser = "SELECT * FROM users WHERE id = $id LIMIT 1";
    $resultRow = $mysqli->query($queryCheckUser)->fetch_row();
    
    if ($resultRow == null) {
        $queryInsert = "INSERT INTO users VALUES ('$id', '$username', '$nickname')";
        $mysqli->query($queryInsert);
        return;
    }

    if ($username != $resultRow[1] || $nickname != $resultRow[2]) {
        $queryUpdate = "UPDATE users 
                        SET username = '$username', nickname = '$nickname'
                        WHERE id = $id";
        $mysqli->query($queryUpdate);
    }
}