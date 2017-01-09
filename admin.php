<?php
session_start();


if (!$_SESSION['l']) {
// redirect
    header('Location:connexion.php');

}


if (!empty($_POST)) {
    /* Connexion à une base ODBC avec l'invocation de pilote */
    $dsn = 'mysql:dbname=b1a_ingesup;host=localhost';
    $user = 'root';
    $password = 'root';


    try {
        $dbh = new PDO($dsn, $user, $password);
    } catch (PDOException $e) {
        echo 'Connexion échouée : ' . $e->getMessage();
    }

    $stmt = $dbh->prepare("UPDATE `user` SET `name`= :name,`password`= :password,`email`= :mail WHERE id= :id");

    $stmt->execute([
        ':name' => $_POST['nom'],
        ':password' => $_POST['password'],
        ':mail' => $_POST['mail'],
        ':id' => $_SESSION['user']['id']
    ]);

    $_SESSION['user']['name'] = $_POST['nom'];
    $_SESSION['user']['password'] = $_POST['password'];
    $_SESSION['user']['email'] = $_POST['mail'];

    echo "Information Modifier !";
}


?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Admin</title>
    <link rel="stylesheet" href="styleform.css">

</head>
<?php
require ('nav.php');
?>
<body>



<form method="post" id="msform" action="#">
    <fieldset>

        <input type="text" placeholder="Nom" id="nom" name="nom" value="<?php echo $_SESSION['user']['name'] ?>"> <br>


        <input type="email" placeholder="Mail" id="mail" name="mail" value="<?php echo $_SESSION['user']['email'] ?>">
        <br>


        <input type="password" placeholder="Mot de Passe" id="password" name="password"
               value="<?php echo $_SESSION['user']['password'] ?>"> <br>

        <br>
        <button type="submit" class="action-button"> Modifier</button>
        <a href="delete.php"><button type="button" class="action-button"> Suprimer le compte </button></a>

        <a href="account.php"><button type="button" class="action-button"> Retour </button></a>

    </fieldset>
</form>


</body>
</html>
