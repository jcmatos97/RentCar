<?php 
    class MarcaVehiculo_model extends CI_Model 
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
                return $this->db->select('id, nombre')
                                ->where('estado', '1')
                                ->get('marcavehiculo')
                                ->result();
            }
            elseif (count(func_get_args()) == 1)
            {
                return $this->db->select('id, nombre')
                                ->where('estado', '1')
                                ->where('id', $args[0])
                                ->get('marcavehiculo')
                                ->result();
            }
        }

        public function post($data)
        {    
            $this->db->insert('marcavehiculo', $data);
        }

        public function put($id, $data)
        {
            $this->db->where('id', $id);
            $this->db->update('marcavehiculo', $data);
        }

        public function delete($id, $data)
        {
            $this->db->where('id', $id);
            $this->db->update('marcavehiculo', $data);
        }

    }
?>