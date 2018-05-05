
<h2>Pedido: <?php echo $pedido_cabecera_item['id_pedido'];?></h2>
Cliente: <?php echo $pedido_cabecera_item['EmpresaId_Empresa_ERP'];?><br>
Fecha de creación: <?php echo $pedido_cabecera_item['fec_creacion'];?><br>

<?php foreach ($pedido_linea_lista as $pedido_linea_item): ?>
	<?php //echo var_dump($pedido_linea_item);?>
	<div class="main">
		Renglón: <?php echo $pedido_linea_item['Renglon']; ?><br/>
		Cód. producto: <?php echo $pedido_linea_item['ArticuloId']; ?><br/>
		SKU: <?php echo $pedido_linea_item['SKU']; ?><br/>
		cantidad: <?php echo $pedido_linea_item['Cantidad']; ?><br/>
		precio unitario: <?php echo $pedido_linea_item['Precio_unitario']; ?><br/>
	</div>
<?php endforeach; ?>

<br>