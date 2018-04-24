<?php
class clientes_ERP_model extends CI_Model 
{
	private $db_mon;
	
	public function __construct()
	{
		$this->db_mon = $this->load->database('ERP');
	}
		
	public function get_clientes_ERP($Id = FALSE)
	{
        if ($Id === FALSE)
        {
			$query = $this->db_mon->get('clientes');
			return $query->result_array();
		}
		
		$query = $this->db_mon->get_where('clientes', array('Id' => $Id));
		//echo $this->db_mon->get_compiled_select();
		return $query->row_array();
	}
	
}