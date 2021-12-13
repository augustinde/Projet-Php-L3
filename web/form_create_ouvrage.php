<?php

    require_once '..\App\src\Entity\Genre.php';
    require_once '..\App\src\Entity\Editeur.php';
    require_once '..\App\src\Manager\GenreManager.php';
    require_once '..\App\src\Manager\EditeurManager.php';

    use App\src\Manager\GenreManager;
    use App\src\Manager\EditeurManager;
    use App\src\Entity\Genre;
    use App\src\Entity\Editeur;

    $genreManager = new GenreManager();

    $genres = $genreManager->readall();

    $editeurManager = new EditeurManager();

    $editeurs = $editeurManager->readall();
?>


<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ajout d'un ouvrage</title>
    <?php
        require_once 'include/head.php';
    ?>
</head>
<body>
<?php
    require_once 'include/navbar.php';
?>
    <form action="create_ouvrage.php" method="post">
        <label for="titre">Titre</label><input type="text" name="titre">
        <label for="annee">Année de parution</label><input type="text" name="annee">
        <label for="etat">Etat</label>

        <select name="etat">
            <option value="0">Mauvais</option>
            <option value="1">Bon</option>
        </select>

        <label for="editeur">Editeur</label>

        <select name="editeur">

            <?php

                foreach ($editeurs as $editeur){
                    ?>
                    <option value="<?php echo $editeur->getId(); ?>"><?php echo $editeur->getNom(); ?></option>
                    <?php
                }

            ?>

        </select>

        <label for="genre">Genre</label>

        <select name="genre">
            <?php

            foreach ($genres as $genre){
                ?>
                <option value="<?php echo $genre->getId(); ?>"><?php echo $genre->getNom(); ?></option>
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
