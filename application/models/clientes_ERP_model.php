<?php
class clientes_ERP_model extends CI_Model 
{
	
	public function __construct()
	{
		$this->load->database('ERP');
	}
		
	public function get_clientes_ERP($Id = FALSE)
	{
        if ($Id === FALSE)
        {
			$query = $this->db->get('clientes');
			return $query->result_array();
		}
		
		$query = $this->db->get_where('clientes', array('Id' => $Id));
		//echo $this->db->get_compiled_select();
		return $query->row_array();
	}
	
}