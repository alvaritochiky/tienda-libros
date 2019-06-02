<!doctype html>
<html lang="es">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="tipo_contenido"  content="text/html;" http-equiv="content-type" charset="utf-8">

    <title>La Librería de Papá</title>
    <!--Icono-->
    <link rel="icon" type="image/png" href="assets/img/LogoIcon.png"/>
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
    <!--Ficheros JS-->
    <script src='assets/JS/Select.js'></script>
    <script src="assets/JS/Validation.js"></script>
    <script src="assets/JS/InvoicesPDF.js"></script>
</head>

<body>
    <?php

    //Modales
    if (isset($_SESSION['error_login'])) {
        ?>

        <script>
            Swal.fire({
                type: 'error',
                title: 'Vaya',
                text: 'Usuario o contraseña incorrecto',
            })
        </script>
        <?php
        Utils::deleteSession("error_login");
    }
    if (isset($_SESSION['edit']) && $_SESSION['edit'] == 'complete') {
        ?>
        <script>
            function showAlert() {
                Swal.fire(
                    'Perfecto!',
                    'El usuario se ha editado correctamente!',
                    'success'
                )
            }

            showAlert();
        </script>
        <?php
        Utils::deleteSession("edit");
    }
    if (isset($_SESSION['edit']) && $_SESSION['edit'] == 'failed') {
        ?>
        <script>
            Swal.fire({
                type: 'error',
                title: 'Vaya',
                text: 'El usuario no se ha podido editar',
            })
        </script>
        <?php
        Utils::deleteSession("edit");
    }
    if (isset($_SESSION["deleteUser"]) && $_SESSION["deleteUser"] == "complete") {
        ?>
        <script>
            function a() {
                Swal.fire(
                    'Perfecto',
                    'El usuario ha sido borrado correctamente!',
                    'success'
                )
            }
    
            a();
        </script>
        <?php
    } elseif (isset($_SESSION["deleteUser"]) && $_SESSION["deleteUser"] == "failed") {
        ?>
        <script>
            function a() {
                Swal.fire({
                    type: 'error',
                    title: 'Vaya',
                    text: 'El usuario no se ha podido borrar',
                })
            }
    
            a();
        </script>
        <?php
    
    }
    Utils::deleteSession("deleteUser");

    ?>
    <nav class=" success-color menuHeader" id="menuHeader">
        <nav class="navbar navbar-expand-xl navbar-dark ">

            <a class="navbar-brand" href="index.php"><img src="assets/img/Logo.png"><span class="titulo ml-3 h4 ">La Librería de Papá</span></a>


            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#basicExampleNav" id="navbar-toggler" aria-controls="basicExampleNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse ml-3" id="basicExampleNav">


                <ul class="navbar-nav mr-auto ">
                    <li class="nav-item mr-2">
                        <a class="nav-link" href="index.php"><i class="fas fa-home"></i>
                            <span class="sr-only">(current)</span>
                        </a>
                    </li>
                    <li class="nav-item mr-2">
                        <a class="nav-link" href="index.php?controller=producto&action=indexBooks" class="items"><span class="items">Libros</a></span>
                    </li>
                    <li class="nav-item mr-2">
                        <a class="nav-link" href="index.php?controller=producto&action=indexEbooks" class="items"><span class="items">eBook</a></span>
                    </li>

                    <!-- Dropdown -->
                    <li class="nav-item dropdown ">
                        <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="items">Géneros</span></a>
                        <div class="dropdown-menu dropdown-primary green accent-3" aria-labelledby="navbarDropdownMenuLink">
                            <?php $genero = Utils::showGeneros(); ?>
                            
                            <?php while ($gen = $genero->fetch_object()) : ?>

                                <a class="dropdown-item" href="index.php?controller=genero&action=show&id=<?= $gen->id ?>"><?= $gen->nombre ?></a>
                            <?php endwhile; ?>
                    </li>
                </ul>


                <form class="form-inline mr-3" action="index.php?controller=producto&action=buscarLibro" method="post">
                    <input class="form-control" type="text" placeholder="Buscar libro,autor" aria-label="Search" name="searchBook">
                    <button class="btn btn-outline-white btn-rounded btn-sm my-2" type="submit">Buscar</button>
                </form>
                <ul>
                    <?php $stats = Utils::statsCarrito(); ?>
                    <li class="list-unstyled mt-3 mr-2"><a href="index.php?controller=carrito&action=index" id="carr" class="white-text"><i class="fas fa-shopping-cart mt-2 text-dark"></i>(<?php echo $stats["count"] ?>)</a></li>

                </ul>
                <?php
                if (!isset($_SESSION["identity"])) {
                    ?>
                    <div class="nav navbar-nav">
                        <a href="" class="btn danger-color   text-white" data-toggle="modal" data-target="#modalLoginForm">Iniciar
                            sesión</a>
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
                        let none2 = document.getElementById("navbar-toggler");
                        let none = document.getElementById("basicExampleNav");
                        none.setAttribute("style", "display: none!important;");
                        none2.setAttribute("style", "display: none!important;");
                        let bg = document.getElementById("menuHeader");
                        bg.setAttribute("style", "background-color: #2BBBAD!important;");
                    </script>
                    <a class="dropdown-item" href="index.php?controller=producto&action=gestion">Gestionar productos</a>
                    <a class="dropdown-item" href="index.php?controller=pedido&action=gestion">Gestionar pedidos</a>


                <?php
            }
            if (isset($_SESSION["identity"])) {
                $idUser = $_SESSION['identity']->id;
                ?>
                    <a class="dropdown-item" href="index.php?controller=pedido&action=mis_pedidos">Mis pedidos <i class="fas fa-shopping-basket fa-lg"></i></a>
                    <a class="dropdown-item" href="index.php?controller=usuario&action=edit&id=<?= $idUser ?>">Editar perfil <i class="fas fa-user-edit fa-lg"></i></a>
                    <a class="dropdown-item" href="index.php?controller=usuario&action=logout">Cerrar Sesión <i class="fas fa-power-off fa-lg"></i></a>


                </div>
                </div>
            <?php
        } ?>

            </div>

            <div class="modal fade " id="modalLoginForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

                <div class="modal-dialog " role="document">

                    <div class="modal-content">

                        <div class="modal-header text-center success-color">
                            <h4 class="modal-title w-100 font-weight-bold">Iniciar Sesión</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="index.php?controller=usuario&action=login" method="post" >
                            <div class="modal-body mx-3">

                                <div class="md-form mb-5">

                                    <i class="fas fa-user prefix grey-text"></i>

                                    <input type="email" id="defaultForm-email" class="form-control text-dark m-5 form-log" name="email" id="email" required onchange="validateFormLogIn()">

                                    <div id="errorEmail"></div>
                                    <label for="defaultForm-email" class="text-success">Email</label>

                                </div>
                                <div class="md-form mb-4">
                                    <i class="fas fa-lock prefix grey-text"></i>
                                    <input type="password" id="defaultForm-pass" class="form-control  text-dark m-5" name="pass" id="pass" required onchange="validateFormLogIn()">
                                    <div id="errorPass"></div>
                                    <label for="defaultForm-pass" class="text-success">Contraseña</label>
                                    <hr>
                                </div>

                            </div>
                            <div class="d-flex justify-content-center mb-4">
                                <button type="submit" disabled class="btn success-color text-white" id="logInButton">Entrar</button>
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
        <div class="modal fade" id="modalRegisterForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header text-center success-color">
                        <h4 class="modal-title w-100 font-weight-bold">Registrar</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form class="text-center" action="index.php?controller=usuario&action=register" method="post">

                        <div class="form-row ml-2 p-3">
                            <div class="col">

                                <div class="md-form">
                                    <input type="text" id="materialRegisterFormFirstName" class="form-control" name="nombre" required onchange="validateFormSignIn()">
                                    <div id="errorName"></div>
                                    <label for="materialRegisterFormFirstName" class="text-success">Nombre</label>
                                </div>
                            </div>
                            <div class="col">

                                <div class="md-form">
                                    <input type="text" id="materialRegisterFormLastName" class="form-control" name="apellidos" required onchange="validateFormSignIn()">
                                    <div id="errorLastName"></div>
                                    <label for="materialRegisterFormLastName" class="text-success">Apellido</label>
                                </div>
                            </div>
                        </div>

                        <div class="md-form mt-0 ml-4 p-3">
                            <input type="email" id="materialRegisterFormEmail" class="form-control" name="email" required onchange="validateFormSignIn()">
                            <div id="errorEmailSingIn"></div>
                            <label for="materialRegisterFormEmail" class="text-success">Email</label>
                        </div>


                        <div class="md-form ml-4 p-3">
                            <input type="password" id="materialRegisterFormPassword" class="form-control" aria-describedby="materialRegisterFormPasswordHelpBlock" name="password" required onchange="validateFormSignIn()">
                            <div id="errorPassSignIn"></div>
                            <label for="materialRegisterFormPassword" class="text-success">Contraseña</label>

                        </div>
                        <div class="md-form ml-4 p-3">
                            <input type="password" id="materialRegisterFormCheckPassword" class="form-control" aria-describedby="materialRegisterFormPasswordHelpBlock" name="ckeck-password" required onchange="validateFormSignIn()">
                            <div id="errorRePass"></div>
                            <label for="materialRegisterFormPassword" class="text-success">Repite tu contraseña</label>

                        </div>

                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="defaultChecked2" required onchange="validateFormSignIn()">
                            <div id="errorTerms"></div>
                            <label class="custom-control-label text-success" for="defaultChecked2" >Aceptar terminos y condiciones</label>
                        </div>


                        <div class="d-flex justify-content-center mb-4 mt-5">
                            <button type="submit" disabled id="signInButton" class="btn success-color text-white">Registrar</button>
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
} elseif (isset($_SESSION["registro"]) && $_SESSION["registro"] == "failed") {
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