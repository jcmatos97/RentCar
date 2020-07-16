<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ModeloVehiculo extends CI_Controller {

    var $data;
    
    function __construct() 
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model('ModeloVehiculo_model');
        sesion_requerida();
        
        //Datos del Navbar
        $this->data["nombre"] = $this->session->userdata('nombre');
        $this->data["apellido"] = $this->session->userdata('apellido');
        $this->data["usuario"] = $this->session->userdata('usuario');
    }

	public function Agregar()
	{
        $this->data['title'] = 'Agregar Modelo de Vehiculo';

        //Datos Foraneos
        $this->load->model('MarcaVehiculo_model');
        $this->load->model('TipoVehiculo_model');
        $this->data["marcas"] = $this->MarcaVehiculo_model->get();
        $this->data["tipos"] = $this->TipoVehiculo_model->get();

        /*Validaciones*/
        //Modelo de Vehiculo
        $this->form_validation->set_rules('nombre', 'Nombre del Modelo de Vehiculo', 'required|max_length[25]|alpha_numeric_spaces|is_unique[modelovehiculo.nombre]', 
        array(
            'required' => 'El campo {field} es requerido.',
            'max_length' => 'El {field} no debe tener mas de {param} caracteres.',
            'alpha_numeric_spaces' => 'El {field} solo debe tener caracteres alfabeticos y numericos.',
            'is_unique' => 'El valor "'.$this->input->post('nombre').'" ya existe en la base de datos, digite uno diferente.'
        ));
        
        $this->form_validation->set_rules('marcavehiculo', 'Marca del Vehiculo', 'required|integer', 
        array(
            'required' => 'El campo {field} es requerido.',
            'integer' => 'El valor de la {field} tiene que ser un entero.'
        ));

        $this->form_validation->set_rules('tipovehiculo', 'Tipo de Vehiculo', 'required|integer', 
        array(
            'required' => 'El campo {field} es requerido.',
            'integer' => 'El valor de la {field} tiene que ser un entero.'
        ));

        //Evaluando Campos
        if ($this->form_validation->run() === FALSE)
        {
            $this->load->view('Templates/header', $this->data);
            $this->load->view('Vehiculo/Modelo/Agregar');
            $this->load->view('Templates/footer');
        }
        else
        {
            $data = array(
                'nombre' => $this->input->post('nombre'),
                'id_tipovehiculo' => $this->input->post('tipovehiculo'),
                'id_marcavehiculo' => $this->input->post('marcavehiculo'),
                'estado' => '1'
            );
            $this->ModeloVehiculo_model->post($data);
            redirect(base_url().'modelovehiculo');
        }
    }
    
    public function Actualizar($param)
	{
        if(!$param)
        {
            show_404();
        }
        
        $this->data['title'] = 'Actualizar Modelo de Vehiculo';
        
        //Datos Foraneos
        $this->load->model('MarcaVehiculo_model');
        $this->load->model('TipoVehiculo_model');
        $this->data["marcas"] = $this->MarcaVehiculo_model->get();
        $this->data["tipos"] = $this->TipoVehiculo_model->get();

        /*Validaciones*/
        //Modelo de Vehiculo
        $this->form_validation->set_rules('nombre', 'Nombre del Modelo de Vehiculo', 'required|max_length[25]|alpha_numeric_spaces|edit_unique[modelovehiculo.nombre.'.$param.']', 
        array(
            'required' => 'El campo {field} es requerido.',
            'max_length' => 'El {field} no debe tener mas de {param} caracteres.',
            'alpha_numeric_spaces' => 'El {field} solo debe tener caracteres alfabeticos y numericos.',
            'edit_unique' => 'La {field} ya existe en la base de datos, digite una diferente o deje el valor anterior'
        ));
        
        $this->form_validation->set_rules('marcavehiculo', 'Marca del Vehiculo', 'required|integer', 
        array(
            'required' => 'El campo {field} es requerido.',
            'integer' => 'El valor de la {field} tiene que ser un entero.'
        ));

        $this->form_validation->set_rules('tipovehiculo', 'Tipo de Vehiculo', 'required|integer', 
        array(
            'required' => 'El campo {field} es requerido.',
            'integer' => 'El valor de la {field} tiene que ser un entero.'
        ));

        //Evaluando Campos
        if ($this->form_validation->run() === FALSE)
        {
            //Datos 
            $this->data["datashow"] = $this->ModeloVehiculo_model->get($param)[0];
            
            $this->load->view('Templates/header', $this->data);
            $this->load->view('Vehiculo/Modelo/Actualizar');
            $this->load->view('Templates/footer');
        }
        else
        {
            $data = array(
                'nombre' => $this->input->post('nombre'),
                'id_tipovehiculo' => $this->input->post('tipovehiculo'),
                'id_marcavehiculo' => $this->input->post('marcavehiculo'),
            );
            $this->ModeloVehiculo_model->put($param, $data);
            redirect(base_url().'modelovehiculo');
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
        $this->ModeloVehiculo_model->delete($param, $data);
        redirect(base_url().'modelovehiculo');
    }
    
    public function index()
	{
        $this->data['title'] = 'Modelos de Vehiculo';

        //Datos foraneos
        $this->data["datashow"] = $this->ModeloVehiculo_model->customizedGet();

        $this->load->view('Templates/header-datatable', $this->data);
        $this->load->view('Vehiculo/Modelo/Mostrar');
        //$this->load->view('Templates/footer');
	}
}