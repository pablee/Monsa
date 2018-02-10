<?php
//Corrige (oculta) el cartel de error en el final de la pagina hosteada.
ini_set("display_errors", 0);
ini_set("log_errors", 1);
ini_set("error_log", "syslog");

session_start();
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('productos');
        $this->load->model('checkout');
        $this->load->model('suscripcion');
        $this->load->model('pedido');
	}


    public function formularios()
    {
        $data['form_action'] = "enviar";
        $this->load->view('formularios/login',$data);
        //$this->load->view('formularios/comprar',$data);
    }


    public function index()
	{
        $data['form_action'] = "enviar";
        $data['destacados'] = $this->productos->destacados();

		$this->load->view('header');
        $this->formularios();
		$this->load->view('login');
	}


    public function login()
    {
        $this->load->model('login');
        $data['usuario']  = $this->input->post('usuario');
        $data['password'] = $this->input->post('password');
        $data['recordar'] = $this->input->post('recordar');
        $validacion=$this->login->validar($data);

        if($validacion==1)
        {
            $_SESSION["login"]=true;
            $this->inicio();
        }
        else{
            $_SESSION["login"]=false;
            $this->index();
            }
    }


    public function logout()
    {
        $this->load->view('logout');
    }


    public function inicio()
    {
        if($_SESSION["login"]==true)
        {
            $this->load->view('header');
            $this->load->view('navbar');
            //$this->load->view('admin/nuevo_producto');
        }
        else{
            $this->load->view('logout');
        }

    }
/*
	public function enviar()
	{
		//Datos de contacto
        $data['nombre']   = $this->input->post('nombre');
		$data['mail']     = $this->input->post('mail');
		$data['telefono'] = $this->input->post('telefono');
		$data['para']     = $this->input->post('para');
		$data['consulta'] = $this->input->post('consulta');

		//Datos de producto
        $data['sku']=$this->input->post('sku');
        $data['titulo']=$this->input->post('titulo');
        $data['precio']=$this->input->post('precio');
        $data['rubro']=$this->input->post('rubro');
        $data['marca']=$this->input->post('marca');
        $data['talle']=$this->input->post('talle');
        $data['cantidad']=$this->input->post('cantidad');

        $this->pedido->guardar($data);

		$data['envio']=$this->load->view('formularios/send', $data);
		$this->load->view('formularios/success',$data);
		$this->index();
	}


    /*Listar por categoria
    public function categoria()
    {
        $filtrado=array("rubro"=>"", "marca"=>"", "modelo"=>"");
        $filtrado["rubro"]=$this->input->get('rubro');

        //Obtengo las marcas disponibles para la categoria.
        $data['marcas']=$this->productos->filtrar_marcas($filtrado["rubro"]);
        //Obtengo las marcas disponibles para la categoria.
        $data['modelos']=$this->productos->filtrar_modelos($filtrado["rubro"]);

        //Obtengo los productos de acuerdo a los filtros usados.
        $data['productos']=$this->productos->listar_cat($filtrado["rubro"]);
        $data['filtrado']=$filtrado;
        $data['i']=0;
        $data['form_action'] = "enviar";

        $this->load->view('header');
        $this->load->view('formularios/login',$data);
        $this->load->view('formularios/contacto',$data);
        $this->load->view('formularios/post_venta',$data);
        $this->load->view('formularios/rrhh',$data);
        $this->load->view('formularios/sucursales',$data);
        $this->load->view('formularios/venta_corporativa',$data);
        $this->load->view('formularios/comprar',$data);

        $this->load->view('info/garantia');
        $this->load->view('contacto');
        $this->load->view('login');
        $this->navbar();
        $this->load->view('productos/listar',$data);
        $this->load->view('nosotros');
        $this->load->view('footer');
    }


    public function filtrar()
    {
        $filtrado=array("sku"=>"", "rubro"=>"", "marca"=>"", "tipo"=>"", "modelo"=>"", "buscado"=>"");
        $filtrado["sku"]=$this->input->get('sku');
        $filtrado["rubro"]=$this->input->get('rubro');
        $filtrado["marca"]=$this->input->get('marca');
        $filtrado["tipo"]=$this->input->get('tipo');
        $filtrado["modelo"]=$this->input->get('modelo');
        $filtrado["buscado"]=$this->input->post('buscado');

        //Obtengo los productos de acuerdo a los filtros usados.
        $productos=$this->productos->filtrar($filtrado);

        $data['productos']=$productos;

        $filtrado["rubro"]=$productos[0]['rubro'];

        //Obtengo las marcas disponibles para la categoria.
        $data['marcas']=$this->productos->filtrar_marcas($filtrado["rubro"]);
        //Obtengo los modelos disponibles para la categoria.
        $data['modelos']=$this->productos->filtrar_modelos($filtrado["rubro"]);
        //Obtengo los tipos disponibles para la categoria.
        $data['tipos']=$this->productos->filtrar_tipos($filtrado["rubro"]);

        //Devuelvo los filtros usados para visualizar los mismos en la vista.
        $data['filtrado']=$filtrado;
        $data['i']=0;

        $this->load->view('header');
        $this->formularios();
        $this->load->view('formularios/comprar',$data);
        $this->load->view('info/garantia');
        $this->load->view('contacto');
        $this->load->view('login');
        $this->navbar();
        $this->load->view('productos/listar',$data);
        $this->load->view('nosotros');
        $this->load->view('footer');
    }


    public function producto()
    {
        $sku=$this->input->get('sku');
        $data['form_action'] = "enviar";
        $data['producto']=$this->productos->buscar_sku($sku);

        $this->load->view('header');
        $this->formularios();
        $this->load->view('formularios/comprar',$data);
        $this->load->view('info/garantia');
        $this->load->view('contacto');
        $this->load->view('login');
        $this->navbar();
        $this->load->view('productos/producto',$data);
        $this->load->view('nosotros');
        $this->load->view('footer');
    }


    public function adjuntar()
    {
        //Datos de contacto
        $data['nombre']   = $this->input->post('nombre');
        $data['mail']     = $this->input->post('mail');
        $data['telefono'] = $this->input->post('telefono');
        $data['para']     = $this->input->post('para');
        $data['consulta'] = $this->input->post('consulta');

        $config['upload_path']          = './uploads/cv/';
        $config['allowed_types']        = '*';
        $config['max_size']             = '50000';
        $config['max_width']            = '1024';
        $config['max_height']           = '768';

        $this->load->library('upload', $config);

        if ( ! $this->upload->do_upload('archivo'))
        {
            $error = array('error' => $this->upload->display_errors());
            $this->load->view('upload_form', $error);
        }
        else
        {
            //$upload_data=$this->upload->data();
            $data['informacion'] = array('upload_data' => $this->upload->data());
            $this->load->view('formularios/send_attachment', $data);
        }

        $this->index();
    }


    public function checkout()
    {
        //Datos de producto
        $data['sku']=$this->input->post('sku');
        $data['titulo']=$this->input->post('titulo');
        $data['precio']=$this->input->post('precio');
        $data['rubro']=$this->input->post('rubro');
        $data['marca']=$this->input->post('marca');

        $data['preference']=$this->checkout->preference($data);

        $this->load->view('header');
        $this->formularios();

        $this->load->view('info/garantia');
        $this->load->view('contacto');
        $this->load->view('login');
        $this->navbar();

        $this->load->view('productos/comprar',$data);
        $this->load->view('nosotros');
        $this->load->view('footer');
    }


    public function suscripcion()
    {
        $data['correo']=$this->input->post('correo');
        $data["suscripcion"]=$this->suscripcion->guardar($data);
        $this->load->view('formularios/success_suscripcion',$data);
        $this->index();
    }
    */
}
