<?php


namespace App\src\Entity;


class Emprunter
{

    private $id;
    private $id_ouvrage;
    private $id_abonne;
    private $delais_emprunt;
    private $date_sortie_emprunt;
    private $date_retour_emprunt;
    private $etat_emprunt;

    /**
     * @return mixed
     */
    public function getIdOuvrage()
    {
        return $this->id_ouvrage;
    }

    /**
     * @param mixed $id_ouvrage
     */
    public function setIdOuvrage($id_ouvrage)
    {
        $this->id_ouvrage = $id_ouvrage;
    }

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
    public function getDelaisEmprunt()
    {
        return $this->delais_emprunt;
    }

    /**
     * @param mixed $delais_emprunt
     */
    public function setDelaisEmprunt($delais_emprunt)
    {
        $this->delais_emprunt = $delais_emprunt;
    }

    /**
     * @return mixed
     */
    public function getDateSortieEmprunt()
    {
        return $this->date_sortie_emprunt;
    }

    /**
     * @param mixed $date_sortie_emprunt
     */
    public function setDateSortieEmprunt($date_sortie_emprunt)
    {
        $this->date_sortie_emprunt = $date_sortie_emprunt;
    }

    /**
     * @return mixed
     */
    public function getDateRetourEmprunt()
    {
        return $this->date_retour_emprunt;
    }

    /**
     * @param mixed $date_retour_emprunt
     */
    public function setDateRetourEmprunt($date_retour_emprunt)
    {
        $this->date_retour_emprunt = $date_retour_emprunt;
    }

    /**
     * @return mixed
     */
    public function getEtatEmprunt()
    {
        return $this->etat_emprunt;
    }

    /**
     * @param mixed $etat_emprunt
     */
    public function setEtatEmprunt($etat_emprunt)
    {
        $this->etat_emprunt = $etat_emprunt;
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


}