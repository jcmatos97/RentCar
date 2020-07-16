<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Configuracion extends CI_Controller {
    
    var $data;
    
    function __construct() 
    {
        parent::__construct();
        $this->load->library('session');
        sesion_requerida();
        //Datos del Navbar
        $this->data["nombre"] = $this->session->userdata('nombre');
        $this->data["apellido"] = $this->session->userdata('apellido');
        $this->data["usuario"] = $this->session->userdata('usuario');
    }

    public function Agregar()
	{
        $this->data['title'] = 'Agregar Usuario';

        $this->load->view('Templates/header', $this->data);
        $this->load->view('Configuracion/Agregar');
        $this->load->view('Templates/footer');
    }
    
    public function Actualizar()
	{
        $this->data['title'] = 'Actualizar Usuario';

        $this->load->view('Templates/header', $this->data);
        $this->load->view('Configuracion/Actualizar');
        $this->load->view('Templates/footer');
    }
    
    public function index()
	{
        $this->data['title'] = 'Usuarios';

        $this->load->view('Templates/header', $this->data);
        $this->load->view('Configuracion/Mostrar');
        $this->load->view('Templates/footer');
	}
}