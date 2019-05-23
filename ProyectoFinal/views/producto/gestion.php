<h1>Gestion de productos</h1>
<a href="javascript:window.history.back();"><i class="fas fa-arrow-left fa-2x"></i><span class="h2">ATRÁS</span><!--<img src="assets/img/back-arrow.gif" width="100px" height="75px">ATRAS--></a>
<br><br>
<a href="index.php?controller=producto&action=crear" class="btn btn-success text-white mb-5">
    Crear producto
</a>
<?php
if (isset($_SESSION["producto"]) && $_SESSION["producto"] == "complete") {
    ?>
    <script>
        function showAlert() {
            Swal.fire(
                'Perfecto',
                'El producto se ha modificado correctamente!',
                'success'
            )
        }

        showAlert();
    </script>
    <?php
} elseif (isset($_SESSION["producto"]) && $_SESSION["producto"] == "failed") {
    ?>
    <script>
        function showAlert() {
            Swal.fire({
                type: 'error',
                title: 'Vaya',
                text: 'El producto no se ha podido modificar',
            })
        }

        showAlert();
    </script>
    <?php
}
if (isset($_SESSION["delete"]) && $_SESSION["delete"] == "complete") {
    ?>
    <script>
        function showAlert() {
            Swal.fire(
                'Perfecto',
                'El producto  ha sido borrado correctamente!',
                'success'
            )
        }

        showAlert();
    </script>
    <?php
} elseif (isset($_SESSION["delete"]) && $_SESSION["delete"] == "failed") {
    ?>
    <script>
        function showAlert() {
            Swal.fire({
                type: 'error',
                title: 'Vaya',
                text: 'El producto  no se ha podido borrar',
            })
        }

        showAlert();
    </script>
    <?php

}
Utils::deleteSession("producto");
Utils::deleteSession("delete");
?>

<div class="table-responsive">
    <table class="table ">
        <thead class="black white-text">
        <tr>
            <th>ID</th>
            <th>NOMBRE</th>
            <th>PRECIO</th>
            <th>STOCK</th>
            <th>Formato</th>
            <th>ACCIONES</th>
        </tr>
        </thead>
        <?php
        while ($resultado = $producto->fetch_object()) {
            echo "<tr>";
            foreach ($producto as $dat => $val) {

                echo "<td>" . $val["id"] . "</td>";
                echo "<td>" . $val["nombre"] . "</td>";
                echo "<td>" . $val["precio"] . "€</td>";
                echo "<td>" . $val["stock"] . "</td>";
                echo "<td>" . $val["tipo"] . "</td>";
                echo "<td>";
                echo "<a href='index.php?controller=producto&action=editar&id=" . $val["id"] . "' class='btn btn-success text-white mr-2'>Editar</a>";
                echo "<a href='index.php?controller=producto&action=eliminar&id=" . $val["id"] . "' class='btn btn-danger text-white'>Eliminar</a>";
                echo "</td>";
                echo "</tr>";
            }
            echo "</tr>";
        }
        ?>

    </table>
</div>

