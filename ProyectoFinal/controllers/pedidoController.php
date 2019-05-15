<?php
include_once "models/pedido.php";

class pedidoController
{
    public function hacer()
    {
        include_once "views/pedido/hacer.php";
    }

    public function add()
    {
        if (isset($_SESSION["identity"])) {

            $stats = Utils::statsCarrito();
            $coste = $stats["total"];
            $pedido = new Pedido();
            $pedido->setUsuario_id($_SESSION["identity"]->id);
            $pedido->setProvincia($_POST["provincia"]);
            $pedido->setLocalidad($_POST["localidad"]);
            $pedido->setDireccion($_POST["direccion"]);
            $pedido->setCoste($coste);

            $save = $pedido->save();
            //Guardar venta
            $venta = $pedido->venta();
            if ($save && $venta) {
                $_SESSION["pedido"] = "complete";
            } else {
                $_SESSION["pedido"] = "failed";
            }
            header("location:index.php?controller=pedido&action=confirmado");
        } else {
            header("Location:index.php");
        }
    }

    public function confirmado()
    {
        if (isset($_SESSION['identity'])) {
            $identity = $_SESSION['identity'];
            $pedido = new Pedido();
            $pedido->setUsuario_id($identity->id);

            $pedido = $pedido->getOneByUser();

            $pedido_productos = new Pedido();
            $productos = $pedido_productos->getProductosByPedido($pedido->id);
        }
        include_once "views/pedido/confirmado.php";
    }

    public function mis_pedidos()
    {
        Utils::isIdentity();
        $usuario_id = $_SESSION['identity']->id;
        $pedido = new Pedido();


        $pedido->setUsuario_id($usuario_id);
        $pedidos = $pedido->getAllByUser();
        include_once "views/pedido/mis_pedidos.php";
    }

    public function detalle()
    {
        Utils::isIdentity();
        if (isset($_GET['id'])) {
            $id = $_GET['id'];

            // Sacar el pedido
            $pedido = new Pedido();
            $pedido->setId($id);
            $pedido = $pedido->getOne();

            // Sacar los poductos
            $pedido_productos = new Pedido();
            $productos = $pedido_productos->getProductosByPedido($id);

            include_once 'views/pedido/detalle.php';
        } else {
            header('Location:index.php?controller=pedido&action=mis_pedidos');
        }

        include_once "views/pedido/detalle.php";
    }

    public function gestion()
    {
        //Poner que solo puede entrar el administrador
        $gestion = true;
        $pedido = new Pedido();
        $pedidos = $pedido->getAll();
        include_once "views/pedido/mis_pedidos.php";
    }

    public function estado()
    {
        //Utils::isAdmin();
        if (isset($_POST['pedido_id']) && isset($_POST['estado'])) {
            // Recoger datos form
            $id = $_POST['pedido_id'];
            $estado = $_POST['estado'];

            // Upadate del pedido
            $pedido = new Pedido();
            $pedido->setId($id);
            $pedido->setEstado($estado);
            $pedido->edit();

            header("Location:index.php?controller=pedido&action=gestion");
        } else {
            header("Location:index.php");

        }
    }
}