<?php

foreach($productos as $producto)
{
    if($producto["destacado"]==0)
    {
        $destacado="No";
    }
    else{
        $destacado="Si";
        }

	if($producto["publicado"]==0)
	{
		$publicado="No";
	}
	else{
		$publicado="Si";
	}
    echo
        '	
	<tr>	   		
		<td>'.$producto["sku"].'</td>
		<td>'.$producto["titulo"].'</td>
		<td>'.$producto["stock"].'</td>		
		<td>'.$producto["precio"].'</td>
		<td>'.$producto["rubro"].'</td>
		<td>'.$producto["marca"].'</td>
		<td>'.$producto["tipo"].'</td>
		<td>'.$producto["modelo"].'</td>
		<td>'.$producto["talle"].'</td>
		<td>'.$destacado.'</td>
		<td>'.$publicado.'</td>
		<td>'.$producto["img"].'</td>
		<td>'.$producto["img2"].'</td>
		<td>'.$producto["img3"].'</td>
	</tr>
	';
}

?>