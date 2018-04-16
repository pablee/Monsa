<?php
class empresas_ERP_model extends CI_Model 
{
	
	public function __construct()
	{
		$this->load->database('ERP');
	}
		
	public function get_by_id($id = FALSE)
	{
        if ($id === FALSE)
        {
			$query = $this->db->get('empresas');
			return $query->result_array();
		}
		
		$query = $this->db->get_where('empresas', array('Id' => $id));
		//echo $this->db->get_compiled_select();
		return $query->row_array();
	}
	
}