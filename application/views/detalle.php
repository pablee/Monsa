<?php foreach($detalles as $detalle): ?>
	<tr>	   		
		<td><?php echo $detalle["id"] ?></td>
		<td><?php echo $detalle["sku"] ?></td>
		<td><?php echo $detalle["cantidad"] ?></td>
		<td><?php echo $detalle["fecha"] ?></td>
		<td><a href="guardar">Confirmar pedido</a></td>
	</tr>
<?php endforeach; ?>