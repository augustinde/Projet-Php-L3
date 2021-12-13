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
    <?php
        require_once 'include/head.php';
    ?>
</head>
<body>
<?php
    require_once 'include/navbar.php';
?>
    <br>
    <div class="row">

        <?php

            foreach ($ouvrages as $ouvrage){

                $genre = $genreManager->read((int)$ouvrage->getIdGenre());
                $editeur = $editeurManager->read((int)$ouvrage->getIdEditeur());

                $etat = $ouvrage->getEtat() == 0 ? "Mauvais" : "Bon";
                ?>

                <div class="col-sm-6">
                    <div class="card mb-3">
                        <div class="card-body">
                            <h5 class="card-title"><?= $ouvrage->getTitre() ?></h5>
                            <p class="card-text">Paru en <?= $ouvrage->getAnneeParution() ?></p>
                            <p class="card-text">Etat : <?= $etat ?></p>
                            <p class="card-text">Genre : <?= $genre->getNom() ?></p>
                            <p class="card-text">Editeur : <?= $editeur->getNom() ?></p>
                            <a href="delete_ouvrage.php?id=<?= $ouvrage->getId() ?>" class="btn btn-primary">Supprimer</a>
                        </div>
                    </div>
                </div>

                <?php
            }

        ?>

    </div>

</body>
</html>
