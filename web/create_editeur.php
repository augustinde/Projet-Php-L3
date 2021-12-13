<?php

require_once '..\App\src\Entity\Editeur.php';
require_once '..\App\src\Manager\EditeurManager.php';

use App\src\Entity\Editeur;
use App\src\Manager\EditeurManager;

$editeur = new Editeur();
$editeur->setNom($_POST['nom']);

$em = new EditeurManager();

$saveIsOk = $em->save($editeur);

if($saveIsOk){
    $message = "Editeur ajouté !";

}else{
    $message = "Editeur non ajouté !";
}

header('Location: form_create_editeur.php?message='.$message);
