<?php
include_once "models/Genero.php";
include_once "models/Producto.php";

class generoController
{
    public function index()
    {
        $genero = new Genero();
        $generos = $genero->getAll();
        include_once "views/genero/index.php";
    }

    public function show()
    {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];

            // Conseguir categoria
            $genero = new Genero();
            $genero->setId($id);
            $genero = $genero->getOne();


            // Conseguir productos;
            $producto = new Producto();
            $producto->setGeneroId($id);
            $productos = $producto->getAllGenero();

            include_once 'views/genero/ver.php';
        }
    }
    public function crear(){

        include_once 'views/genero/crear.php';
    }
    public function save(){

        if(isset($_POST) && isset($_POST['nombre'])){
            // Guardar la categoria en bd
            $genero = new Genero();
            $genero->setNombre($_POST['nombre']);
            $save = $genero->save();
        }
        header("Location:index.php");
    }
}