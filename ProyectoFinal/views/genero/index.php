<h1>Gestionar generos</h1>
<a href="javascript:window.history.back();"><i class="fas fa-arrow-left fa-2x"></i><span class="h2">ATRÁS</span><!--<img src="assets/img/back-arrow.gif" width="100px" height="75px">ATRAS--></a>
<br><br>
<a href="index.php?controller=genero&action=crear" class="btn btn-success text-white mb-5">
    Crear genero
</a>
<div class="table-responsive">
    <table class="table ">
        <thead class="black white-text">
        <tr>
            <th>ID</th>
            <th>NOMBRE</th>
        </tr>
        </thead>
        <?php while ($gen = $generos->fetch_object()): ?>
            <tr>
                <td><?= $gen->id; ?></td>
                <td><?= $gen->nombre; ?></td>
            </tr>
        <?php endwhile; ?>
    </table>
</div>

