<?php
if (isset($edit) && isset($pro) && is_object($pro)) {
    echo "<h1>Editar producto $pro->nombre</h1>";
    $url = "index.php?controller=producto&action=save&id=" . $pro->id;
} else {
    echo "<h1> Crear nuevos productos </h1>";
    $url = "index.php?controller=producto&action=save";
}
?>

<div class="container text-center">
    <div class="row pb-5">
        <form action="<?php echo $url ?>" method="post" enctype="multipart/form-data"
              class="  edit-create-form border border-light p-5 w-75">

            <!--Cambiar estos isset, si porque estan de esta forma simplificada y no me gusta-->
            Nombre
            <input class="form-control mb-4" type="text" name="nombre"
                   value="<?= isset($pro) && is_object($pro) ? $pro->nombre : ''; ?>"/>
            Descripcion
            <textarea name="descripcion"
                      class="form-control mb-4"><?= isset($pro) && is_object($pro) ? $pro->descripcion : ''; ?></textarea>
            Autor
            <br>
            <input class="form-control mb-4" type="text" name="autor"
                   value="<?= isset($pro) && is_object($pro) ? $pro->autor : ''; ?>"/>
            Precio
            <br>
            <input class="form-control mb-4" type="text" name="precio"
                   value="<?= isset($pro) && is_object($pro) ? $pro->precio : ''; ?>"/>

            tipo
            <br>

            <input class="form-control mb-4" type="text" name="tipo"
                   value="<?= isset($pro) && is_object($pro) ? $pro->tipo : ''; ?>"/>
            Stock
            <input class="form-control mb-4" type="number" name="stock"
                   value="<?= isset($pro) && is_object($pro) ? $pro->stock : ''; ?>"/>

            Genero
            <?php $generos = Utils::showGeneros(); ?>
            <select class="form-control mb-4 " name="genero">
                <!--Cambiar estos isset-->
                <?php while ($resultado = $generos->fetch_object()): ?>
                    <option value="<?= $resultado->id ?>" <?= isset($pro) && is_object($pro) && $resultado->id == $pro->genero_id ? 'selected' : ''; ?>>
                        <?= $resultado->nombre ?>
                    </option>
                <?php endwhile; ?>
            </select>
            Imagen
            <br><br>
            <?php
            if (isset($pro) && is_object($pro) && !empty($pro->imagen)) {

                echo "<img src='$pro->imagen' class='thumb'>";
            } else {
                echo "<img src='assets/img/Logo.png' class='thumb'>";
            }

            ?>
            <br><br>
            <div class="custom-file">
                <input type="file" class="custom-file-input" name="imagen" id="inputGroupFile01"
                       aria-describedby="inputGroupFileAddon01">
                <label class="custom-file-label" for="inputGroupFile01">Elige un archivo</label>
            </div>
            <!--<input class="form-control mb-4 " type="file" name="imagen"/>-->
            <br><br>
             PDF
            <br><br>
            <?php
            if (isset($pro) && is_object($pro) && !empty($pro->imagen)) {

                echo $pro->pdf;
            } else {
                echo "No tiene formato pdf";
            }

            ?>
            <div class="custom-file">
                <input type="file" class="custom-file-input" name="pdf" id="inputGroupFile01"
                       aria-describedby="inputGroupFileAddon01">
                <label class="custom-file-label" for="inputGroupFile01">Elige un archivo</label>
            </div>
            <br><br>

            <button class="form-control mb-4 btn btn-success text-white w-50 p-2" type="submit">Guardar</button>

        </form>
    </div>
</div>


