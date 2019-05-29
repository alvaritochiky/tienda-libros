<?php
if (!isset($_SESSION["admin"])) {
    ?>
    <div id="carousel-example-1z" class="carousel slide carousel-fade mb-5" data-ride="carousel">

        <ol class="carousel-indicators">
            <li data-target="#carousel-example-1z" data-slide-to="0" class="active"></li>
            <li data-target="#carousel-example-1z" data-slide-to="1"></li>
            <li data-target="#carousel-example-1z" data-slide-to="2"></li>
        </ol>


        <div class="carousel-inner" role="listbox">

            <div class="carousel-item active">
                <a href="index.php?controller=producto&action=ver&id=32"><img class="d-block w-100" src="assets/img/carrousel2.jpg" alt="First slide"></a>
            </div>

            <div class="carousel-item">
                <a href="index.php?controller=genero&action=show&id=5"><img class="d-block w-100" src="assets/img/carrousel3.jpg" alt="Second slide"></a>
            </div>
            <div class="carousel-item">
                <a href="index.php?controller=producto&action=ver&id=43"> <img class="d-block w-100" src="assets/img/carrousel5.jpg" alt="Third slide"></a>
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

    <h1 class="mb-5">Producto destacado</h1>

    <!--<div class="example-1 square scrollbar-dusty-grass square thin row pb-2">-->
    <div class="row h2-sm">
        <?php

        while ($product = $productos->fetch_object()) {

            echo "<div class='col-lg-2 col-sm-1 mt-3'></div>";
            echo "<div class=' dest col-lg-3 ml-lg-5 col-sm-12 mt-5 mb-5 text-lg-left text-sm-center'>";

            if ($product->imagen != null) {
                echo "<a href='index.php?controller=producto&action=ver&id=$product->id'><img src='$product->imagen'></a> ";
            } else {
                echo "<a href='index.php?controller=producto&action=ver&id=$product->id'><img src='assets/img/Logo.png'></a>";
            }
            echo "</div>";

            echo "<div class='col-lg-5'><a href='index.php?controller=producto&action=ver&id=$product->id'><h1>$product->nombre </h1>";
            echo "</a>";
            echo "<p class='h2 font-italic'>" . $product->autor . "</p>";
            echo "<p class='descriptionDest'>Sinopsis<br>" . $product->descripcion . "</p>";
            echo "<p class='h1'>" . $product->precio . " €</p>";
            echo "<a href='index.php?controller=carrito&action=add&id=$product->id' class='btn btn-success text-white' id='btn-prod'>Comprar</a>";

            echo "<br><br><br></div>";
        }
        ?>
    </div>
    <h1>Top ventas</h1>
    <div class="row h2-sm">
        <div class="swiper-container">
            <div class="swiper-wrapper">
                <?php

                while ($product = $productosSales->fetch_object()) {
                    echo "<div class='swiper-slide' ><a href='index.php?controller=producto&action=ver&id=$product->id'><img src='$product->imagen'></a></div>";
                }
                ?>
            </div>
            <div class="swiper-pagination"></div>
        </div>
    </div>
    <h1>Lo más nuevo</h1>
    <div class="row h2-sm">
        <div class="swiper-container">
            <div class="swiper-wrapper">
                <?php
                while ($product = $productosNew->fetch_object()) {
                    echo "<div class='swiper-slide' ><a href='index.php?controller=producto&action=ver&id=$product->id'><img src='$product->imagen'></a></div>";
                }
                ?>
            </div>
            <div class="swiper-pagination"></div>
        </div>
    </div>
    <?php

    ?>
    </div>
<?php
} else {
    ?>
    <script>
        document.getElementById("basicExampleNav").style.visibility = "hidden";
    </script>
    <h1 class="ml-5">Gestiones del administrador</h1>
    <div class="containter">
        <div class="row"></div>
        <div class="row"></div>
        <div class="row"></div>
        <div class="row"></div>
        <div class="row">
            <div class="col-xl-4 col-sm-0"></div>
            <a href='index.php?controller=genero&action=index' class='btn default-color  text-white  col-xl-4 col-sm-12 m-5 p-4' id='btn-prod'><span class="h4">Gestionar generos <i class="fas fa-bars fa-lg"></i></span></a>
            <div class="col-xl-4 col-sm-0"></div>
        </div>
        <div class="row">
            <div class="col-xl-4 col-sm-0"></div>
            <a href='index.php?controller=usuario&action=listar' class='btn default-color text-white col-xl-4 col-sm-12 m-5 p-4' id='btn-prod'><span class="h4">Gestionar usuarios <i class="fas fa-users fa-lg"></i></span></a>
            <div class="col-xl-4 col-sm-0"></div>
        </div>
        <div class="row">
            <div class="col-xl-4 col-sm-0"></div>
            <a href='index.php?controller=producto&action=gestion' class='btn default-color text-white col-xl-4 col-sm-12 m-5 p-4' id='btn-prod'><span class="h4">Gestionar productos <i class="fas fa-book fa-lg"></i></span></a>
            <div class="col-xl-4 col-sm-0"></div>
        </div>
        <div class="row">
            <div class="col-xl-4 col-sm-0"></div>
            <a href='index.php?controller=pedido&action=gestion' class='btn default-color text-white col-xl-4 col-sm-12 m-5 p-4' id='btn-prod'><span class="h4">Gestionar pedidos <i class="fas fa-shopping-cart fa-lg"></i></span></a>
            <div class="col-xl-4 col-sm-0"></div>
        </div>
        <div class="row">
            <div class="col-xl-4 col-sm-0"></div>
            <a href='index.php?controller=usuario&action=logout' class='btn warning-color-dark text-white col-xl-4 col-sm-12 m-5 p-4' id='btn-prod'><span class="h4">Cerrar Sesion <i class="fas fa-power-off fa-lg"></i></span></a>
            <div class="col-xl-4 col-sm-0"></div>
        </div>
    </div>


<?php
}
?>