<?php if (isset($product)) {
    echo '<h1>Productos encontrados</h1>';
    echo '<div class="productos example-1 square scrollbar-dusty-grass square thin row">';
        echo "<div class='product col-lg-3 ml-lg-5 col-sm-12'>";
        echo "<a href='index.php?controller=producto&action=ver&id=$product->id'>";
        if ($product->imagen != null) {
            echo "<img src='$product->imagen'>";
        } else {
            echo "<img src='assets/img/Logo.png'>";
        }
        echo "<h2>$product->nombre </h2>";
        echo "</a>";
        echo "<p>" . $product->precio . " €</p>";
        echo "<a href='index.php?controller=carrito&action=add&id=$product->id' class='btn btn-success text-white'>Comprar</a>";
        echo "</div>";

} else {
    echo "<h1> El producto no existe </h1>";
}
?>
</div>

