<?php
class pedido_cabecera_model extends CI_Model 
{
	private $db_ci;

	public function __construct()
	{
		$this->db_ci = $this->load->database('CodeIgniter', TRUE);
	}
		
	public function get_pedidos($id_pedido = FALSE)
	{
        if ($id_pedido === FALSE)
        {
			$query = $this->db_ci->get('pedido_cabecera');
			return $query->result_array();
		}
		
		$query = $this->db_ci->get_where('pedido_cabecera', array('id_pedido' => $id_pedido));//select * from pedido_cabcera where id_pedido = $id_pedido;
		//echo $this->db_ci->get_compiled_select();
		return $query->row_array();
	}
	
	public function get_pedidos_by_cliente($cod_cliente = FALSE)
	{
		if ($cod_cliente === FALSE)
		{
			$query = $this->db_ci->get('pedido_cabecera');
			return $query->result_array();
		}
		
		//$this->db_ci->where('cod_cliente',$cod_cliente);
		//$query = $this->db_ci->get('pedido_cabecera');
		$query = $this->db_ci->get_where('pedido_cabecera', array('EmpresaId_Empresa_ERP' => $cod_cliente));
		//echo $this->db_ci->get_compiled_select();
		return $query->result_array();
	}
	
	public function set_pedidos()
	{
		$this->load->helper('url');

		$data = array(
			//'id_pedido' => $this->input->post('id_pedido'), // es un autonumérico
			'EmpresaId_Empresa_ERP' => $this->input->post('cod_cliente'),
			'Clave_Cliente_ERP' => $this->input->post('cod_cliente'),
			'fec_creacion' => $this->input->post('fec_creacion')
		);

		return $this->db_ci->insert('pedido_cabecera', $data);
	}
	
	public function set_pedidos_sin_form($cod_cliente, $fec_creacion)
	{

		$data = array(
			//'id_pedido' => $this->input->post('id_pedido'), // es un autonumérico
			'EmpresaId_Empresa_ERP' => $cod_cliente,
			'Clave_Cliente_ERP' => $cod_cliente,
			'id_estado' => 1,//Estado inicial. Pedido Temporal.
			'fec_creacion' => $fec_creacion
		);

		$result = $this->db_ci->insert('pedido_cabecera', $data);
		if ($result == true)
		{
			//devuelvo el código de identificador obtenido luego de insertar la cabecera de pedido.
			return $this->db_ci->insert_id();
		}
		else
		{
			return $result;
		}
	}
}