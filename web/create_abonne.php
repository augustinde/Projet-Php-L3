<?php

require_once '..\App\src\Entity\Abonne.php';
require_once '..\App\src\Manager\AbonneManager.php';

use App\src\Entity\Abonne;
use App\src\Manager\AbonneManager;

$abonne = new Abonne();
$abonne->setNom($_POST['nom']);
$abonne->setPnom($_POST['pnom']);
$abonne->setEmail($_POST['email']);
$abonne->setTel($_POST['tel']);
$abonne->setAdresse($_POST['adresse']);
$abonne->setIdCateg((int)$_POST['categorie']);

$em = new AbonneManager();

$saveIsOk = $em->save($abonne);

if($saveIsOk){
    $message = "Abonné ajouté !";

}else{
    $message = "Abonné non ajouté !";
}

header('Location: form_create_abonne.php?message='.$message);
