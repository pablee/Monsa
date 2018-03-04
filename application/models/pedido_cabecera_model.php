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

        $query = $this->db->get_where('pedido_cabecera', array('id_pedido' => $id_pedido));
        return $query->row_array();
	}
	
	public function set_pedidos()
	{
		$this->load->helper('url');

		$data = array(
			'id_pedido' => $this->input->post('id_pedido'),
			'cod_cliente' => $this->input->post('cod_cliente'),
			'fec_creacion' => $this->input->post('fec_creacion')
		);

		return $this->db->insert('pedido_cabecera', $data);
	}
}