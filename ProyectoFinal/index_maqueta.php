<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Tienda de Libros</title>
    <link rel="stylesheet" href="assets/css/styles.css">
</head>
<body>
<div id="container">
    <!-- CABEZERA -->
    <header id="header">
        <div id="logo">
            <a href="index_maqueta.php">
                <img src="assets/img/Logo.png" alt="Logo Libro"/></a>
            <a href="index_maqueta.php" id="titulo">
                TIENDA DE LIBROS
            </a>
        </div>
    </header>
    <!--MENU -->
    <nav id="menu">
        <ul>
            <li>
                <a href="#">
                    Inicio
                </a>
            </li>
            <li>
                <a href="#">
                    Buscar por género
                </a>
            </li>
            <li>
                <a href="#">
                    Comics
                </a>
            </li>
            <li>
                <a href="#">
                    Libros destacados
                </a>
            </li>
            <li>
                <a href="#">
                    Ebooks
                </a>
            </li>
            <li>
                <a href="#">
                    Ofertas
                </a>
            </li>

        </ul>
    </nav>
    <div id="content">
        <!-- BARRA LATERAL -->

        <aside id="lateral">
            <div id="login" class="block_aside">
                <h3>Iniciar Sesion</h3>
                <form action="" method="post">
                    <input type="text" name="email" placeholder="Email">
                    <input type="password" name="pass" placeholder="**********">
                    <input type="submit" value="Entrar">
                </form>
                <ul>
                    <li><a href="#">Mis pedidos</a></li>
                    <li><a href="#">Gestionar pedidos</a></li>
                    <li><a href="#">Gestionar generos</a></li>
                </ul>
            </div>
        </aside>


        <!-- CONTENIDO CENTRAL -->

        <div id="central">
            <h1>Productos destacados</h1>
            <div class="product">
                <img src="assets/img/Logo.png"/>
                <h2>50 sombras de grey</h2>
                <p>20€</p>
                <a href="#" class="button">Comprar</a>
            </div>
            <div class="product">
                <img src="assets/img/Logo.png"/>
                <h2>50 sombras de grey</h2>
                <p>20€</p>
                <a href="#" class="button">Comprar</a>
            </div>
            <div class="product">
                <img src="assets/img/Logo.png"/>
                <h2>50 sombras de grey</h2>
                <p>20€</p>
                <a href="#" class="button">Comprar</a>
            </div>
            <div class="product">
                <img src="assets/img/Logo.png"/>
                <h2>50 sombras de grey</h2>
                <p>20€</p>
                <a href="#" class="button">Comprar</a>
            </div>
        </div>
    </div>
    <!-- FOOTER -->

    <footer id="footer">
        <p>Desarrollado por Alvaro Roldan &copy<?php echo date("Y") ?></p>
    </footer>
</div>
</body>
</html>