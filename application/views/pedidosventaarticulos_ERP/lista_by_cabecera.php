
	<?php foreach ($lista_pedidosventaarticulos_ERP as $item_pedidosventaarticulos_ERP): ?>
		<?php //echo var_dump($item_pedidosventaarticulos_ERP);?>
		<div class="main">
			Renglón: <?php echo $item_pedidosventaarticulos_ERP['Id']; ?><br/>
			Cód. del producto: <?php echo $item_pedidosventaarticulos_ERP['ArticuloId']; ?><br/>
			Clave del producto: <?php echo $item_pedidosventaarticulos_ERP['ArticuloClave']; ?><br/>
			Nombre del producto: <?php echo $item_pedidosventaarticulos_ERP['ArticuloNombre']; ?><br/>
			cantidad: <?php echo $item_pedidosventaarticulos_ERP['Precio']; ?><br/>
			cantidad: <?php echo $item_pedidosventaarticulos_ERP['Cantidad']; ?><br/>
			importe: <?php echo $item_pedidosventaarticulos_ERP['Importe']; ?><br/><br/>
		</div>
	<?php endforeach; ?>