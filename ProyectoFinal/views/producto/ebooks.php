<script src='assets/JS/Select.js'></script>
<h1>Ebook</h1>

<div class="row">
    <div class="col-5"></div>
    <select class="browser-default custom-select w-25 col-2 success-color text-white" name='filters' onchange='testFilt(this.value)'>
        <option selected disabled>Ordenar por:</option>
        <option value="destE">Destacados</option>
        <option value="LessMoreE">Precio: de mas bajo a mas alto</option>
        <option value="MoreLessE">Precio: de mas alto a mas bajo</option>
        <option value="alphaE">Alfabeticamente</option>
    </select>
    <div col="5"></div>
</div>
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