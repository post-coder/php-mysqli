<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP + MySQL Login</title>
    
    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

</head>
<body>
    <div class="container py-5">
        <h1>Login</h1>

        <form action="" method="POST">
            <div class="form-group mb-3">
                <label for="username">Username</label>
                <input type="text" name="username" placeholder="Username" required>
            </div>
            <div class="form-group mb-3">
                <label for="password">Password</label>
                <input type="password" name="password" placeholder="Password" required>
            </div>

            <input type="submit">
        </form>


        <?php

        if(isset($_POST['username']) && isset($_POST['password'])) {

            include_once './db/connection.php';
            
            // controllare che l'username sia presente nel db e che la password combaci
            // $sql = 'SELECT * 
            // FROM `users`
            // WHERE `username` = "' . $_POST['username'] .'" AND `password` = ' . $_POST['password'];

            $stmt = $connection->prepare(
                'SELECT * 
                FROM `users`
                WHERE `username` = ? AND `password` = ?');

            $stmt->bind_param("ss", $username, $password);
            $username = $_POST['username'];
            $password = $_POST['password'];

	
            $stmt->execute();



            // echo $sql;

            // eseguiamo la query e salviamo il risultato
            // $result = $connection->query($sql);


            $result = $stmt->get_result();


            if($result && $result->num_rows > 0) {
                // siamo sicuri che il login sia stato effettuato!
                // echo "login effettuato";


                // facciamo partire la sessione
                session_start();

                while($row = $result->fetch_assoc()) {

                    // var_dump($row);
                    
                    // salviamo l'username in una variabile di sessione
                    $_SESSION['username'] = $row['username'];
                    // facciamo lo stesso anche con il nome
                    $_SESSION['name'] = $row['name'];

                 }
                

                
                // reindirizzo l'utente
                header('Location: index.php');
                
            } else {
                echo "credenziali sbagliate";
            }

        }

        ?>
    </div>

    <!-- bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>