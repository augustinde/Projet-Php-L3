<?php

require_once '..\App\src\Entity\Emprunter.php';
require_once '..\App\src\Entity\Abonne.php';
require_once '..\App\src\Entity\Ouvrage.php';
require_once '..\App\src\Manager\EmprunterManager.php';
require_once '..\App\src\Manager\OuvrageManager.php';
require_once '..\App\src\Manager\AbonneManager.php';


use App\src\Manager\EmprunterManager;
use App\src\Manager\OuvrageManager;
use App\src\Manager\AbonneManager;


$empruntManager = new EmprunterManager();
$abonneManager = new AbonneManager();
$ouvrageManager = new OuvrageManager();

$emprunts = $empruntManager->readall();
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
    <title>Emprunts</title>
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
            <td>Date sortie</td>
            <td>Date retour</td>
            <td>Delais emprunt</td>
            <td>Etat emprunt</td>
            <td>Ouvrage</td>
            <td>Abonné</td>
        </tr>
        <?php

            foreach ($emprunts as $emprunt){

                $abonne = $abonneManager->read((int)$emprunt->getIdAbonne());
                $ouvrage = $ouvrageManager->read((int)$emprunt->getIdOuvrage());
                $etat = $emprunt->getEtatEmprunt() == 0 ? "Rendu" : "Emprunter";

                ?>

               <tr>
                   <td><?= $emprunt->getDateSortieEmprunt() ?></td>
                   <td>
                       <?php
                       if($emprunt->getDateRetourEmprunt() == null){
                            ?><a href="retourEmprunt.php?id=<?= $emprunt->getId() ?>">Retourner</a><?php
                       }else{
                           echo $emprunt->getDateRetourEmprunt();
                       }
                       ?>
                   </td>
                   <td><?= $emprunt->getDelaisEmprunt() ?></td>
                   <td><?= $etat ?></td>
                   <td><?= $ouvrage->getTitre() ?></td>
                   <td><?= $abonne->getNom() ?></td>
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
