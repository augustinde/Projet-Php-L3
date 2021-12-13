<?php

namespace App\src\Manager;

use App\src\Entity\Genre;
use PDO;

class GenreManager
{

    private $pdo;
    
    private $pdostat;
    
    public function __construct()
    {
    
        $this->pdo = new PDO('mysql:host=localhost;dbname=projetbiblio;port=3306','root','');
    
    }
    
    
    public function read($id)
    {
        $this->pdostat = $this->pdo->prepare('SELECT * FROM genre WHERE id = :id');
        
        $this->pdostat->bindValue(':id', $id, PDO::PARAM_INT);
        $executeIsOk = $this->pdostat->execute();
        
        if($executeIsOk){
        
            $genre = $this->pdostat->fetchObject('App\src\Entity\Genre');
            
            if($genre === false){
            
                return null;
            }else{
            
                return $genre;
            
            }
        }else{
        
            return false;
        
        }  
    
    }
    
    
    public function readall()
    {
    
        $this->pdostat = $this->pdo->query('SELECT * FROM genre ORDER BY id');
    
        $genres = [];
    
        while($genre = $this->pdostat->fetchObject('App\src\Entity\Genre')){
    
            $genres[] = $genre;
    
        }
    
        return $genres;
    
    
    }
    
    public function delete(Genre $genre)
    {
        $this->pdostat = $this->pdo->prepare('DELETE FROM genre WHERE id = :id LIMIT 1');
        $this->pdostat->bindValue(':id', $genre->getId(), PDO::PARAM_INT);
    
        return $this->pdostat->execute();
    
    }
    
    
    private function create(Genre $genre)
    {
    
        $this->pdostat = $this->pdo->prepare('INSERT INTO genre VALUES (DEFAULT, :nom)');
    
        //Ajout des paramètres (Raccourcis : addbv)
        $this->pdostat->bindValue(':nom', $genre->getNom(), PDO::PARAM_STR);



        $executeIsOk = $this->pdostat->execute();
    
        if(!$executeIsOk) {
    
            return false;
    
        }else{
    
            $id = $this->pdo->lastInsertId();
            $genre = $this->read($id);
    
            return true;
    
        }
    
    }
    
    private function update(Genre $genre)
    {
    
        $this->pdostat = $this->pdo->prepare('UPDATE genre set nom=:nom WHERE id=:id LIMIT 1');
        
        //Ajout des paramètres (Raccourcis : addbv)
        $this->pdostat->bindValue(':id', $genre->getId(), PDO::PARAM_INT);
        $this->pdostat->bindValue(':nom', $genre->getNom(), PDO::PARAM_STR);



        return $this->pdostat->execute();
    
    }
    
    public function save(Genre &$genre)
    {
    
        if(is_null($genre->getId())){
            return $this->create($genre);
        }else{
            return $this->update($genre);
        }
    
    }

}