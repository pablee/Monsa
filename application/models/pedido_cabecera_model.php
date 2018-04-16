<?php
class pedido_cabecera_model extends CI_Model 
{

	public function __construct()
	{
		$this->load->database();
	}
		
	public function get_pedidos($id_pedido = FALSE)
	{
        if ($id_pedido === FALSE)
        {
			$query = $this->db->get('pedido_cabecera');
			return $query->result_array();
		}
		
		$query = $this->db->get_where('pedido_cabecera', array('id_pedido' => $id_pedido));//select * from pedido_cabcera where id_pedido = $id_pedido;
		//echo $this->db->get_compiled_select();
		return $query->row_array();
	}
	
	public function get_pedidos_by_cliente($cod_cliente = FALSE)
	{
		if ($cod_cliente === FALSE)
		{
			$query = $this->db->get('pedido_cabecera');
			return $query->result_array();
		}
		
		//$this->db->where('cod_cliente',$cod_cliente);
		//$query = $this->db->get('pedido_cabecera');
		$query = $this->db->get_where('pedido_cabecera', array('cod_cliente' => $cod_cliente));
		//echo $this->db->get_compiled_select();
		return $query->result_array();
	}
	
	public function set_pedidos()
	{
		$this->load->helper('url');

		$data = array(
			//'id_pedido' => $this->input->post('id_pedido'), // es un autonumérico
			'cod_cliente' => $this->input->post('cod_cliente'),
			'fec_creacion' => $this->input->post('fec_creacion')
		);

		return $this->db->insert('pedido_cabecera', $data);
	}
	
	public function set_pedidos_sin_form($cod_cliente, $fec_creacion)
	{

		$data = array(
			//'id_pedido' => $this->input->post('id_pedido'), // es un autonumérico
			'cod_cliente' => $cod_cliente,
			'fec_creacion' => $fec_creacion
		);

		$result = $this->db->insert('pedido_cabecera', $data);
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