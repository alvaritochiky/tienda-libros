<?php

class Usuario
{
    private $id;
    private $nombre;
    private $apellidos;
    private $email;
    private $password;
    private $rol;
    private $imagen;
    private $db;


    //Declaro el constructor
    public function __construct()
    {
        $this->db = Database::connect();
    }
    //Declaro los getters and setters
    function getId()
    {
        return $this->id;
    }

    function getNombre()
    {
        return $this->nombre;
    }

    function getApellidos()
    {
        return $this->apellidos;
    }

    function getEmail()
    {
        return $this->email;
    }

    function getPassword()
    {
        return $this->password;
    }

    function getRol()
    {
        return $this->rol;
    }

    function getImagen()
    {
        return $this->imagen;
    }

    function setId($id)
    {
        $this->id = $id;
    }

    function setNombre($nombre)
    {
        $this->nombre = $this->db->real_escape_string($nombre);
    }

    function setApellidos($apellidos)
    {
        $this->apellidos = $this->db->real_escape_string($apellidos);
    }

    function setEmail($email)
    {
        $this->email = $this->db->real_escape_string($email);
    }

    function setPassword($password)
    {
        $this->password = $password;
    }

    function setRol($rol)
    {
        $this->rol = $rol;
    }

    function setImagen($imagen)
    {
        $this->imagen = $imagen;
    }
    public function getOne()
    {
        $usuarios = $this->db->query("SELECT * FROM usuarios WHERE id='$this->id'");
        return $usuarios->fetch_object();
    }

    //Funcion de registrar usuario, al ser el campo email unico no se pueden insertar dos
    //email iguales y por tanto el registro no seria valido
    function register()
    {
        $nombre = $this->getNombre();
        $apellidos = $this->getApellidos();
        $email = $this->getEmail();
        $pass = $this->getPassword();
        $sql = "INSERT INTO usuarios VALUES(NULL,'$nombre','$apellidos','$email','$pass','user', null);";
        $save = $this->db->query($sql);

        $result = false;
        if ($save) {
            $result = true;
        }
        return $result;
    }
    //Funcion para loguearse comprobando que existe el usuario y si la contraseña es correcta
    public function login()
    {
        $result = false;
        $email = $this->email;
        $password = $this->password;


        $sql = "SELECT * FROM usuarios WHERE email = '$email'";
        $login = $this->db->query($sql);


        if ($login && $login->num_rows == 1) {
            $usuario = $login->fetch_object();
            if ($usuario->contraseña == $password) {
                $result = $usuario;
            }
        }

        return $result;
    }
    //Funcion para mostrar todos los usuarios
    public function getAllUsers()
    {
        $usuarios = $this->db->query("SELECT * FROM usuarios where rol='user'");
        return $usuarios;
    }
    //Funcion para borrar un determinado usuario
    public function deleteUser()
    {
        $id = $this->getId();
        $sql = "DELETE FROM usuarios WHERE id=$id";
        $delete = $this->db->query($sql);
        $result = false;
        if ($delete) {
            $result = true;
        }
        return $result;
    }

    //Funcion para editar un usuario

    public function editUser()
    {
        $nombre = $this->getNombre();
        $apellidos = $this->getApellidos();
        $email = $this->getEmail();
        $pass = $this->getPassword();
        

        $sql = "UPDATE usuarios SET nombre='$nombre', apellidos='$apellidos',email='$email', contraseña='$pass'";

        $sql .= " WHERE id=$this->id;";

        $save = $this->db->query($sql);


        $result = false;
        if ($save) {
            $result = true;
        }
        return $result;
    }
}
