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

$stmt = $dbh->prepare("SELECT * FROM produits");

$stmt->execute();

$user = $stmt->fetchAll() ;





?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Shop</title>
    <link rel="stylesheet" href="styleShop.css">


</head>
<body>
<nav>
    <ul class="topnav" id="myTopnav">
        <li><a href="shop.php">Shop</a></li>
        <li><a href="account.php">Mon Compte</a></li>
        <li><a href="connexion.php">Connexion</a></li>
        <li><a href="inscription.php">Inscription</a></li>


    </ul>


    <div class="bar"></div>
</nav>
<?php
foreach ($user as $item) {



echo '<figure class="produit">';
    echo '<img src="' . $item['image'] . '"' . '/>';
    echo '<figcaption>';
        echo '<h3>' . $item['name'] . '</h3>';
        echo '<p>' . $item['description'] . '</p>';
        echo '<div class="price">';
            echo  "$".$item['price'];
        echo '</div>';
    echo '</figcaption><i class="ion-android-cart"></i>';
    echo '<a href="#"></a>';
echo '</figure>';

}
?>

</body>
</html>

