<?php
if (isset($_SESSION["identity"])) {
    ?>
    <h1>Hacer pedido</h1>
    <a href="index.php?controller=carrito&action=index">Ver los productos yel precio del pedido</a>
    <br/>

    <h3>Dirección para el envio:</h3>
    <form action="index.php?controller=pedido&action=add" method="POST">
        Provincia
        <input type="text" name="provincia" required/>
        Ciudad
        <input type="text" name="localidad" required/>
        Direccion
        <input type="text" name="direccion" required/>

        <input type="submit" value="Confirmar pedido"/>
    </form>
    <?php
} else {
    echo "<h1>Necesitas estar identificado</h1>";
    echo "<p>Necesitas estar logueado en la web para poder realiar tu pedido</p>";
}
?>