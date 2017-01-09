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

$products = $stmt->fetchAll() ;





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
foreach ($products as $item) {



echo '<figure class="produit">';
    echo '<img src="upload/' . $item['image'] . '"' . '/>';
    echo '<figcaption>';
        echo '<h3>' . $item['name'] . '</h3>';
        echo '<p>' . $item['description'] . '</p>';
        echo '<div class="price">';
            echo  "$".$item['price'];
        echo '</div>';
    echo '</figcaption>';
    //echo '<i class="ion-android-cart"></i>';
    //echo '<a href="#"></a>';


    echo '<form method="post" action="cart.php"> <input type="hidden" name="product" value=\''.json_encode($item).'\'>';
    echo '<button  class="ion-android-cart"> </button> </form>';
echo '</figure>';


}
?>

</body>
</html>

