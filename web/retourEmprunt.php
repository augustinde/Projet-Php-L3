<?php

require_once '..\App\src\Entity\Emprunter.php';
require_once '..\App\src\Manager\EmprunterManager.php';


use App\src\Manager\EmprunterManager;

$empruntManager = new EmprunterManager();

$emprunt = $empruntManager->read($_GET['id']);

$emprunt->setDateRetourEmprunt(date('Y-m-d'));
$emprunt->setEtatEmprunt(0);
$retourIsOk = $empruntManager->save($emprunt);

if($retourIsOk){
    $message = "Emprunt retourné !";

}else{
    $message = "Emprunt non retourné !";
}

header('Location: list_emprunt.php?message='.$message);
