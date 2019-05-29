<?php
include_once "models/Usuario.php";

class usuarioController
{
    public function register()
    {
        if (isset($_POST)) {
            $usuario = new Usuario();
            $usuario->setNombre($_POST["nombre"]);
            $usuario->setApellidos($_POST["apellidos"]);
            $usuario->setEmail($_POST["email"]);
            $usuario->setPassword($_POST["password"]);
            $save = $usuario->register();
            if ($save) {

                $_SESSION["registro"] = "complete";

            } else {

                $_SESSION["registro"] = "failed";
            }
        } else {
            $_SESSION["registro"] = "failed";

        }
        header("location:index.php");
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
            unset($_SESSION["carrito"]);
        }
        if (isset($_SESSION["admin"])) {
            unset($_SESSION["admin"]);
            unset($_SESSION["carrito"]);
        }
        header("location:index.php");
    }

    public function listar()
    {
        $usuario = new Usuario();

        $usuarios = $usuario->getAllUsers();


        include_once "views/usuario/listar.php";
    }
//Borro el usuario desde el administrador
    public function delete()
    {
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


    function edit()
    {
            
        if (isset($_GET["id"])) {
            $editar = true;
            $id = $_GET["id"];
            $usuario = new Usuario();
            $usuario->setId($id);
            $usu = $usuario->getOne();
            include_once "views/usuario/editar.php";
        } else {
            header('Location:index.php?controller=producto&action=gestion');
        }
    }

    public function editForm(){
        if (isset($_POST)) {
            $id = $_GET["id"];
            $usuario = new Usuario();
            $usuario->setNombre($_POST["nombre"]);
            $usuario->setApellidos($_POST["apellidos"]);
            $usuario->setEmail($_POST["email"]);
            $usuario->setPassword($_POST["password"]);
            $usuario->setId($id);

            var_dump($usuario);
            
            $save = $usuario->editUser();



            if ($save) {
                    echo "skere";
                $_SESSION["edit"] = "complete";
                $_SESSION["identity"]->nombre=$usuario->getNombre();

            } else {
                echo "skereBad";
                $_SESSION["edit"] = "failed";
            }
        } else {
            $_SESSION["edit"] = "failed";

        }
         header("location:index.php");
    }
    //Borro el usuario desde editar perfil
    public function deleteUser()
    {
        if (isset($_GET['id'])) {

            $id = $_GET['id'];
            $usuario = new Usuario();
            $usuario->setId($id);

            $delete = $usuario->deleteUser();
            if ($delete) {

                $_SESSION['deleteUser'] = 'complete';
                unset($_SESSION['identity']);
            } else {
                $_SESSION['deleteUser'] = 'failed';
            }
        } else {
            $_SESSION['deleteUser'] = 'failed';
        }

        header('Location:index.php');
    }

}