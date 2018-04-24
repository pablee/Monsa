<?php
class empresas_ERP extends CI_Controller 
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('empresas_ERP_model');
		$this->load->helper('url_helper');
	}

	public function index()
	{
		$data['lista_empresas_ERP'] = $this->empresas_ERP_model->get_by_id();
        $data['title'] = 'Todas las empresas';

        $this->load->view('templates/header', $data);
        $this->load->view('empresas_ERP/index', $data);
        $this->load->view('templates/footer');
	}

}