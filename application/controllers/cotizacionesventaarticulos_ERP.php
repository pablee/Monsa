<?php
class cotizacionesventaarticulos_ERP extends CI_Controller 
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('cotizacionesventaarticulos_ERP_model');
		$this->load->helper('url_helper');
	}

	public function lista_by_cabecera($id = NULL)
	{
		$data['lista_cotizacionesventaarticulos_ERP'] = $this->cotizacionesventaarticulos_ERP_model->get_by_cabecera($id);
		
		if (!empty($data['lista_cotizacionesventaarticulos_ERP']))
		{
			$this->load->view('cotizacionesventaarticulos_ERP/lista_by_cabecera', $data);
		}
		else
		{
			//presentar una vista estática que indique que no hay datos...
		}
	}
	

}