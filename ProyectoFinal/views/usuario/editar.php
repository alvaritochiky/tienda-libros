<?php
if (isset($editar) && isset($usu) && is_object($usu)) {
    echo "<h1>Editar usuario $usu->nombre</h1>";
    //Modificar url
    $url = "index.php?controller=usuario&action=editForm&id=" . $usu->id;
}
?>
<div class="container text-center">
    <div class="row pb-5">
        <form action="<?php echo $url ?>" method="post" enctype="multipart/form-data"
              class="  edit-create-form border border-light p-5 w-75">
            Nombre
            <input class="form-control mb-4" type="text" name="nombre"
                   value="<?= isset($usu) && is_object($usu) ? $usu->nombre : ''; ?>"/>
            Apellidos
            <input class="form-control mb-4" type="text" name="apellidos"
                   value="<?= isset($usu) && is_object($usu) ? $usu->nombre : ''; ?>"/>
            Email
            <br>
            <input class="form-control mb-4" type="text" name="email"
                   value="<?= isset($usu) && is_object($usu) ? $usu->email : ''; ?>"/>
            Contraseña
            <br>
            <input class="form-control mb-4" type="text" name="password"
                   value='**************'>

            <button class="form-control mb-4 btn btn-success text-white w-50 p-2" type="submit">Guardar</button>

        </form>
    </div>
</div>