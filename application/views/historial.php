<?php

foreach($pedidos as $pedido)
{
    echo
        '	
	<tr>	   		
		<td>'.$pedido["id"].'</td>
		<td>'.$pedido["sku"].'</td>
		<td>'.$pedido["cantidad"].'</td>
		<td>'.$pedido["fecha"].'</td>
		<td><a href="detalle?id='.$pedido["id"].'">Elegir pedido</a></td>
	</tr>
	';
}

?>