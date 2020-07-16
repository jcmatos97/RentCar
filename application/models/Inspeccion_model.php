<?php 
    class Inspeccion_model extends CI_Model 
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
                
            }
            elseif (count(func_get_args()) == 1)
            {
                return $this->db->select('*')
                            ->where('id_vehiculo', $args[0])
                            ->get('inspeccion')
                            ->result();
            }
        }

        public function post($data)
        {    
            $this->db->insert('inspeccion', $data);
            return $this->db->insert_id();
        }

        public function put($id, $data)
        {
            $this->db->where('id_vehiculo', $id);
            $this->db->update('inspeccion', $data);
        }
    }
?>