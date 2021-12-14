<?php

require_once '..\App\src\Entity\Abonne.php';
require_once '..\App\src\Entity\Categorie.php';
require_once '..\App\src\Manager\AbonneManager.php';
require_once '..\App\src\Manager\CategorieManager.php';


use App\src\Manager\AbonneManager;
use App\src\Manager\CategorieManager;


$abonneManager = new AbonneManager();
$categorieManager = new CategorieManager();
$abonnes = $abonneManager->readall();

?>

<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <style>
        table, tr,td{
            border:1px solid black !important;
        }
        table{
            width:100%;
        }
    </style>
    <title>Liste des abonnés</title>
    <?php
        require_once 'include/head.php';
    ?>
</head>
<body>
<?php
    require_once 'include/navbar.php';
?>
    <br>
    <table border="1">

        <tr>
            <td>Nom</td>
            <td>Prénom</td>
            <td>Téléphone</td>
            <td>Email</td>
            <td>Adresse</td>
            <td>Statut</td>
            <td>Nombre de retard</td>
            <td>Indice de confiance</td>
            <td>Catégorie</td>
        </tr>
        <?php

            foreach ($abonnes as $abonne){

                $categorie = $categorieManager->read((int)$abonne->getIdCateg());
                //$etat = $emprunt->getEtatEmprunt() == 0 ? "Rendu" : "Emprunter";
                ?>

               <tr>
                   <td><?= $abonne->getNom() ?></td>
                   <td><?= $abonne->getPrenom() ?></td>
                   <td><?= $abonne->getTel() ?></td>
                   <td><?= $abonne->getEmail() ?></td>
                   <td><?= $abonne->getAdresse() ?></td>
                   <td><?= $abonne->getStatut() ?></td>
                   <td><?= $abonne->getNbRetard() ?></td>
                   <td><?= $abonne->getIndiceConfiance() ?></td>
                   <td><?= $categorie->getNom() ?></td>
               </tr>

                <?php
            }

        ?>

    </table>
<?php

if(isset($_GET['message'])){
    echo $_GET['message'];
}
?>
</body>
</html>
