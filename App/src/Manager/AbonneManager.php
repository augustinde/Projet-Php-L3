<?php

namespace App\src\Manager;
use App\src\Entity\Abonne;
use PDO;

class AbonneManager
{

    private $pdo;
    
    private $pdostat;
    
    public function __construct()
    {
    
        $this->pdo = new PDO('mysql:host=localhost;dbname=projetbiblio;port=3306','root','');
    
    }
    
    
    public function read($id)
    {
        $this->pdostat = $this->pdo->prepare('SELECT * FROM abonne WHERE id = :id');
        
        $this->pdostat->bindValue(':id', $id, PDO::PARAM_INT);
        $executeIsOk = $this->pdostat->execute();
        
        if($executeIsOk){
        
            $abonne = $this->pdostat->fetchObject('App\src\Entity\Abonne');
            
            if($abonne === false){
            
                return null;
            }else{
            
                return $abonne;
            
            }
        }else{
        
            return false;
        
        }  
    
    }
    
    
    public function readall()
    {
    
        $this->pdostat = $this->pdo->query('SELECT * FROM abonne ORDER BY id');
    
        $abonnes = [];
    
        while($abonne = $this->pdostat->fetchObject('App\src\Entity\Abonne')){
    
            $abonnes[] = $abonne;
    
        }
    
        return $abonnes;
    
    
    }
    
    public function delete(Abonne $abonne)
    {
        $this->pdostat = $this->pdo->prepare('DELETE FROM abonne WHERE id = :id LIMIT 1');
        $this->pdostat->bindValue(':id', $abonne->getId(), PDO::PARAM_INT);
    
        return $this->pdostat->execute();
    
    }
    
    
    private function create(Abonne $abonne)
    {
    
        $this->pdostat = $this->pdo->prepare('INSERT INTO abonne (id, nom, prenom, tel, email, adresse, id_categorie) VALUES (DEFAULT, :nom, :pnom, :tel, :email, :adresse, :id_categ)');

        //Ajout des paramètres (Raccourcis : addbv)

        $this->pdostat->bindValue(':nom', $abonne->getNom());
        $this->pdostat->bindValue(':pnom', $abonne->getPnom());
        $this->pdostat->bindValue(':tel', $abonne->getTel());
        $this->pdostat->bindValue(':email', $abonne->getEmail());
        $this->pdostat->bindValue(':adresse', $abonne->getAdresse());
        $this->pdostat->bindValue(':id_categ', $abonne->getIdCateg(), PDO::PARAM_INT);


        $executeIsOk = $this->pdostat->execute();
    
        if(!$executeIsOk) {
    
            return false;
    
        }else{
    
            $id = $this->pdo->lastInsertId();
            $abonne = $this->read($id);
    
            return true;
    
        }
    
    }
    
    private function update(Abonne $abonne)
    {
    
        $this->pdostat = $this->pdo->prepare('UPDATE abonne set nom=:nom, prenom=:pnom, tel=:tel, email=:email, adresse=:adresse, statut=:statut, nb_retard=:nb_retard, indice_confiance=:indice_confiance, id_categorie=:id_categ WHERE id=:id LIMIT 1');
        
        //Ajout des paramètres (Raccourcis : addbv)
        $this->pdostat->bindValue(':id', $abonne->getId(), PDO::PARAM_INT);
        $this->pdostat->bindValue(':nom', $abonne->getNom());
        $this->pdostat->bindValue(':pnom', $abonne->getPnom());
        $this->pdostat->bindValue(':tel', $abonne->getTel());
        $this->pdostat->bindValue(':email', $abonne->getEmail());
        $this->pdostat->bindValue(':adresse', $abonne->getAdresse());
        $this->pdostat->bindValue(':statut', $abonne->getStatut());
        $this->pdostat->bindValue(':nb_retard', $abonne->getNbRetard());
        $this->pdostat->bindValue(':indice_confiance', $abonne->getIndiceConfiance());
        $this->pdostat->bindValue(':id_categ', $abonne->getIdCateg(), PDO::PARAM_INT);



        return $this->pdostat->execute();
    
    }
    
    public function save(Abonne &$abonne)
    {
    
        if(is_null($abonne->getId())){
            return $this->create($abonne);
        }else{
            return $this->update($abonne);
        }
    
    }

}