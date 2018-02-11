<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include_once "Database.php";

class Pedido
{
    public function listar($user_id)
    {
        $db=new database();
        $db->conectar();

        $consulta="SELECT *		
			       FROM Pedido
			       WHERE user_id = ".$user_id.";";

        $resultado=mysqli_query($db->conexion, $consulta)
        or die ("No se pueden mostrar los pedidos.");

        $pedidos = array(array("id", "user_id", "sku", "cantidad", "fecha"));
        $i=0;
        while($datos = mysqli_fetch_assoc($resultado))
        {
            $pedidos[$i]["id"]=$datos["id"];
            $pedidos[$i]["user_id"]=$datos["user_id"];
            $pedidos[$i]["sku"]=$datos["sku"];
            $pedidos[$i]["cantidad"]=$datos["cantidad"];
            $pedidos[$i]["fecha"]=$datos["fecha"];
            $i++;
        }
        return $pedidos;
    }


    public function detalle($id)
    {
        $db=new database();
        $db->conectar();

        $consulta="SELECT *
			       FROM Pedido
			       WHERE id = ".$id.";";

        $resultado=mysqli_query($db->conexion, $consulta)
        or die ("No se pueden mostrar los pedidos.");

        $detalles = array(array("id", "user_id", "sku", "cantidad", "fecha"));

        $i=0;
        while($datos = mysqli_fetch_assoc($resultado))
        {
            $detalles[$i]["id"]=$datos["id"];
            $detalles[$i]["user_id"]=$datos["user_id"];
            $detalles[$i]["sku"]=$datos["sku"];
            $detalles[$i]["cantidad"]=$datos["cantidad"];
            $detalles[$i]["fecha"]=$datos["fecha"];
            $i++;
        }
        return $detalles;
    }


    public function guardar($data)
    {
        $db=new database();
        $db->conectar();

        $fecha=date("Y-m-d");
        $cantidad=1;

        $consulta = 'INSERT INTO Pedido (sku,
                                         cantidad,
                                         fecha)
                     VALUES("' . $data["sku"] . '",
                            "' . $cantidad . '",
                            "' . $fecha . '");';

        $resultado=mysqli_query($db->conexion, $consulta)
        or die ("No se pudo guardar el pedido.");
    }

    //Exporta un archivo csv en la carpeta de descargas del usuario
    public function exportar()
    {
        $pedidos = $this->listar();

        //$file = fopen("productos.csv","w");
        $file = fopen("php://output","w");

        foreach ($pedidos as $pedido)
        {
            //fputcsv($file,explode(',',$producto["titulo"]));
            fputcsv($file, $pedido);
        }

        fclose($file);
    }

    //Exporta un archivo csv en la carpeta raiz de la pagina
    public function exportar_local()
    {
        $pedidos = $this->listar();

        $file = fopen("pedidos.csv","w");

        foreach ($pedidos as $pedido)
        {
            fputcsv($file, $pedido);
        }

        fclose($file);
    }
}
?>