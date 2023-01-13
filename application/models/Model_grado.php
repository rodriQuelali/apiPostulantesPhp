<?php
defined('BASEPATH') OR exit('No direct script access allowed');

date_default_timezone_set('America/La_Paz');

class Model_grado extends CI_Model
{

    public $id;
    public $nombre;
    public $estado;
    public $rango;

    //agregar carrera
    public function guardaGrado()
    {
        $estado_code = array();
        if(isset($_POST["txtNombreGrado"])){
            $this->nombre = $_POST["txtNombreGrado"];
            $this->estado = $_POST["txtEstado"];
            $this->rango = $_POST["txtRango"];
            //para guardar
            $insertado = $this->db->insert('grado', $this);
             $estado_code = array("http"=>http_response_code(201),
                                "estado"=>"ok");
			//return $this->db->save_queries;
            return $estado_code;
        }else{
            return $estado_code = array("http"=>http_response_code(500),
                                "estado"=>"No se registro");
        }
    }

    public function updateGrado()
    {
        # code...
        if(isset($_POST["id"])){
            $this->rango = $_POST["rango"];
            //$insertado = $this->db->insert('alumnos', $this);
            $this->db->update('grado', array('rango' => $_POST['rango']), array('id' => $_POST['id']));
             $estado_code = array("http"=>http_response_code(201),
                                "estado"=>"ok",
                            "tipo"=>"Rango");
			//return $this->db->save_queries;
            return $estado_code;
        }else{
            return $estado_code = array("http"=>http_response_code(500),
                                "estado"=>"NO se edito rango");
        }
    }
    public function listarGradoModel()
    {
        $this->db->select('*');
        $query = $this->db->get('grado');
        return $query->result();
    }
    
}