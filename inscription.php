<?php
/* Connexion à une base ODBC avec l'invocation de pilote */
$dsn = 'mysql:dbname=b1a_ingesup;host=localhost';
$user = 'root';
$password = 'root';

try {
    $dbh = new PDO($dsn, $user, $password);
} catch (PDOException $e) {
    echo 'Connexion échouée : ' . $e->getMessage();
}

/*
echo '<pre>';
var_dump($_POST);
echo '</pre>';
*/



if (!empty($_POST["nom"]) && !empty($_POST["mail"]) && !empty($_POST["password"])) {
// Preparer la requete et l'enregistrement pour le lancement
    $stmt = $dbh->prepare("INSERT INTO `user`(`id`, `name`, `password`, `email`) VALUES (:id,:name,:password,:mail)");

// Execute la requete -> retourne un boolean
    $stmt->execute([
        ':name' => $_POST['nom'],
        ':password' => $_POST['password'],
        ':mail' => $_POST['mail'],
        ':id' => $_SESSION['user']['id']
    ]);
}
elseif (!empty($_POST)){
    echo "Oups ! Remplissez le formulaire";
}



/*
echo '<pre>';
var_dump($stmt->fetchAll());
echo '</pre>';
*/
?>



<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Inscription</title>
    <link rel="stylesheet" href="styleform.css">

</head>
<?php
require ('nav.php');
?>
<body>

<form method="post" id="msform" action="#">
    <fieldset>
    <h3>Inscription</h3>
    <input type="text" placeholder="Nom" id="nom" name="nom"> <br>

    <input type="email" placeholder="Mail" id="mail" name="mail"> <br>

        <input type="password" placeholder="Mot de Passe" id="password" name="password"> <br>

    <br>
        <button type="submit"class="action-button"> Envoyer </button>

        <a href="connexion.php"><button type="button" class="action-button"> Connexion </button></a>

    </fieldset>
</form>




</body>
</html>