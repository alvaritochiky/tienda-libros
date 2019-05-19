<div id="carousel-example-1z" class="carousel slide carousel-fade mb-5" data-ride="carousel">

    <ol class="carousel-indicators">
        <li data-target="#carousel-example-1z" data-slide-to="0" class="active"></li>
        <li data-target="#carousel-example-1z" data-slide-to="1"></li>
        <li data-target="#carousel-example-1z" data-slide-to="2"></li>
    </ol>


    <div class="carousel-inner" role="listbox">

        <div class="carousel-item active">
            <img class="d-block w-100" src="assets/img/carrousel2.jpg"
                 alt="First slide">
        </div>

        <div class="carousel-item">
            <img class="d-block w-100" src="assets/img/carrousel3.jpg"
                 alt="Second slide">
        </div>
        <div class="carousel-item">
            <img class="d-block w-100" src="assets/img/carrousel5.jpg"
                 alt="Third slide">
        </div>


    </div>

    <a class="carousel-control-prev" href="#carousel-example-1z" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carousel-example-1z" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>

</div>

<h1 class="mb-5">Productos destacados</h1>

<!--<div class="example-1 square scrollbar-dusty-grass square thin row pb-2">-->
<div class="row h2-sm">
    <?php
    while ($product = $productos->fetch_object()) {

        echo "<div class='col-lg-2 col-sm-1 mt-3'></div>";
        echo "<div class=' col-lg-3 ml-lg-5 col-sm-12 mt-5 mb-5 text-lg-left text-sm-center'>";

        if ($product->imagen != null) {
            echo "<a href='index.php?controller=producto&action=ver&id=$product->id'><img src='$product->imagen'></a> ";
        } else {
            echo "<a href='index.php?controller=producto&action=ver&id=$product->id'><img src='assets/img/Logo.png'></a>";
        }
        echo "</div>";

        echo "<div class='col-lg-5'><a href='index.php?controller=producto&action=ver&id=$product->id'><h1>$product->nombre </h1>";
        echo "</a>";
        echo "<p class='h2 font-italic'>" . $product->autor . "</p>";
        echo "<p>Sinopsis<br>" . $product->descripcion . "</p>";
        echo "<p class='h1'>" . $product->precio . " €</p>";
        echo "<a href='index.php?controller=carrito&action=add&id=$product->id' class='btn btn-success text-white' id='btn-prod'>Comprar</a>";

        echo "<br><br><br></div>";


    }
    ?>
</div>
<!--</div>-->


