<?php

require_once '..\App\src\Entity\Genre.php';
require_once '..\App\src\Manager\GenreManager.php';

use App\src\Entity\Genre;
use App\src\Manager\GenreManager;

$genre = new Genre();
$genre->setNom($_POST['nom']);

$em = new GenreManager();

$saveIsOk = $em->save($genre);

if($saveIsOk){
    $message = "Genre ajouté !";

}else{
    $message = "Genre non ajouté !";
}

header('Location: form_create_genre.php?message='.$message);
