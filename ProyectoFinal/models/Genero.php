<?php

class Genero
{
    private $id;
    private $nombre;
    private $db;

    function __construct()
    {
        $this->db = Database::connect();
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    public function getAll()
    {
        $generos=$this->db->query("SELECT * FROM genero");
        return $generos;

    }

}