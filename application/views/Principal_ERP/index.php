

<?php foreach ($lista_empresas_ERP as $item_empresas_ERP): ?>
	<?php //echo var_dump($item_empresas_ERP);?>
	<div class="main">
		Id. de Empresa: <?php echo $item_empresas_ERP['Id']; ?><br/>
		Clave: <?php echo $item_empresas_ERP['Clave']; ?><br/>
		CUIT: <?php echo $item_empresas_ERP['Cuit']; ?><br/>
		Nombre de Empresa: <?php echo $item_empresas_ERP['Nombre']; ?><br/>
	</div>
	<p><a href="<?php echo site_url('Principal_ERP/'.$item_empresas_ERP['Id']); ?>">Ver detalle de empresa</a></p>

<?php endforeach; ?>