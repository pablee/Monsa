
<?php if (!empty($lista_pedidosventa_ERP)): ?>
	<?php foreach ($lista_pedidosventa_ERP as $item_pedidosventa_ERP): ?>
		<?php //echo var_dump($item_pedidosventa_ERP);?>
		<div class="main">
			Identificador: <?php echo $item_pedidosventa_ERP['Id']; ?><br/>
			Cantidad de productos: <?php echo $item_pedidosventa_ERP['TotalItems']; ?><br/>
			Importe total: <?php echo $item_pedidosventa_ERP['Total']; ?><br/>
			Estado: <?php echo $item_pedidosventa_ERP['Estado']; ?>
		</div>
		<p><a href="<?php echo site_url('pedidosventa_ERP_by_id/'.$item_pedidosventa_ERP['Id']); ?>">Ver Pedido</a></p>
		<p><a href="<?php echo site_url('pedidosventa_ERP/'.$item_pedidosventa_ERP['Id']); ?>">Solicitar nuevo pedido en base al presente</a></p>

	<?php endforeach; ?>
<?php endif; ?>