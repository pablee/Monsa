
<?php if (!empty($lista_empresas_ERP)): ?>
	<?php foreach ($lista_empresas_ERP as $item_empresas_ERP): ?>
		<?php //echo var_dump($item_empresas_ERP);?>
		<div class="main">
			Id: <?php echo $item_empresas_ERP['Id']; ?><br/>
			Clave: <?php echo $item_empresas_ERP['Clave']; ?><br/>
			Nombre: <?php echo $item_empresas_ERP['Nombre']; ?><br/>
			CUIT: <?php echo $item_empresas_ERP['Cuit']; ?>
		</div>
		<p><a href="<?php echo site_url('cotizacionesventa_ERP/'.$item_empresas_ERP['Id']); ?>">Ver detalle de Cotización</a></p>
<?php endforeach; ?>
<?php endif ?>
