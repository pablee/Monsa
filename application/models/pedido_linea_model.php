<?php
class pedido_linea_model extends CI_Model 
{

	public function __construct()
	{
		$this->load->database();
	}
		
	public function get_pedido_lineas($id_pedido = FALSE)
	{
        if ($id_pedido != FALSE)
        {
			$query = $this->db->get_where('pedido_linea', array('id_pedido' => $id_pedido));//select * from pedido_linea where id_pedido = $id_pedido;
			return $query->result_array();
		}
	}
	
	public function set_pedido_linea()
	{
		//realmente no recuerdo bien para que sirve ésta línea
		$this->load->helper('url');
		
		//buscar el último número de renglon existente en las líneas de pedidos
		
		//insertar el nuevo renglon solicitado en el pedido
		$data = array(
			'id_pedido' => $this->input->post('id_pedido'),
			'cod_producto' => $this->input->post('cod_producto'),
			'renglon' => $this->input->post('renglon'),
			'sku' => $this->input->post('sku'),
			'cantidad' => $this->input->post('cantidad'),
			'precio_unitario' => $this->input->post('precio_unitario'),
			'precio_total' => $this->input->post('precio_unitario') * $this->input->post('cantidad'),
			'usr_ult_modif' => 'admin',
			'fec_ult_modif'=> getdate()
		);

		return $this->db->insert('pedido_cabecera', $data);
	}
	
	public function set_pedidos_lineas_sin_form($PedidoVentaId, $ArticuloId, $Cantidad)
	{

		$data = array(
			//'id_pedido_linea' => $this->input->post('id_pedido'), // es un autonumérico
			'PedidoVentaId' => $PedidoVentaId,
			'ArticuloId' => $ArticuloId,
			'Cantidad' => $Cantidad
		);

		$result = $this->db->insert('pedido_linea', $data);
		if ($result == true)
		{
			return $this->db->insert_id();
		}
		else
		{
			return $result;
		}
	}
}