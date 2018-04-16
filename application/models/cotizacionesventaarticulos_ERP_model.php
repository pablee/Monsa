<?php
class cotizacionesventaarticulos_ERP_model extends CI_Model 
{	
	public function __construct()
	{		
		$this->load->database('ERP');
	}
		
	public function get_by_id($id = FALSE)
	{
        if ($id === FALSE)
        {
			$query = $this->db->get('cotizacionesventaarticulos');
			return $query->result_array();
		}
		
		$query = $this->db->get_where('cotizacionesventaarticulos', array('id' => $id));
		//echo $this->db->get_compiled_select();
		return $query->result_array();
	}
	
	public function get_by_cabecera($id = FALSE)
	{
		if (!$id === FALSE)
		{		
			$query = $this->db->get_where('cotizacionesventaarticulos', array('CotizacionVentaId' => $id));
			//echo $this->db->get_compiled_select();
			return $query->result_array();
		}
	}
}