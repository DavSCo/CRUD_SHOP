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


if (!empty($_POST["name"]) && !empty($_POST["description"])  && !empty($_POST["price"])) {

    if (isset($_FILES['image'])) {

        // echo $_FILES['nomDuInput']['name'] . '<br>'; // Nom du fichier
        $finfo = finfo_open(FILEINFO_MIME_TYPE); // Vérifie le type MIME du fichier
        $mime = finfo_file($finfo, $_FILES['image']['tmp_name']); // Regarde dans ce fichier le type MIME
        finfo_close($finfo); // Fermeture de la lecture
        $filename = explode('.', $_FILES['image']['name']); // Explosion du nom sur le point
        $extension =  $filename[count($filename) - 1]; // L'extension du fichier
        //echo $extension . ' ' . $mime;
        if($extension == 'jpg' && $mime == 'image/jpeg'){
            move_uploaded_file($_FILES['image']['tmp_name'],
                'upload/' . $_FILES['image']['name']);
        }
    }

// Preparer la requete et l'enregistrement pour le lancement
    $stmt = $dbh->prepare("INSERT INTO `produits`( `name`, `description`, `image`, `price`, `user_id`) 
VALUES (:name,:description,:image,:price, :id)");

// Execute la requete -> retourne un boolean
    $stmt->execute([
        ':name' => $_POST['name'],
        ':description' => $_POST['description'],
        ':image' => $_FILES['image']['name'],
        ':price' => $_POST['price'],
        ':id' => $_SESSION['user']['id']
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
