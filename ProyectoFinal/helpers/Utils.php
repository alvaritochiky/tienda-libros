<?php

class Utils
{
    public static function deleteSession($name)
    {
        if (isset($_SESSION[$name])) {
            $_SESSION[$name] = null;
            unset($_SESSION[$name]);
        }

        return $name;
    }

    public static function isIdentity(){
        if(!isset($_SESSION['identity'])){
            header("Location:index.php");
        }else{
            return true;
        }
    }

    public static function showGeneros()
    {
        require_once 'models/Genero.php';
        $genero = new Genero();
        $generos = $genero->getAll();
        return $generos;
    }

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
    public static function showStatus($status){
        $value = 'Pendiente';

        if($status == 'confirm'){
            $value = 'Pendiente';
        }elseif($status == 'preparation'){
            $value = 'En preparaciÃ³n';
        }elseif($status == 'ready'){
            $value = 'Preparado para enviar';
        }elseif($status = 'sended'){
            $value = 'Enviado';
        }

        return $value;
    }
}
