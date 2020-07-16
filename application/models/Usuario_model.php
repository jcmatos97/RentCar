<?php 
    class Usuario_model extends CI_Model 
    {
        public function __construct()
        {
            parent::__construct();
            //Codeigniter : Write Less Do More
            $this->load->database();
        }
        
        public function get()
        {
            //->result();
            return $this->db->select('*')
                            ->where('usuario', $this->input->post('usuario'))
                            ->where('clave', $this->input->post('clave'))
                            ->where('estado', '1')
                            ->get('empleado')
                            ->row();
        }

        public function getById($param)
        {
            //->result();
            return $this->db->select('*')
                            ->where('id', $param)
                            ->get('empleado')
                            ->row();
        }

        public function getAll()
        {
            //->result();
            return $this->db->select('*')
                            ->get('empleado')
                            ->row();
        }

    }
?>