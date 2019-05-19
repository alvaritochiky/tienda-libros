
    <h1><?= $genero->nombre ?></h1>

    <div class="row">

        <?php
        while ($product = $productos->fetch_object()) {
            echo "<div class='product col-lg-3 ml-lg-5 col-sm-12 mt-3'>";
            echo "<a href='index.php?controller=producto&action=ver&id=$product->id'>";
            if ($product->imagen != null) {
                echo "<img src='$product->imagen'>";
            } else {
                echo "<img src='assets/img/Logo.png'>";
            }
            echo "<h2>$product->nombre </h2>";
            echo "</a>";
            echo "<p><i>" . $product->autor . "</i></p>";
            echo "<p>" . $product->precio . " €</p>";
            echo "<a href='index.php?controller=carrito&action=add&id=$product->id' class='btn btn-success text-white' id='btn-prod'>Comprar</a>";
            echo "</div>";
        }
        ?>
    </div>


