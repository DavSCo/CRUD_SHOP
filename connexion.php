<?php
session_start();



if(!empty($_POST)) {

    /* Connexion à une base ODBC avec l'invocation de pilote */
    $dsn = 'mysql:dbname=b1a_ingesup;host=localhost';
    $user = 'root';
    $password = 'root';


    try {
        $dbh = new PDO($dsn, $user, $password);
    } catch (PDOException $e) {
        echo 'Connexion échouée : ' . $e->getMessage();
    }


    $stmt = $dbh->prepare("SELECT * FROM user WHERE email = :mail AND password = :password");

    $stmt->execute([
        ':password' => $_POST['password'],
        ':mail' => $_POST['mail']

    ]);

    $user = $stmt->fetchAll() ;
    if (count($user) > 0) {
        $_SESSION['l'] = true;
        $_SESSION['user'] = $user[0];
        header('Location:account.php');
    } else {
        echo "Identifiant ou mot de passe inexistant";
    }

}


?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion</title>
    <link rel="stylesheet" href="styleform.css">

</head>
<?php
require ('nav.php');
?>
<body>


<form method="post" id="msform" action="#">
    <fieldset>
    <h3>Connexion</h3>

    <input type="email" placeholder="Mail" id="mail" name="mail"> <br>

        <input type="password" placeholder="Mot de Passe" id="password" name="password"> <br>

    <br>
        <button type="submit"class="action-button"> Connexion </button>
        <a href="inscription.php"><button type="button" class="action-button"> Inscription </button></a>
    </fieldset>
</form>






</body>
</html>