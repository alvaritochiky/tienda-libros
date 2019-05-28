<?php
//Clase global para utilizar sus funciones en cualquier sitio
class Utils
{

    //Borro la sesion que le paso por parametro
    public static function deleteSession($name)
    {
        if (isset($_SESSION[$name])) {
            $_SESSION[$name] = null;
            unset($_SESSION[$name]);
        }

        return $name;
    }
    //Compruebo que la sesion ha sido iniciada
    public static function isIdentity(){
        if(!isset($_SESSION['identity'])){
            header("Location:index.php");
        }else{
            return true;
        }
    }

    //Mostrar generos
    public static function showGeneros()
    {
        require_once 'models/Genero.php';
        $genero = new Genero();
        $generos = $genero->getAll();
        return $generos;
    }

    //Datos del carrito
    public static function statsCarrito()
    {
        $stats = array(
            'count' => 0,
            'total' => 0
        );

        if (isset($_SESSION['carrito'])) {
            $stats['count'] = count($_SESSION['carrito']);

            foreach ($_SESSION['carrito'] as $producto) {
                $stats['total'] += $producto['precio'] * $producto['unidades'];
            }
        }

        return $stats;
    }

    //Estado del pedido
    public static function showStatus($status){
        $value = 'Pendiente';

        if($status == 'confirm'){
            $value = 'Pendiente';
        }elseif($status == 'preparation'){
            $value = 'En preparación';
        }elseif($status == 'ready'){
            $value = 'Preparado para enviar';
        }elseif($status = 'sended'){
            $value = 'Enviado';
        }

        return $value;
    }
}
