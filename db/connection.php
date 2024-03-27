<?php
// con la funzione define() definiamo una COSTANTE in PHP
// ha bisogno di due argomenti: il primo è il nome della costante, il secondo è il suo valore
// le costanti per best practice e per distinguerle dalle variabili
// non hanno il simbolo del dollaro e sono scritte tutte in maiuscolo
define("DB_SERVERNAME", "localhost");
define("DB_USERNAME","root");
define("DB_PASSWORD", "root");
define("DB_NAME", "movie_db");


// Crea un'interfaccia di connessione e la salva in una variabile ($connection)
$connection = new mysqli(DB_SERVERNAME, DB_USERNAME, DB_PASSWORD, DB_NAME);
 
// Controlla la connessione, mostra un messaggio solo se ci sono problemi
if ($connection && $connection->connect_error) {
    echo "Connection failed: " . $connection->connect_error;
}
// se non leggiamo nulla vuol dire che la connessione al nostro database è andata a buon fine

