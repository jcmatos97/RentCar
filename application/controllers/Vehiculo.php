<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Vehiculo extends CI_Controller {

    var $data;
    var $filename;
    
    function __construct() 
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model('Vehiculo_model');
        sesion_requerida();
        
        //Datos del Navbar
        $this->data["nombre"] = $this->session->userdata('nombre');
        $this->data["apellido"] = $this->session->userdata('apellido');
        $this->data["usuario"] = $this->session->userdata('usuario');

    }
    
	public function Agregar()
	{
        $this->data['title'] = 'Agregar Vehiculo';
        
        //Datos Foraneos
        $this->load->model('ModeloVehiculo_model');
        $this->load->model('TipoCombustible_model');
        $this->data["modelos"] = $this->ModeloVehiculo_model->get();
        $this->data["combustibles"] = $this->TipoCombustible_model->get();

        //Apartado de Subida de Archivos
        $config['upload_path']          = './archivos/';
        $config['allowed_types']        = 'gif|jpg|png';
        $config['max_size']             = 10*1024;

        $this->load->library('upload', $config);
        //
        
        /*Validaciones*/
        //Modelo de Vehiculo
        $this->form_validation->set_rules('no_chasis', 'Numero de Chasis', 'required|exact_length[17]|alpha_numeric|is_unique[vehiculo.no_chasis]', 
        array(
            'required' => 'El campo {field} es requerido.',
            'exact_length' => 'El {field} debe tener exactamente {param} caracteres.',
            'alpha_numeric' => 'El {field} solo debe tener caracteres alfabeticos y numericos, sin espacios.',
            'is_unique' => 'El valor "'.$this->input->post('no_chasis').'" ya existe en la base de datos, digite uno diferente.'
        ));

        $this->form_validation->set_rules('no_motor', 'Numero de Motor', 'required|exact_length[6]|alpha_numeric|is_unique[vehiculo.no_motor]', 
        array(
            'required' => 'El campo {field} es requerido.',
            'exact_length' => 'El {field} debe tener exactamente {param} caracteres.',
            'alpha_numeric' => 'El {field} solo debe tener caracteres alfabeticos y numericos, sin espacios.',
            'is_unique' => 'El valor "'.$this->input->post('no_motor').'" ya existe en la base de datos, digite uno diferente.'
        ));
        
        $this->form_validation->set_rules('no_placa', 'Numero de Placa', 'required|exact_length[7]|alpha_numeric|is_unique[vehiculo.no_placa]', 
        array(
            'required' => 'El campo {field} es requerido.',
            'exact_length' => 'El {field} debe tener exactamente {param} caracteres.',
            'alpha_numeric' => 'El {field} solo debe tener caracteres alfabeticos y numericos, sin espacios.',
            'is_unique' => 'El valor "'.$this->input->post('no_placa').'" ya existe en la base de datos, digite uno diferente.'
        ));
        
        $this->form_validation->set_rules('modelovehiculo', 'Modelo del Vehiculo', 'required|integer', 
        array(
            'required' => 'El campo {field} es requerido.',
            'integer' => 'El valor de la {field} tiene que ser un entero.'
        ));

        $this->form_validation->set_rules('tipocombustible', 'Tipo de Combustible', 'required|integer', 
        array(
            'required' => 'El campo {field} es requerido.',
            'integer' => 'El valor de la {field} tiene que ser un entero.'
        ));

        $this->form_validation->set_rules('foto', 'Foto', 'callback_subirArchivo');

        $this->form_validation->set_rules('montopordia', 'Monto por Dia', 'required|integer', 
        array(
            'required' => 'El {field} es obligatorio.',
            'integer' => 'El valor debe ser un entero.'
        ));

        $this->form_validation->set_rules('descripcion', 'Descripcion', 'max_length[1000]', 
        array(
            'max_length' => 'El valor de la {field} no debe sobrepasar los {param} caracteres.',
        ));

        //Evaluando Campos
        if ($this->form_validation->run() === FALSE)
        { 
            //Borramos la foto porque el formulario tiene inconsistencias
            @unlink('./archivos/'.$this->filename);

            $this->load->view('Templates/header', $this->data);
            $this->load->view('Vehiculo/Vehiculo/Agregar');
            $this->load->view('Templates/footer');
        }
        else
        {
            $data = array(
                'descripcion' => $this->input->post('descripcion'),
                'no_chasis' => $this->input->post('no_chasis'),
                'no_motor' => $this->input->post('no_motor'),
                'no_placa' => $this->input->post('no_placa'),
                'foto' => $this->filename,
                'montopordia' => $this->input->post('montopordia'),
                'estado' => '1',
                'id_modelovehiculo' => $this->input->post('modelovehiculo'),
                'id_tipocombustible' => $this->input->post('tipocombustible'),
            );
            $id_inserted = $this->Vehiculo_model->post($data);
            redirect(base_url().'vehiculo/detalle/'.$id_inserted);
        }
    }
    
    public function Actualizar($param)
	{
        if(!$param)
        {
            show_404();
        }

        $this->data['title'] = 'Actualizar Vehiculo';
        
        //Datos Foraneos
        $this->load->model('ModeloVehiculo_model');
        $this->load->model('TipoCombustible_model');
        $this->data["modelos"] = $this->ModeloVehiculo_model->get();
        $this->data["combustibles"] = $this->TipoCombustible_model->get();

        //Apartado de Subida de Archivos
        $config['upload_path']          = './archivos/';
        $config['allowed_types']        = 'gif|jpg|png';
        $config['max_size']             = 10*1024;

        $this->load->library('upload', $config);
        //
        
        /*Validaciones*/
        //Modelo de Vehiculo
        $this->form_validation->set_rules('no_chasis', 'Numero de Chasis', 'required|exact_length[17]|alpha_numeric|edit_unique[vehiculo.no_chasis.'.$param.']', 
        array(
            'required' => 'El campo {field} es requerido.',
            'exact_length' => 'El {field} debe tener exactamente {param} caracteres.',
            'alpha_numeric' => 'El {field} solo debe tener caracteres alfabeticos y numericos, sin espacios.'
        ));

        $this->form_validation->set_rules('no_motor', 'Numero de Motor', 'required|exact_length[6]|alpha_numeric|edit_unique[vehiculo.no_motor.'.$param.']', 
        array(
            'required' => 'El campo {field} es requerido.',
            'exact_length' => 'El {field} debe tener exactamente {param} caracteres.',
            'alpha_numeric' => 'El {field} solo debe tener caracteres alfabeticos y numericos, sin espacios.'
        ));
        
        $this->form_validation->set_rules('no_placa', 'Numero de Placa', 'required|exact_length[7]|alpha_numeric|edit_unique[vehiculo.no_placa.'.$param.']', 
        array(
            'required' => 'El campo {field} es requerido.',
            'exact_length' => 'El {field} debe tener exactamente {param} caracteres.',
            'alpha_numeric' => 'El {field} solo debe tener caracteres alfabeticos y numericos, sin espacios.'
        ));
        
        $this->form_validation->set_rules('modelovehiculo', 'Modelo del Vehiculo', 'required|integer', 
        array(
            'required' => 'El campo {field} es requerido.',
            'integer' => 'El valor de la {field} tiene que ser un entero.'
        ));

        $this->form_validation->set_rules('tipocombustible', 'Tipo de Combustible', 'required|integer', 
        array(
            'required' => 'El campo {field} es requerido.',
            'integer' => 'El valor de la {field} tiene que ser un entero.'
        ));

        $this->form_validation->set_rules('foto', 'Foto', 'callback_subirArchivoUpdate');

        $this->form_validation->set_rules('montopordia', 'Monto por Dia', 'required|integer', 
        array(
            'required' => 'El {field} es obligatorio.',
            'integer' => 'El valor debe ser un entero.'
        ));

        $this->form_validation->set_rules('descripcion', 'Descripcion', 'max_length[1000]', 
        array(
            'max_length' => 'El valor de la {field} no debe sobrepasar los {param} caracteres.',
        ));

        //Evaluando Campos
        if ($this->form_validation->run() === FALSE)
        { 
            //Borramos la foto porque el formulario tiene inconsistencias
            @unlink('./archivos/'.$this->filename);

            //Datos 
            $this->data["datashow"] = $this->Vehiculo_model->get($param)[0];

            $this->load->view('Templates/header', $this->data);
            $this->load->view('Vehiculo/Vehiculo/Actualizar');
            $this->load->view('Templates/footer');
        }
        else
        {
            $data = array(
                'descripcion' => $this->input->post('descripcion'),
                'no_chasis' => $this->input->post('no_chasis'),
                'no_motor' => $this->input->post('no_motor'),
                'no_placa' => $this->input->post('no_placa'),
                'montopordia' => $this->input->post('montopordia'),
                'estado' => '1',
                'id_modelovehiculo' => $this->input->post('modelovehiculo'),
                'id_tipocombustible' => $this->input->post('tipocombustible'),
            );

            //Check if photo is empty before update
            (isset($this->filename))?$data['foto']=$this->filename:'';
            
            $this->Vehiculo_model->put($param, $data);
            redirect(base_url().'vehiculo/detalle/'.$param);
        }
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
        
        $this->Vehiculo_model->delete($param, $data);
        redirect(base_url().'vehiculo');
    }

    public function Detalle($param)
	{
        if(!$param)
        {
            show_404();
        }

        $this->data['title'] = 'Detalle del Vehiculo';
        
        //Datos Foraneos
        $this->data["datashow"] = $this->Vehiculo_model->get($param)[0];

        $this->load->view('Templates/header', $this->data);
        $this->load->view('Vehiculo/Vehiculo/Detalle');
        $this->load->view('Templates/footer');
    }
    
    public function index()
	{
        $this->data['title'] = 'Vehiculos';
        
        //Datos Foraneos
        $this->data["datashow"] = $this->Vehiculo_model->get();

        $this->load->view('Templates/header-datatable', $this->data);
        $this->load->view('Vehiculo/Vehiculo/Mostrar');
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

    function subirArchivoUpdate()
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