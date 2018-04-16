<?php
class pedidosventaarticulos_ERP_model extends CI_Model 
{	
	public function __construct()
	{		
		$this->load->database('ERP');
	}
		
	public function get_by_id($id = FALSE)
	{
        if ($id === FALSE)
        {
			$query = $this->db->get('pedidosventaarticulos');
			return $query->result_array();
		}
		
		$query = $this->db->get_where('pedidosventaarticulos', array('id' => $id));
		//echo $this->db->get_compiled_select();
		return $query->result_array();
	}
	
	public function get_by_cabecera($id = FALSE)
	{
		if (!$id === FALSE)
		{		
			$query = $this->db->get_where('pedidosventaarticulos', array('PedidoVentaId' => $id));
			//echo $this->db->get_compiled_select();
			return $query->result_array();
		}
	}
}