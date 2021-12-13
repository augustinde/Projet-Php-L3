<?php

require_once '../App/src/Manager/OuvrageManager.php';

use App\src\Manager\OuvrageManager;

$em = new OuvrageManager();

$ouvrage = $em->read((int)$_GET['id']);

$deleteIsOk = $em->delete($ouvrage);

if($deleteIsOk){
    $message = "Ouvrage supprimé !";
}else{
    $message = "Ouvrage non supprimé !";
}

header('Location: list_ouvrage.php?message='.$message);
