<?php if (isset($gestion)): ?>
    <h1>Gestionar pedidos</h1>
<?php else: ?>
    <h1>Mis pedidos</h1>
<?php endif; ?>
<a href="index.php"><i class="fas fa-arrow-left fa-2x"></i><span class="h2">ATRÁS</span></a>
<br><br>
<div class="table-responsive">
    <table class="table">
        <thead class="black text-white">
        <tr>
            <th>Nº Pedido</th>
            <th>Coste</th>
            <th>Fecha</th>
            <th>Estado</th>
        </tr>
        </thead>
        <?php
        while ($ped = $pedidos->fetch_object()):
            ?>

            <tr>
                <td>
                    <a href="index.php?controller=pedido&action=detalle&id=<?= $ped->id ?>"><?= $ped->id ?></a>
                </td>
                <td>
                    <?= $ped->coste ?> €
                </td>
                <td>
                    <?= $ped->fecha ?>
                </td>
                <td>
                    <?= Utils::showStatus($ped->estado) ?>
                </td>
            </tr>

        <?php endwhile; ?>
    </table>
</div>
