<h1>Lista de usuarios</h1>

<?php
if (isset($_SESSION["delete"]) && $_SESSION["delete"] == "complete") {
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
} elseif (isset($_SESSION["delete"]) && $_SESSION["delete"] == "failed") {
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
Utils::deleteSession("delete");
?>
<a href="javascript:window.history.back();"><i class="fas fa-arrow-left fa-2x"></i><span class="h2">ATRÁS</span><!--<img src="assets/img/back-arrow.gif" width="100px" height="75px">ATRAS--></a>
<br><br>
<div class="table-responsive">
    <table class="table ">
        <thead class="black white-text">
        <tr>
            <th>ID</th>
            <th>NOMBRE</th>
            <th>Email</th>
            <th>ACCIONES</th>
        </tr>
        </thead>

        <?php

        while ($resultado = $usuarios->fetch_object()) {
            echo "<tr>";
            foreach ($usuarios as $dat => $val) {

                echo "<td>" . $val["id"] . "</td>";
                echo "<td>" . $val["nombre"] . "</td>";
                echo "<td>" . $val["email"] . "</td>";
                echo "<td>";
                echo "<a href='index.php?controller=usuario&action=delete&id=" . $val["id"] . "' class='btn btn-danger text-white'>Eliminar</a>";
                echo "</td>";
                echo "</tr>";
            }
            echo "</tr>";
        }

        ?>

    </table>
</div>