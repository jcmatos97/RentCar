<?php 
    class Vehiculo_model extends CI_Model 
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
                return $this->db->select('vehiculo.id, vehiculo.descripcion, vehiculo.no_chasis, vehiculo.no_motor, vehiculo.no_placa, vehiculo.foto, vehiculo.montopordia, vehiculo.id_modelovehiculo, vehiculo.id_tipocombustible,'.
                                    'modelovehiculo.nombre as modelo, tipocombustible.nombre as tipocombustible, tipovehiculo.nombre as tipovehiculo, marcavehiculo.nombre as marca')
                            ->join('modelovehiculo', 'modelovehiculo.id = vehiculo.id_modelovehiculo')
                            ->join('tipocombustible', 'tipocombustible.id = vehiculo.id_tipocombustible')
                            //Anexando las dos tablas foraneas al modelo
                            ->join('tipovehiculo', 'tipovehiculo.id = modelovehiculo.id_tipovehiculo')
                            ->join('marcavehiculo', 'marcavehiculo.id = modelovehiculo.id_marcavehiculo')
                            ->where('vehiculo.estado', '1')
                            ->get('vehiculo')
                            ->result();
            }
            elseif (count(func_get_args()) == 1)
            {
                return $this->db->select('vehiculo.id, vehiculo.descripcion, vehiculo.no_chasis, vehiculo.no_motor, vehiculo.no_placa, vehiculo.foto, vehiculo.montopordia, vehiculo.id_modelovehiculo, vehiculo.id_tipocombustible,'.
                                    'modelovehiculo.nombre as modelo, tipocombustible.nombre as tipocombustible, tipovehiculo.nombre as tipovehiculo, marcavehiculo.nombre as marca')
                            ->join('modelovehiculo', 'modelovehiculo.id = vehiculo.id_modelovehiculo')
                            ->join('tipocombustible', 'tipocombustible.id = vehiculo.id_tipocombustible')
                            //Anexando las dos tablas foraneas al modelo
                            ->join('tipovehiculo', 'tipovehiculo.id = modelovehiculo.id_tipovehiculo')
                            ->join('marcavehiculo', 'marcavehiculo.id = modelovehiculo.id_marcavehiculo')
                            ->where('vehiculo.estado', '1')
                            ->where('vehiculo.id', $args[0])
                            ->get('vehiculo')
                            ->result();
            }
        }

        public function get_all()
        {
            $args = func_get_args();
            if (count(func_get_args()) == 0)
            {
                return $this->db->select('vehiculo.id, vehiculo.descripcion, vehiculo.no_chasis, vehiculo.no_motor, vehiculo.no_placa, vehiculo.foto, vehiculo.montopordia, vehiculo.id_modelovehiculo, vehiculo.id_tipocombustible,'.
                                    'modelovehiculo.nombre as modelo, tipocombustible.nombre as tipocombustible, tipovehiculo.nombre as tipovehiculo, marcavehiculo.nombre as marca')
                            ->join('modelovehiculo', 'modelovehiculo.id = vehiculo.id_modelovehiculo')
                            ->join('tipocombustible', 'tipocombustible.id = vehiculo.id_tipocombustible')
                            //Anexando las dos tablas foraneas al modelo
                            ->join('tipovehiculo', 'tipovehiculo.id = modelovehiculo.id_tipovehiculo')
                            ->join('marcavehiculo', 'marcavehiculo.id = modelovehiculo.id_marcavehiculo')
                            ->get('vehiculo')
                            ->result();
            }
            elseif (count(func_get_args()) == 1)
            {
                return $this->db->select('vehiculo.id, vehiculo.descripcion, vehiculo.no_chasis, vehiculo.no_motor, vehiculo.no_placa, vehiculo.foto, vehiculo.montopordia, vehiculo.id_modelovehiculo, vehiculo.id_tipocombustible,'.
                                    'modelovehiculo.nombre as modelo, tipocombustible.nombre as tipocombustible, tipovehiculo.nombre as tipovehiculo, marcavehiculo.nombre as marca')
                            ->join('modelovehiculo', 'modelovehiculo.id = vehiculo.id_modelovehiculo')
                            ->join('tipocombustible', 'tipocombustible.id = vehiculo.id_tipocombustible')
                            //Anexando las dos tablas foraneas al modelo
                            ->join('tipovehiculo', 'tipovehiculo.id = modelovehiculo.id_tipovehiculo')
                            ->join('marcavehiculo', 'marcavehiculo.id = modelovehiculo.id_marcavehiculo')
                            ->where('vehiculo.id', $args[0])
                            ->get('vehiculo')
                            ->row();
            }
        }

        public function post($data)
        {    
            $this->db->insert('vehiculo', $data);
            return $this->db->insert_id();
        }

        public function put($id, $data)
        {
            $this->db->where('id', $id);
            $this->db->update('vehiculo', $data);
        }

        public function delete($id, $data)
        {
            $this->db->where('id', $id);
            $this->db->update('vehiculo', $data);
        }

        //Pagination Section, used in Renta.php Controller
        public function get_count($searchParameters) 
        {
            return  $this->db->select('vehiculo.id')
                    ->join('modelovehiculo', 'modelovehiculo.id = vehiculo.id_modelovehiculo')
                    ->join('tipocombustible', 'tipocombustible.id = vehiculo.id_tipocombustible')
                    ->join('tipovehiculo', 'tipovehiculo.id = modelovehiculo.id_tipovehiculo')
                    ->join('marcavehiculo', 'marcavehiculo.id = modelovehiculo.id_marcavehiculo')
                    ->where('vehiculo.estado', '1')
                    ->where($searchParameters)
                    ->count_all_results('vehiculo');
        }
    
        //Pagination Section, used in Renta.php Controller
        public function get_vehiculos($limit, $start, $searchParameters) 
        {
            $query = $this->db->select('vehiculo.id, vehiculo.descripcion, vehiculo.no_chasis, vehiculo.no_motor, vehiculo.no_placa, vehiculo.foto, vehiculo.montopordia, vehiculo.id_modelovehiculo, vehiculo.id_tipocombustible,'.
                    'modelovehiculo.nombre as modelo, tipocombustible.nombre as tipocombustible, tipovehiculo.nombre as tipovehiculo, marcavehiculo.nombre as marca')
                    ->join('modelovehiculo', 'modelovehiculo.id = vehiculo.id_modelovehiculo')
                    ->join('tipocombustible', 'tipocombustible.id = vehiculo.id_tipocombustible')
                    //Anexando las dos tablas foraneas al modelo
                    ->join('tipovehiculo', 'tipovehiculo.id = modelovehiculo.id_tipovehiculo')
                    ->join('marcavehiculo', 'marcavehiculo.id = modelovehiculo.id_marcavehiculo')
                    ->where('vehiculo.estado', '1');

            $queryAddParameters = $query
                    ->where($searchParameters)
                    ->limit($limit, $start)
                    ->get('vehiculo');
            return $queryAddParameters->result();
        }
    }
?>