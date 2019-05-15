
<?php

if (isset($_SESSION['pedido']) && $_SESSION['pedido'] == 'complete') {
    ?>
    <div id="pdf">
    <h1>Hola <?php echo $_SESSION["identity"]->nombre ?> tu pedido ha sido confirmado</h1>
    <p>
        Tu pedido ha sido guardado con exito, una vez que realices la transferencia
        bancaria a la cuenta 7382947289239ADD con el coste del pedido, será procesado y enviado.
    </p>
    <br/>
    <?php if (isset($pedido)): ?>


            <h3>Datos del pedido:</h3>

            Número de pedido: <?= $pedido->id ?> <br/>
            Total a pagar: <?= $pedido->coste ?> € <br/>
            Productos:
            <table>
                <tr>
                    <th>Imagen</th>
                    <th>Nombre</th>
                    <th>Precio</th>
                    <th>Unidades</th>
                </tr>
                <?php while ($producto = $productos->fetch_object()): ?>
                    <tr>
                        <td>
                            <?php if ($producto->imagen != null): ?>
                                <img src="<?php echo $producto->imagen ?>" class="img_carrito"/>
                            <?php else: ?>
                                <img src="assets/img/Logo.png" class="img_carrito"/>
                            <?php endif; ?>
                        </td>
                        <td>
                            <a href="index.php?controller=producto&action=ver&id=<?= $producto->id ?>"><?= $producto->nombre ?></a>
                        </td>
                        <td>
                            <?= $producto->precio ?>
                        </td>
                        <td>
                            <?= $producto->unidades ?>
                        </td>
                    </tr>
                <?php
                $totalStock=$producto->stock-$producto->unidades;
                    $bbdd=new mysqli("localhost","root","","tienda_libros");
                    $sql="UPDATE productos SET stock='$totalStock' where id='$producto->id'";
                    $bbdd->query($sql);
                endwhile;


                ?>

            </table>
        </div>
        <a class='button' id="Download">Descargar pdf con la factura</a>


    <?php



    endif; ?>

    <?php
} elseif (isset($_SESSION['pedido']) && $_SESSION['pedido'] != 'complete') {
    echo "<h1>Tu pedido NO ha podido procesarse</h1>";
}
?>


