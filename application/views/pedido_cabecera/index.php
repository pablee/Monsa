

<?php foreach ($lista_pedido_cabecera as $pedido_cabecera_item): ?>
	<?php //echo var_dump($pedido_cabecera_item);?>
	<div class="main">
		Pedido nro.: <?php echo $pedido_cabecera_item['id_pedido']; ?><br/>
		Cod. Cliente: <?php echo $pedido_cabecera_item['cod_cliente']; ?><br/>
		Fecha de creación: <?php echo $pedido_cabecera_item['fec_creacion']; ?>
	</div>
	<p><a href="<?php echo site_url('pedido_cabecera/'.$pedido_cabecera_item['id_pedido']); ?>">Ver Pedido</a></p>

<?php endforeach; ?>