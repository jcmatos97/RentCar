<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Devolucion extends CI_Controller {

    var $data;
    
    function __construct() 
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model('Vehiculo_model');
        $this->load->model('Renta_model');
        sesion_requerida();
        //Datos del Navbar
        $this->data["nombre"] = $this->session->userdata('nombre');
        $this->data["apellido"] = $this->session->userdata('apellido');
        $this->data["usuario"] = $this->session->userdata('usuario');
    }

    public function index()
	{
        $this->data['title'] = 'Facturas de Renta Provisionales';

        //Cargando Modelos faltantes
        $this->load->model('Usuario_model');
        $this->load->model('Cliente_model');
        
        foreach ($this->Renta_model->getOpen() as $value) 
        {
            $this->data["datashow"][] = (object)[
                "rentadevolucion" => $value,
                "cliente" =>  $this->Cliente_model->get_all($value->id_cliente),
                "vehiculo" =>  $this->Vehiculo_model->get_all($value->id_vehiculo),
                "empleado" =>  $this->Usuario_model->getById($value->id_empleado),
            ];
        }            

        $this->load->view('Templates/header-datatable', $this->data);
        $this->load->view('Devolucion/index');
    }
    
    public function Proceso($param)
    {
        if(!$param)
        {
            show_404();
        }

        $this->data['title'] = 'Proceso de Devolucion';
        
        //Cargando Modelos faltantes
        $this->load->model('Usuario_model');
        $this->load->model('Cliente_model');

        //Datos Foraneos
        $this->data["rentadevolucion"] = $this->Renta_model->getOpenById($param);
        @$this->data["cliente"] = $this->Cliente_model->get_all($this->data["rentadevolucion"]->id_cliente);
        @$this->data["vehiculo"] = $this->Vehiculo_model->get_all($this->data["rentadevolucion"]->id_vehiculo);
        @$this->data["empleado"] = $this->Usuario_model->getById($this->data["rentadevolucion"]->id_empleado);
        
        //Validaciones
        $this->form_validation->set_rules('idRenta', 'Renta', 'required|integer', 
        array(
        'required' => 'Debe seleccionar un {field}.',
        'integer' => 'Debe seleccionar un {field} válido.'
        ));

        $this->form_validation->set_rules('comentario', 'Comentario', 'max_length[1000]', 
        array(
            'max_length' => 'El valor de la {field} no debe sobrepasar los {param} caracteres.',
        ));

        //Evaluando Campos
        if ($this->form_validation->run() === FALSE)
        {
            $this->load->view('Templates/header', $this->data);
            $this->load->view('Devolucion/Proceso');
            $this->load->view('Templates/footer'); 
        }
        else
        {
            //echo "Carro Devuelto!";
            /*
            //$this->load->helper('date');
            */

            $renta = $this->Renta_model->getOpenById($this->input->post('idRenta'));

            $fechahoy = new DateTime('today', new DateTimeZone('America/Caracas'));
            $fechaseleccionada = new DateTime($renta->fecharenta, new DateTimeZone('America/Caracas'));
            $segundosdiferencia = ((strtotime($fechahoy->format('Y-m-d')))-(strtotime($fechaseleccionada->format('Y-m-d'))));
            $cantidaddias = $segundosdiferencia/86400; 

            $data = array(
                'fechadevolucion' =>  $fechahoy->format('Y-m-d'),
                'cantidaddias' => ($cantidaddias == 0)?1:$cantidaddias,
                'comentario' => $this->input->post('comentario'),
                'estado' => '0',
            );
            /*
            echo "<pre>";
            var_dump($data);
            echo "<pre>";
            */
            //Vehiculo estado inactivo
            $this->Vehiculo_model->put($renta->id_vehiculo, array('estado' => '1'));
            $returnedId = $this->Renta_model->put($renta->id, $data);
            //$this->Cliente_model->put();
            
            redirect(base_url().'renta/detalle/'.$renta->id);
        }
    }
}