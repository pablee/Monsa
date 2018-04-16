
	<?php foreach ($lista_facturaventaitems_ERP as $item_facturaventaitems_ERP): ?>
		<?php //echo var_dump($item_facturaventaitems_ERP);?>
		<div class="main">
			Renglón: <?php echo $item_facturaventaitems_ERP['Id']; ?><br/>
			Cód. producto: <?php echo $item_facturaventaitems_ERP['ArticuloId']; ?><br/>
			cantidad: <?php echo $item_facturaventaitems_ERP['Cantidad']; ?><br/>
			importe: <?php echo $item_facturaventaitems_ERP['Importe']; ?><br/><br/>
		</div>
	<?php endforeach; ?>