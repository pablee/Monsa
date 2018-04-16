<?php
class pedido_cabecera extends CI_Controller 
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
		$data['lista_pedido_cabecera'] = $this->pedido_cabecera_model->get_pedidos();
        $data['title'] = 'Todos los pedidos';

        $this->load->view('templates/header', $data);
        $this->load->view('pedido_cabecera/index', $data);
        $this->load->view('templates/footer');
	}

	public function pedidos_by_cliente($cod_cliente = NULL)
	{
		//Definimos el array de objetos obtenidos desde la base de datos.
		$data['lista_pedido_cabecera'] = $this->pedido_cabecera_model->get_pedidos_by_cliente($cod_cliente);
		//Definimos una variable para ser utilizada en la vista con el título de lo que estamos realizando.
        $data['title'] = 'Todos los pedidos de un cliente';
		//defino una variable con el código de cliente que filtramos. Se deberá traer el nombre en base a éste código.
		$data['codigo_cliente'] = $cod_cliente;
		//Llamamos a la vista que presentará nuestra información
        $this->load->view('templates/header', $data);
        $this->load->view('pedido_cabecera/pedidos_by_cliente', $data);
        $this->load->view('templates/footer');
	}
	
	public function view($id_pedido = NULL)
	{
		//definimos una varible title para que se indique que estamos haciendo.
		$data['title'] = 'Pedido puntual con sus líneas';
		//Definimos una variable con el array de objetos obtenidos de la base de datos
		$data['pedido_cabecera_item'] = $this->pedido_cabecera_model->get_pedidos($id_pedido);
		$data['pedido_linea_lista'] = $this->pedido_linea_model->get_pedido_lineas($id_pedido);
		
		if (empty($data['pedido_cabecera_item']))
		{
			show_404();
		}
		
		if (empty($data['pedido_linea_lista']))
		{
			show_404();
        }

        //$data['id_pedido'] = $data['pedido_cabecera_item']['id_pedido']; Obtener el valor de una propiedad del objeto.

        $this->load->view('templates/header', $data);
        $this->load->view('pedido_cabecera/view', $data);
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
	
	public function creacion_sin_form($cod_cliente, $fec_creacion)
	{
		//Defino una variable para el Header
		$data['title'] = 'Pedidos del cliente';
		//al llamar a ésta función se utilizan los campos del post.
		$this->pedido_cabecera_model->set_pedidos_sin_form($cod_cliente, $fec_creacion);
		//Obtengo los datos del cliente
		$data['lista_pedido_cabecera'] = $this->pedido_cabecera_model->get_pedidos_by_cliente($cod_cliente);
		//defino una variable con el código de cliente que filtramos. Se deberá traer el nombre en base a éste código.
		$data['codigo_cliente'] = $cod_cliente;
		//Llamamos a la vista que presentará nuestra información
        $this->load->view('templates/header', $data);
        $this->load->view('pedido_cabecera/pedidos_by_cliente', $data);
        $this->load->view('templates/footer');
	}
}