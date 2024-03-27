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



// salviamo la query sql da eseguire
$sql = "SELECT movies.*, categories.name AS 'category'
FROM `movies`
INNER JOIN categories
ON movies.category_id = categories.id;
        ";

// eseguiamo la query e salviamo i risultati in una variabile
$result = $connection->query($sql);




?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP + MySQL</title>
    
    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

</head>
<body>
    <div class="container py-5">
        <h1>PHP + MySQL</h1>

        <h2 class="mb-4">Film</h2>
        <ul>
            <?php
            if($result && $result->num_rows > 0) {
                    

                // eseguire delle operazioni PER OGNI riga del database
                while($row = $result->fetch_assoc()) {
                    // var_dump($row);
                    echo "<li> <h3>" . $row['title'] . "</h3> <p>Film " . $row['category'] . ".<br>" . $row['description'] . "</p> </li>";
                }
            
            
            }
            ?>
        </ul>
    </div>

    <!-- bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>