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


?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Produits</title>
    <link rel="stylesheet" href="styleFormList.css">

</head>
<?php
require ('nav.php');
?>
<body>



<form method="post" id="msform" action="#">
    <fieldset>
        <h3>Vos Produits</h3>


        <style>
            table {
                border-collapse: collapse;
                width: 100%;
            }

            th, td {
                text-align: left;
                padding: 8px;
            }

            tr:nth-child(even){background-color: #f2f2f2}

            th {
                background-color: #4CAF50;
                color: white;
            }


        </style>



        <?php

        $stmt = $dbh->prepare("SELECT * FROM produits WHERE user_id = :id");


        $stmt->execute([
                ':id' => $_SESSION['user']['id']
        ]);

        $user = $stmt->fetchAll() ;





        echo '<table border="1" >';
        echo '<tr>';

        echo '<th> nom </th>';
        echo '<th> description </th>';
        echo '<th> image </th>';
        echo '<th> prix </th>';
        echo '<th> action </th>';
        echo '<th> action </th>';
        echo '</tr>';
        foreach ($user as $item) {
            echo '<tr>';

            echo '<td>' . $item['name'] . '</td>';
            echo '<td>' . $item['description'] . '</td>';
            echo '<td>' . $item['image'] . '</td>';
            echo '<td>' . $item['price'] . '</td>';
            echo '<td><a href="update.php?id=' . $item['id'] . '">Modifier</a></td>';
            echo '<td><a href="deleteproduct.php?id=' . $item['id'] . '">Supprimer</a></td>';
            echo '</tr>';
        }
        echo '</table>';


        ?>


        <a href="add.php"><button type="button" class="action-button"> Ajouter Produit </button></a>
        <a href="account.php"><button type="button" class="action-button"> Votre Compte </button></a>

    </fieldset>


</form>


</body>
</html>

