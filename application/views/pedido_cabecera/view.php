
<h2>Pedido: <?php echo $pedido_cabecera_item['id_pedido']?></h2>
Cliente: <?php echo $pedido_cabecera_item['cod_cliente']?><br>
Fecha de creación: <?php echo $pedido_cabecera_item['fec_creacion']?><br>

<?php
foreach ($pedido_linea as $pedido_linea_item): ?>

        <h3><?php echo $pedido_tem['cod_cliente']; ?></h3>
        <div class="main">
                <?php echo $pedido_cabecera_item['fec_creacion']; ?>
        </div>
        <p><a href="<?php echo site_url('pedido_cabecera/'.$pedido_cabecera_item['id_pedido']); ?>">Ver Pedido</a></p>

<?php endforeach; ?>

<br>