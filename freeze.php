<?php
session_start();

// Controllo se sono passati 30 secondi dal momento di freeze
// Al momento di freeze aggiundo 30 secondi
// Se l'orario corrente è maggiore di freeze + 30 secondi
//  30 secondi sono passati e quindi ripulsco la sessione e sposto l'utente in index

$end_freeze_time = $_SESSION['freeze'] + 30;

if (time() > $end_freeze_time) {
    unset($_SESSION['attempts']);
    unset($_SESSION['freeze']);
    header('Location: ./index.php');
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

    <h1>Questa è pagina di blocco temporanea</h1>
    <h2><?php echo ($end_freeze_time - time()) ?> secondi rimasti</h2>

</body>

</html>