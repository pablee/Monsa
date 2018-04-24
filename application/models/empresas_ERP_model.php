<?php
class empresas_ERP_model extends CI_Model 
{
	private $db_mon;
	
	public function __construct()
	{
		$this->db_mon = $this->load->database('SQL_2008',TRUE);
	}
		
	public function get_by_id($id = FALSE)
	{
        if ($id === FALSE)
        {
			$query = $this->db_mon->get('Empresas');
			return $query->result_array();
		}
		
		$query = $this->db_mon->get_where('Empresas', array('Id' => $id));
		//echo $this->db_mon->get_compiled_select();
		return $query->row_array();
	}
	
}