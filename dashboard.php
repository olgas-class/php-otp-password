<?php
session_start();
var_dump($_SESSION);
// L'utente è loggato se nella sessione esiste chiave auth ed è settata a true

// Se l'utente non è loggato, allora lo rindirizzo nella pagina index
if (!isset($_SESSION['auth']) || $_SESSION['auth'] !== true) {
    header('Location: index.php');
    die;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
    <main class="container">
        <h1 class="mt-5 text-center">Benvenuto utente! </h1>
        <p class="text-center">Questa è la pagina protetta. Solo se hai fatto login puoi vederla!</p>
        <a class="btn btn-danger" href="./logout.php">Logout</a>
    </main>

</body>

</html>