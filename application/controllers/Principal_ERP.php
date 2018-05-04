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
		$this->load->model('pedido_cabecera_model');
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

	public function pedido_web ($cod_cliente = NULL, $sku = NULL, $cant = NULL)
	{
		if ($cod_cliente === NULL) 
		{
			echo 'Error no se tiene el código de cliente para continuar';
		} 
		else 
		{
			//Buscar un pedido temporal en la base de datos - Serían los pedidos con estado = 1.
			$id_temporal = $this->pedido_cabecera_model->get_id_temporal();

			//Si no existe un pedido temporal, lo creo
			if ($id_temporal === NULL) 
			{
				$this->pedido_cabecera_model->set_pedidos_sin_form($cod_cliente, $fec_creacion);
				$id_temporal = $this->pedido_cabecera_model->get_id_temporal();
			}

			//Si existe un pedido temporal lo utilizo
			
			//Agrego el producto en el pedido temporal
		}
	}

}