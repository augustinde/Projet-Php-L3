<?php


namespace App\src\Manager;


use App\src\Entity\Emprunter;
use PDO;

class EmprunterManager
{

    private $pdo;
    
    private $pdostat;
    
    public function __construct()
    {

        $this->pdo = new PDO('mysql:host=localhost;dbname=projetbiblio;port=3306','root','');
    
    }
    
    
    public function read($id)
    {
        $this->pdostat = $this->pdo->prepare('SELECT * FROM emprunter WHERE id = :id');
        
        $this->pdostat->bindValue(':id', $id, PDO::PARAM_INT);
        $executeIsOk = $this->pdostat->execute();
        
        if($executeIsOk){
        
            $emprunt = $this->pdostat->fetchObject('App\src\Entity\Emprunter');
            
            if($emprunt === false){
            
                return null;
            }else{
            
                return $emprunt;
            
            }
        }else{
        
            return false;
        
        }  
    
    }
    
    
    public function readall()
    {
    
        $this->pdostat = $this->pdo->query('SELECT * FROM emprunter');
    
        $emprunts = [];
    
        while($emprunt = $this->pdostat->fetchObject('App\src\Entity\Emprunter')){
    
            $emprunts[] = $emprunt;
    
        }
    
        return $emprunts;
    
    
    }

    public function readallAbonne($idAbonne)
    {

        $this->pdostat = $this->pdo->prepare('SELECT * FROM emprunter WHERE id_abonne = :id_abonne');
        $this->pdostat->bindValue(':id_abonne', $idAbonne, PDO::PARAM_INT);
        $this->pdostat->execute();

        $emprunts = [];

        while($emprunt = $this->pdostat->fetchObject('App\src\Entity\Emprunter')){

            $emprunts[] = $emprunt;

        }

        return $emprunts;


    }
    
    public function delete(Emprunter $emprunt)
    {
        $this->pdostat = $this->pdo->prepare('DELETE FROM emprunter WHERE id = :id LIMIT 1');
        $this->pdostat->bindValue(':id', $emprunt->getId(), PDO::PARAM_INT);
        return $this->pdostat->execute();
    
    }
    
    
    public function create(Emprunter $emprunt)
    {
        var_dump($emprunt);
        $this->pdostat = $this->pdo->prepare('INSERT INTO emprunter VALUES (DEFAULT, :id_ouvrage, :id_abonne, :delais_emprunt, :date_sortie_emprunt, :date_retour_emprunt, :etat_emprunt)');

        //Ajout des paramètres (Raccourcis : addbv)
        $this->pdostat->bindValue(':id_ouvrage', $emprunt->getIdOuvrage(), PDO::PARAM_INT);
        $this->pdostat->bindValue(':id_abonne', $emprunt->getIdAbonne(), PDO::PARAM_INT);
        $this->pdostat->bindValue(':delais_emprunt', $emprunt->getDelaisEmprunt());
        $this->pdostat->bindValue(':date_sortie_emprunt', $emprunt->getDateSortieEmprunt());
        $this->pdostat->bindValue(':date_retour_emprunt', $emprunt->getDateRetourEmprunt());
        $this->pdostat->bindValue(':etat_emprunt', $emprunt->getEtatEmprunt());

        $executeIsOk = $this->pdostat->execute();

        if(!$executeIsOk) {
    
            return false;
    
        }else{
    
            $id = $this->pdo->lastInsertId();
            $emprunt = $this->read($emprunt->getId());
    
            return true;
    
        }
    
    }
    
    public function update(Emprunter $emprunt)
    {
    
        $this->pdostat = $this->pdo->prepare('UPDATE emprunter set date_retour_emprunt = :date_retour_emprunt, etat_emprunt = :etat_emprunt WHERE id = :id LIMIT 1');
        
        //Ajout des paramètres (Raccourcis : addbv)
        $this->pdostat->bindValue(':date_retour_emprunt', $emprunt->getDateRetourEmprunt());
        $this->pdostat->bindValue(':etat_emprunt', $emprunt->getEtatEmprunt());
        $this->pdostat->bindValue(':id', $emprunt->getId(), PDO::PARAM_INT);



        return $this->pdostat->execute();
    
    }
    
    public function save(Emprunter &$emprunt)
    {
    
        if(is_null($emprunt->getId())){
            return $this->create($emprunt);
        }else{
            return $this->update($emprunt);
        }
    
    }

}