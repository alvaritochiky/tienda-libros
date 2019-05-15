<h1>Gestion de productos</h1>
<a href="index.php?controller=producto&action=crear" class="btn btn-success text-white mb-5">
    Crear producto
</a>
<?php
if (isset($_SESSION["producto"]) && $_SESSION["producto"] == "complete") {
    echo "<strong class='alert_green'>El producto se ha creado correctamente</strong><br><br>";
} elseif (isset($_SESSION["producto"]) && $_SESSION["producto"] == "failed") {
    echo "<strong class='alert_red'>El producto no se ha podido crear</strong><br><br>";
}
if (isset($_SESSION["delete"]) && $_SESSION["delete"] == "complete") {
    echo "<strong class='alert_green'>El producto se ha borrado</strong><br><br>";
} elseif (isset($_SESSION["delete"]) && $_SESSION["delete"] == "failed") {
    echo "<strong class='alert_red'>El producto no se ha borrado</strong><br><br>";
}
Utils::deleteSession("producto");
Utils::deleteSession("delete");
?>
<div class="example-1 square scrollbar-dusty-grass square thin pb-5">
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
