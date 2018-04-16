<?php
class pedidosventa_ERP extends CI_Controller 
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('pedidosventa_ERP_model');
		$this->load->model('pedidosventaarticulos_ERP_model');
		$this->load->helper('url_helper');
	}

	public function index()
	{
		$data['lista_pedidosventa_ERP'] = $this->pedidosventa_ERP_model->get_by_id();
        $data['title'] = 'Todos los pedidos';

        $this->load->view('templates/header', $data);
		if (!empty($data['lista_pedidosventa_ERP']))
		{
			$this->load->view('pedidosventa_ERP/index', $data);
		}
		else
		{
			//presentar vista fija que indique que no hay datos
		}
        $this->load->view('templates/footer');
	}

	public function lista_by_empresa($id = NULL)
	{
		$data['lista_pedidosventa_ERP'] = $this->pedidosventa_ERP_model->get_by_empresa($id);
        $data['title'] = 'Pedidos de un cliente';
		
		if (!empty($data['lista_pedidosventa_ERP']))
		{
			$this->load->view('pedidosventa_ERP/lista_by_empresa', $data);
		}
		else
		{
			//presentar vista que indique que no hay datos para los parametros ingresados
		}
	}
	
	public function view($id = NULL)
	{
		$data['title'] = 'Pedido puntual con sus líneas.';
		$data['lista_pedidosventa_ERP'] = $this->pedidosventa_ERP_model->get_by_id($id);
		$data['lista_pedidosventaarticulos_ERP'] = $this->pedidosventaarticulos_ERP_model->get_by_cabecera($id);
		
		if (empty($data['lista_pedidosventa_ERP']))
		{
			show_404();
		}
		else
		{
			$this->load->view('templates/header', $data);
			$this->load->view('pedidosventa_ERP/view', $data);
			if (!empty($data['lista_pedidosventaarticulos_ERP']))
			{
				$this->load->view('pedidosventaarticulos_ERP/lista_by_cabecera', $data);
			}
			else
			{
				//vista con un texto que indique que no hay articulos para la cotización.
			}
			$this->load->view('templates/footer');
		}
	}
	
	public function solicitar_duplicado($id = FALSE)
	{
		$nuevo_id;
		//Necesitamos un identificador de pedido del ERP para duplicar.
		if ($id === FALSE)
		{
			show_404();
		}
		else
		{
			//Cargamos los pedidos del ERP con el identificador
			$data['lista_pedidosventa_ERP'] = $this->pedidosventa_ERP_model->get_by_id($id);
			//Cargamos las líneas de pedido con el identificador
			$data['lista_pedidosventaarticulos_ERP'] = $this->pedidosventaarticulos_ERP_model->get_by_cabecera($id);
		}
		//Si no obtenemos un pedido del ERP cancelamos la acción.
		if (empty($data['lista_pedidosventa_ERP']))
		{
			show_404();
		}
		else
		{
			//Cargamos los modelos de nuestras tablas locales
			$this->load->model('pedido_cabecera_model');
			$this->load->model('pedido_linea_model');
			//Por cada pedido encontrado con éste identificador cargamos uno nuevo en nuestra base. Debería ser uno solo, pero es un array y lo manejamos así
			foreach($data['lista_pedidosventa_ERP'] as $item_pedidoventa_ERP)
			{
				//Cargo la información en variables locales.
				$Empresa_Id = $item_pedidoventa_ERP['EmpresaId'];
				$Fecha_Creacion = '0000-00-00';
				//Llamo a la función del modelo donde inserta información por medio de parámetros. La función me devuelve el identificador del nuevo registro.
				//$nuevo_id = $this->pedido_cabecera_model->set_pedidos_sin_form($Empresa_Id, $Fecha_Creacion);
				$nuevo_id = $this->pedido_cabecera_model->set_pedidos_sin_form(1, $Fecha_Creacion);
				//valido que no sea un pedido sin líneas, no debería, pero viene del ERP
				if (!empty($data['lista_pedidosventaarticulos_ERP']))
				{
					//Por cada línea del pedido del ERP debo insertar una línea de pedido local.
					foreach($data['lista_pedidosventaarticulos_ERP'] as $item_pedidosventaarticulos_ERP)
					{
						//Cargo la información en variables locales
						$PedidoId = $item_pedidosventaarticulos_ERP['PedidoVentaId'];
						$ArticuloId = $item_pedidosventaarticulos_ERP['ArticuloId'];
						$Cantidad = $item_pedidosventaarticulos_ERP['Cantidad'];
						//Inserto la información por medio de una función del modelo que recibe parámetros. La función me devuelve el identificador del nuevo registro.
						$this->pedido_linea_model->set_pedidos_lineas_sin_form($PedidoId, $ArticuloId, $Cantidad);
					}
				}
			}			
			
			//Finalmente redirecciono al usuario a las vistas del objeto final.
			redirect('/pedido_cabecera/view/'.$nuevo_id);
		}
	}

}