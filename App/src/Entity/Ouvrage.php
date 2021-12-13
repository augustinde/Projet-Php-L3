<?php


namespace App\src\Entity;


class Ouvrage
{

    private $id;
    private $titre;
    private $annee_parution;
    private $etat;
    private $id_editeur;
    private $id_genre;

    /**
     * @return mixed
     */
    public function getIdEditeur()
    {
        return $this->id_editeur;
    }

    /**
     * @param mixed $id_editeur
     */
    public function setIdEditeur($id_editeur)
    {
        $this->id_editeur = $id_editeur;
    }

    /**
     * @return mixed
     */
    public function getIdGenre()
    {
        return $this->id_genre;
    }

    /**
     * @param mixed $id_genre
     */
    public function setIdGenre($id_genre)
    {
        $this->id_genre = $id_genre;
    }

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
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * @param mixed $titre
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;
    }

    /**
     * @return mixed
     */
    public function getAnneeParution()
    {
        return $this->annee_parution;
    }

    /**
     * @param mixed $annee_parution
     */
    public function setAnneeParution($annee_parution)
    {
        $this->annee_parution = $annee_parution;
    }

    /**
     * @return mixed
     */
    public function getEtat()
    {
        return $this->etat;
    }

    /**
     * @param mixed $etat
     */
    public function setEtat($etat)
    {
        $this->etat = $etat;
    }



}