<?php

namespace App\src\Manager;

use App\src\Entity\Categorie;
use PDO;

class CategorieManager
{

    private $pdo;
    
    private $pdostat;
    
    public function __construct()
    {
    
        $this->pdo = new PDO('mysql:host=localhost;dbname=projetbiblio;port=3306','root','');
    
    }
    
    
    public function read($id)
    {
        $this->pdostat = $this->pdo->prepare('SELECT * FROM categorie WHERE id = :id');
        
        $this->pdostat->bindValue(':id', $id, PDO::PARAM_INT);
        $executeIsOk = $this->pdostat->execute();
        
        if($executeIsOk){
        
            $categ = $this->pdostat->fetchObject('App\src\Entity\Categorie');
            
            if($categ === false){
            
                return null;
            }else{
            
                return $categ;
            
            }
        }else{
        
            return false;
        
        }  
    
    }
    
    
    public function readall()
    {
    
        $this->pdostat = $this->pdo->query('SELECT * FROM categorie ORDER BY id');
    
        $categs = [];
    
        while($categ = $this->pdostat->fetchObject('App\src\Entity\Categorie')){
    
            $categs[] = $categ;
    
        }
    
        return $categs;
    
    
    }
    
    public function delete(Categorie $categ)
    {
        $this->pdostat = $this->pdo->prepare('DELETE FROM categorie WHERE id = :id LIMIT 1');
        $this->pdostat->bindValue(':id', $categ->getId(), PDO::PARAM_INT);
    
        return $this->pdostat->execute();
    
    }
    
    
    private function create(Categorie $categ)
    {
    
        $this->pdostat = $this->pdo->prepare('INSERT INTO categorie VALUES (DEFAULT, :nom)');
    
        //Ajout des paramètres (Raccourcis : addbv)
        $this->pdostat->bindValue(':nom', $categ->getNom(), PDO::PARAM_STR);


        $executeIsOk = $this->pdostat->execute();
    
        if(!$executeIsOk) {
    
            return false;
    
        }else{
    
            $id = $this->pdo->lastInsertId();
            $categ = $this->read($id);
    
            return true;
    
        }
    
    }
    
    private function update(Categorie $categ)
    {
    
        $this->pdostat = $this->pdo->prepare('UPDATE categorie set nom=:nom WHERE id=:id LIMIT 1');
        
        //Ajout des paramètres (Raccourcis : addbv)
        $this->pdostat->bindValue(':id', $categ->getId(), PDO::PARAM_INT);
        $this->pdostat->bindValue(':nom', $categ->getNom(), PDO::PARAM_STR);



        return $this->pdostat->execute();
    
    }
    
    public function save(Categorie &$categ)
    {
    
        if(is_null($categ->getId())){
            return $this->create($categ);
        }else{
            return $this->update($categ);
        }
    
    }
}