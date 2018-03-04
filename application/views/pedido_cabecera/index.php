<h2><?php echo $title; ?></h2>

<?php foreach ($pedido_cabecera as $pedido_cabecera_item): ?>

        <h3><?php echo $pedido_cabecera_item['cod_cliente']; ?></h3>
        <div class="main">
                <?php echo $pedido_cabecera_item['fec_creacion']; ?>
        </div>
        <p><a href="<?php echo site_url('pedido_cabecera/'.$pedido_cabecera_item['id_pedido']); ?>">Ver Pedido</a></p>

<?php endforeach; ?>