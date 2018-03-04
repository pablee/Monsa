<?php
class pedido_cabecera extends CI_Controller 
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('pedido_cabecera_model');
		$this->load->helper('url_helper');
	}

	public function index()
	{
		$data['pedido_cabecera'] = $this->pedido_cabecera_model->get_pedidos();
        $data['title'] = 'Pedidos';

        $this->load->view('templates/header', $data);
        $this->load->view('pedido_cabecera/index', $data);
        $this->load->view('templates/footer');
	}

	public function view($id_pedido = NULL)
	{
		$data['pedido_cabecera_item'] = $this->pedido_cabecera_model->get_pedidos($id_pedido);
		
        if (empty($data['pedido_cabecera_item']))
        {
            show_404();
        }

        $data['id_pedido'] = $data['pedido_cabecera_item']['id_pedido'];

        $this->load->view('templates/header', $data);
        $this->load->view('pedido_cabecera/view', $data);
        $this->load->view('templates/footer');
	}
	
	public function create()
	{
		$this->load->helper('form');
		$this->load->library('form_validation');

		
		$data['title'] = 'Create pedido_cabecera item';
		
		

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
}