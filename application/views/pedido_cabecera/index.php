

<?php foreach ($lista_pedido_cabecera as $pedido_cabecera_item): ?>
	<?php //echo var_dump($pedido_cabecera_item);?>
	<div class="main">
		Pedido nro.: <?php echo $pedido_cabecera_item['id_pedido']; ?><br/>
		Identificador de Empresa: <?php echo $pedido_cabecera_item['EmpresaId_Empresa_ERP']; ?><br/>
		Clave del Cliente: <?php echo $pedido_cabecera_item['Clave_Cliente_ERP']; ?><br/>
		Fecha de creación: <?php echo $pedido_cabecera_item['fec_creacion']; ?><br/>
		Identificador de estado: <?php echo $pedido_cabecera_item['id_estado']; ?><br/>
	</div>
	<p><a href="<?php echo site_url('pedido_cabecera/'.$pedido_cabecera_item['id_pedido']); ?>">Ver Pedido</a></p>

<?php endforeach; ?>