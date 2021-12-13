<?php

namespace App\src\Manager;

use App\src\Entity\Auteur;
use PDO;

class AuteurManager
{

    private $pdo;
    
    private $pdostat;
    
    public function __construct()
    {
    
        $this->pdo = new PDO('mysql:host=localhost;dbname=projetbiblio;port=3306','root','');
    
    }
    
    
    public function read($id)
    {
        $this->pdostat = $this->pdo->prepare('SELECT * FROM auteur WHERE id = :id');
        
        $this->pdostat->bindValue(':id', $id, PDO::PARAM_INT);
        $executeIsOk = $this->pdostat->execute();
        
        if($executeIsOk){
        
            $auteur = $this->pdostat->fetchObject('App\src\Entity\Auteur');
            
            if($auteur === false){
            
                return null;
            }else{
            
                return $auteur;
            
            }
        }else{
        
            return false;
        
        }  
    
    }
    
    
    public function readall()
    {
    
        $this->pdostat = $this->pdo->query('SELECT * FROM auteur ORDER BY id');
    
        $auteurs = [];
    
        while($auteur = $this->pdostat->fetchObject('App\src\Entity\Auteur')){
    
            $auteurs[] = $auteur;
    
        }
    
        return $auteurs;
    
    
    }
    
    public function delete(Auteur $auteur)
    {
        $this->pdostat = $this->pdo->prepare('DELETE FROM auteur WHERE id = :id LIMIT 1');
        $this->pdostat->bindValue(':id', $auteur->getId(), PDO::PARAM_INT);
    
        return $this->pdostat->execute();
    
    }
    
    
    private function create(Auteur $auteur)
    {
    
        $this->pdostat = $this->pdo->prepare('INSERT INTO auteur VALUES (DEFAULT, :nom, :pnom)');
    
        //Ajout des paramètres (Raccourcis : addbv)
        $this->pdostat->bindValue(':nom', $auteur->getNom(), PDO::PARAM_STR);
        $this->pdostat->bindValue(':pnom', $auteur->getPnom(), PDO::PARAM_STR);


        $executeIsOk = $this->pdostat->execute();
    
        if(!$executeIsOk) {
    
            return false;
    
        }else{
    
            $id = $this->pdo->lastInsertId();
            $auteur = $this->read($id);
    
            return true;
    
        }
    
    }
    
    private function update(Auteur $auteur)
    {
    
        $this->pdostat = $this->pdo->prepare('UPDATE auteur set nom=:nom, prenom=:pnom WHERE id=:id LIMIT 1');
        
        //Ajout des paramètres (Raccourcis : addbv)
        $this->pdostat->bindValue(':id', $auteur->getId(), PDO::PARAM_INT);

        $this->pdostat->bindValue(':nom', $auteur->getNom(), PDO::PARAM_STR);
        $this->pdostat->bindValue(':pnom', $auteur->getPnom(), PDO::PARAM_STR);



        return $this->pdostat->execute();
    
    }
    
    public function save(Auteur &$auteur)
    {
    
        if(is_null($auteur->getId())){
            return $this->create($auteur);
        }else{
            return $this->update($auteur);
        }
    
    }
}