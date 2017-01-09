<?php

session_start();


echo '<pre>';
var_dump(json_decode($_POST['product'], true));

echo '</pre>';

// Ajouter dans la session ($_SESSION['cart']) la valeur du $_POST['product']



// Afficher les élément déjà dans le panier



