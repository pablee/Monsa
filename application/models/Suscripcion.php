<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include_once "Database.php";


class Suscripcion
{
    public function listar()
    {
        $db=new database();
        $db->conectar();

        $consulta="SELECT *		
			       FROM Suscripcion;";

        $resultado=mysqli_query($db->conexion, $consulta)
        or die ("No se pueden mostrar los correos.");

        $correos = array(array("id", "correo"));
        $i=0;
        while($datos = mysqli_fetch_assoc($resultado))
        {
            //$correos[$i]["id"]=$datos["id"];
            $correos[$i]["correo"]=$datos["correo"];
            $i++;
        }
        return $correos;
    }


    public function guardar($data)
    {
        $db=new database();
        $db->conectar();
        
        $consulta = 'INSERT INTO Suscripcion (correo)
                     VALUES("' . $data["correo"] . '")';

        $resultado=mysqli_query($db->conexion, $consulta);
        //or die ("No se pudo guardar la suscripcion.");

        if($resultado==false)
        {
            $suscripcion=false;
        }
        else
            {
                $suscripcion=true;
            }

        return $suscripcion;
    }


    public function exportar()
    {
        $suscripciones = $this->listar();

        //$file = fopen("productos.csv","w");
        $file = fopen("php://output","w");

        foreach ($suscripciones as $suscripcion)
        {
            //fputcsv($file,explode(',',$producto["titulo"]));
            fputcsv($file, $suscripcion);
        }

        fclose($file);
    }



}
?>