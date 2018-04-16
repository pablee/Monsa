<?php
class facturasventa_ERP_model extends CI_Model 
{	
	public function __construct()
	{		
		$this->load->database('ERP');
	}
		
	public function get_by_id($id = FALSE)
	{
        if ($id === FALSE)
        {
			$query = $this->db->get('facturasventa');
			return $query->result_array();
		}
		
		$query = $this->db->get_where('facturasventa', array('id' => $id));
		//echo $this->db->get_compiled_select();
		return $query->result_array();
	}
	
	public function get_by_empresa($id = FALSE)
	{
		if ($id === FALSE)
		{
			$query = $this->db->get('facturasventa');
			return $query->result_array();
		}
		
		$query = $this->db->get_where('facturasventa', array('EmpresaId' => $id));
		//echo $this->db->get_compiled_select();
		return $query->result_array();
	}
}