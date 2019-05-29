<?php if (isset($product)) {
    echo '<h1>Productos encontrados</h1>';
    echo '<div class="row">';
    while ($productos = $product->fetch_object()) {

        echo "<div class='col-lg-2 col-sm-1 mt-3'></div>";
        echo "<div class=' dest col-lg-3 ml-lg-5 col-sm-12 mt-5 mb-5 text-lg-left text-sm-center'>";

        if ($productos->imagen != null) {
            echo "<a href='index.php?controller=producto&action=ver&id=$productos->id'><img src='$productos->imagen'></a> ";
        } else {
            echo "<a href='index.php?controller=producto&action=ver&id=$productos->id'><img src='assets/img/Logo.png'></a>";
        }
        echo "</div>";

        echo "<div class='col-lg-5'><a href='index.php?controller=producto&action=ver&id=$productos->id'><h1>$productos->nombre </h1>";
        echo "</a>";
        echo "<p class='h2 font-italic'>" . $productos->autor . "</p>";
       
        echo "<p class='h1'>" . $productos->precio . " €</p>";
        echo "<a href='index.php?controller=carrito&action=add&id=$productos->id' class='btn btn-success text-white' id='btn-prod'>Comprar</a>";

        echo "<br><br><br></div>";

    }
   echo " </div>";
}

else {
echo "<h1> El producto no existe </h1>";
}
?>
</div>

