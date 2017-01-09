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

if (!empty($_POST)) {
    $stmt = $dbh->prepare("UPDATE `produits` SET `name`= :name,`description`= :description,`image`= :image,`price`= :price WHERE id= :id");

    $stmt->execute([
        ':name' => $_POST['name'],
        ':description' => $_POST['description'],
        ':image' => $_POST['image'],
        ':price' => $_POST['price'],
        ':id' => $_GET['id']
    ]);

    echo "Information Modifier !";
}

$req = $dbh->prepare('SELECT * FROM produits WHERE id = :id');
$req->execute([
    ':id' => $_GET['id']
]);


$product = $req->fetch();










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
<h3>Modifier votre produit</h3>
        <input type="text" placeholder="Nom du produit" id="name" name="name" value="<?= $product['name'] ?>"> <br>


       <input type="text" placeholder="Description" id="description" name="description" value="<?= $product['description'] ?>">
        <br>


        <input type="file" placeholder="Image" id="image" name="image"
               value="<?= $product['image'] ?>"> <br>

        <input type="text" placeholder="Prix" id="price" name="price"
        value="<?= $product['price'] ?>"> <br>

        <br>
        <button type="submit" class="action-button"> Modifier</button>

        <a href="liste.php"><button type="button" class="action-button"> Retour </button></a>

    </fieldset>
</form>


</body>
</html>

