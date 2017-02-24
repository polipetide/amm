<?php

	session_start();
    $ip =  "localhost";
    $user = "melisMarta";
    $user = "root";
    $password = "anatra176";
    $db = "amm14_melisMarta";
    $db = "fiori";
    $mysqli = new mysqli();
    $mysqli->connect($ip, $user, $password, $db);
    
    // verifico la presenza di errori
    if($mysqli->connect_errno!= 0){
        // gestione errore
        $idErrore= $mysqli->connect_errno;
        $msg= $mysqli->connect_error;
        error_log("Errore nella connessione al server $idErrore: $msg", 0);
        echo "Errore nella connessione $msg";
    }
?>
