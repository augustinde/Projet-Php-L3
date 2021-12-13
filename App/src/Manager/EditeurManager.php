<?php

namespace App\src\Manager;

use App\src\Entity\Editeur;
use PDO;

class EditeurManager
{

    private $pdo;
    
    private $pdostat;
    
    public function __construct()
    {
    
        $this->pdo = new PDO('mysql:host=localhost;dbname=projetbiblio;port=3306','root','');
    
    }
    
    
    public function read($id)
    {
        $this->pdostat = $this->pdo->prepare('SELECT * FROM editeur WHERE id = :id');
        
        $this->pdostat->bindValue(':id', $id, PDO::PARAM_INT);
        $executeIsOk = $this->pdostat->execute();
        
        if($executeIsOk){
        
            $editeur = $this->pdostat->fetchObject('App\src\Entity\Editeur');
            
            if($editeur === false){
            
                return null;
            }else{
            
                return $editeur;
            
            }
        }else{
        
            return false;
        
        }  
    
    }
    
    
    public function readall()
    {
    
        $this->pdostat = $this->pdo->query('SELECT * FROM editeur ORDER BY id');
    
        $editeurs = [];
    
        while($editeur = $this->pdostat->fetchObject('App\src\Entity\Editeur')){
    
            $editeurs[] = $editeur;
    
        }
    
        return $editeurs;
    
    
    }
    
    public function delete(Editeur $editeur)
    {
        $this->pdostat = $this->pdo->prepare('DELETE FROM editeur WHERE id = :id LIMIT 1');
        $this->pdostat->bindValue(':id', $editeur->getId(), PDO::PARAM_INT);
    
        return $this->pdostat->execute();
    
    }
    
    
    private function create(Editeur $editeur)
    {
    
        $this->pdostat = $this->pdo->prepare('INSERT INTO editeur VALUES (DEFAULT, :nom)');
    
        //Ajout des paramètres (Raccourcis : addbv)
        $this->pdostat->bindValue(':nom', $editeur->getNom(), PDO::PARAM_STR);


        $executeIsOk = $this->pdostat->execute();
    
        if(!$executeIsOk) {
    
            return false;
    
        }else{
    
            $id = $this->pdo->lastInsertId();
            $editeur = $this->read($id);
    
            return true;
    
        }
    
    }
    
    private function update(Editeur $editeur)
    {
    
        $this->pdostat = $this->pdo->prepare('UPDATE editeur set nom=:nom WHERE id=:id LIMIT 1');
        
        //Ajout des paramètres (Raccourcis : addbv)
        $this->pdostat->bindValue(':id', $editeur->getId(), PDO::PARAM_INT);
        $this->pdostat->bindValue(':nom', $editeur->getNom(), PDO::PARAM_STR);



        return $this->pdostat->execute();
    
    }
    
    public function save(Editeur &$editeur)
    {
    
        if(is_null($editeur->getId())){
            return $this->create($editeur);
        }else{
            return $this->update($editeur);
        }
    
    }
}