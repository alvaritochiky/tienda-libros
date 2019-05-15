<?php
include_once "models/Producto.php";

class productoController
{
    public function index()
    {
        $producto = new Producto();
        $productos = $producto->getRandom();
        include_once "views/producto/destacados.php";
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

            /*if(!is_dir("uploads/images")){
                mkdir("uploads/images");
            }
            move_uploaded_file($file["tmp_name"],"uploads/images".$filename);*/
            $producto->setImagen($filename);
            $producto->setPdf($_POST["pdf"]);

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
        //isAdmin

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
        //Llamar al metodo Utils::isAdmin que tengo que crear


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
                $nombre=$_POST["searchBook"];
                $producto = new Producto();
                $producto->setNombre($nombre);
                $product = $producto->searchBook();

                include_once "views/producto/search.php";
            } else {
                header("location:index.php");
            }
        }

    }
}