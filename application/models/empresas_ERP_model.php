<?php
class empresas_ERP_model extends CI_Model 
{
	private $db_mon;
	private $Tabla;
	public function __construct()
	{
		$this->db_mon = $this->load->database('ERP',TRUE);
		//$this->db_mon = $this->load->database('SQL_2008',TRUE);
		$this->Tabla = 'vSW_Empresas';
	}
		
	public function get_by_id($id = FALSE)
	{
		//var_dump($this->db_mon);
        if ($id === FALSE)
        {
			$query = $this->db_mon->get($this->Tabla);
			return $query->result_array();
		}
		
		$query = $this->db_mon->get_where($this->Tabla, array('Id' => $id));
		//echo $this->db_mon->get_compiled_select();
		return $query->row_array();
	}
	
}