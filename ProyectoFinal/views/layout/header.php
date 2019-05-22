<!doctype html>
<html lang="es">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="UTF-8">
    <title>Tienda de Libros</title>

<!--SweetAlert2-->

    <!-- Optional: include a polyfill for ES6 Promises for IE11 and Android browser -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.33.1/sweetalert2.all.min.js"></script>


    <!--Swipper-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.5.0/css/swiper.min.css">
    <!-- JQuery -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
    <!-- Bootstrap core CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <!-- Material Design Bootstrap -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.8.0/css/mdb.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/styles.css">

    <script type="text/javascript">
        $(document).ready(function () {
            $('#Download').click(function () {

                var w = document.getElementById("pdf").offsetWidth;
                var h = document.getElementById("pdf").offsetHeight;


                html2canvas(document.getElementById("pdf"), {

                    onrendered: function (canvas) {
                        var img = canvas.toDataURL("image/jpeg", 1);
                        var doc = new jsPDF('L', "mm", [w, h]);
                        doc.addImage(img, 'JPEG', 0, 0);
                        doc.save('factura.pdf');
                    }
                });
            });

        });

    </script>
</head>
<body>
<nav class=" success-color menuHeader" id="menuHeader">
    <nav class="navbar navbar-expand-xl navbar-dark ">

        <a class="navbar-brand" href="index.php"><img src="assets/img/logo.png"><span class="ml-3 h4 ">Alvaro's Library</span></a>


        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#basicExampleNav"
                aria-controls="basicExampleNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div  class="collapse navbar-collapse " id="basicExampleNav">


            <ul  class="navbar-nav mr-auto ml-5 ">
                <li class="nav-item mr-5">
                    <a class="nav-link" href="index.php"><i class="fas fa-home"></i>
                        <span class="sr-only">(current)</span>
                    </a>
                </li>
                <li class="nav-item mr-5">
                    <a class="nav-link" href="index.php?controller=producto&action=indexBooks" class="items"><span
                                class="items">Libros</a></span>
                </li>
                <li class="nav-item mr-5">
                    <a class="nav-link" href="index.php?controller=producto&action=indexEbooks" class="items"><span
                                class="items">eBook</a></span>
                </li>

                <!-- Dropdown -->
                <li class="nav-item dropdown  mr-5">
                    <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown"
                       aria-haspopup="true" aria-expanded="false"><span class="items">Generos</span></a>
                    <div class="dropdown-menu dropdown-primary green accent-3" aria-labelledby="navbarDropdownMenuLink">
                        <?php $genero = Utils::showGeneros(); ?>
                        <!--<a class="dropdown-item" href="index.php?controller=genero&action=show" >Romantica</a>
                        <a class="dropdown-item" href="#">Fantasia</a>
                        <a class="dropdown-item" href="#">Juvenil</a>
                        <a class="dropdown-item" href="#">Thriller</a>
                        <a class="dropdown-item" href="#">Novela Grafica</a>-->
                        <?php while ($gen = $genero->fetch_object()): ?>

                            <a class="dropdown-item"
                               href="index.php?controller=genero&action=show&id=<?= $gen->id ?>"><?= $gen->nombre ?></a>
                        <?php endwhile; ?>
                </li>
            </ul>


            <form class="form-inline" action="index.php?controller=producto&action=buscarLibro" method="post">
                <input class="form-control" type="text" placeholder="Buscar libro" aria-label="Search"
                       name="searchBook">
                <button class="btn btn-outline-white btn-rounded btn-sm my-2" type="submit">Buscar</button>
            </form>
            <ul>
                <?php $stats = Utils::statsCarrito(); ?>
                <li class="list-unstyled mt-3 ml-5"><a href="index.php?controller=carrito&action=index" id="carr"
                                                       class="white-text"><i
                                class="fas fa-shopping-cart mt-2 text-dark"></i>(<?php echo $stats["count"] ?>)</a></li>

            </ul>
            <?php
            if (!isset($_SESSION["identity"])) {
                ?>
                <div class="nav navbar-nav col-lg-2 col-md-3 col-sm-4 ml-sm-5">
                    <a href="" class="btn danger-color   text-white" data-toggle="modal" data-target="#modalLoginForm">Iniciar
                        sesion</a>
                </div>
                <?php

            }
            if (isset($_SESSION["identity"])) {
                echo '<div class="dropdown ml-sm-5">';
                echo '<a class="btn btn  green accent-3 text-dark dropdown-toggle" id="dropdownMenu1" data-toggle="dropdown"
                   aria-haspopup="true" aria-expanded="false">' . $_SESSION["identity"]->nombre . ' </a>';
                echo '<div class="dropdown-menu green accent-3 " aria-labelledby="navbarDropdownMenuLink">';
            }
            if (isset($_SESSION["admin"])) {
                ?>
                <script>

        let none=document.getElementById("basicExampleNav");
                    //document.getElementById("basicExampleNav").style.visibility="hidden";
        none.setAttribute("style", "display: none!important;");
                    let bg=document.getElementById("menuHeader");
                    bg.setAttribute("style", "background-color: #2BBBAD!important;");
                </script>
                <a class="dropdown-item" href="index.php?controller=producto&action=gestion">Gestionar productos</a>
                <a class="dropdown-item" href="index.php?controller=pedido&action=gestion">Gestionar pedidos</a>


                <?php
            }
            if (isset($_SESSION["identity"])) {

            ?>
            <a class="dropdown-item" href="index.php?controller=pedido&action=mis_pedidos">Mis pedidos</a>
            <a class="dropdown-item" href="#">Editar perfil</a>
            <a class="dropdown-item" href="index.php?controller=usuario&action=logout">Cerrar Sesion</a>


        </div>
        </div>
        <?php
        } ?>

        </div>


        <div class="modal fade " id="modalLoginForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
             aria-hidden="true">

            <div class="modal-dialog " role="document">

                <div class="modal-content">

                    <div class="modal-header text-center success-color">
                        <h4 class="modal-title w-100 font-weight-bold">Iniciar Sesion</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="index.php?controller=usuario&action=login" method="post" onsubmit="return validar()">
                        <div class="modal-body mx-3">

                            <div class="md-form mb-5">

                                <i class="fas fa-user prefix grey-text"></i>

                                <input type="email" id="defaultForm-email" class="form-control  text-dark m-5"
                                       name="email" id="email">

                                <label for="defaultForm-email" class="text-success ">Email</label>

                            </div>
                            <div class="md-form mb-4">
                                <i class="fas fa-lock prefix grey-text"></i>
                                <input type="password" id="defaultForm-pass" class="form-control  text-dark m-5"
                                       name="pass" id="pass">
                                <label for="defaultForm-pass" class="text-success">Contraseña</label>
                                <hr>
                            </div>


                        </div>
                        <div class="d-flex justify-content-center mb-4">
                            <button type="submit" class="btn success-color text-white">Entrar</button>
                        </div>
                        <p class="text-center">¿No tienes cuenta?
                            <a href="" data-toggle="modal" data-target="#modalRegisterForm">Registrate
                            </a>
                        </p>
                </div>
            </div>
            </form>
        </div>
        </div>
    </nav>
    <div class="modal fade" id="modalRegisterForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header text-center success-color">
                    <h4 class="modal-title w-100 font-weight-bold">Registrar</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form class="text-center" action="index.php?controller=usuario&action=save" method="post">

                    <div class="form-row ml-2 p-3">
                        <div class="col">

                            <div class="md-form">
                                <input type="text" id="materialRegisterFormFirstName" class="form-control"
                                       name="nombre">
                                <label for="materialRegisterFormFirstName">Nombre</label>
                            </div>
                        </div>
                        <div class="col">

                            <div class="md-form">
                                <input type="text" id="materialRegisterFormLastName" class="form-control"
                                       name="apellidos">
                                <label for="materialRegisterFormLastName">Apellido</label>
                            </div>
                        </div>
                    </div>

                    <div class="md-form mt-0 ml-4 p-3">
                        <input type="email" id="materialRegisterFormEmail" class="form-control" name="email">
                        <label for="materialRegisterFormEmail">Email</label>
                    </div>


                    <div class="md-form ml-4 p-3">
                        <input type="password" id="materialRegisterFormPassword" class="form-control"
                               aria-describedby="materialRegisterFormPasswordHelpBlock" name="password">
                        <label for="materialRegisterFormPassword">Contraseña</label>

                    </div>

                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="defaultChecked2">
                        <label class="custom-control-label" for="defaultChecked2">Aceptar terminos y condiciones</label>
                    </div>


                    <div class="d-flex justify-content-center mb-4 mt-5">
                        <button type="submit" class="btn success-color text-white">Registrar</button>
                    </div>

                </form>
            </div>
        </div>
    </div>

</nav>

<?php
if (isset($_SESSION["registro"]) && $_SESSION["registro"] == "complete") {
    ?>
    <script>

        function showAlert() {
            Swal.fire(
                'Perfecto!',
                'El usuario se ha creado correctamente!',
                'success'
            )
        }

        showAlert();

    </script>

<?php
}elseif (isset($_SESSION["registro"]) && $_SESSION["registro"] == "failed"){
?>
    <script>
       Swal.fire({
           type: 'error',
           title: 'Vaya',
           text: 'El usuario no se ha podido crear',
       })
    </script>
    <?php

}
Utils::deleteSession("registro");
?>
<div id="container">
    <!--/.Navbar-->
    <div id="content">
        <div id="central">
