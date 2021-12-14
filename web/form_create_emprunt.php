<?php

require_once '..\App\src\Entity\Ouvrage.php';
require_once '..\App\src\Entity\Abonne.php';
require_once '..\App\src\Manager\OuvrageManager.php';
require_once '..\App\src\Manager\AbonneManager.php';

use App\src\Entity\Abonne;
use App\src\Entity\Ouvrage;
use App\src\Manager\AbonneManager;
use App\src\Manager\OuvrageManager;

$ouvrageManager = new OuvrageManager();
$abonneManager = new AbonneManager();


$ouvrages = $ouvrageManager->readall();
$abonnes = $abonneManager->readall();

?>

<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ajout d'un emprunt</title>
    <?php
        require_once 'include/head.php';
    ?>
</head>
<body>
<?php
    require_once 'include/navbar.php';
?>
<form action="create_emprunt.php" method="post">
    <label for="demprunt">Délais emprunt</label><input type="text" name="demprunt"><br>

    <label for="abonne">Abonné</label>

    <select id="abonne" name="abonne">

        <?php

        foreach ($abonnes as $abonne){
            ?>
            <option value="<?php echo $abonne->getIdAbonne(); ?>"><?php echo $abonne->getNom(); ?></option>
            <?php
        }

        ?>

    </select>
    <br>
    <label for="ouvrage">Ouvrage</label>

    <select id="ouvrage" name="ouvrage">

        <?php

        foreach ($ouvrages as $ouvrage){
            ?>
            <option value="<?php echo $ouvrage->getIdOuvrage(); ?>"><?php echo $ouvrage->getTitre(); ?></option>
            <?php
        }

        ?>

    </select>
    <br>
    <input type="submit" value="Ajouter">
</form>

<?php

if(isset($_GET['message'])){
    echo $_GET['message'];
}
?>
</body>
</html>
