<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cliente extends CI_Controller {
    
    var $data;
    var $filename;
    
    function __construct() 
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model('Cliente_model');
        sesion_requerida();

        //Datos del Navbar
        $this->data["nombre"] = $this->session->userdata('nombre');
        $this->data["apellido"] = $this->session->userdata('apellido');
        $this->data["usuario"] = $this->session->userdata('usuario');
    }

	public function Agregar()
	{
        $this->data['title'] = 'Agregar Cliente';

        //Tarjetas de Credito, nombres y siglas
        $nombresCC = array('American Express', 'China Unionpay', 'Diners Club CarteBlance', 'Diners Club', 'Discover Card', 'Interpayment', 'JCB', 'Maestro', 'Dankort', 'NSPK MIR', 'Troy', 'MasterCard', 'Visa', 'UATP', 'Verve', 'CIBC Convenience Card', 'Royal Bank of Canada Client Card', 'TD Canada Trust Access Card', 'Scotiabank Scotia Card', 'BMO ABM Card', 'HSBC Canada Card'); 
        $siglasCC = array('amex', 'unionpay', 'carteblanche', 'dinersclub', 'discover', 'interpayment', 'jcb', 'maestro', 'dankort', 'mir', 'troy', 'mastercard', 'visa', 'uat', 'verve', 'cibc', 'rbc', 'tdtrust', 'scotia', 'bmoabm', 'hsbc');

        //Apartado de Subida de Archivos
        $config['upload_path']          = './archivos/';
        $config['allowed_types']        = 'gif|jpg|png';
        $config['max_size']             = 10*1024;
        
        $this->load->library('upload', $config);
        //

        /*Validaciones*/
        //Modelo del Cliente    
        $this->form_validation->set_rules('nombre', 'Nombre', 'required|max_length[30]|alpha_space', 
        array(
            'required' => 'El campo {field} es requerido.',
            'max_length' => 'El {field} debe tener como máximo {param} caracteres.',
            'alpha_space' => 'El {field} solo debe tener caracteres alfabeticos y espacios.'
        ));

        $this->form_validation->set_rules('apellido', 'Apellido', 'required|max_length[30]|alpha_space', 
        array(
            'required' => 'El campo {field} es requerido.',
            'max_length' => 'El {field} debe tener como máximo {param} caracteres.',
            'alpha_space' => 'El {field} solo debe tener caracteres alfabeticos y espacios.'
        ));
        
        $this->form_validation->set_rules('cedula', 'Cédula', 'required|exact_length[11]|numeric|validate_identity_number|is_unique[cliente.cedula]', 
        array(
            'required' => 'El campo {field} es requerido.',
            'exact_length' => 'La {field} debe tener exactamente {param} caracteres.',
            'numeric' => 'La {field} solo debe tener caracteres numéricos.',
            'validate_identity_number' => 'La {field} no es válida.',
            'is_unique' => 'La {field} ya existe en la base de datos, digite una diferente'
        ));

        $this->form_validation->set_rules('tipopersona', 'Tipo de Persona', 'required|integer', 
        array(
            'required' => 'El campo {field} es requerido.',
            'integer' => 'El valor de la {field} no es válido.'
        ));
        
        $this->form_validation->set_rules('foto', 'Foto', 'callback_subirArchivo');
        
        $this->form_validation->set_rules('no_tarjetadecredito', 'Numero de Tarjeta de Credito', 'required|numeric|validate_creditcard['.$this->input->post('tipotarjeta').']|is_unique[cliente.no_tarjetadecredito]',
        array(
            'required' => 'El {field} es requerido.',
            'numeric' => 'El {field} solo debe tener caracteres numéricos.',
            'validate_creditcard' => 'El numero de ingresado no es una tarjeta '.$nombresCC[array_search($this->input->post('tipotarjeta'), $siglasCC)].' válida.',
            'is_unique' => 'El {field} ya esta en uso, digite una diferente'
        ));

        $this->form_validation->set_rules('tipotarjeta', 'Tipo de Tarjeta', 'required|max_length[50]|alpha', 
        array(
            'required' => 'El {field} es requerido.',
            'max_length' => 'El {field} debe tener como máximo {param} caracteres.',
            'alpha' => 'El valor de la {field} solo debe tener caracteres alfabeticos.'
        ));
        
        $this->form_validation->set_rules('limitecredito', 'Limite de Credito', 'required|integer|greater_than[0]|less_than[10000000000]', 
        array(
            'required' => 'El {field} es obligatorio.',
            'integer' => 'El valor debe ser un entero.',
            'greater_than' => 'El {field} debe ser mayor a {param}.',
            'less_than' => 'El {field} debe ser menor a {param}.'
        ));

        $this->form_validation->set_rules('codigotarjeta', 'Codigo de Tarjeta', 'required|exact_length[3]|integer', 
        array(
            'required' => 'El {field} es obligatorio.',
            'exact_length' => 'El {field} debe tener {param} caracteres.',
            'integer' => 'El valor debe ser un entero.'
        ));

        $this->form_validation->set_rules('mes', 'Mes', 'required|integer|greater_than[0]|less_than[13]', 
        array(
            'required' => 'El {field} es obligatorio.',
            'integer' => 'El valor debe ser un entero.',
            'greater_than' => 'El valor del {field} debe ser valido.',
            'less_than' => 'El valor del {field} debe ser valido.'
        ));

        $this->form_validation->set_rules('anio', 'Año', 'required|integer|greater_than['.(date('Y')-1).']|less_than['.(date('Y')+11).']', 
        array(
            'required' => 'El {field} es obligatorio.',
            'integer' => 'El valor debe ser un entero.',
            'greater_than' => 'El {field} debe ser mayor a {param}.',
            'less_than' => 'El {field} debe ser menor a {param}.'
        ));

        //Evaluando Campos
        if ($this->form_validation->run() === FALSE)
        { 
            //Borramos la foto porque el formulario tiene inconsistencias
            @unlink('./archivos/'.$this->filename);

            $this->load->view('Templates/header', $this->data);
            $this->load->view('Cliente/Agregar');
            $this->load->view('Templates/footer');
        }
        else
        {
            $data = array(
                'nombre' => $this->input->post('nombre'),
                'apellido' => $this->input->post('apellido'),
                'cedula' => $this->input->post('cedula'),
                'tipopersona' => $this->input->post('tipopersona'),
                'foto' => $this->filename,
                'no_tarjetadecredito' => $this->input->post('no_tarjetadecredito'),
                'limitecredito' => $this->input->post('limitecredito'),
                'codigotarjeta' => $this->input->post('codigotarjeta'),
                'expiraciontarjeta' => $this->input->post('mes').'-'.$this->input->post('anio'),
                'estado' => '1'
            );
            $id_inserted = $this->Cliente_model->post($data);
            redirect(base_url().'cliente/detalle/'.$id_inserted);
        }
    }
    
    public function Actualizar($param)
	{
        if(!$param)
        {
            show_404();
        }

        $this->data['title'] = 'Actualizar Cliente';

        //Tarjetas de Credito, nombres y siglas
        $nombresCC = array('American Express', 'China Unionpay', 'Diners Club CarteBlance', 'Diners Club', 'Discover Card', 'Interpayment', 'JCB', 'Maestro', 'Dankort', 'NSPK MIR', 'Troy', 'MasterCard', 'Visa', 'UATP', 'Verve', 'CIBC Convenience Card', 'Royal Bank of Canada Client Card', 'TD Canada Trust Access Card', 'Scotiabank Scotia Card', 'BMO ABM Card', 'HSBC Canada Card'); 
        $siglasCC = array('amex', 'unionpay', 'carteblanche', 'dinersclub', 'discover', 'interpayment', 'jcb', 'maestro', 'dankort', 'mir', 'troy', 'mastercard', 'visa', 'uat', 'verve', 'cibc', 'rbc', 'tdtrust', 'scotia', 'bmoabm', 'hsbc');

        //Apartado de Subida de Archivos
        $config['upload_path']          = './archivos/';
        $config['allowed_types']        = 'gif|jpg|png';
        $config['max_size']             = 10*1024;
        
        $this->load->library('upload', $config);
        //

        /*Validaciones*/
        //Modelo del Cliente    
        $this->form_validation->set_rules('nombre', 'Nombre', 'required|max_length[30]|alpha_space', 
        array(
            'required' => 'El campo {field} es requerido.',
            'max_length' => 'El {field} debe tener como máximo {param} caracteres.',
            'alpha_space' => 'El {field} solo debe tener caracteres alfabeticos y espacios.'
        ));

        $this->form_validation->set_rules('apellido', 'Apellido', 'required|max_length[30]|alpha_space', 
        array(
            'required' => 'El campo {field} es requerido.',
            'max_length' => 'El {field} debe tener como máximo {param} caracteres.',
            'alpha_space' => 'El {field} solo debe tener caracteres alfabeticos y espacios.'
        ));
        
        $this->form_validation->set_rules('cedula', 'Cédula', 'required|exact_length[11]|numeric|validate_identity_number|edit_unique[cliente.cedula.'.$param.']', 
        array(
            'required' => 'El campo {field} es requerido.',
            'exact_length' => 'La {field} debe tener exactamente {param} caracteres.',
            'numeric' => 'La {field} solo debe tener caracteres numéricos.',
            'validate_identity_number' => 'La {field} no es válida.',
            'edit_unique' => 'La {field} ya existe en la base de datos, digite una diferente o deje el valor anterior'
        ));

        $this->form_validation->set_rules('tipopersona', 'Tipo de Persona', 'required|integer', 
        array(
            'required' => 'El campo {field} es requerido.',
            'integer' => 'El valor de la {field} no es válido.'
        ));
        
        $this->form_validation->set_rules('foto', 'Foto', 'callback_subirArchivoUpdate');


        //Activar validaciones de tarjeta si la opción esta activada
        if(($this->input->post('isEnabledUpdate')) !== null)
        {

            $this->form_validation->set_rules('no_tarjetadecredito', 'Numero de Tarjeta de Credito', 'required|numeric|validate_creditcard['.$this->input->post('tipotarjeta').']|edit_unique[cliente.no_tarjetadecredito.'.$param.']',
            array(
                'required' => 'El {field} es requerido.',
                'numeric' => 'El {field} solo debe tener caracteres numéricos.',
                'validate_creditcard' => 'El numero de ingresado no es una tarjeta '.$nombresCC[array_search($this->input->post('tipotarjeta'), $siglasCC)].' válida.',
                'edit_unique' => 'La {field} ya existe en la base de datos, digite una diferente o deje el valor anterior'
            ));
            
            $this->form_validation->set_rules('tipotarjeta', 'Tipo de Tarjeta', 'required|max_length[50]|alpha', 
            array(
                'required' => 'El {field} es requerido.',
                'max_length' => 'El {field} debe tener como máximo {param} caracteres.',
                'alpha' => 'El valor de la {field} solo debe tener caracteres alfabeticos.'
            ));
            
            $this->form_validation->set_rules('limitecredito', 'Limite de Credito', 'required|integer|greater_than[0]|less_than[10000000000]', 
            array(
                'required' => 'El {field} es obligatorio.',
                'integer' => 'El valor debe ser un entero.',
                'greater_than' => 'El {field} debe ser mayor a {param}.',
                'less_than' => 'El {field} debe ser menor a {param}.'
            ));
            
            $this->form_validation->set_rules('codigotarjeta', 'Codigo de Tarjeta', 'required|exact_length[3]|integer', 
            array(
                'required' => 'El {field} es obligatorio.',
                'exact_length' => 'El {field} debe tener {param} caracteres.',
                'integer' => 'El valor debe ser un entero.'
            ));
            
            $this->form_validation->set_rules('mes', 'Mes', 'required|integer|greater_than[0]|less_than[13]', 
            array(
                'required' => 'El {field} es obligatorio.',
                'integer' => 'El valor debe ser un entero.',
                'greater_than' => 'El valor del {field} debe ser valido.',
                'less_than' => 'El valor del {field} debe ser valido.'
            ));
            
            $this->form_validation->set_rules('anio', 'Año', 'required|integer|greater_than['.(date('Y')-1).']|less_than['.(date('Y')+11).']', 
            array(
                'required' => 'El {field} es obligatorio.',
                'integer' => 'El valor debe ser un entero.',
                'greater_than' => 'El {field} debe ser mayor a {param}.',
                'less_than' => 'El {field} debe ser menor a {param}.'
            ));
        }
        
        //Evaluando Campos
        if ($this->form_validation->run() === FALSE)
        { 
            //Borramos la foto porque el formulario tiene inconsistencias
            @unlink('./archivos/'.$this->filename);

            //Datos 
            $this->data["datashow"] = $this->Cliente_model->get($param)[0];
            $this->data["isEnabledUpdate"] = (($this->input->post('isEnabledUpdate')) !== null)?"1":"0";

            $this->load->view('Templates/header', $this->data);
            $this->load->view('Cliente/Actualizar');
            $this->load->view('Templates/footer');
        }
        else
        {
            $data = array(
                'nombre' => $this->input->post('nombre'),
                'apellido' => $this->input->post('apellido'),
                'cedula' => $this->input->post('cedula'),
                'tipopersona' => $this->input->post('tipopersona'),
            );
            
            //Activar validaciones de tarjeta si la opción esta activada
            if(($this->input->post('isEnabledUpdate')) !== null)
            {
                //Check if photo is empty before update
                (($this->filename))?$data['foto']=$this->filename:'';
                (($this->input->post('no_tarjetadecredito')) !== "")?$data['no_tarjetadecredito']=$this->input->post('no_tarjetadecredito'):'';
                (($this->input->post('limitecredito')) !== "")?$data['limitecredito']=$this->input->post('limitecredito'):'';
                (($this->input->post('codigotarjeta')) !== "")?$data['codigotarjeta']=$this->input->post('codigotarjeta'):'';
                (($this->input->post('mes') !== "")||($this->input->post('anio') !== ""))?$data['expiraciontarjeta']=$this->input->post('mes').'-'.$this->input->post('anio'):'';
            }
            
            $this->Cliente_model->put($param, $data);
            redirect(base_url().'cliente/detalle/'.$param);
        }
    }

    public function Detalle($param)
	{
        if(!$param)
        {
            show_404();
        }
        
        $this->data['title'] = 'Detalle del Cliente';

        //Datos Foraneos
        $this->data["datashow"] = $this->Cliente_model->get($param)[0];

        //Librerias
        require_once 'system/libraries/CreditCardRules.php';
        $this->data['ccValidator'] = new CreditCardRules();

        $this->load->view('Templates/header', $this->data);
        $this->load->view('Cliente/Detalle');
        $this->load->view('Templates/footer');
    }

    public function Eliminar($param)
	{
        if(!$param)
        {
            show_404();
        }
        
        $data = array(
            'estado' => 0
        );
        
        $this->Cliente_model->delete($param, $data);
        redirect(base_url().'cliente');
    }
    
    public function index()
	{
        $this->data['title'] = 'Clientes';

        //Datos Foraneos
        $this->data["datashow"] = $this->Cliente_model->get();

        $this->load->view('Templates/header-datatable', $this->data);
        $this->load->view('Cliente/Mostrar');
        //$this->load->view('Templates/footer');
    }
    
    function subirArchivo()
    {
        if($this->upload->do_upload('foto'))
        {
            $this->filename = $this->upload->data()['file_name'];
            $this->form_validation->set_message('subirArchivo', 'Archivo arriba.');
            return true;
        }
        else
        {
            $msg = $this->upload->display_errors();
            $is_empty = "<p>You did not select a file to upload.</p>";
            $is_not_allowed = "<p>The filetype you are attempting to upload is not allowed.</p>";
            $is_oversized = "<p>The file you are attempting to upload is larger than the permitted size.</p>";

            if($msg === $is_empty)
            {
                $this->form_validation->set_message('subirArchivo', 'No haz seleccionado un archivo para subir.');
                return false;
            }
            else if($msg === $is_not_allowed)
            {
                $this->form_validation->set_message('subirArchivo', 'Solo los formatos gif, jpg y png estan permitidos.');
                return false;
            }        
            else if($msg === $is_oversized)
            {
                $this->form_validation->set_message('subirArchivo', 'El tamaño del archivo sobrepasa los 10 MB.');
                return false;
            }
        }
    }

    public function subirArchivoUpdate()
    {
        if($this->upload->do_upload('foto'))
        {
            $this->filename = $this->upload->data()['file_name'];
            $this->form_validation->set_message('subirArchivo', 'Archivo arriba.');
            return true;
        }
        else
        {
            $msg = $this->upload->display_errors();
            $is_empty = "<p>You did not select a file to upload.</p>";
            $is_not_allowed = "<p>The filetype you are attempting to upload is not allowed.</p>";
            $is_oversized = "<p>The file you are attempting to upload is larger than the permitted size.</p>";

            if($msg === $is_empty)
            {
                return true;
            }
            else if($msg === $is_not_allowed)
            {
                $this->form_validation->set_message('subirArchivo', 'Solo los formatos gif, jpg y png estan permitidos.');
                return false;
            }        
            else if($msg === $is_oversized)
            {
                $this->form_validation->set_message('subirArchivo', 'El tamaño del archivo sobrepasa los 10 MB.');
                return false;
            }
        }
    }
}