<?php

require_once '..\App\src\Entity\Categorie.php';
require_once '..\App\src\Manager\CategorieManager.php';

use App\src\Entity\Categorie;
use App\src\Manager\CategorieManager;

$categ = new Categorie();
$categ->setNom($_POST['nom']);

$em = new CategorieManager();

$saveIsOk = $em->save($categ);

if($saveIsOk){
    $message = "Categorie ajouté !";

}else{
    $message = "Categorie non ajouté !";
}

header('Location: form_create_categorie.php?message='.$message);
