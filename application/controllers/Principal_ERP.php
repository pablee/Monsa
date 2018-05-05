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
		$this->load->model('pedido_linea_model');
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

	public function set_pedido_web ($cod_cliente = FALSE, $SKU = FALSE, $Cantidad = FALSE)
	{
		if ($cod_cliente === FALSE) 
		{
			echo 'Error no se tiene el código de cliente para continuar';
		} 
		else 
		{
			if ($SKU === FALSE) 
			{
				echo 'Error al recibir el código de producto';
			} 
			else 
			{
				//Buscar un pedido temporal en la base de datos - Serían los pedidos con estado = 1.
				//Retorna FALSE si no recibe un código de cliente. NULL si no existe un pedido temporal para el cliente.
				$pedido_temporal = $this->pedido_cabecera_model->get_id_temporal($cod_cliente);

				//Si no existe un pedido temporal, lo creo.
				if ($pedido_temporal === NULL) 
				{
					//Mejorar la carga de una cabecera de pedido sin formulario para lo que sea necesario.
					//Agregar id_estado, por defecto se inserta 1
					//Agregar ...
					$fec_creacion = '00-00-0000';
					$this->pedido_cabecera_model->set_pedidos_sin_form($cod_cliente, $fec_creacion);
					$pedido_temporal = $this->pedido_cabecera_model->get_id_temporal($cod_cliente);
				}

				//Habiendo creado un pedido temporal, lo utilizo.
				$id_pedido = $pedido_temporal['id_pedido'];
				//Agrego el producto en el pedido temporal
				$this->pedido_linea_model->set_pedidos_lineas_sin_form($id_pedido, $SKU, $Cantidad);
				

				redirect('/pedido_cabecera/view/'.$id_pedido);

			}
		}
	}

}