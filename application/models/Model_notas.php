<?php
defined('BASEPATH') OR exit('No direct script access allowed');

date_default_timezone_set('America/La_Paz');

class Model_notas extends CI_Model
{
    public $id; //no
    public $nota;
    public $ci;  //post
    public $grado; //1
    public $gestionSemestre;

    function gestionG()
    {
        $fecha = "";
        $registro = date('m');
        if($registro >= 7){
            $fecha = "II-".date('Y');
        }else{
            $fecha = "I-".date('Y');
        }
        return $fecha;
        # code...
    }


    public function updateNotas()
    {
        # code...
        if(isset($_POST["id"])){
            $this->nota = $_POST["nota"];
            //$insertado = $this->db->insert('alumnos', $this);
            $this->db->update('alumnos', array('nota' => $_POST['nota']), array('id' => $_POST['id']));
             $estado_code = array("http"=>http_response_code(201),
                                "estado"=>"ok",
                            "tipo"=>"nota");
			//return $this->db->save_queries;
            return $estado_code;
        }else{
            return $estado_code = array("http"=>http_response_code(500),
                                "estado"=>"NO se edito");
        }
    }

    public function filtroNotaAlumnosModel()
    {
        # code...
        $this->ci = $_POST['txtFiltroNota'];
        $this->db->select('alumnos.nombre AS nombreEs, alumnos.paterno AS paterno, alumnos.materno AS materno, alumnos.nota AS nota, grado.rango AS rango');
        $array = array('ci' => $this->ci, 'gestionSemestre' => $this-> gestionG());

        $this->db->from('alumnos');
        $this->db->join('grado', 'alumnos.grado = grado.id');
        $this->db->where($array);
       
        $query = $this->db->get();
        return $query-> result();

    }
    
}
