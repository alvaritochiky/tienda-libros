<?php if (isset($product)) {
    echo "<h1 > $product->nombre </h1 >";
    echo "<div id='detail-product'>";
    echo "<div class='image'>";
    if ($product->imagen != null) {
        echo "<img src = '$product->imagen' />";
    } else {
        echo "<img src='assets/img/Logo.png'>";
    }
    echo "</div>";
    echo "<div class='data'>";
    echo "<p class='description'>". nl2br($product->descripcion) ."</p >";
    echo "<p class='price'> $product->precio €</p >";
    echo "<p class='price'> $product->tipo</p >";
    echo "<a href = 'index.php?controller=carrito&action=add&id=$product->id' class='btn btn-success text-white' id='btn-prod'> Comprar</a >";
    echo "</div>";
    echo "</div>";
} else {
    echo "<h1> El producto no existe </h1>";
}
?>