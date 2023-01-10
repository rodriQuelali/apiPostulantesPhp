<?php
defined('BASEPATH') OR exit('No direct script access allowed');

date_default_timezone_set('America/La_Paz');

class Model_grado extends CI_Model
{

    public $id;
    public $nombre;
    public $estado;
    public $rango;

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