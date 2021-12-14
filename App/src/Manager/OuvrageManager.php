<?php

namespace App\src\Manager;

use App\src\Entity\Ouvrage;
use PDO;

class OuvrageManager
{

    private $pdo;
    
    private $pdostat;
    
    public function __construct()
    {
    
        $this->pdo = new PDO('mysql:host=localhost;dbname=projetbiblio;port=3306','root','');
    
    }
    
    
    public function read($id)
    {
        $this->pdostat = $this->pdo->prepare('SELECT * FROM ouvrage WHERE id_ouvrage = :id');
        
        $this->pdostat->bindValue(':id', $id, PDO::PARAM_INT);
        $executeIsOk = $this->pdostat->execute();
        
        if($executeIsOk){
        
            $ouvrage = $this->pdostat->fetchObject('App\src\Entity\Ouvrage');
            
            if($ouvrage === false){
            
                return null;
            }else{
            
                return $ouvrage;
            
            }
        }else{
        
            return false;
        
        }  
    
    }


    public function readall()
    {
    
        $this->pdostat = $this->pdo->query('SELECT * FROM ouvrage ORDER BY id_ouvrage');
    
        $ouvrages = [];
    
        while($ouvrage = $this->pdostat->fetchObject('App\src\Entity\Ouvrage')){
    
            $ouvrages[] = $ouvrage;
    
        }
    
        return $ouvrages;
    
    
    }
    
    public function delete(Ouvrage $ouvrage)
    {
        $this->pdostat = $this->pdo->prepare('DELETE FROM ouvrage WHERE id = :id LIMIT 1');
        $this->pdostat->bindValue(':id', $ouvrage->getIdOuvrage(), PDO::PARAM_INT);
    
        return $this->pdostat->execute();
    
    }
    
    
    private function create(Ouvrage $ouvrage)
    {
    
        $this->pdostat = $this->pdo->prepare('INSERT INTO ouvrage VALUES (DEFAULT, :titre, :annee_parution, :etat, :id_editeur, :id_genre)');
    
        //Ajout des paramètres (Raccourcis : addbv)
        $this->pdostat->bindValue(':titre', $ouvrage->getTitre(), PDO::PARAM_STR);
        $this->pdostat->bindValue(':annee_parution', $ouvrage->getAnneeParution());
        $this->pdostat->bindValue(':etat', $ouvrage->getEtat(), PDO::PARAM_INT);
        $this->pdostat->bindValue(':id_editeur', $ouvrage->getIdEditeur(), PDO::PARAM_INT);
        $this->pdostat->bindValue(':id_genre', $ouvrage->getIdGenre(), PDO::PARAM_INT);


        $executeIsOk = $this->pdostat->execute();
    
        if(!$executeIsOk) {
    
            return false;
    
        }else{
    
            $id = $this->pdo->lastInsertId();
            $ouvrage = $this->read($id);
    
            return true;
    
        }
    
    }
    
    private function update(Ouvrage $ouvrage)
    {
    
        $this->pdostat = $this->pdo->prepare('UPDATE ouvrage set titre=:titre, annee_parution=:annee_parution, etat=:etat, id_editeur=:id_editeur, id_genre=:id_genre WHERE id_ouvrage=:id LIMIT 1');
        
        //Ajout des paramètres (Raccourcis : addbv)
        $this->pdostat->bindValue(':id', $ouvrage->getIdOuvrage(), PDO::PARAM_INT);
        $this->pdostat->bindValue(':titre', $ouvrage->getTitre(), PDO::PARAM_STR);
        $this->pdostat->bindValue(':annee_parution', $ouvrage->getAnneeParution());
        $this->pdostat->bindValue(':etat', $ouvrage->getEtat(), PDO::PARAM_INT);
        $this->pdostat->bindValue(':id_editeur', $ouvrage->getIdEditeur(), PDO::PARAM_INT);
        $this->pdostat->bindValue(':id_genre', $ouvrage->getIdGenre(), PDO::PARAM_INT);


        return $this->pdostat->execute();
    
    }
    
    public function save(Ouvrage &$ouvrage)
    {
    
        if(is_null($ouvrage->getIdOuvrage())){
            return $this->create($ouvrage);
        }else{
            return $this->update($ouvrage);
        }
    
    }
}