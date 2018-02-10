<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include_once "Database.php";
require_once "mercadopago.php";

class Productos
{
    public function listar()
    {
        $db=new database();
        $db->conectar();
				
        $consulta="SELECT *		
			       FROM Productos;";

        $resultado=mysqli_query($db->conexion, $consulta)
        or die ("No se pueden mostrar los productos.");

        $productos = array(array("sku", "titulo", "stock", "precio", "rubro", "marca", "tipo", "modelo", "talle", "destacado", "publicado", "img", "img2", "img3"));
        $i=0;
        while($producto = mysqli_fetch_assoc($resultado))
        {
            //Elimino los 0 a la izquierda del sku.
            $sku=ltrim($producto["sku"],"0");
            $productos[$i]["sku"]=$sku;
            $productos[$i]["titulo"]=$producto["titulo"];
            $productos[$i]["stock"]=$producto["stock"];
            $productos[$i]["precio"]=$producto["precio"];
            $productos[$i]["rubro"]=$producto["rubro"];
            $productos[$i]["marca"]=$producto["marca"];
            $productos[$i]["tipo"]=$producto["tipo"];
            $productos[$i]["modelo"]=$producto["modelo"];
            $productos[$i]["talle"]=$producto["talle"];
            $productos[$i]["destacado"]=$producto["destacado"];
            $productos[$i]["publicado"]=$producto["publicado"];
            $productos[$i]["img"]=$producto["img"];
            $productos[$i]["img2"]=$producto["img2"];
            $productos[$i]["img3"]=$producto["img3"];
            $i++;
        }
        return $productos;
    }


    public function listar_cat($categoria)
    {
        $db=new database();
        $db->conectar();

        if($categoria=="accesorios")
        {
            $consulta="SELECT DISTINCT *
                       FROM Productos
                       WHERE rubro = '$categoria'
                       OR rubro = 'Calzado'
                       AND publicado = true
                       GROUP BY titulo;";
        }
        else
            {
                $consulta="SELECT DISTINCT *
                           FROM Productos
                           WHERE rubro = '$categoria'
                           AND publicado = true
                           GROUP BY titulo;";
            }

        $resultado=mysqli_query($db->conexion, $consulta)
        or die ("No se pueden mostrar los productos por categoria.");

        $productos = array(array("sku", "titulo", "stock", "precio", "rubro", "marca", "tipo", "modelo", "talle", "destacado", "publicado", "img"));
        $i=0;
        while($producto = mysqli_fetch_assoc($resultado))
        {
            //Elimino los 0 a la izquierda del sku.
            $sku=ltrim($producto["sku"],"0");
            $productos[$i]["sku"]=$sku;
            $productos[$i]["titulo"]=$producto["titulo"];
            $productos[$i]["stock"]=$producto["stock"];

            if($producto["rubro"]=="Motos")
            {
                $productos[$i]["precio"]="Consultar";
            }
            else
                {
                    $productos[$i]["precio"]=round($producto["precio"], 0, PHP_ROUND_HALF_UP);
                }

            $productos[$i]["rubro"]=$producto["rubro"];
            $productos[$i]["marca"]=$producto["marca"];
            $productos[$i]["tipo"]=$producto["tipo"];
            $productos[$i]["modelo"]=$producto["modelo"];
            $productos[$i]["talle"]=$producto["talle"];
            $productos[$i]["destacado"]=$producto["destacado"];
            $productos[$i]["publicado"]=$producto["publicado"];
            $productos[$i]["img"]=$producto["img"];
            $i++;
        }
        return $productos;
    }


    //Busca las marcas de una categoria
    public function filtrar_marcas($categoria)
    {
        $db=new database();
        $db->conectar();

        $consulta="SELECT DISTINCT marca
			       FROM Productos
			       WHERE rubro = '$categoria';";
        $resultado=mysqli_query($db->conexion, $consulta)
        or die ("No se pudo armar los filtros de marca por categoria.");

        if(mysqli_num_rows($resultado)==0)
        {
            $mensaje=false;
            return $mensaje;
        }
        else{
                $i = 0;
                while ($producto = mysqli_fetch_assoc($resultado))
                {
                    $marcas[$i]["nombre"] = $producto["marca"];
                    $i++;
                }
                return $marcas;
            }
    }

    //Busca los modelos de una categoria
    public function filtrar_modelos($categoria)
    {
        $db=new database();
        $db->conectar();

        $consulta="SELECT DISTINCT modelo
			       FROM Productos
			       WHERE rubro = '$categoria';";
        $resultado=mysqli_query($db->conexion, $consulta)
        or die ("No se pudo armar los filtros de modelo por categoria.");

        if(mysqli_num_rows($resultado)==0)
        {
            $mensaje=false;
            return $mensaje;
        }
        else{
                $i=0;
                while($producto = mysqli_fetch_assoc($resultado))
                {
                    $modelos[$i]["nombre"]=$producto["modelo"];
                    $i++;
                }
                return $modelos;
            }
    }

    //Busca los tipos de una categoria
    public function filtrar_tipos($categoria)
    {
        $db=new database();
        $db->conectar();

        $consulta="SELECT DISTINCT tipo
			       FROM Productos
			       WHERE rubro = '$categoria';";
        $resultado=mysqli_query($db->conexion, $consulta)
        or die ("No se pudo armar los filtros de tipo por categoria.");

        if(mysqli_num_rows($resultado)==0)
        {
            $mensaje=false;
            return $mensaje;
        }
        else{
            $i=0;
            while($producto = mysqli_fetch_assoc($resultado))
            {
                $tipos[$i]["nombre"]=$producto["tipo"];
                $i++;
            }
            return $tipos;
        }
    }


    //Busca los productos de acuerdo a los filtros elegidos
    public function filtrar($filtrado)
    {
        $db=new database();
        $db->conectar();

        if(isset($filtrado["sku"]))
        {
            $consulta='SELECT *
                       FROM Productos
                       WHERE sku = "'.$filtrado["sku"].'";';
        }

        if(isset($filtrado["marca"]))
        {
            $consulta='SELECT *
                       FROM Productos
                       WHERE rubro = "'.$filtrado["rubro"].'"
                       AND marca = "'.$filtrado["marca"].'"
                       AND publicado = true
                       GROUP BY titulo;;';
        }

        if(isset($filtrado["tipo"]))
        {
            $consulta='SELECT *
                       FROM Productos
                       WHERE rubro = "'.$filtrado["rubro"].'"                     
                       AND tipo LIKE "%'.$filtrado["tipo"].'%"
                       AND publicado = true
                       GROUP BY titulo;;';
        }

        if(isset($filtrado["modelo"]))
        {
            $consulta='SELECT *
                       FROM Productos
                       WHERE rubro = "'.$filtrado["rubro"].'"                     
                       AND modelo = "'.$filtrado["modelo"].'"
                       AND publicado = true
                       GROUP BY titulo;;';
        }

        //La consulta busca el texto ingresado en el buscador del home.
        if(isset($filtrado["buscado"]))
        {
            $consulta='SELECT *
                       FROM Productos
                       WHERE rubro LIKE "%'.$filtrado["buscado"].'%"
                       OR marca LIKE "%'.$filtrado["buscado"].'%"
                       OR modelo LIKE "%'.$filtrado["buscado"].'%"
                       OR tipo LIKE "%'.$filtrado["buscado"].'%"
                       OR titulo LIKE "%'.$filtrado["buscado"].'%"
                       AND publicado = true
                       GROUP BY titulo;;';
        }

        //echo $consulta;
        $resultado=mysqli_query($db->conexion, $consulta)
        or die ("No se puede filtrar.");

        $productos = array(array("sku", "titulo", "stock", "precio", "rubro", "marca", "tipo", "modelo", "talle", "destacado", "publicado", "img"));

        if(mysqli_num_rows($resultado)==0)
        {
            $mensaje=false;
            return $mensaje;
        }
        else{
            $i=0;
            while($producto = mysqli_fetch_assoc($resultado))
            {
                //Elimino los 0 a la izquierda del sku.
                $sku=ltrim($producto["sku"],"0");
                $productos[$i]["sku"]=$sku;
                //$productos[$i]["sku"]=$producto["sku"];
                $productos[$i]["titulo"]=$producto["titulo"];
                $productos[$i]["stock"]=$producto["stock"];

                if($producto["rubro"]=="Motos")
                {
                    $productos[$i]["precio"]="Consultar";
                }
                else
                    {
                    $productos[$i]["precio"]=round($producto["precio"], 0, PHP_ROUND_HALF_UP);
                    }

                $productos[$i]["rubro"]=$producto["rubro"];
                $productos[$i]["marca"]=$producto["marca"];
                $productos[$i]["tipo"]=$producto["tipo"];
                $productos[$i]["modelo"]=$producto["modelo"];
                $productos[$i]["talle"]=$producto["talle"];
                $productos[$i]["destacado"]=$producto["destacado"];
                $productos[$i]["publicado"]=$producto["publicado"];
                $productos[$i]["img"]=$producto["img"];
                $i++;
            }
            return $productos;
            }

    }


    public function destacados()
    {
        $db=new database();
        $db->conectar();
		
        $consulta="SELECT *
			       FROM Productos
			       WHERE destacado=1
			       GROUP BY titulo;";

        $resultado=mysqli_query($db->conexion, $consulta)
        or die ("No se pueden mostrar los productos destacados.");

        $productos = array(array("sku", "titulo", "stock", "precio", "rubro", "marca", "tipo", "destacado", "img"));
        $i=0;
		
		if(mysqli_num_rows($resultado)!=0)
		{
			while($producto = mysqli_fetch_assoc($resultado))
			{
				$productos[$i]["sku"]=$producto["sku"];

                $titulo = substr($producto["titulo"], 0, 24);
                $titulo = strtolower($titulo);
                $productos[$i]["titulo"]=ucwords($titulo);
				//$productos[$i]["titulo"]=$producto["titulo"];

				$productos[$i]["stock"]=$producto["stock"];
				$productos[$i]["precio"]=$producto["precio"];
				$productos[$i]["rubro"]=$producto["rubro"];
				$productos[$i]["marca"]=$producto["marca"];
                $productos[$i]["tipo"]=$producto["tipo"];
				$productos[$i]["destacado"]=$producto["destacado"];
				$productos[$i]["img"]=$producto["img"];
				$i++;
			}			
		}
		else{
				$productos[$i]=NULL;				
			}
        
		
        return $productos;
    }


    //Guarda un producto cargado manualmente
    public function guardar($upload_data, $upload_data_2, $upload_data_3, $producto)
    {
        $img=strlen($upload_data["file_name"]);
        $img2=strlen($upload_data_2["file_name"]);
        $img3=strlen($upload_data_3["file_name"]);

        if($img>=50||$img2>=50||$img3>=50)
        {
            $error="El nombre de las imagenes no puede ser superior a 50 caracteres.";
            return $error;
        }
        else
            {
                $destacados=$this->destacados();
                if(count($destacados)>=5)
                {
                    $error="La cantidad de productos destacados no puede ser mayor que 5.";
                    return $error;
                }

                //Borra los 0 a la izquierda
                $sku=ltrim($producto["sku"],"0");
                //echo $upload_data["file_name"];
                $db=new database();
                $db->conectar();

                $consulta = 'INSERT INTO Productos (sku,
                                            titulo,
                                            stock,
                                            precio,
                                            rubro,
                                            marca,
                                            tipo,
                                            modelo,
                                            talle,
                                            destacado,
                                            publicado,
                                            img,
                                            img2,
                                            img3)
                     VALUES("' . $sku . '",
                            "' . $producto["titulo"] . '",
                            "' . $producto["stock"] . '",
                            "' . $producto["precio"] . '",
                            "' . $producto["rubro"] . '",
                            "' . $producto["marca"] . '",
                            "' . $producto["tipo"] . '",
                            "' . $producto["modelo"] . '",
                            "' . $producto["talle"] . '",
                            "' . $producto["destacado"] . '",
                            "' . $producto["publicado"] . '",
                            "' . $upload_data["file_name"] . '",
                            "' . $upload_data_2["file_name"] . '",
                            "' . $upload_data_3["file_name"] . '")';

                if (!mysqli_query($db->conexion, $consulta))
                {
                    //echo $consulta;
                    echo("Error description: " . mysqli_error($db->conexion));
                    echo '<br>';
                    $resultado=mysqli_query($db->conexion, $consulta) or die ("No se pudo guardar el producto, el sku ingresado ya existe.");
                }
            }
    }


    public function guardar_archivo($upload_data)
    {
        $db = new database();
        $db->conectar();

        if (($fichero = fopen("uploads/".$upload_data["file_name"]."", "r")) !== FALSE)
        {
            while (($datos = fgetcsv($fichero, 1000)) !== FALSE)
            {
                $consulta = 'INSERT INTO Productos (sku,
                                                    titulo,
                                                    stock,
                                                    precio,
                                                    rubro,
                                                    marca,
                                                    tipo,
                                                    modelo,
                                                    talle,
                                                    destacado,
                                                    publicado,
                                                    img)
                             VALUES("' . $datos["0"] . '",
                                    "' . $datos["1"] . '",
                                    "' . $datos["2"] . '",
                                    "' . $datos["3"] . '",
                                    "' . $datos["4"] . '",
                                    "' . $datos["5"] . '",
                                    "' . $datos["6"] . '",
                                    "' . $datos["7"] . '",
                                    "' . $datos["8"] . '",
                                    "' . $datos["9"] . '",
                                    "' . $datos["10"] . '",
                                    "' . $upload_data["file_name"] . '")';
                $resultado = mysqli_query($db->conexion, $consulta) or die ("No se pueden guardar los productos.");
            }
        }
    }


    public function actualizar($productos)
    {
        $db=new database();
        $db->conectar();

        foreach($productos as $producto)
        {
            $consulta='UPDATE Productos 
                       SET  titulo = "'.$producto['titulo'].'",
                            stock = "'.$producto['stock'].'",
                            precio = "'.$producto['precio'].'",
                            rubro = "'.$producto['rubro'].'",
                            marca = "'.$producto['marca'].'",
                            tipo = "'.$producto['tipo'].'",
                            modelo = "' . $producto["modelo"] . '",
                            talle = "' . $producto["talle"] . '",
                            publicado = "' . $producto["publicado"] . '",
                            destacado = "'.$producto['destacado'].'",
                            img="'.$producto['img'].'",
                            img2="'.$producto['img2'].'",
                            img3="'.$producto['img3'].'"
                       WHERE sku = "'.$producto['sku'].'";';
            $resultado=mysqli_query($db->conexion, $consulta)
            or die ("No se pudo actualizar los productos.");
           
            //$productos['idPlan']=mysqli_insert_id($db->conexion);
        }

        //return $productos;
    }


    public function buscar_sku($sku)
    {
        $db=new database();
        $db->conectar();

        $consulta='SELECT *
                   FROM Productos
                   WHERE sku = "'.$sku.'";';

        //echo $consulta;
        $resultado=mysqli_query($db->conexion, $consulta)
        or die ("No se pudo encontrar el articulo por sku.");

        $producto = array("sku", "titulo", "stock", "precio", "rubro", "marca", "tipo", "modelo", "talles", "destacado", "publicado", "img", "img2", "img3");

        while($encontrado = mysqli_fetch_assoc($resultado))
        {
            $producto["sku"]=$encontrado["sku"];
            $producto["titulo"]=$encontrado["titulo"];
            $producto["stock"]=$encontrado["stock"];

            if($encontrado["rubro"]=="Motos")
            {
                $producto["precio"]="Consultar";
            }
            else
                {
                    $producto["precio"]=round($encontrado["precio"], 0, PHP_ROUND_HALF_UP);
                }

            $producto["rubro"]=$encontrado["rubro"];
            $producto["marca"]=$encontrado["marca"];
            $producto["tipo"]=$encontrado["tipo"];
            $producto["modelo"]=$encontrado["modelo"];
            $producto["talles"]=$encontrado["talle"];
            $producto["destacado"]=$encontrado["destacado"];
            $producto["publicado"]=$encontrado["publicado"];
            $producto["img"]=$encontrado["img"];
            $producto["img2"]=$encontrado["img2"];
            $producto["img3"]=$encontrado["img3"];
        }


        $consultar_talles='SELECT * 
                           FROM Productos
                           WHERE titulo="'.$producto["titulo"].'"';

        $resultado_talles=mysqli_query($db->conexion, $consultar_talles)
        or die ("No se encontraron los talles.");
        //Cantidad de productos con mismo titulo para obtener los talles existentes
        $cantidad_talles=mysqli_num_rows($resultado_talles);
        //Creacion de array talles
        $talles=array($cantidad_talles);
        $i=0;
        //Carga el array con los talles encontrados
        while($encontrado = mysqli_fetch_assoc($resultado_talles))
        {
            if($encontrado["stock"]>0&&$encontrado["publicado"]==1)
            {
                $talles[$i]=$encontrado["talle"];
            }
            $i++;
        }

        $producto["talles"]=$talles;

        return $producto;
    }


    public function exportar()
    {
        $productos = $this->listar();

        //$file = fopen("productos.csv","w");
        $file = fopen("php://output","w");

        foreach ($productos as $producto)
        {
            //fputcsv($file,explode(',',$producto["titulo"]));
            fputcsv($file, $producto);
        }

        fclose($file);
    }
}
?>