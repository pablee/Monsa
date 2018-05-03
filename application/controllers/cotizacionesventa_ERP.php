<?php
class CotizacionesVenta_ERP extends CI_Controller 
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('CotizacionesVenta_ERP_model');
		$this->load->model('CotizacionesVentaArticulos_ERP_model');
		$this->load->helper('url_helper');
	}

	public function index()
	{
		$data['lista_cotizacionesventa_ERP'] = $this->CotizacionesVenta_ERP_model->get_by_id();
        $data['title'] = 'Todas las cotizaciones';

        $this->load->view('templates/header', $data);
		if (!empty($data['lista_cotizacionesventa_ERP']))
		{
			$this->load->view('cotizacionesventa_ERP/index', $data);
		}
		else
		{
			//presentar vista fija que indique que no hay datos
		}
        $this->load->view('templates/footer');
	}

	public function lista_by_empresa($id = NULL)
	{
		$data['lista_cotizacionesventa_ERP'] = $this->CotizacionesVenta_ERP_model->get_by_empresa($id);
        $data['title'] = 'Cotizaciones de un cliente';
		
		if (!empty($data['lista_cotizacionesventa_ERP']))
		{
			$this->load->view('cotizacionesventa_ERP/lista_by_empresa', $data);
		}
		else
		{
			//presentar vista que indique que no hay datos para los parametros ingresados
		}
	}
	
	public function view($id = NULL)
	{
		$data['title'] = 'Cotización puntual con sus líneas.';
		$data['lista_cotizacionesventa_ERP'] = $this->CotizacionesVenta_ERP_model->get_by_id($id);
		$data['lista_cotizacionesventaarticulos_ERP'] = $this->CotizacionesVentaArticulos_ERP_model->get_by_cabecera($id);
		
		if (empty($data['lista_cotizacionesventa_ERP']))
		{
			//show_404();
			echo "no hay cotizaciones disponibles";
		}
		else
		{
			$this->load->view('templates/header', $data);
			$this->load->view('cotizacionesventa_ERP/view', $data);
			if (!empty($data['lista_cotizacionesventaarticulos_ERP']))
			{
				$this->load->view('cotizacionesventaarticulos_ERP/lista_by_cabecera', $data);
			}
			else
			{
				//vista con un texto que indique que no hay articulos para la cotización.
			}
			$this->load->view('templates/footer');
		}
	}

}