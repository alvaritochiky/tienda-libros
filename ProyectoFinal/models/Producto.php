<?php


class Producto
{
    private $id;
    private $genero_id;
    private $nombre;
    private $descripcion;
    private $precio;
    private $stock;
    private $oferta;
    private $fecha;
    private $imagen;
    private $db;

    public function __construct()
    {
        $this->db = Database::connect();
    }


    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }


    public function getGeneroId()
    {
        return $this->genero_id;
    }


    public function setGeneroId($genero_id)
    {
        $this->genero_id = $genero_id;
    }

    public function getNombre()
    {
        return $this->nombre;
    }


    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }


    public function getDescripcion()
    {
        return $this->descripcion;
    }


    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;
    }

    public function getPrecio()
    {
        return $this->precio;
    }


    public function setPrecio($precio)
    {
        $this->precio = $precio;
    }

    public function getStock()
    {
        return $this->stock;
    }


    public function setStock($stock)
    {
        $this->stock = $stock;
    }


    public function getOferta()
    {
        return $this->oferta;
    }

    public function setOferta($oferta)
    {
        $this->oferta = $oferta;
    }

    public function getFecha()
    {
        return $this->fecha;
    }

    public function setFecha($fecha)
    {
        $this->fecha = $fecha;
    }

    public function getImagen()
    {
        return $this->imagen;
    }

    public function setImagen($imagen)
    {
        $this->imagen = $imagen;
    }

    public function getAll()
    {
        $productos = $this->db->query("SELECT * FROM productos");
        return $productos;
    }

    public function getRandom()
    {
        $productos = $this->db->query("SELECT * FROM productos");
        return $productos;
    }

    public function getOne()
    {
        $productos = $this->db->query("SELECT * FROM productos WHERE id='$this->id'");
        return $productos->fetch_object();
    }

    function save()
    {
        $nombre = $this->getNombre();
        $descripcion = $this->getDescripcion();
        $precio = $this->getPrecio();
        $stock = $this->getStock();
        $genero = $this->getGeneroId();
        $imagen = $this->getImagen();

        $sql = "INSERT INTO productos VALUES(NULL,$genero,'$nombre','$descripcion',$precio,$stock,null, CURDATE(),'$imagen');";
        $save = $this->db->query($sql);
        $result = false;
        if ($save) {
            $result = true;
        }
        return $result;
    }

    function edit()
    {
        $nombre = $this->getNombre();
        $descripcion = $this->getDescripcion();
        $precio = $this->getPrecio();
        $stock = $this->getStock();
        $genero = $this->getGeneroId();
        $imagen = $this->getImagen();

        $sql = "UPDATE productos SET nombre='$nombre', descripcion='$descripcion', precio='$precio', stock='$stock', genero_id='$genero'";
        if ($imagen != null) {
            $sql .= ", imagen='assets/img/libros/" . $imagen . "'";
        }

        $sql .= " WHERE id=$this->id;";


        $save = $this->db->query($sql);

        $result = false;
        if ($save) {
            $result = true;
        }
        return $result;
    }

    public function delete()
    {
        $id = $this->getId();
        $sql = "DELETE FROM productos WHERE id=$id";
        $delete = $this->db->query($sql);
        $result = false;
        if ($delete) {
            $result = true;
        }
        return $result;
    }

    public function searchBook()
    {

        $productos = $this->db->query("SELECT * FROM productos WHERE nombre='$this->nombre'");
        return $productos->fetch_object();


    }
    function stockDel(){
        echo "hola";
    }

}