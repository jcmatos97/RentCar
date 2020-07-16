<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    var $data;
    
    function __construct() 
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('Renta_model');
        sesion_requerida();
        //Datos del Navbar
        $this->data["nombre"] = $this->session->userdata('nombre');
        $this->data["apellido"] = $this->session->userdata('apellido');
        $this->data["usuario"] = $this->session->userdata('usuario');
    }

	public function index()
	{
        $this->data['title'] = 'Tablero Principal';
        /*
        echo "<pre>";
        echo var_dump($this->session);
        echo "</pre>";
        */

        //Cargando Modelos faltantes
        $this->load->model('Usuario_model');
        $this->load->model('Cliente_model');
        $this->load->model('Vehiculo_model');
        
        foreach ($this->Renta_model->getClosedDashboard() as $value) 
        {
            $this->data["datashow"][] = (object)[
                "rentadevolucion" => $value,
                "cliente" =>  $this->Cliente_model->get_all($value->id_cliente),
                "vehiculo" =>  $this->Vehiculo_model->get_all($value->id_vehiculo),
                "empleado" =>  $this->Usuario_model->getById($value->id_empleado),
            ];
        }     
         
        $this->data['ventasTotales'] = $this->Renta_model->rentasDevolucionesTotales(0);
        $this->data['numeroRentas'] = $this->Renta_model->numeroRentas();
        $this->data['pendienteRecaudacion'] = $this->Renta_model->rentasDevolucionesTotales(1);
        $this->data['vehiculosMasRentados'] = $this->Renta_model->vehiculosMasRentados();

        $this->load->view('Templates/header', $this->data);
        $this->load->view('Home/index');
        $this->load->view('Templates/footer');
	}
}