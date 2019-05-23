<div class="example-1 square scrollbar-dusty-grass square thin ">
    <h1>Carrito de la compra</h1>

    <?php if (isset($_SESSION['carrito']) && count($_SESSION['carrito']) >= 1) {
        ?>
    <div class="table-responsive">
        <table class="table">
            <thead class="black text-white">
            <tr>
                <th>Imagen</th>
                <th>Nombre</th>
                <th>Precio</th>
                <th>Unidades</th>
                <th>Eliminar</th>
            </tr>
            </thead>
            <?php
            foreach ($carrito as $indice => $elemento) {

                $producto = $elemento['producto'];
                ?>
                <tr>
                    <td>
                        <?php if ($producto->imagen != null) {
                            echo "<img src='$producto->imagen' class='img_carrito'/>";
                        } else {
                            echo "<img src='assets/img/Logo.png' class='img_carrito'/>";
                        }
                        ?>
                    </td>
                    <td>
                        <div class="mt-4">
                            <a class="h5"
                               href="index.php?controller=producto&action=ver&id=<?= $producto->id ?>"><?= $producto->nombre ?></a>
                        </div>
                    </td>
                    <td>
                        <div class="h5 mt-4"><?= $producto->precio ?>€</div>
                    </td>
                    <script type="text/javascript">
                        var precio =<?= $producto->precio ?>;
                        var id =<?= $producto->id ?>;


                        function addProd(indi) {
                            var cont = document.getElementById("uni" + indi).innerHTML;
                            var tot = document.getElementById("tot").innerHTML;
                            cont2 = parseInt(cont);
                            tot2 = parseInt(tot);
                            var xhttp = new XMLHttpRequest();
                            xhttp.onreadystatechange = function () {
                                if (this.readyState == 4 && this.status == 200) {
                                    document.getElementById("uni" + indi).innerHTML = cont2 + 1;
                                    document.getElementById("tot").innerHTML = tot2 + precio;


                                }
                            };
                            xhttp.open("GET", "index.php?controller=carrito&action=up&index=" + indi, true);
                            xhttp.send();

                        }


                    </script>
                    <td>

                        <span id="uni<?= $indice ?>" class="h5"><?= $elemento['unidades'] ?></span>

                        <div class="updown-unidades mt-3">
                            <button onclick="addProd(<?= $indice ?>)" class='btn-success p-2 border-0'>+</button>

                            <button class='btn-success text-white p-2 border-0'><a
                                        href="index.php?controller=carrito&action=down&index=<?= $indice ?>" id="res2"
                                        class="text-white">-</a></button>
                        </div>
                    </td>
                    <td>
                        <a href="index.php?controller=carrito&action=delete&index=<?= $indice ?>"
                           class='btn btn-danger text-white mt-4'>Quitar producto</a>
                    </td>
                </tr>
                <?php
            } ?>
        </table>
    </div>
        <div class="delete-carrito">
            <a href="index.php?controller=carrito&action=delete_all" class='btn btn-success text-white'">Vaciar
            carrito</a>
        </div>
        <div class="total-carrito">
            <?php $stats = Utils::statsCarrito(); ?>
            <h3>Precio total: <span id="tot" class="h3"><?= $stats['total'] ?></span> €</h3>
            <a href="index.php?controller=pedido&action=hacer" class='btn btn-success text-white'">Hacer pedido</a>
        </div>
        <?php

    } else {
        echo "<p class='text-center h4'> El carrito está vacio, añade algun producto </p >";
    } ?>
</div>
