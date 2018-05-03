<?php
class Principal_ERP extends CI_Controller 
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Empresas_ERP_model');
		$this->load->model('Clientes_ERP_model');
		$this->load->model('CotizacionesVenta_ERP_model');
		$this->load->model('PedidosVenta_ERP_model');
		$this->load->model('FacturasVenta_ERP_model');
		//$this->load->model('RemitosVenta_ERP_model');
		$this->load->helper('url_helper');
	}

	public function index()
	{
		$data['lista_empresas_ERP'] = $this->Empresas_ERP_model->get_by_id();
        $data['title'] = 'Todas las empresas';

        $this->load->view('templates/header', $data);
        $this->load->view('Principal_ERP/index', $data);
        $this->load->view('templates/footer');
	}
	
	public function view($id = NULL)
	{
		//definimos una varible title para que se indique que estamos haciendo.
		$data['title'] = 'Información detallada de la empresa';
		//Definimos una variable con el array de objetos obtenidos de la base de datos
		$data['item_empresas_ERP'] = $this->Empresas_ERP_model->get_by_id($id);
		$data['lista_cotizacionesventa_ERP'] = $this->CotizacionesVenta_ERP_model->get_by_empresa($id);
		$data['lista_pedidosventa_ERP'] = $this->PedidosVenta_ERP_model->get_by_empresa($id);
		$data['lista_facturasventa_ERP'] = $this->FacturasVenta_ERP_model->get_by_empresa($id);
		//$data['lista_remitosventa_ERP'] = $this->RemitosVenta_ERP_model->get_by_empresa($id);
		
		if (empty($data['item_empresas_ERP']))
		{
			show_404();
		}
		
        $this->load->view('templates/header', $data);
		
        $this->load->view('Principal_ERP/view', $data);
		
		if (!empty($data['lista_cotizacionesventa_ERP']))
		{
			$this->load->view('cotizacionesventa_ERP/lista_by_empresa', $data);
        }
		
		if (!empty($data['lista_pedidosventa_ERP']))
		{
			$this->load->view('pedidosventa_ERP/lista_by_empresa', $data);
        }
		
		$this->load->view('templates/footer');
	}
}