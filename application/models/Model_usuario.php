<?php
defined('BASEPATH') OR exit('No direct script access allowed');

date_default_timezone_set('America/La_Paz');

class Model_usuario extends CI_Model
{
    public $id;
    public $nombre;
    public $paterno;
    public $materno;
    public $estado;
    public $f_registro;
    public $f_actualizacion;
    public $intentos;
    public $password;
    public $rol;
    public $ruta;


    public function loginUsuario()
    {
        # code...
        $this->nombre = $_POST['nombre'];
        $this->password = $_POST['password'];
        $this->db->select('*');
        $array = array('nombre' => $this->nombre, 'password' => $this->password);
        $this->db->where($array);
        $query = $this->db->get('usuario');
        return $query->custom_row_object(0,'Model_usuario');

    }

    public function guardar_usuario()
    {
        # code...
        $estado_code = array();
        $registro = new DateTime("now", new DateTimeZone('America/La_Paz'));
		$registro = $registro->format('Y-m-d');
        if(isset($_POST["txtnombre"])){
            $this->nombre = $_POST["txtnombre"];
            $this->paterno = $_POST["txtpaterno"];
            $this->materno = $_POST["txtmaterno"];
            $this->estado = "si";
            $this->f_registro = $registro;
            $this->f_actualizacion = $registro;
            $this->intentos = 0;
            $this->password = $_POST["txtpass"];
            $this->rol = 0;
            //para guardar
            $insertado = $this->db->insert('usuario', $this);
             $estado_code = array("http"=>http_response_code(201),
                                "estado"=>"ok");
			//return $this->db->save_queries;
            return $estado_code;
        }else{
            return $estado_code = array("http"=>http_response_code(500),
                                "estado"=>"mall");
        }
        
    }
    public function listar_usuario()
    {
        # code...
        $this->db->select('id, nombre, paterno, materno');
        $query = $this->db->get('usuario');
        return $query->result();
    }    
}


?>