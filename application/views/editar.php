<?php

echo '<form name="grilla" method="POST" action="actualizar"';

foreach ($productos as $producto)
{
    if($producto["destacado"]==0)
    {
        $destacado="<option value=\"1\"> No </option>";
    }
    else{
        $destacado="<option value=\"1\"> Si </option>";
        }

    if($producto["publicado"]==0)
    {
        $publicado="<option value=\"1\"> No </option>";
    }
    else{
        $publicado="<option value=\"1\"> Si </option>";
    }

    echo
    '	
    <tr>	  
        <td>
            <input type="text" class="form-control" id="" name="grilla['.$sku=ltrim($producto["sku"],"0").'][sku]" value="'.$sku=ltrim($producto["sku"],"0").'" required></input>
        </td>
    
        <td>	
            <input type="text"   class="form-control" id="" name="grilla['.$sku=ltrim($producto["sku"],"0").'][titulo]" value="'.$producto["titulo"].'" onchange="campoModificado('.$sku=ltrim($producto["sku"],"0").')"></input>
        </td>
    
        <td style="width: 80px;">
            <input type="text"   class="form-control" id="" name="grilla['.$sku=ltrim($producto["sku"],"0").'][stock]" value="'.$producto["stock"].'" onchange="campoModificado('.$sku=ltrim($producto["sku"],"0").')"></input>
        </td>
    
        <td class="col-xs-1">
            <input type="text"   class="form-control" id="" name="grilla['.$sku=ltrim($producto["sku"],"0").'][precio]" value="'.$producto["precio"].'" onchange="campoModificado('.$sku=ltrim($producto["sku"],"0").')"></input>
        </td>
    
        <td>
            <!--input type="text"   class="form-control" id="" name="grilla['.$sku=ltrim($producto["sku"],"0").'][rubro]" value="'.$producto["rubro"].'" onchange="campoModificado('.$sku=ltrim($producto["sku"],"0").')"></input-->
            <select class="form-control" id="" name="grilla['.$sku=ltrim($producto["sku"],"0").'][rubro]" onchange="campoModificado('.$sku=ltrim($producto["sku"],"0").')">
    
                <option value="'.$producto["rubro"].'">'.$producto["rubro"].'</option>';
                foreach($rubros AS $rubro)
                    {
                    echo '<option value="'.$rubro.'"> '.$rubro.' </option>';
                    }
    echo'         
            </select>
    
        </td>
    
        <td>		
            <!--input type="text"   class="form-control" id="" name="grilla['.$sku=ltrim($producto["sku"],"0").'][marca]" value="'.$producto["marca"].'" onchange="campoModificado('.$sku=ltrim($producto["sku"],"0").')"></input-->
            <select class="form-control" id="" name="grilla['.$sku=ltrim($producto["sku"],"0").'][marca]" onchange="campoModificado('.$sku=ltrim($producto["sku"],"0").')">    
                <option value="'.$producto["marca"].'">'.$producto["marca"].'</option>';
                foreach($marcas AS $marca)
                    {
                    echo '<option value="'.$marca.'"> '.$marca.' </option>';
                    }
    echo'         
            </select>                
        </td>

        <td>
            <select class="form-control" id="" name="grilla['.$sku=ltrim($producto["sku"],"0").'][tipo]" onchange="campoModificado('.$sku=ltrim($producto["sku"],"0").')">
                <option value="'.$producto["tipo"].'">'.$producto["tipo"].'</option>';
                foreach($tipos AS $tipo)
                {
                    echo '<option value="'.$tipo.'"> '.$tipo.' </option>';
                }
    echo'         
            </select>                
        </td>

        <td>
            <input type="text"   class="form-control" id="" name="grilla['.$sku=ltrim($producto["sku"],"0").'][modelo]" value="'.$producto["modelo"].'" onchange="campoModificado('.$sku=ltrim($producto["sku"],"0").')"></input>
        </td>

        <td style="width: 70px;">
            <input type="text"   class="form-control" id="" name="grilla['.$sku=ltrim($producto["sku"],"0").'][talle]" value="'.$producto["talle"].'" onchange="campoModificado('.$sku=ltrim($producto["sku"],"0").')"></input>
        </td>

        <td>	    
            <select class="form-control" id="" name="grilla['.$sku=ltrim($producto["sku"],"0").'][destacado]" onchange="campoModificado('.$sku=ltrim($producto["sku"],"0").')">
                '.$destacado.'
                <option value="1"> Si </option>
                <option value="0"> No </option>
            </select>
        </td>    

        <td>
            <select class="form-control" id="" name="grilla['.$sku=ltrim($producto["sku"],"0").'][publicado]" onchange="campoModificado('.$sku=ltrim($producto["sku"],"0").')">
                '.$publicado.'
                <option value="1"> Si </option>
                <option value="0"> No </option>
            </select>
        </td>

        <td>
            <input type="text"   class="form-control" id="" name="grilla['.$sku=ltrim($producto["sku"],"0").'][img]" value="'.$producto["img"].'" onchange="campoModificado('.$sku=ltrim($producto["sku"],"0").')"></input>
        </td>
        
        <td>
            <input type="text"   class="form-control" id="" name="grilla['.$sku=ltrim($producto["sku"],"0").'][img2]" value="'.$producto["img2"].'" onchange="campoModificado('.$sku=ltrim($producto["sku"],"0").')"></input>
        </td>

        <td>
            <input type="text"   class="form-control" id="" name="grilla['.$sku=ltrim($producto["sku"],"0").'][img3]" value="'.$producto["img3"].'" onchange="campoModificado('.$sku=ltrim($producto["sku"],"0").')"></input>
        </td>




        <td><input type="hidden" class="form-control" id="modificado-'.$sku=ltrim($producto["sku"],"0").'" name="grilla['.$sku=ltrim($producto["sku"],"0").'][modificado]" value="0"></input></td>
    ';
}

echo '<button type="submit" class="btn btn-primary">Guardar</button>';
echo '</form>';

?>