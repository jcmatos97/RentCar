<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Renta extends CI_Controller {

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
        $this->data['title'] = 'Rentar un Vehiculo';

        //Datos Foraneos
        $this->load->model('ModeloVehiculo_model');
        $this->load->model('TipoCombustible_model');
        $this->load->model('MarcaVehiculo_model');
        $this->data["modelos"] = $this->ModeloVehiculo_model->get();
        $this->data["combustibles"] = $this->TipoCombustible_model->get();
        $this->data["marcas"] = $this->MarcaVehiculo_model->get();

        //Validaciones
        $this->form_validation->set_rules('modelovehiculo', 'Modelo del Vehiculo', 'integer', 
        array(
            'integer' => 'El valor de la {field} tiene que ser un entero.'
        ));

        $this->form_validation->set_rules('marcavehiculo', 'Marca del Vehiculo', 'integer', 
        array(
            'integer' => 'El valor de la {field} tiene que ser un entero.'
        ));

        $this->form_validation->set_rules('tipocombustible', 'Tipo de Combustible', 'integer', 
        array(
            'integer' => 'El valor de la {field} tiene que ser un entero.'
        ));

        $this->form_validation->set_rules('preciominimo', 'Precio Minimo', 'integer', 
        array(
            'integer' => 'El valor debe ser un entero.'
        ));

        $this->form_validation->set_rules('preciomaximo', 'Precio Maximo', 'integer', 
        array(
            'integer' => 'El valor debe ser un entero.'
        ));
        //Evaluando Campos
        if ($this->form_validation->run() === FALSE)
        {
            //Parametros de Busqueda
            $searchParameters = array();

            //Seccion Paginación
            $this->load->library("pagination");

            $config = array();
            $config["base_url"] = base_url() . "renta";
            $config["total_rows"] = $this->Vehiculo_model->get_count($searchParameters);
            $config["per_page"] = 8;
            $config["uri_segment"] = 2;
            $config["full_tag_open"] = "<ul class='pagination'>";
            $config["full_tag_close"] = "</ul>";
            $config["first_link"] = FALSE;

            $config["first_tag_open"] = "<li class='page-item'>";
            $config["first_tag_close"] = "</li>";

            $config["last_link"] = FALSE;
            $config["last_tag_open"] = "<li class='page-item'>";
            $config["last_tag_close"] = "</li>";

            $config["next_link"] = "Siguiente";
            $config["next_tag_open"] = "<li class='page-item'>";
            $config["next_tag_close"] = "</li>";

            $config["prev_link"] = "Anterior";
            $config["prev_tag_open"] = "<li class='page-item'>";
            $config["prev_tag_close"] = "</li>";

            $config["cur_tag_open"] = "<li class='page-item active'><div class='page-link'>";
            $config["cur_tag_close"] = "</div></li>";

            $config["num_tag_open"] = "<li class='page-item'>";
            $config["num_tag_close"] = "</li>";

            $config["attributes"] = array('class' => 'page-link');

            $this->pagination->initialize($config);

            $page = ($this->uri->segment(2)) ? $this->uri->segment(2) : 0;
 
            $this->data["links"] = $this->pagination->create_links();
 
            $this->data['datashow'] = $this->Vehiculo_model->get_vehiculos($config["per_page"], $page, $searchParameters);

            $this->data["isEnabledSearch"] = (($this->input->post('isEnabledSearch')) !== null)?"1":"0";

            //Seccion Vistas y Templates 
            $this->load->view('Templates/header', $this->data);
            $this->load->view('Renta/index');
            $this->load->view('Templates/footer');
        }
        else
        {
            //Parametros de Busqueda
            $searchParameters = array();

            if($this->input->post('marcavehiculo') !== null)
            {
                $searchParameters["marcavehiculo.id ="] = $this->input->post('marcavehiculo');
            }
            if($this->input->post('modelovehiculo') !== null)
            {
                $searchParameters["modelovehiculo.id ="] = $this->input->post('modelovehiculo');
            }
            if($this->input->post('tipocombustible') !== null)
            {
                $searchParameters["tipocombustible.id ="] = $this->input->post('tipocombustible');
            }
            if($this->input->post('preciominimo') !== "")
            {
                $searchParameters["vehiculo.montopordia >="] = $this->input->post('preciominimo');
            }
            if($this->input->post('preciomaximo') !== "")
            {
                $searchParameters["vehiculo.montopordia <="] = $this->input->post('preciomaximo');
            }
            
            //Seccion Paginación
            $this->load->library("pagination");

            $config = array();
            $config["base_url"] = base_url() . "renta";
            $config["total_rows"] = $this->Vehiculo_model->get_count($searchParameters);
            $config["per_page"] = 8;
            $config["uri_segment"] = 2;
            $config["full_tag_open"] = "<ul class='pagination'>";
            $config["full_tag_close"] = "</ul>";
            $config["first_link"] = FALSE;

            $config["first_tag_open"] = "<li class='page-item'>";
            $config["first_tag_close"] = "</li>";
            
            $config["last_link"] = FALSE;
            $config["last_tag_open"] = "<li class='page-item'>";
            $config["last_tag_close"] = "</li>";
            
            $config["next_link"] = "Siguiente";
            $config["next_tag_open"] = "<li class='page-item'>";
            $config["next_tag_close"] = "</li>";
            
            $config["prev_link"] = "Anterior";
            $config["prev_tag_open"] = "<li class='page-item'>";
            $config["prev_tag_close"] = "</li>";
            
            $config["cur_tag_open"] = "<li class='page-item active'><div class='page-link'>";
            $config["cur_tag_close"] = "</div></li>";

            $config["num_tag_open"] = "<li class='page-item'>";
            $config["num_tag_close"] = "</li>";

            $config["attributes"] = array('class' => 'page-link');

            $this->pagination->initialize($config);

            $page = ($this->uri->segment(2)) ? $this->uri->segment(2) : 0;

            $this->data["links"] = $this->pagination->create_links();
            $this->data['datashow'] = $this->Vehiculo_model->get_vehiculos($config["per_page"], $page, $searchParameters);
            $this->data["isEnabledSearch"] = (($this->input->post('isEnabledSearch')) !== null)?"1":"0";

           
            $fieldsSearched = (object) [
                'marcavehiculo' => $this->input->post('marcavehiculo'),
                'modelovehiculo' => $this->input->post('modelovehiculo'),
                'tipocombustible' => $this->input->post('tipocombustible'),
                'preciominimo' => $this->input->post('preciominimo'),
                'preciomaximo' => $this->input->post('preciomaximo')
              ];

            $this->data['fieldsSearched'] = $fieldsSearched;

            //Seccion Vistas y Templates 
            $this->load->view('Templates/header', $this->data);
            $this->load->view('Renta/index');
            $this->load->view('Templates/footer');
        }
    }

    public function Proceso($param)
    {
        if(!$param)
        {
            show_404();
        }

        $this->data['title'] = 'Proceso de Renta';
        
        //Datos Foraneos
        @$this->data["datashow"] = $this->Vehiculo_model->get($param)[0];
        $this->load->model('Cliente_model');
        $this->data["clientes"] = $this->Cliente_model->get();
        
        //Validaciones
        $this->form_validation->set_rules('idCarro', 'Vehiculo', 'required|integer|check_status[vehiculo.id]', 
        array(
        'required' => 'Debe seleccionar un {field}.',
        'integer' => 'Debe seleccionar un {field} válido.',
        'check_status' => 'Debe seleccionar un {field} activo.'
        ));

        $this->form_validation->set_rules('fechalimite', 'Fecha Limite', 'required|valid_date|tomorrow_or_higher', 
        array(
        'required' => 'Debe seleccionar una {field}.',
        'valid_date' => 'Debe ingresar una {field} valida.',
        'tomorrow_or_higher' => 'La {field} deber tener como mínimo la fecha de mañana.'
        ));

        $this->form_validation->set_rules('cliente', 'Cliente', 'required|integer|check_status[cliente.id]', 
        array(
        'required' => 'Debe seleccionar un {field}.',
        'integer' => 'Debe seleccionar un {field} válido.',
        'check_status' => 'Debe seleccionar un {field} activo.'
        ));

        //Evaluando Campos
        if ($this->form_validation->run() === FALSE)
        {
            $this->load->view('Templates/header', $this->data);
            $this->load->view('Renta/Proceso');
            $this->load->view('Templates/footer'); 
        }
        else
        {
            //$this->load->helper('date');

            $vehiculo = $this->Vehiculo_model->get($this->input->post('idCarro'))[0];
            //$cliente = $this->Cliente_model->get($this->input->post('cliente'))[0];

            $montopordia = $vehiculo->montopordia+($vehiculo->montopordia*0.18);
            $fechahoy = new DateTime('today', new DateTimeZone('America/Caracas'));
            $fechaseleccionada = new DateTime($this->input->post('fechalimite'), new DateTimeZone('America/Caracas'));
            $segundosdiferencia = ((strtotime($fechaseleccionada->format('Y-m-d')))-(strtotime($fechahoy->format('Y-m-d'))));
            $cantidaddias = $segundosdiferencia/86400; 

            $data = array(
                'fecharenta' => $fechahoy->format('Y-m-d'),
                'fechadevolucion' =>  $fechaseleccionada->format('Y-m-d'),
                'montopordia' => $montopordia,
                'cantidaddias' => $cantidaddias,
                'comentario' => '',
                'estado' => '1',
                'id_empleado' => $this->session->id,
                'id_vehiculo' => $this->input->post('idCarro'),
                'id_cliente' => $this->input->post('cliente')
            );

            //Vehiculo estado inactivo
            $this->Vehiculo_model->put($this->input->post('idCarro'), array('estado' => '0'));
            $returnedId = $this->Renta_model->post($data);
            //$this->Cliente_model->put();
            
            redirect(base_url().'renta/detalle/'.$returnedId);
        }
        
    }

    public function Detalle()
    {
        $args = func_get_args();
        if (count(func_get_args()) == 0)
        {
            $this->data['title'] = 'Historico de Rentas';

            //Cargando Modelos faltantes
            $this->load->model('Usuario_model');
            $this->load->model('Cliente_model');
            
            foreach ($this->Renta_model->getClosed() as $value) 
            {
                $this->data["datashow"][] = (object)[
                    "rentadevolucion" => $value,
                    "cliente" =>  $this->Cliente_model->get_all($value->id_cliente),
                    "vehiculo" =>  $this->Vehiculo_model->get_all($value->id_vehiculo),
                    "empleado" =>  $this->Usuario_model->getById($value->id_empleado),
                ];
            }            

            $this->load->view('Templates/header-datatable', $this->data);
            $this->load->view('Renta/Mostrar');
        }
        elseif (count(func_get_args()) == 1)
        {
            $param = $args[0];
            $this->data['title'] = 'Detalle de Renta';

            //Cargando Modelos faltantes
            $this->load->model('Usuario_model');
            $this->load->model('Cliente_model');

            //Datos Foraneos
            $this->data["rentadevolucion"] = $this->Renta_model->get($param);
            @$this->data["cliente"] = $this->Cliente_model->get_all($this->data["rentadevolucion"]->id_cliente);
            @$this->data["vehiculo"] = $this->Vehiculo_model->get_all($this->data["rentadevolucion"]->id_vehiculo);
            @$this->data["empleado"] = $this->Usuario_model->getById($this->data["rentadevolucion"]->id_empleado);
            
            $this->load->view('Templates/header', $this->data);
            $this->load->view('Renta/Detalle');
            $this->load->view('Templates/footer');
        }
    }
}