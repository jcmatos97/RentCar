<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class TipoCombustible extends CI_Controller {

    var $data;
    
    function __construct() 
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model('TipoCombustible_model');
        sesion_requerida();

        //Datos del Navbar
        $this->data["nombre"] = $this->session->userdata('nombre');
        $this->data["apellido"] = $this->session->userdata('apellido');
        $this->data["usuario"] = $this->session->userdata('usuario');
    }

	public function Agregar()
	{
        $this->data['title'] = 'Agregar Tipo de Combustible';

        /*Validaciones*/
        //Tipo Combustible
        $this->form_validation->set_rules('nombre', 'Nombre del Tipo de Combustible', 'required|max_length[25]|alpha_numeric_spaces|is_unique[tipocombustible.nombre]', 
            array(
                'required' => 'El campo {field} es requerido.',
                'max_length' => 'El {field} no debe tener mas de {param} caracteres.',
                'alpha_numeric_spaces' => 'El {field} solo debe tener caracteres alfabeticos y numericos.',
                'is_unique' => 'El valor "'.$this->input->post('nombre').'" ya existe en la base de datos, digite uno diferente.'
            ));

        //Evaluando Campos
        if ($this->form_validation->run() === FALSE)
        {
            $this->load->view('Templates/header', $this->data);
            $this->load->view('Vehiculo/TipoCombustible/Agregar');
            $this->load->view('Templates/footer');
        }
        else
        {
            $data = array(
                'nombre' => $this->input->post('nombre'),
                'estado' => '1'
            );
            $this->TipoCombustible_model->post($data);
            redirect(base_url().'tipocombustible');
        }
    }
    
    public function Actualizar($param)
	{
        if(!$param)
        {
            show_404();
        }
        
        $this->data['title'] = 'Actualizar Tipo de Combustible';
        
        /*Validaciones*/
        //Tipo de Combustible
        $this->form_validation->set_rules('nombre', 'Nombre del Tipo de Combustible', 'required|max_length[25]|alpha_numeric_spaces|edit_unique[tipocombustible.nombre.'.$param.']', 
            array(
                'required' => 'El campo {field} es requerido.',
                'max_length' => 'El {field} no debe tener mas de {param} caracteres.',
                'alpha_numeric_spaces' => 'El {field} solo debe tener caracteres alfabeticos y numericos.'
            ));

        //Evaluando Campos
        if ($this->form_validation->run() === FALSE)
        {
            //Datos 
            $this->data["datashow"] = $this->TipoCombustible_model->get($param)[0];
            
            $this->load->view('Templates/header', $this->data);
            $this->load->view('Vehiculo/TipoCombustible/Actualizar');
            $this->load->view('Templates/footer');
        }
        else
        {
            $data = array(
                'nombre' => $this->input->post('nombre')
            );
            $this->TipoCombustible_model->put($param, $data);
            redirect(base_url().'tipocombustible');
        }
    }

    public function Eliminar($param)
	{
        if(!$param)
        {
            show_404();
        }
        $data = array(
            'estado' => '0'
        );
        $this->TipoCombustible_model->delete($param, $data);
        redirect(base_url().'tipocombustible');
    }
    
    public function index()
	{
        $this->data['title'] = 'Tipos de Combustible';

        //Datos foraneos
        $this->data["datashow"] = $this->TipoCombustible_model->get();

        $this->load->view('Templates/header-datatable', $this->data);
        $this->load->view('Vehiculo/TipoCombustible/Mostrar');
        //$this->load->view('Templates/footer');
	}
}