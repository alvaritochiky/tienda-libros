<?php
include_once "models/Producto.php";

class productoController
{
    public function index()
    {
        $producto = new Producto();
        $productos = $producto->getDest();
        $productosSales = $producto->getMoreSales();
        $productosNew = $producto->getMoreNew();
        include_once "views/producto/destacados.php";
    }
    public function indexBooks()
    {
        $producto = new Producto();
        $productos = $producto->getAllBooks();
        include_once "views/producto/books.php";
    }
    public function indexEbooks()
    {
        $producto = new Producto();
        $productos = $producto->getAllEbooks();
        include_once "views/producto/ebooks.php";
    }

    public function ver()
    {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $producto = new Producto();
            $producto->setId($id);
            $product = $producto->getOne();
        }
        include_once "views/producto/ver.php";
    }


    public
    function gestion()
    {

        //Hacer metodo en Utils preguntando si es admin
        $producto = new Producto();

        $producto = $producto->getAll();
        include_once "views/producto/gestion.php";
    }

    public
    function crear()
    {
        //Hacer metodo en Utils preguntando si es admin
        include_once "views/producto/crear.php";
    }

    public
    function save()
    {
        //Hacer metodo en Utils preguntando si es admin
        if (isset($_POST)) {
            $producto = new Producto();
            $producto->setNombre($_POST["nombre"]);
            $producto->setDescripcion($_POST["descripcion"]);
            $producto->setAutor($_POST["autor"]);
            $producto->setPrecio($_POST["precio"]);
            $producto->setTipo($_POST["tipo"]);
            $producto->setStock($_POST["stock"]);
            $producto->setGeneroId($_POST["genero"]);

            //Guardar la imagen
            $file = $_FILES["imagen"];
            $filename = $file["name"];
            $mimetype = $file["type"];

            $producto->setImagen($filename);
            $file1 = $_FILES["pdf"];
            $filename1 = $file1["name"];

            $producto->setPdf($filename1);
            if (isset($_GET["id"])) {
                $id = $_GET["id"];
                $producto->setId($id);
                $save = $producto->edit();
            } else {
                $save = $producto->save();
            }


            if ($save) {
                $_SESSION["producto"] = "complete";
            } else {
                $_SESSION["producto"] = "failed";
            }
        }
        header("Location:index.php?controller=producto&action=gestion");
    }

    public
    function editar()
    {


        if (isset($_GET["id"])) {
            $edit = true;
            $id = $_GET["id"];
            $producto = new Producto();
            $producto->setId($id);
            $pro = $producto->getOne();
            include_once "views/producto/crear.php";
        } else {
            header('Location:index.php?controller=producto&action=gestion');
        }
    }


    public
    function eliminar()
    {


        if (isset($_GET['id'])) {

            $id = $_GET['id'];
            $producto = new Producto();
            $producto->setId($id);

            $delete = $producto->delete();
            if ($delete) {

                $_SESSION['delete'] = 'complete';
            } else {
                $_SESSION['delete'] = 'failed';
            }
        } else {
            $_SESSION['delete'] = 'failed';
        }

        header('Location:index.php?controller=producto&action=gestion');
    }

    function buscarLibro()
    {
        if (isset($_POST)) {

            if ($_POST["searchBook"] != "") {
                $nombre = $_POST["searchBook"];
                $autor = $_POST["searchBook"];
                $producto = new Producto();
                $producto->setNombre($nombre);
                $producto->setAutor($autor);
                $product = $producto->searchBook();


                include_once "views/producto/search.php";
            } else {
                header("location:index.php");
            }
        }
    }
}
