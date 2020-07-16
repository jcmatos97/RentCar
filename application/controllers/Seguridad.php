<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Seguridad extends CI_Controller {

    function __construct() 
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model('Usuario_model');
        //sesion_requerida();
        //rol_admin_requerido();
        //isAdmin();        
    }

    public function index()
    {
        //var_dump($_SESSION);

        /*Sesion Verificador*/
        no_sesion_requerida();

        /*Datos para la Vista*/
        $data = array();
        $data['title'] = "Iniciar Sesión";

        /*Validaciones*/
        //Usuario
        $this->form_validation->set_rules('usuario', 'Usuario', 'required', 
            array('required' => 'El campo Usuario es requerido.'));
        //Clave
        $this->form_validation->set_rules('clave', 'Clave', 'required',
            array('required' => 'El campo Clave es requerido.'));
    
        //Evaluando Campos
        if ($this->form_validation->run() === FALSE)
        {
            $this->load->view('Seguridad/index', $data);
        }
        else
        {
            $infomacionUsuario = $this->Usuario_model->get();
            if(isset($infomacionUsuario))
            {
                $this->iniciarSesion($infomacionUsuario);
            }
            else 
            {        
                $data['error'] = "El Usuario y/o Clave son Incorrectos";
                $this->load->view('Seguridad/index', $data);
            }
        }
    }
    
    private function iniciarSesion($infomacionUsuario)
	{
        $info_sesion = array(
            'id' => $infomacionUsuario->id,
            'nombre' => $infomacionUsuario->nombre, 
            'apellido' => $infomacionUsuario->apellido,
            'usuario' => $infomacionUsuario->usuario,
            'rol' => $infomacionUsuario->rol
        );
        $this->session->set_userdata($info_sesion);
        redirect(base_url());
    }
    
    public function cerrarSesion()
	{ 
        $info_sesion = array(
            '__ci_last_regenerate',
            'id',
            'nombre', 
            'apellido',
            'usuario',
            'rol'
        );
        $this->session->unset_userdata($info_sesion);
        session_destroy();
        redirect(base_url().'seguridad');
	}
}