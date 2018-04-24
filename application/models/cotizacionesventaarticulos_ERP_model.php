<?php
class cotizacionesventaarticulos_ERP_model extends CI_Model 
{
	private $db_mon;

	public function __construct()
	{		
		$this->db_mon = $this->load->database('ERP', TRUE);
	}
		
	public function get_by_id($id = FALSE)
	{
        if ($id === FALSE)
        {
			$query = $this->db_mon->get('cotizacionesventaarticulos');
			return $query->result_array();
		}
		
		$query = $this->db_mon->get_where('cotizacionesventaarticulos', array('id' => $id));
		//echo $this->db_mon->get_compiled_select();
		return $query->result_array();
	}
	
	public function get_by_cabecera($id = FALSE)
	{
		if (!$id === FALSE)
		{		
			$query = $this->db_mon->get_where('cotizacionesventaarticulos', array('CotizacionVentaId' => $id));
			//echo $this->db_mon->get_compiled_select();
			return $query->result_array();
		}
	}
}