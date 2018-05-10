<?php
class Clientes_ERP_model extends CI_Model 
{
	private $db_mon;
	private $Tabla;
	
	public function __construct()
	{
		$this->db_mon = $this->load->database('ERP');
		$this->Tabla = 'vSW_Clientes';
	}
		
	public function get_clientes_ERP($Id = FALSE)
	{
        if ($Id === FALSE)
        {
			$query = $this->db_mon->get($this->Tabla);
			return $query->result_array();
		}
		
		$query = $this->db_mon->get_where($this->Tabla, array('Id' => $Id));
		//echo $this->db_mon->get_compiled_select();
		return $query->row_array();
	}
	
}