<?php 
    class Cliente_model extends CI_Model 
    {
        public function __construct()
        {
            parent::__construct();
            //Codeigniter : Write Less Do More
            $this->load->database();
        }
        
        public function get()
        {
            $args = func_get_args();
            if (count(func_get_args()) == 0)
            {
                return $this->db->select('id, nombre, apellido, cedula, no_tarjetadecredito, expiraciontarjeta, codigotarjeta, limitecredito, tipopersona, estado, foto, creacion')
                            ->where('estado', '1')
                            ->get('cliente')
                            ->result();
            }
            elseif (count(func_get_args()) == 1)
            {
                return $this->db->select('id, nombre, apellido, cedula, no_tarjetadecredito, expiraciontarjeta, codigotarjeta, limitecredito, tipopersona, estado, foto, creacion')
                            ->where('estado', '1')
                            ->where('id', $args[0])
                            ->get('cliente')
                            ->result();
            }
        }

        public function get_all()
        {
            $args = func_get_args();
            if (count(func_get_args()) == 0)
            {
                return $this->db->select('id, nombre, apellido, cedula, no_tarjetadecredito, expiraciontarjeta, codigotarjeta, limitecredito, tipopersona, estado, foto, creacion')
                            ->get('cliente')
                            ->result();
            }
            elseif (count(func_get_args()) == 1)
            {
                return $this->db->select('id, nombre, apellido, cedula, no_tarjetadecredito, expiraciontarjeta, codigotarjeta, limitecredito, tipopersona, estado, foto, creacion')
                            ->where('id', $args[0])
                            ->get('cliente')
                            ->row();
            }
        }

        public function post($data)
        {
            $this->db->insert('cliente', $data);
            return $this->db->insert_id();
        }

        public function put($id, $data)
        {
            $this->db->where('id', $id);
            $this->db->update('cliente', $data);
        }

        public function delete($id, $data)
        {
            $this->db->where('id', $id);
            $this->db->update('cliente', $data);
        }
    }
?>