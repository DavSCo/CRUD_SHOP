<?php
session_start();

ini_set('display_errors', 1);
ini_set('error_reporting', E_ALL);

if (!$_SESSION['l']) {
// redirect
    header('Location:connexion.php');

}

    /* Connexion à une base ODBC avec l'invocation de pilote */
    $dsn = 'mysql:dbname=b1a_ingesup;host=localhost';
    $user = 'root';
    $password = 'root';


    try {
        $dbh = new PDO($dsn, $user, $password);
    } catch (PDOException $e) {
        echo 'Connexion échouée : ' . $e->getMessage();
    }



    $stmt = $dbh->prepare("DELETE FROM `user` WHERE id=:id");

    $stmt->execute([
        ':id' => $_SESSION['user']['id']
    ]);

header('Location:connexion.php');




?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Suppression</title>
    <link rel="stylesheet" href="styleform.css">
</head>
<body>

<form method="post" id="msform" action="#">
    <fieldset>




        <br>
        <button type="submit"class="action-button"> Suprimer </button>


    </fieldset>
</form>




</body>
</html>
