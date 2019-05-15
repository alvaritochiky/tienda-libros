<?php
include_once "models/Genero.php";
class generoController
{
    public function index()
    {
        $genero=new Genero();
        $generos=$genero->getAll();
        include_once "views/genero/index.php";
    }
}