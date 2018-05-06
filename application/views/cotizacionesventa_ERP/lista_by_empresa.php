<h3> Cotizaciones de la Empresa </h3>
<?php if (!empty($lista_cotizacionesventa_ERP)): ?>
	<?php foreach ($lista_cotizacionesventa_ERP as $item_cotizacionesventa_ERP): ?>
		<?php //echo var_dump($item_cotizacionesventa_ERP);?>
		<div class="main">
			Id. Cotización: <?php echo $item_cotizacionesventa_ERP['Id']; ?><br/>
			Cant. de prod.: <?php echo $item_cotizacionesventa_ERP['TotalItems']; ?><br/>
			Importe total: <?php echo $item_cotizacionesventa_ERP['Total']; ?><br/>
			Estado: <?php echo $item_cotizacionesventa_ERP['Estado']; ?>
		</div>
		<p><a href="<?php echo site_url('cotizacionesventa_ERP/'.$item_cotizacionesventa_ERP['Id']); ?>">Ver cotización</a></p>

	<?php endforeach; ?>
<?php endif; ?>