<?php
include_once "models/Producto.php";

class carritoController
{
    //Muestra el carrito
    public function index()
    {
        if (isset($_SESSION["carrito"])) {
            $carrito = $_SESSION["carrito"];
        }
        include_once "views/carrito/index.php";
    }

    //Añade un producto al carrito
    public function add()
    {

        if (isset($_GET["id"])) {
            $producto_id = $_GET["id"];
        } else {
            header("Location:index.php");
        }
        if (isset($_SESSION["carrito"])) {
            $counter = 0;
            foreach ($_SESSION['carrito'] as $indice => $elemento) {
                if ($elemento['id_producto'] == $producto_id) {
                    $_SESSION['carrito'][$indice]['unidades']++;
                    $counter++;
                }
            }
        }
        if (!isset($counter) || $counter == 0) {
            $producto = new Producto();
            $producto->setId($producto_id);
            $producto = $producto->getOne();

            if (is_object($producto)) {
                $_SESSION["carrito"][] = array(
                    "id_producto" => $producto->id,
                    "precio" => $producto->precio,
                    "unidades" => 1,
                    "producto" => $producto
                );
            }
        }

        header("Location:index.php?controller=carrito&action=index");
    }

// Borra todos los productos del carrito
    public function delete_all()
    {
        unset($_SESSION["carrito"]);
        header("Location:index.php?controller=carrito&action=index");
    }

// Borra el producto selecciconado
    public function delete()
    {
        if (isset($_GET['index'])) {
            $index = $_GET['index'];
            unset($_SESSION['carrito'][$index]);
        }
        header("Location:index.php?controller=carrito&action=index");
    }

//Añade una unidad del producto
    public function up()
    {
        if (isset($_GET['index'])) {
            $index = $_GET['index'];
            $_SESSION['carrito'][$index]['unidades']++;
        }
        header("Location:index.php?controller=carrito&action=index");
    }

//Quita una unidad del producto
    public function down()
    {
        if (isset($_GET['index'])) {
            $index = $_GET['index'];
            $_SESSION['carrito'][$index]['unidades']--;

            if ($_SESSION['carrito'][$index]['unidades'] == 0) {
                unset($_SESSION['carrito'][$index]);
            }
        }
        header("Location:index.php?controller=carrito&action=index");
    }
}