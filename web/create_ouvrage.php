<?php

require_once '..\App\src\Entity\Ouvrage.php';
require_once '..\App\src\Manager\OuvrageManager.php';

use App\src\Entity\Ouvrage;
use App\src\Manager\OuvrageManager;

$ouvrage = new Ouvrage();

$ouvrage->setTitre($_POST['titre']);
$ouvrage->setAnneeParution($_POST['annee']);
$ouvrage->setEtat($_POST['etat']);
$ouvrage->setIdEditeur($_POST['editeur']);
$ouvrage->setIdGenre($_POST['genre']);

$em = new OuvrageManager();

$saveIsOk = $em->save($ouvrage);

if($saveIsOk){
    $message = "Ouvrage ajouté !";

}else{
    $message = "Ouvrage non ajouté !";
}

header('Location: form_create_ouvrage.php?message='.$message);
