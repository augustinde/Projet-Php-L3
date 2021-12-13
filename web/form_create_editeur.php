<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ajout d'un éditeur</title>
    <?php
        require_once 'include/head.php';
    ?>
</head>
<body>
<?php
    require_once 'include/navbar.php';
?>
<form action="create_editeur.php" method="post">
    <label for="nom">Nom</label><input type="text" name="nom">

    <input type="submit" value="Ajouter">
</form>

<?php

if(isset($_GET['message'])){
    echo $_GET['message'];
}
?>
</body>
</html>
