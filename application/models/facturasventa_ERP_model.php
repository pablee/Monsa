<?php
class FacturasVenta_ERP_model extends CI_Model 
{	
	private $db_mon;
	private $Tabla;

	public function __construct()
	{		
		$this->db_mon = $this->load->database('ERP', TRUE);
		$this->Tabla = 'vSW_FacturasVenta';
	}
		
	public function get_by_id($id = FALSE)
	{
        if ($id === FALSE)
        {
			$query = $this->db_mon->get($this->Tabla);
			return $query->result_array();
		}
		
		$query = $this->db_mon->get_where($this->Tabla, array('Id' => $id));
		//echo $this->db_mon->get_compiled_select();
		return $query->result_array();
	}
	
	public function get_by_empresa($id = FALSE)
	{
		if ($id === FALSE)
		{
			$query = $this->db_mon->get($this->Tabla);
			return $query->result_array();
		}
		
		$query = $this->db_mon->get_where($this->Tabla, array('EmpresaId' => $id));
		//echo $this->db_mon->get_compiled_select();
		return $query->result_array();
	}
}