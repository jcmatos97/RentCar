<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inspeccion extends CI_Controller {

    var $data;
    
    function __construct() 
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model('Vehiculo_model');
        $this->load->model('Inspeccion_model');
        sesion_requerida();
        //Datos del Navbar
        $this->data["nombre"] = $this->session->userdata('nombre');
        $this->data["apellido"] = $this->session->userdata('apellido');
        $this->data["usuario"] = $this->session->userdata('usuario');
    }

    public function index()
	{
        $this->data['title'] = 'Inspeccion de un Vehiculo';

        //Datos Foraneos
        $this->data["datashow"] = $this->Vehiculo_model->get();

        $this->load->view('Templates/header-datatable', $this->data);
        $this->load->view('Inspeccion/index');
        //$this->load->view('Templates/footer');
    }
    
    public function Detalle($param)
	{
        $this->data['title'] = 'Detalle de la Inspeccion de un Vehiculo';

        //Datos Foraneos
        $this->data["datashow"] = $this->Vehiculo_model->get($param)[0];
        @$this->data["inspeccion"] = $this->Inspeccion_model->get($param)[0];

        $this->load->view('Templates/header-datatable', $this->data);
        $this->load->view('Inspeccion/Detalle');
        $this->load->view('Templates/footer');
    }

    public function Proceso($param)
	{
        $this->data['title'] = 'Proceso de Inspeccion de un Vehiculo';

        //Datos Foraneos
        $this->data["datashow"] = $this->Vehiculo_model->get($param)[0];
        @$this->data["inspeccion"] = $this->Inspeccion_model->get($param)[0];

        $this->form_validation->set_rules('id_vehiculo', 'Vehiculo', 'required|integer|check_status[vehiculo.id]', 
        array(
        'required' => 'Debe seleccionar un {field}.',
        'integer' => 'Debe seleccionar un {field} válido.',
        'check_status' => 'Debe seleccionar un {field} activo.'
        ));

        $this->form_validation->set_rules('nivelcombustible', 'Nivel de Combustible', 'required|integer|greater_than[-1]|less_than[101]', 
        array(
            'required' => 'El {field} es obligatorio.',
            'integer' => 'El valor debe ser un entero.',
            'greater_than' => 'El valor del {field} debe estar entre 0-100.',
            'less_than' => 'El valor del {field} debe estar entre 0-100.'
        ));

        $this->form_validation->set_rules('rayaduras', 'Numero de Rayaduras', 'required|integer|greater_than[-1]|less_than[51]', 
        array(
            'required' => 'El {field} es obligatorio.',
            'integer' => 'El valor debe ser un entero.',
            'greater_than' => 'El valor del {field} debe estar entre 0-50.',
            'less_than' => 'El valor del {field} debe estar entre 0-50.'
        ));

        $this->form_validation->set_rules('aboyaduras', 'Numero de Aboyaduras', 'required|integer|greater_than[-1]|less_than[51]', 
        array(
            'required' => 'El {field} es obligatorio.',
            'integer' => 'El valor debe ser un entero.',
            'greater_than' => 'El valor del {field} debe estar entre 0-50.',
            'less_than' => 'El valor del {field} debe estar entre 0-50.'
        ));

        if ($this->form_validation->run() === FALSE)
        {
            $this->load->view('Templates/header-datatable', $this->data);
            $this->load->view('Inspeccion/Proceso');
            $this->load->view('Templates/footer');
        }
        else
        {
            $RuedaR1 = ($this->input->post("r1") !== null)?"1":"0";
            $RuedaL1 = ($this->input->post("l1") !== null)?"1":"0";
            $RuedaR2 = ($this->input->post("r2") !== null)?"1":"0";
            $RuedaL2 = ($this->input->post("l2") !== null)?"1":"0";

            $data = array(
                "fecha" => (new DateTime('', new DateTimeZone('America/Caracas')))->format("Y-m-d H:i:s"),
                "rayaduras" => $this->input->post("rayaduras"),
                "aboyaduras" => $this->input->post("aboyaduras"),
                "nivelcombustible" => $this->input->post("nivelcombustible"),
                "gomarepuesto" => ($this->input->post("gomarepuesto") !== null)?"1":"0",
                "gato" => ($this->input->post("gato") !== null)?"1":"0",
                "estadogomas" => $RuedaR1."".$RuedaL1."".$RuedaR2."".$RuedaL2,
                "kitherramientas" => ($this->input->post("kitherramientas") !== null)?"1":"0",
                "id_vehiculo" => $this->input->post("id_vehiculo")
            );

            $idCarro = $this->input->post("id_vehiculo");
            $inspeccion = $this->Inspeccion_model->get($idCarro);

            if(count($inspeccion) == 0)
            {
                $this->Inspeccion_model->post($data);
                redirect(base_url().'inspeccion/detalle/'.$idCarro);
            }
            else
            {
                $this->Inspeccion_model->put($idCarro, $data);
                redirect(base_url().'inspeccion/detalle/'.$idCarro);
            }
        }
    }
}