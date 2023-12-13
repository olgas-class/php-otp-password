<?php
require_once __DIR__ . "/config.php";

session_start();

// Se l'utente ha la sessione ancora valida lo portiamo nella dashboard automaticamente
if (isset($_SESSION['auth']) && $_SESSION['auth'] === true) {
    header('Location: ./dashboard.php');
    die;
}

// Se nella session esiste freeze sposto utente in freeze
if (isset($_SESSION['freeze'])) {
    header('Location: ./freeze.php');
    die;
}

/*
   Se otp corrisponde 
    Inseriamo nella sessione chiave auth = true
    faccio passare utente alla dashboard
   Altrimenti 
    Nella session aumentare il counter di tentativi
    Se il numero di tentativi è >= 3
    Salviamo timestamp (orario) di questo ultimo tentativo nella session
    Spostiamo utente nella pagina freeze
*/

$_SESSION['attempts'] =  !empty($_SESSION['attempts']) ? $_SESSION['attempts'] : 0;

if (isset($_POST['otp'])) {
    $code = $_POST['otp'];
    if ($code == OTP_CODE) {
        $_SESSION['auth'] = true;
        header('Location: ./dashboard.php');
    } else {
        echo 'ERROREEEE!';
        $_SESSION['attempts']++;

        if ($_SESSION['attempts'] >= 3) {
            $_SESSION['freeze'] = time();
            header('Location: ./freeze.php');
            die;
        }
    }

    var_dump($_SESSION['attempts']);
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
    <main class="mt-5 container">
        <h2 class="text-center">Inserisci OTP</h2>
        <p class="text-center">Hai <?php echo (3 - $_SESSION['attempts']); ?> tentativi rimasti</p>
        <div class="row justify-content-center">
            <div class="col-5">
                <form class="mt-5" action="index.php" method="POST">
                    <div class="mb-3">
                        <input name="otp" type="number" class="form-control" placeholder="1234">
                    </div>
                    <div class="text-center">
                        <button class="btn btn-primary" type="submit">Invia</button>
                    </div>
                </form>
            </div>
        </div>


    </main>

</body>

</html>