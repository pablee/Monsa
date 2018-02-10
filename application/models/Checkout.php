<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once "mercadopago.php";

class Checkout
{
    public function preference($data)
    {
        $mp = new MP('1244831999709490', 'II4OhgaoXwLaEBH8iEXJZ6Rrt1HXMG14');
        $preference_data = array(
                                "items" => array(
                                                array(
                                                    "title" => $data['titulo'],
                                                    "quantity" => 1,
                                                    "currency_id" => "ARS", // Available currencies at: https://api.mercadopago.com/currencies
                                                    "unit_price" => 10.00
                                                    )
                                                )
                                );

        $preference = $mp->create_preference($preference_data);

        return $preference;
    }
}