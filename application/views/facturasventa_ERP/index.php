
<?php if (!empty($lista_facturasventa_ERP)): ?>
	<?php foreach ($lista_facturasventa_ERP as $item_facturasventa_ERP): ?>
		<?php //echo var_dump($item_facturasventa_ERP);?>
		<div class="main">
			Identificador: <?php echo $item_facturasventa_ERP['Id']; ?><br/>
			Cantidad de productos: <?php echo $item_facturasventa_ERP['TotalItems']; ?><br/>
			Importe total: <?php echo $item_facturasventa_ERP['Total']; ?><br/>
			Estado: <?php echo $item_facturasventa_ERP['Estado']; ?>
		</div>
		<p><a href="<?php echo site_url('facturasventa_ERP/'.$item_facturasventa_ERP['Id']); ?>">Ver detalle de Pedido</a></p>
<?php endforeach; ?>
<?php endif ?>
