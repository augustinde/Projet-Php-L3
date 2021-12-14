<?php

namespace App\src\Entity;

class Abonne
{

    private $nom;
    private $id_abonne;
    private $prenom;
    private $tel;
    private $email;
    private $adresse;
    private $statut;
    private $nb_retard;
    private $indice_confiance;
    private $id_categorie;

    /**
     * @return mixed
     */
    public function getIdAbonne()
    {
        return $this->id_abonne;
    }

    /**
     * @param mixed $id_abonne
     */
    public function setIdAbonne($id_abonne)
    {
        $this->id_abonne = $id_abonne;
    }

    /**
     * @return mixed
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * @param mixed $prenom
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;
    }

    /**
     * @return mixed
     */
    public function getTel()
    {
        return $this->tel;
    }

    /**
     * @param mixed $tel
     */
    public function setTel($tel)
    {
        $this->tel = $tel;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getAdresse()
    {
        return $this->adresse;
    }

    /**
     * @param mixed $adresse
     */
    public function setAdresse($adresse)
    {
        $this->adresse = $adresse;
    }

    /**
     * @return mixed
     */
    public function getStatut()
    {
        return $this->statut;
    }

    /**
     * @param mixed $statut
     */
    public function setStatut($statut)
    {
        $this->statut = $statut;
    }

    /**
     * @return mixed
     */
    public function getNbRetard()
    {
        return $this->nb_retard;
    }

    /**
     * @param mixed $nb_retard
     */
    public function setNbRetard($nb_retard)
    {
        $this->nb_retard = $nb_retard;
    }

    /**
     * @return mixed
     */
    public function getIndiceConfiance()
    {
        return $this->indice_confiance;
    }

    /**
     * @param mixed $indice_confiance
     */
    public function setIndiceConfiance($indice_confiance)
    {
        $this->indice_confiance = $indice_confiance;
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
    public function getIdCateg()
    {
        return $this->id_categorie;
    }

    /**
     * @param mixed $id_categ
     */
    public function setIdCateg($id_categ)
    {
        $this->id_categorie = $id_categ;
    }


}