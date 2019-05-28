<?php

class Genero
{
    private $id;
    private $nombre;
    private $db;
//Declaro el constructor
    function __construct()
    {
        $this->db = Database::connect();
    }
//Declaro los getters and setters
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

    //Saco todos los campos de todos los registros de la tabla genero
    public function getAll()
    {
        $generos=$this->db->query("SELECT * FROM genero");
        return $generos;

    }
    //Saco todos los campos de la tabla genero solo de un registro
    public function getOne(){
        $generos = $this->db->query("SELECT * FROM genero WHERE id={$this->getId()}");
        return $generos->fetch_object();
    }

    //Añado un nuevo genero a la tabla genero
    public function save(){
        $sql = "INSERT INTO genero VALUES(NULL, '{$this->getNombre()}');";
        $save = $this->db->query($sql);

        $result = false;
        if($save){
            $result = true;
        }
        return $result;
    }
}