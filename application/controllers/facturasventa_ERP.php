<?php
class facturasventa_ERP extends CI_Controller 
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('facturasventa_ERP_model');
		$this->load->model('facturaventaitems_ERP_model');
		$this->load->helper('url_helper');
	}

	public function index()
	{
		$data['lista_facturasventa_ERP'] = $this->facturasventa_ERP_model->get_by_id();
        $data['title'] = 'Todas las facturas';

        $this->load->view('templates/header', $data);
		if (!empty($data['lista_facturasventa_ERP']))
		{
			$this->load->view('facturasventa_ERP/index', $data);
		}
		else
		{
			//presentar vista fija que indique que no hay datos
		}
        $this->load->view('templates/footer');
	}

	public function lista_by_empresa($id = NULL)
	{
		$data['lista_facturasventa_ERP'] = $this->facturasventa_ERP_model->get_by_empresa($id);
        $data['title'] = 'Facturas de un cliente';
		
		if (!empty($data['lista_facturasventa_ERP']))
		{
			$this->load->view('facturasventa_ERP/lista_by_empresa', $data);
		}
		else
		{
			//presentar vista que indique que no hay datos para los parametros ingresados
		}
	}
	
	public function view($id = NULL)
	{
		$data['title'] = 'Factura puntual con sus líneas.';
		$data['lista_facturasventa_ERP'] = $this->facturasventa_ERP_model->get_by_id($id);
		$data['lista_facturaventaitems_ERP'] = $this->facturaventaitems_ERP_model->get_by_cabecera($id);
		
		if (empty($data['lista_facturasventa_ERP']))
		{
			show_404();
		}
		else
		{
			$this->load->view('templates/header', $data);
			$this->load->view('facturasventa_ERP/view', $data);
			if (!empty($data['lista_facturaventaitems_ERP']))
			{
				$this->load->view('facturaventaitems_ERP/lista_by_cabecera', $data);
			}
			else
			{
				//vista con un texto que indique que no hay articulos para la cotización.
			}
			$this->load->view('templates/footer');
		}
	}

}