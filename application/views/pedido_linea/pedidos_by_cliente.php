<h3>Cod. Cliente: <?php echo $codigo_cliente; ?></h3>

<?php foreach ($lista_pedido_cabecera as $pedido_cabecera): ?>
	<?php //echo var_dump($pedido_cabecera);?>
	<div class="main">
		Pedido nro.: <?php echo $pedido_cabecera['id_pedido']; ?><br/>
		
		Fecha de creación: <?php echo $pedido_cabecera['fec_creacion']; ?>
	</div>
	<p><a href="<?php echo site_url('pedido_cabecera/'.$pedido_cabecera['id_pedido']); ?>">Ver Pedido</a></p>

<?php endforeach; ?>