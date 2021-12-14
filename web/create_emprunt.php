<?php

require_once '..\App\src\Entity\Emprunter.php';
require_once '..\App\src\Entity\Ouvrage.php';
require_once '..\App\src\Manager\EmprunterManager.php';
require_once '..\App\src\Manager\OuvrageManager.php';

use App\src\Entity\Emprunter;
use App\src\Entity\Ouvrage;
use App\src\Manager\EmprunterManager;
use App\src\Manager\OuvrageManager;

var_dump($_POST);
$emprunt = new Emprunter();
$emprunt->setDateRetourEmprunt(null);
$emprunt->setDateSortieEmprunt(date('Y-m-d'));
$emprunt->setDelaisEmprunt($_POST['demprunt']);
$emprunt->setIdAbonne((int)$_POST['abonne']);
$emprunt->setIdOuvrage((int)$_POST['ouvrage']);
$emprunt->setEtatEmprunt(1);

$empruntManager = new EmprunterManager();

$ouvrageManager = new OuvrageManager();

$ouvrage = $ouvrageManager->read($emprunt->getIdOuvrage());
$ouvrage->setEtat(0);


$saveIsOk = $empruntManager->save($emprunt);

if($saveIsOk){
    $message = "Emprunt ajouté !";
    $ouvrageManager->save($ouvrage);
}else{
    $message = "Emprunt non ajouté ! (L'ouvrage est déjà emprunter ou l'abonné possède déjà un emprunt !)";
}

header('Location: form_create_emprunt.php?message='.$message);
