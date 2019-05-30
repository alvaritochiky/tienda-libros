

<h1>Libros</h1>

<div class="row">
    <div class="col-5"></div>
    <select class="browser-default custom-select w-25 col-2 success-color text-white" name='filters' onchange='testFilt(this.value)'>
        <option selected disabled>Ordenar por:</option>
        <option value="dest">Destacados</option>
        <option value="LessMore">Precio: de mas bajo a mas alto</option>
        <option value="MoreLess">Precio: de mas alto a mas bajo</option>
        <option value=alpha>Alfabeticamente</option>
    </select>
    <div col="5"></div>
</div>
<?php

$db = new mysqli("localhost", "root", "", "tienda_libros");
$MenosMas = "SELECT * from productos where tipo='fisico' AND stock>0 order by RAND()";
$prod = $db->query($MenosMas);
echo "<div class='row'>";
while ($productos = $prod->fetch_assoc()) {
    echo "<div class='product col-lg-3 ml-lg-5 col-sm-12 mt-3'>";
    echo "<a href='index.php?controller=producto&action=ver&id=$productos[id]'>";
    echo "<img src='$productos[imagen]'>";

    echo "<h2>$productos[nombre] </h2>";
    echo "</a>";
    echo "<p><i>$productos[autor]</i></p>";
    echo "<p>$productos[precio]€</p>";
    echo "<a href='index.php?controller=carrito&action=add&id=$productos[id]' class='btn btn-success text-white' id='btn-prod'>Comprar</a>";
    echo "</div>";
}

?>
</div>