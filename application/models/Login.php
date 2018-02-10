<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include_once "Database.php";

class Login
{
    public function validar($data)
    {
        $db = new database();
        $db->conectar();

        $consulta = 'SELECT * FROM Usuario 
                     WHERE mail = "'.$data['usuario'].'" 
                     AND password = "'.$data['password'].'";';
        $resultado = mysqli_query($db->conexion, $consulta) or die ("Fallo la consulta, no se puede validar el usuario");
        $datos = mysqli_fetch_assoc($resultado);

        if (1 == mysqli_num_rows($resultado))
        {
            if ($data['recordar'] == "1")
            {
                //setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day
                setcookie("usuario", $data['usuario'], time() + (86400 * 30), "/"); // 86400 = 1 day
                setcookie("password", $data['password'], time() + (86400 * 30), "/"); // 86400 = 1 day
            }
            else
                {
                    //set the expiration date to one hour ago
                    setcookie("usuario", "", time() - 3600, "/");
                    setcookie("password", "", time() - 3600, "/");
                }

            $validacion=1;
            /*header("location: ../home.php");*/

        }
        else{
            $validacion=0;
            /*header("location: ../index.php");*/
        }

        return $validacion;
    }

}