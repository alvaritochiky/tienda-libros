<?php

class Pedido
{
    private $id;
    private $usuario_id;
    private $provincia;
    private $localidad;
    private $direccion;
    private $coste;
    private $estado;
    private $fecha;
    private $hora;
    private $db;

    //Declaro el constructor
    public function __construct()
    {
        $this->db = Database::connect();
    }
    //Declaro los getters and setters
    function getId()
    {
        return $this->id;
    }

    function getUsuario_id()
    {
        return $this->usuario_id;
    }

    function getProvincia()
    {
        return $this->provincia;
    }

    function getLocalidad()
    {
        return $this->localidad;
    }

    function getDireccion()
    {
        return $this->direccion;
    }

    function getCoste()
    {
        return $this->coste;
    }

    function getEstado()
    {
        return $this->estado;
    }

    function getFecha()
    {
        return $this->fecha;
    }

    function getHora()
    {
        return $this->hora;
    }

    function setId($id)
    {
        $this->id = $id;
    }

    function setUsuario_id($usuario_id)
    {
        $this->usuario_id = $usuario_id;
    }

    function setProvincia($provincia)
    {
        $this->provincia = $this->db->real_escape_string($provincia);
    }

    function setLocalidad($localidad)
    {
        $this->localidad = $this->db->real_escape_string($localidad);
    }

    function setDireccion($direccion)
    {
        $this->direccion = $this->db->real_escape_string($direccion);
    }

    function setCoste($coste)
    {
        $this->coste = $coste;
    }

    function setEstado($estado)
    {
        $this->estado = $estado;
    }

    function setFecha($fecha)
    {
        $this->fecha = $fecha;
    }

    function setHora($hora)
    {
        $this->hora = $hora;
    }

    //Saco todos los campos  de todos los registros de la tabla pedidos con orden descendiente
    public function getAll()
    {
        $productos = $this->db->query("SELECT * FROM pedidos ORDER BY id DESC");
        return $productos;
    }

    //Saco todos los campos de un solo registro de la tabla pedidos
    public function getOne()
    {
        $producto = $this->db->query("SELECT * FROM pedidos WHERE id = {$this->getId()}");
        return $producto->fetch_object();
    }

    
    //Saco los pedidos de un usuario
    public function getOneByUser()
    {
        $sql = "SELECT p.id, p.coste FROM pedidos p WHERE p.usuario_id = {$this->getUsuario_id()} ORDER BY id DESC LIMIT 1";

        $pedido = $this->db->query($sql);

        return $pedido->fetch_object();
    }
    //Saco los pedidos de todos los usuarios
    public function getAllByUser()
    {
        $sql = "SELECT p.* FROM pedidos p "
            . "WHERE p.usuario_id = {$this->getUsuario_id()} ORDER BY id DESC";

        $pedido = $this->db->query($sql);

        return $pedido;
    }

    //Saco los productos de un pedido
    public function getProductosByPedido($id)
    {

        $sql = "SELECT pr.*, lp.unidades FROM productos pr "
            . "INNER JOIN ventas lp ON pr.id = lp.producto_id "
            . "WHERE lp.pedido_id={$id}";

        $productos = $this->db->query($sql);

        return $productos;
    }

    //Guardo los datos del pedido

    function save()
    {
        $usuario_id = $this->getUsuario_id();
        $provincia = $this->getProvincia();
        $localidad = $this->getLocalidad();
        $direccion = $this->getDireccion();
        $coste = $this->getCoste();
        $sql = "INSERT INTO pedidos VALUES(NULL,$usuario_id,'$provincia','$localidad','$direccion',$coste,'confirm', CURDATE(),CURTIME());";

        $save = $this->db->query($sql);
        $result = false;
        if ($save) {
            $result = true;
        }
        return $result;
    }


    public function venta()
    {
        $sql = "SELECT LAST_INSERT_ID() as 'pedido'";
        $query = $this->db->query($sql);
        $pedido_id = $query->fetch_object()->pedido;

        foreach ($_SESSION['carrito'] as $elemento) {
            $producto = $elemento['producto'];

            $insert = "INSERT INTO ventas VALUES(NULL, $pedido_id, $producto->id, {$elemento['unidades']})";
            $save = $this->db->query($insert);
        }

        $result = false;
        if ($save) {
            $result = true;
        }
        return $result;
    }

    //Modifico el estado del pedido
    public function edit()
    {
        $sql = "UPDATE pedidos SET estado='{$this->getEstado()}' ";
        $sql .= " WHERE id={$this->getId()};";

        $save = $this->db->query($sql);

        $result = false;
        if ($save) {
            $result = true;
        }
        return $result;
    }
}
