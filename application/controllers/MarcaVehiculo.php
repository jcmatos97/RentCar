<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MarcaVehiculo extends CI_Controller {

    var $data;
    
    function __construct() 
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model('MarcaVehiculo_model');
        sesion_requerida();

        //Datos del Navbar
        $this->data["nombre"] = $this->session->userdata('nombre');
        $this->data["apellido"] = $this->session->userdata('apellido');
        $this->data["usuario"] = $this->session->userdata('usuario');
    }

	public function Agregar()
	{
        $this->data['title'] = 'Agregar Marca de Vehiculo';

        /*Validaciones*/
        //Marca de Vehiculo
        $this->form_validation->set_rules('nombre', 'Nombre de la Marca del Vehiculo', 'required|max_length[25]|alpha_numeric_spaces|is_unique[marcavehiculo.nombre]', 
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
            $this->load->view('Vehiculo/Marca/Agregar');
            $this->load->view('Templates/footer');
        }
        else
        {
            $data = array(
                'nombre' => $this->input->post('nombre'),
                'estado' => '1',
            );
            $this->MarcaVehiculo_model->post($data);
            redirect(base_url().'marcavehiculo');
        }
    }
    
    public function Actualizar($param)
	{
        if(!$param)
        {
            show_404();
        }
        
        $this->data['title'] = 'Actualizar Marca de Vehiculo';
        
        /*Validaciones*/
        //Marca Vehiculo
        $this->form_validation->set_rules('nombre', 'Nombre de la Marca del Vehiculo', 'required|max_length[25]|alpha_numeric_spaces|edit_unique[marcavehiculo.nombre.'.$param.']', 
            array(
                'required' => 'El campo {field} es requerido.',
                'max_length' => 'El {field} no debe tener mas de {param} caracteres.',
                'alpha_numeric_spaces' => 'El {field} solo debe tener caracteres alfabeticos y numericos.',
                'edit_unique' => 'La {field} ya existe en la base de datos, digite una diferente o deje el valor anterior'
            ));

        //Evaluando Campos
        if ($this->form_validation->run() === FALSE)
        {
            //Datos 
            $this->data["datashow"] = $this->MarcaVehiculo_model->get($param)[0];
            
            $this->load->view('Templates/header', $this->data);
            $this->load->view('Vehiculo/Marca/Actualizar');
            $this->load->view('Templates/footer');
        }
        else
        {
            $data = array(
                'nombre' => $this->input->post('nombre')
            );
            $this->MarcaVehiculo_model->put($param, $data);
            redirect(base_url().'marcavehiculo');
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
        $this->MarcaVehiculo_model->delete($param, $data);
        redirect(base_url().'marcavehiculo');

    }
    
    public function index()
	{
        $this->data['title'] = 'Marcas de Vehiculo';

        //Datos foraneos
        $this->data["datashow"] = $this->MarcaVehiculo_model->get();

        $this->load->view('Templates/header-datatable', $this->data);
        $this->load->view('Vehiculo/Marca/Mostrar');
        //$this->load->view('Templates/footer');
	}
}