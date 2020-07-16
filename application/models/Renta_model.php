<?php 
    class Renta_model extends CI_Model 
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
                
                return $this->db->select('rentadevolucion.id, rentadevolucion.fecharenta, rentadevolucion.fechadevolucion, rentadevolucion.montopordia, rentadevolucion.cantidaddias, rentadevolucion.comentario, rentadevolucion.estado, rentadevolucion.id_empleado, rentadevolucion.id_vehiculo, rentadevolucion.id_cliente')
                            ->get('rentadevolucion')
                            ->result();
            }
            elseif (count(func_get_args()) == 1)
            {
                return $this->db->select('rentadevolucion.id, rentadevolucion.fecharenta, rentadevolucion.fechadevolucion, rentadevolucion.montopordia, rentadevolucion.cantidaddias, rentadevolucion.comentario, rentadevolucion.estado, rentadevolucion.id_empleado, rentadevolucion.id_vehiculo, rentadevolucion.id_cliente')
                            ->where('rentadevolucion.id', $args[0])
                            ->get('rentadevolucion')
                            ->row();
            }
        }

        public function getOpen()
        {
            return $this->db->select('rentadevolucion.id, rentadevolucion.fecharenta, rentadevolucion.fechadevolucion, rentadevolucion.montopordia, rentadevolucion.cantidaddias, rentadevolucion.comentario, rentadevolucion.estado, rentadevolucion.id_empleado, rentadevolucion.id_vehiculo, rentadevolucion.id_cliente')
                ->where('rentadevolucion.estado', "1")
                ->get('rentadevolucion')
                ->result();
        }

        public function getClosed()
        {
            return $this->db->select('rentadevolucion.id, rentadevolucion.fecharenta, rentadevolucion.fechadevolucion, rentadevolucion.montopordia, rentadevolucion.cantidaddias, rentadevolucion.comentario, rentadevolucion.estado, rentadevolucion.id_empleado, rentadevolucion.id_vehiculo, rentadevolucion.id_cliente')
                ->where('rentadevolucion.estado', "0")
                ->get('rentadevolucion')
                ->result();
        }

        public function getOpenById($param)
        {
            return $this->db->select('rentadevolucion.id, rentadevolucion.fecharenta, rentadevolucion.fechadevolucion, rentadevolucion.montopordia, rentadevolucion.cantidaddias, rentadevolucion.comentario, rentadevolucion.estado, rentadevolucion.id_empleado, rentadevolucion.id_vehiculo, rentadevolucion.id_cliente')
                ->where('rentadevolucion.estado', "1")
                ->where('rentadevolucion.id', $param)
                ->get('rentadevolucion')
                ->row();
        }

        //Usado para crear una renta
        public function post($data)
        {    
            $this->db->insert('rentadevolucion', $data);
            return $this->db->insert_id();
        }

        //Usado para cerrar una renta
        public function put($id, $data)
        {
            $this->db->where('id', $id);
            $this->db->update('rentadevolucion', $data);
        }

        /**
         * 
         * Apartado de consultas del dashboard
         * 
         */

        public function numeroRentas()
        {
            return $this->db->select('rentadevolucion.montopordia, rentadevolucion.cantidaddias')
            ->where('rentadevolucion.estado', "0")
            ->count_all_results('rentadevolucion');
        }

        public function rentasDevolucionesTotales($param)
        {
            $sumatotal = 0;
            $ventasTotales = $this->db->select('rentadevolucion.montopordia, rentadevolucion.cantidaddias')
                ->where('rentadevolucion.estado', $param)
                ->get('rentadevolucion')
                ->result();
            
            foreach ($ventasTotales as $key) 
            {
                $sumatotal = $sumatotal+($key->montopordia*$key->cantidaddias);
            }
            return number_format($sumatotal, 2);
        }

        public function vehiculosMasRentados()
        {
            return $this->db->select("count(*) as cantidad, modelovehiculo.nombre as modelo, marcavehiculo.nombre as marca")
                ->join('vehiculo', 'vehiculo.id = rentadevolucion.id_vehiculo')
                ->join('modelovehiculo', 'modelovehiculo.id = vehiculo.id_modelovehiculo')
                ->join('marcavehiculo', 'marcavehiculo.id = modelovehiculo.id_marcavehiculo')
                ->order_by('cantidad','desc')
                ->group_by('rentadevolucion.id_vehiculo')
                ->limit(5)
                ->get('rentadevolucion')
                ->result(); 
        }

        public function getClosedDashboard()
        {
            return $this->db->select('rentadevolucion.id, rentadevolucion.fecharenta, rentadevolucion.fechadevolucion, rentadevolucion.montopordia, rentadevolucion.cantidaddias, rentadevolucion.comentario, rentadevolucion.estado, rentadevolucion.id_empleado, rentadevolucion.id_vehiculo, rentadevolucion.id_cliente')
                ->where('rentadevolucion.estado', "0")
                ->order_by('fechadevolucion','desc')
                ->limit(4)
                ->get('rentadevolucion')
                ->result();
        }

        public function getClosedParam($searchParameters)
        {
            return $this->db->select('rentadevolucion.id, rentadevolucion.fecharenta, rentadevolucion.fechadevolucion, (rentadevolucion.montopordia*rentadevolucion.cantidaddias) as montototal, rentadevolucion.comentario, rentadevolucion.estado, rentadevolucion.id_empleado, rentadevolucion.id_vehiculo, rentadevolucion.id_cliente, CONCAT((marcavehiculo.nombre),(" "),(modelovehiculo.nombre)) as vehiculo, vehiculo.no_placa as placa, CONCAT((cliente.nombre),(" "),(cliente.apellido)) as cliente, CONCAT((empleado.nombre),(" "),(empleado.apellido)) as empleado')
                ->join('vehiculo', 'vehiculo.id = rentadevolucion.id_vehiculo')
                ->join('modelovehiculo', 'modelovehiculo.id = vehiculo.id_modelovehiculo')
                ->join('marcavehiculo', 'marcavehiculo.id = modelovehiculo.id_marcavehiculo')
                ->join('cliente', 'cliente.id = rentadevolucion.id_cliente')
                ->join('empleado', 'empleado.id = rentadevolucion.id_empleado')
                ->where('rentadevolucion.estado', "0")
                ->where($searchParameters)
                ->get('rentadevolucion')
                ->result();
        }
    }
?>