
	<?php foreach ($lista_cotizacionesventaarticulos_ERP as $item_cotizacionesventaarticulos_ERP): ?>
		<?php //echo var_dump($item_cotizacionesventaarticulos_ERP);?>
		<div class="main">
			Renglón: <?php echo $item_cotizacionesventaarticulos_ERP['Id']; ?><br/>
			Cód. producto: <?php echo $item_cotizacionesventaarticulos_ERP['ArticuloId']; ?><br/>
			cantidad: <?php echo $item_cotizacionesventaarticulos_ERP['Cantidad']; ?><br/>
			importe: <?php echo $item_cotizacionesventaarticulos_ERP['Importe']; ?><br/><br/>
		</div>
	<?php endforeach; ?>