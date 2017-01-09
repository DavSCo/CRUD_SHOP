<?php
session_start();

ini_set('display_errors', 1);
ini_set('error_reporting', E_ALL);

/* Connexion à une base ODBC avec l'invocation de pilote */
$dsn = 'mysql:dbname=b1a_ingesup;host=localhost';
$user = 'root';
$password = 'root';

try {
    $dbh = new PDO($dsn, $user, $password);
} catch (PDOException $e) {
    echo 'Connexion échouée : ' . $e->getMessage();
}

if (!empty($_POST["name"]) && !empty($_POST["description"]) && !empty($_POST["image"]) && !empty($_POST["price"])) {
// Preparer la requete et l'enregistrement pour le lancement
    $stmt = $dbh->prepare("INSERT INTO `produits`( `name`, `description`, `image`, `price`) 
VALUES (:name,:description,:image,:price)");

// Execute la requete -> retourne un boolean
    $stmt->execute([
        ':name' => $_POST['name'],
        ':description' => $_POST['description'],
        ':image' => $_POST['image'],
        ':price' => $_POST['price']
    ]);

    header('Location:liste.php');
}
elseif (!empty($_POST)){
    echo "Oups ! Remplissez le formulaire";
}







?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Produits</title>
    <link rel="stylesheet" href="styleform.css">

</head>
<?php
require ('nav.php');
?>
<body>

<form method="post" id="msform" action="#" enctype="multipart/form-data">

    <fieldset>
        <h3>Ajouter un produit</h3>

        <input type="text" placeholder="Nom du produit" id="name" name="name"> <br>

        <input type="text" placeholder="Description" id="description" name="description"> <br>

        <input type="file" placeholder="Image " id="image" name="image"> <br>

        <input type="text" placeholder="Prix" id="price" name="price"> <br>

        <br>
        <button type="submit"class="action-button"> Ajouter </button>

        <a href="liste.php"><button type="button" class="action-button"> Retour </button></a>




    </fieldset>
</form>






</body>
</html>
