<?php


namespace App\src\Entity;


class Auteur
{

    private $id;
    private $nom;
    private $pnom;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * @param mixed $nom
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
    }

    /**
     * @return mixed
     */
    public function getPnom()
    {
        return $this->pnom;
    }

    /**
     * @param mixed $pnom
     */
    public function setPnom($pnom)
    {
        $this->pnom = $pnom;
    }


}