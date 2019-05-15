<?php
/**
 * Created by PhpStorm.
 * User: alvar
 * Date: 31/03/2019
 * Time: 20:52
 */

class Database
{
public static function connect(){
    $db=new mysqli("localhost","root","","tienda_libros");
    $db->query("SET NAMES 'UTF8'");
    return $db;
}
}