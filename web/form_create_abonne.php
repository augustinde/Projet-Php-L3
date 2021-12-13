<?php

require_once '..\App\src\Entity\Categorie.php';
require_once '..\App\src\Manager\CategorieManager.php';

use App\src\Entity\Categorie;
use App\src\Manager\CategorieManager;

$em = new CategorieManager();

$categs = $em->readall();

?>

<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ajout d'un abonné</title>
    <?php
        require_once 'include/head.php';
    ?>
</head>
<body>
<?php
    require_once 'include/navbar.php';
?>
<form action="create_abonne.php" method="post">
    <label for="nom">Nom</label><input type="text" name="nom"><br>
    <label for="pnom">Prénom</label><input type="text" name="pnom"><br>
    <label for="email">Email</label><input type="text" name="email"><br>
    <label for="adresse">Adresse</label><input type="text" name="adresse"><br>
    <label for="tel">Téléphone</label><input type="text" name="tel"><br>

    <label for="categorie">Catégorie</label>

    <select id="categorie" name="categorie">

        <?php

        foreach ($categs as $categ){
            ?>
            <option value="<?php echo $categ->getId(); ?>"><?php echo $categ->getNom(); ?></option>
            <?php
        }

        ?>

    </select>

    <input type="submit" value="Ajouter">
</form>

<?php

if(isset($_GET['message'])){
    echo $_GET['message'];
}
?>
</body>
</html>
