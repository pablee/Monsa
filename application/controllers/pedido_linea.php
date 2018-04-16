<?php
class pedido_linea extends CI_Controller 
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('pedido_cabecera_model');
		$this->load->model('pedido_linea_model');
		$this->load->helper('url_helper');
	}

	public function index()
	{
		echo 'función sin desarrollar';
	}
	
	public function view($id_pedido = NULL)
	{
		//definimos una varible title para que se indique que estamos haciendo.
		$data['title'] = 'Pedido con sus líneas';
		//Definimos una variable con el array de objetos obtenidos de la base de datos
		$data['pedido_linea_item'] = $this->pedido_linea_model->get_pedido_lineas($id_pedido);
		
        if (empty($data['pedido_linea_item']))
        {
            show_404();
        }

        $data['id_pedido'] = $data['pedido_linea_item']['id_pedido']; //Obtener el valor de una propiedad del objeto.

        $this->load->view('templates/header', $data);
        $this->load->view('pedido_linea/view', $data);
        $this->load->view('templates/footer');
	}
	
	public function create()
	{
		$this->load->helper('form');
		$this->load->library('form_validation');

		$data['title'] = 'Creación de un Pedido';
		
		$this->form_validation->set_rules('cod_cliente', 'Código de cliente', 'required');
		$this->form_validation->set_rules('fec_creacion', 'Fecha de creación', 'required');
		
		if ($this->form_validation->run() === FALSE)
		{
			$this->load->view('templates/header', $data);
			$this->load->view('pedido_cabecera/create');
			$this->load->view('templates/footer');
		}
		else
		{
			$this->pedido_cabecera_model->set_pedidos();
			$this->load->view('pedido_cabecera/success');
		}
	}
	
	public function creacion_sin_form($id_pedido, $renglon, $cod_producto, $sku, $cantidad, $precio_unitario, $precio_total)
	{
		//Defino una variable para el Header
		$data['title'] = 'Carga de líneas';
		//al llamar a ésta función se utilizan los campos del post.
		$this->pedido_linea_model->set_pedido_linea($id_pedido, $renglon, $cod_producto, $sku, $cantidad, $precio_unitario, $precio_total);
		//obtengo los datos de pedido_cabecera
		$data['pedido_cabecera_item'] = $this->pedido_cabecera->get_pedidos($id_pedido);
		//Obtengo los datos de las lineas del pedido
		$data['pedido_linea_lista'] = $this->pedido_linea_model->get_pedido_lineas($id_pedido);
		//defino una variable con el código de cliente que filtramos. Se deberá traer el nombre en base a éste código.
		$data['codigo_cliente'] = $data['pedido_cabecera_item']['cod_cliente'];
		
		
		//LO SIGUIENTE SE TENDRÍA QUE LLAMAR POR MEDIO DEL CONTROLADOR DE PEDIDO CABECERA. 
		
		//O TAL VEZ HABRÍA QUE DISEÑAR UNA CLASE PEDIDO, QUE SE PUEDA OBTENER TODA LA INFORMACIÓN
		
		
		
		
		//Llamamos a la vista que presentará nuestra información
        $this->load->view('templates/header', $data);
        $this->load->view('pedido_cabecera/view', $data);
        $this->load->view('templates/footer');
	}
}