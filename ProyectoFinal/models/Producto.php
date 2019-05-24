<?php


class Producto
{
    private $id;
    private $genero_id;
    private $nombre;
    private $descripcion;
    private $autor;
    private $precio;
    private $tipo;
    private $stock;
    private $oferta;
    private $fecha;
    private $imagen;
    private $pdf;
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

    public function getAutor()
    {
        return $this->autor;
    }

    public function setAutor($autor)
    {
        $this->autor = $autor;
    }

    public function getPrecio()
    {
        return $this->precio;
    }


    public function setPrecio($precio)
    {
        $this->precio = $precio;
    }

    public function getTipo()
    {
        return $this->tipo;
    }

    public function setTipo($tipo)
    {
        $this->tipo = $tipo;
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

    public function getPdf()
    {
        return $this->pdf;
    }

    public function setPdf($pdf)
    {
        $this->pdf = $pdf;
    }

    public function getDest()
    {
        $productos = $this->db->query("SELECT * FROM productos order by RAND() LIMIT 1");
        return $productos;
    }
    public function getMoreSales(){
        $productosSales = $this->db->query("SELECT * FROM productos order by rand() limit 10");
        return $productosSales;
    }
    public function getMoreNew(){
        $productosSales = $this->db->query("SELECT * FROM productos order by fecha limit 10");
        return $productosSales;
    }

    public function getAll()
    {
        $productos = $this->db->query("SELECT * FROM productos");
        return $productos;
    }
    public function getAllBooks()
    {
        $productos = $this->db->query("SELECT * FROM productos where tipo='fisico'");
        return $productos;
    }
    public function getAllEbooks()
    {
        $productos = $this->db->query("SELECT * FROM productos where tipo='ebook'");
        return $productos;
    }

    public function getRandom()
    {
        $productos = $this->db->query("SELECT  * FROM productos ORDER BY rand()");
        return $productos;
    }

    public function getOne()
    {
        $productos = $this->db->query("SELECT * FROM productos WHERE id='$this->id'");
        return $productos->fetch_object();
    }
    public function getAllGenero(){
        $sql = "SELECT * FROM productos "
            . "INNER JOIN genero on productos.genero_id=genero.id "
       . "WHERE productos.genero_id = {$this->getGeneroId()} ";
        $productos = $this->db->query($sql);
        return $productos;
    }

    function save()
    {
        $nombre = $this->getNombre();
        $descripcion = $this->getDescripcion();
        $autor=$this->getAutor();
        $precio = $this->getPrecio();
        $tipo=$this->getTipo();
        $stock = $this->getStock();
        $genero = $this->getGeneroId();
        $imagen = $this->getImagen();
        $pdf=$this->getPdf();

        $sql = "INSERT INTO productos VALUES(NULL,$genero,'$nombre','$descripcion','$autor',$precio,'$tipo',$stock,null, CURDATE(),'$imagen','$pdf');";
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
        $autor=$this->getAutor();
        $precio = $this->getPrecio();
        $tipo=$this->getTipo();
        $stock = $this->getStock();
        $genero = $this->getGeneroId();
        $imagen = $this->getImagen();
        $pdf=$this->getPdf();

        $sql = "UPDATE productos SET nombre='$nombre', descripcion='$descripcion',autor='$autor', precio='$precio',tipo='$tipo',stock='$stock', genero_id='$genero',pdf='$pdf'";
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

        $productos = $this->db->query("SELECT * FROM productos WHERE nombre='$this->nombre' OR  autor='$this->autor'");
        return $productos;


    }
}