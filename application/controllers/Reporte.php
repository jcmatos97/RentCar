<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reporte extends CI_Controller {
    var $data;
    
    function __construct() 
    {
        parent::__construct();
        $this->load->library('session');
        sesion_requerida();
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model('Vehiculo_model');
        $this->load->model('Renta_model');
        //Datos del Navbar
        $this->data["nombre"] = $this->session->userdata('nombre');
        $this->data["apellido"] = $this->session->userdata('apellido');
        $this->data["usuario"] = $this->session->userdata('usuario');
    }

	public function index()
    {
        $this->data['title'] = 'Reportería RentCar';

        //Parametros de Busqueda
        $searchParameters = array();

        //Cargando Modelos faltantes
        $this->load->model('Usuario_model');
        $this->load->model('Cliente_model');

        //Validaciones
        $this->form_validation->set_rules('vehiculo', 'Vehiculo', 'max_length[50]|alpha_numeric_spaces', 
        array(
            'max_length' => 'El {field} no debe tener mas de {param} caracteres.',
            'alpha_numeric_spaces' => 'El {field} solo debe tener caracteres alfabeticos y numericos.'
        ));

        $this->form_validation->set_rules('no_placa', 'Numero de Placa', 'exact_length[7]|alpha_numeric', 
        array(
            'exact_length' => 'El {field} debe tener exactamente {param} caracteres.',
            'alpha_numeric' => 'El {field} solo debe tener caracteres alfabeticos y numericos, sin espacios.'
        ));

        $this->form_validation->set_rules('cliente', 'Cliente', 'max_length[61]|alpha_space', 
        array(
            'max_length' => 'El campo {field} debe tener como máximo {param} caracteres.',
            'alpha_space' => 'El campo {field} solo debe tener caracteres alfabeticos y espacios.'
        ));

        $this->form_validation->set_rules('empleado', 'Empleado', 'max_length[61]|alpha_space', 
        array(
            'max_length' => 'El campo {field} debe tener como máximo {param} caracteres.',
            'alpha_space' => 'El campo {field} solo debe tener caracteres alfabeticos y espacios.'
        ));

        $this->form_validation->set_rules('fecharentamin', 'Fecha de Renta Minima', 'valid_date', 
        array(
        'valid_date' => 'El campo {field} no es una fecha válida.',
        ));

        $this->form_validation->set_rules('fecharentamax', 'Fecha de Renta Maxima', 'valid_date', 
        array(
        'valid_date' => 'El campo {field} no es una fecha válida.',
        ));

        $this->form_validation->set_rules('fechadevoluciondmin', 'Fecha de Devolucion Minima', 'valid_date', 
        array(
        'valid_date' => 'El campo {field} no es una fecha válida.',
        ));

        $this->form_validation->set_rules('fechadevoluciondmax', 'Fecha de Devolucion Maxima', 'valid_date', 
        array(
        'valid_date' => 'El campo {field} no es una fecha válida.',
        ));

        $this->form_validation->set_rules('montototalmin', 'Monto Total Minimo', 'integer', 
        array(
        'integer' => 'El campo {field} no es un numero entero.',
        ));

        $this->form_validation->set_rules('montototalmax', 'Monto Total Maximo', 'integer', 
        array(
        'integer' => 'El campo {field} no es un numero entero.',
        ));

        if ($this->form_validation->run() === FALSE)
        {
            //obteniendo data
            $this->data["datashow"] = ($this->Renta_model->getClosedParam($searchParameters));

            $this->data["isEnabledSearch"] = (($this->input->post('isEnabledSearch')) !== null)?"1":"0";
    
            $this->load->view('Templates/header-datatable', $this->data);
            $this->load->view('Reporte/index');
        }
        else
        {
            /*
            */
            if($this->input->post("vehiculo") !== "")
            {
                $searchParameters["CONCAT((marcavehiculo.nombre),(' '),(modelovehiculo.nombre)) LIKE"] = "%".$this->input->post("vehiculo")."%";
            }
            if($this->input->post("no_placa") !== "")
            {
                $searchParameters["placa LIKE"] = "%".$this->input->post("no_placa")."%";
            }
            if($this->input->post("cliente") !== "")
            {
                $searchParameters["CONCAT((cliente.nombre),(' '),(cliente.apellido)) LIKE"] = "%".$this->input->post("cliente")."%";
            }
            if($this->input->post("empleado") !== "")
            {
                $searchParameters["CONCAT((empleado.nombre),(' '),(empleado.apellido)) LIKE"] = "%".$this->input->post("empleado")."%";
            }
            if($this->input->post("montototalmin") !== "")
            {
                $searchParameters["(rentadevolucion.montopordia*rentadevolucion.cantidaddias) >="] = $this->input->post("montototalmin");
            }
            if($this->input->post("montototalmax") !== "")
            {
                $searchParameters["(rentadevolucion.montopordia*rentadevolucion.cantidaddias) <="] = $this->input->post("montototalmax");
            }
            if($this->input->post("fecharentamin") !== "")
            {
                $searchParameters["fecharenta >="] = $this->input->post("fecharentamin");
            }
            if($this->input->post("fecharentamax") !== "")
            {
                $searchParameters["fecharenta <="] = $this->input->post("fecharentamax");
            }
            if($this->input->post("fechadevoluciondmin") !== "")
            {
                $searchParameters["fechadevolucion >="] = $this->input->post("fechadevoluciondmin");
            }
            if($this->input->post("fechadevoluciondmax") !== "")
            {
                $searchParameters["fechadevolucion <="] = $this->input->post("fechadevoluciondmax");
            }

            //obteniendo data
            $this->data["datashow"] = ($this->Renta_model->getClosedParam($searchParameters));

            $fieldsSearched = (object) [
                'vehiculo' => $this->input->post('vehiculo'),
                'no_placa' => $this->input->post('no_placa'),
                'cliente' => $this->input->post('cliente'),
                'empleado' => $this->input->post('empleado'),
                'montototalmin' => $this->input->post('montototalmin'),
                'montototalmax' => $this->input->post('montototalmax'),
                'fecharentamin' => $this->input->post('fecharentamin'),
                'fecharentamax' => $this->input->post('fecharentamax'),
                'fechadevoluciondmin' => $this->input->post('fechadevoluciondmin'),
                'fechadevoluciondmax' => $this->input->post('fechadevoluciondmax')
              ];

            $this->data["isEnabledSearch"] = (($this->input->post('isEnabledSearch')) !== null)?"1":"0";
    
            $this->load->view('Templates/header-datatable', $this->data);
            $this->load->view('Reporte/index');
        }
    }
}
