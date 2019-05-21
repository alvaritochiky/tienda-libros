<?php
include_once "models/Usuario.php";

class usuarioController
{
    public function index()
    {
        echo "Controlador usuarios, Accion index";
    }

    public function save()
    {
        if (isset($_POST)) {
            $usuario = new Usuario();
            $usuario->setNombre($_POST["nombre"]);
            $usuario->setApellidos($_POST["apellidos"]);
            $usuario->setEmail($_POST["email"]);
            $usuario->setPassword($_POST["password"]);
            $save = $usuario->save();
            if ($save) {

                $_SESSION["registro"] = "complete";

            } else {

                $_SESSION["registro"] = "failed";
            }
        } else {
            $_SESSION["registro"] = "failed";

        }
        header("refresh:0;url=index.php");
    }

    public function login()
    {
        if (isset($_POST)) {

            $usuario = new Usuario();
            $usuario->setEmail($_POST['email']);
            $usuario->setPassword($_POST['pass']);

            $identity = $usuario->login();
            if ($identity && is_object($identity)) {
                $_SESSION['identity'] = $identity;
                if ($identity->rol == 'Admin') {
                    $_SESSION['admin'] = true;
                }

            } else {
                $_SESSION['error_login'] = 'Identificación fallida !!';
            }

        }
        header("location:index.php");

    }

    public function logout()
    {
        if (isset($_SESSION["identity"])) {
            unset($_SESSION["identity"]);
        }
        if (isset($_SESSION["admin"])) {
            unset($_SESSION["admin"]);
        }
        header("location:index.php");
    }

    public function listar(){
        $usuario=new Usuario();

        $usuarios=$usuario->getAllUsers();



        include_once "views/usuario/listar.php";
    }

    public function delete(){


            //Llamar al metodo Utils::isAdmin que tengo que crear


            if (isset($_GET['id'])) {

                $id = $_GET['id'];
                $usuario = new Usuario();
                $usuario->setId($id);

                $delete = $usuario->deleteUser();
                if ($delete) {

                    $_SESSION['delete'] = 'complete';
                } else {
                    $_SESSION['delete'] = 'failed';
                }
            } else {
                $_SESSION['delete'] = 'failed';
            }

            header('Location:index.php?controller=usuario&action=listar');
        }

}