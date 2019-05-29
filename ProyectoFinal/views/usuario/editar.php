<?php
if (isset($editar) && isset($usu) && is_object($usu)) {
    echo "<h1>Editar usuario $usu->nombre</h1>";
    //Modificar url
    $url = "index.php?controller=usuario&action=editForm&id=" . $usu->id;
}

if (isset($_SESSION["deleteUser"]) && $_SESSION["deleteUser"] == "complete") {
    ?>
    <script>
        function a() {
            Swal.fire(
                'Perfecto',
                'El usuario ha sido borrado correctamente!',
                'success'
            )
        }

        a();
    </script>
    <?php
} elseif (isset($_SESSION["deleteUser"]) && $_SESSION["deleteUser"] == "failed") {
    ?>
    <script>
        function a() {
            Swal.fire({
                type: 'error',
                title: 'Vaya',
                text: 'El usuario no se ha podido borrar',
            })
        }

        a();
    </script>
    <?php

}
Utils::deleteSession("deleteUser");
?>

<div class="container text-center">
    <div class="row pb-5">
        <form action="<?php echo $url ?>" method="post" enctype="multipart/form-data"
              class="  edit-create-form border border-light p-5 w-75">
            Nombre
            <input class="form-control mb-4" type="text" name="nombre"
                   value="<?= isset($usu) && is_object($usu) ? $usu->nombre : ''; ?>" required/>
            Apellidos
            <input class="form-control mb-4" type="text" name="apellidos"
                   value="<?= isset($usu) && is_object($usu) ? $usu->nombre : ''; ?>" required/>
            Email
            <br>
            <input class="form-control mb-4" type="text" name="email"
                   value="<?= isset($usu) && is_object($usu) ? $usu->email : ''; ?>" required/>
            Contraseña
            <br>
            <input class="form-control mb-4" type="text" name="password"
            value="<?= isset($usu) && is_object($usu) ? $usu->contraseña : ''; ?>"required/> 

            <button class="form-control mb-4 btn btn-success text-white w-50 p-2" type="submit">Guardar</button>

            <a href='index.php?controller=usuario&action=deleteUser&id=<?=$usu->id?>' class=" mb-4 btn btn-danger text-white w-50 p-2">Borrar cuenta</a>
        </form>
    </div>
</div>