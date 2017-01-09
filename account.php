<?php
session_start();
if (!$_SESSION['l']) {
// redirect
    header('Location:connexion.php');

}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Account</title>
    <link rel="stylesheet" href="styleform.css">

</head>
<?php
require ('nav.php');
?>
<body>

<form method="post" id="msform" action="#">
    <fieldset>
<h2>Votre Compte</h2>
        <?php

        if ($_SESSION['l'] == true) {


            echo "Bienvenue"." ".$_SESSION['user']['name']."<br />";

            echo "<br /> Vos Information: <br/><br />";

            echo "Nom: ".$_SESSION['user']['name']."<br />";
            echo "Email: ".$_SESSION['user']['email']."<br />";



        }
        else {
            header('Location:connexion.php');
        }




        ?>


        <br>
        <a href="admin.php"><button type="button" class="action-button"> Modifier </button></a>
        <a href="liste.php"><button type="button" class="action-button"> Vos produits </button></a>


        <a href="logout.php"><button type="button" class="action-button"> Deconnexion </button></a>


    </fieldset>
</form>




</body>
</html>
