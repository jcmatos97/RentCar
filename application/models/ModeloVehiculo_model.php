<?php 
    class ModeloVehiculo_model extends CI_Model 
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
                                ->get('modelovehiculo')
                                ->result();
            }
            elseif (count(func_get_args()) == 1)
            {
                return $this->db->select('modelovehiculo.id, modelovehiculo.nombre as modelovehiculo, modelovehiculo.id_tipovehiculo, modelovehiculo.id_marcavehiculo,'.
                                    'tipovehiculo.nombre as tipovehiculo, marcavehiculo.nombre as marcavehiculo')
                                ->join('tipovehiculo', 'tipovehiculo.id = modelovehiculo.id_tipovehiculo')
                                ->join('marcavehiculo', 'marcavehiculo.id = modelovehiculo.id_marcavehiculo')
                                ->where('modelovehiculo.estado', '1')
                                ->where('modelovehiculo.id', $args[0])
                                ->get('modelovehiculo')
                                ->result();
            }
        }

        public function customizedGet()
        {
            return $this->db->select('modelovehiculo.id, modelovehiculo.nombre as modelovehiculo, modelovehiculo.id_tipovehiculo, modelovehiculo.id_marcavehiculo,'.
                                    'tipovehiculo.nombre as tipovehiculo, marcavehiculo.nombre as marcavehiculo')
                            ->join('tipovehiculo', 'tipovehiculo.id = modelovehiculo.id_tipovehiculo')
                            ->join('marcavehiculo', 'marcavehiculo.id = modelovehiculo.id_marcavehiculo')
                            ->where('modelovehiculo.estado', '1')
                            ->get('modelovehiculo')
                            ->result();
        }

        public function post($data)
        {    
            $this->db->insert('modelovehiculo', $data);
        }

        public function put($id, $data)
        {
            $this->db->where('id', $id);
            $this->db->update('modelovehiculo', $data);
        }

        public function delete($id, $data)
        {
            $this->db->where('id', $id);
            $this->db->update('modelovehiculo', $data);
        }
    }
?>