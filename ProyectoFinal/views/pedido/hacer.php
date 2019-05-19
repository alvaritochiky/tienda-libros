<?php
if (isset($_SESSION["identity"])) {
    ?>
    <h1>Hacer pedido</h1>
    <a href="index.php?controller=carrito&action=index">Ver los productos y el precio del pedido</a>
    <br/>
    <div class="container text-center">
    <h3>Dirección para el envio:</h3>

        <form action="index.php?controller=pedido&action=add" method="POST" class="edit-create-form border border-light p-5 w-75">

            <input class="form-control mb-4" type="text" name="provincia" placeholder="Provincia">


            <input class="form-control mb-4" type="text" name="localidad" placeholder="Localidad">


            <input class="form-control mb-4" type="text" name="direccion" placeholder="Direccion">
           <!-- Provincia
            <input type="text" name="provincia" required/>
            Ciudad
            <input type="text" name="localidad" required/>
            Direccion
            <input type="text" name="direccion" required/>

            <input type="submit" value="Confirmar pedido"/>-->
            <button class="form-control mb-4 btn btn-success text-white w-50 p-2" type="submit">Enviar datos y realizar pedido</button>
        </form>
    </div>
    <?php
} else {
    echo "<h1>Necesitas estar identificado</h1>";
    echo "<p>Necesitas estar logueado en la web para poder realiar tu pedido</p>";
}
?>