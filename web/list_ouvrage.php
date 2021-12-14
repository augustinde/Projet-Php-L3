<?php

require_once '..\App\src\Entity\Ouvrage.php';
require_once '..\App\src\Manager\OuvrageManager.php';
require_once '..\App\src\Entity\Genre.php';
require_once '..\App\src\Manager\GenreManager.php';
require_once '..\App\src\Entity\Editeur.php';
require_once '..\App\src\Manager\EditeurManager.php';

use App\src\Manager\OuvrageManager;
use App\src\Manager\GenreManager;
use App\src\Manager\EditeurManager;

$ouvrageManager = new OuvrageManager();

$ouvrages = $ouvrageManager->readall();

$genreManager = new GenreManager();
$editeurManager = new EditeurManager();

?>

<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ouvrages</title>
    <style>
        table, tr,td{
            border:1px solid black !important;
        }
        table{
            width:100%;
        }
    </style>
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
            <td>Titre</td>
            <td>Date de parution</td>
            <td>Etat</td>
            <td>Genre</td>
            <td>Editeur</td>
            <td>Action</td>
        </tr>

        <?php

            foreach ($ouvrages as $ouvrage){

                $genre = $genreManager->read((int)$ouvrage->getIdGenre());
                $editeur = $editeurManager->read((int)$ouvrage->getIdEditeur());

                $etat = $ouvrage->getEtat() == 0 ? "Pas disponible" : "Disponible";
                ?>
                    
                <tr>
                    <td><?= $ouvrage->getTitre() ?></td>
                    <td><?= $ouvrage->getAnneeParution() ?></td>
                    <td><?= $etat ?></td>
                    <td><?= $genre->getNom() ?></td>
                    <td><?= $editeur->getNom() ?></td>
                    <td><a href="delete_ouvrage.php?id=<?= $ouvrage->getIdOuvrage() ?>" class="btn btn-primary">Supprimer</a></td>
                </tr>


                <?php
            }

        ?>

    </table>

</body>
</html>
