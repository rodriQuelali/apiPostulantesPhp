<?php
defined('BASEPATH') OR exit('No direct script access allowed');

date_default_timezone_set('America/La_Paz');

class Model_alumnos extends CI_Model
{
    //public $id; //no
    public $password; //ci
    public $nombre; //post
    public $paterno;
    public $materno;
    public $sexo; //post
    public $edad;
    public $grado; //1
    public $salon; //1
    public $fecha; //post
    public $ci;  //post
    public $direccion; //post
    public $telefono; //post
    public $estado;  //no
    public $gestion; //no
    public $correo; //post
    public $extencion; //post
    public $turno; //post
    public $nota;
    
    public function guardaAlumnos()
    {
        $estado_code = array();
        $registro = new DateTime("now", new DateTimeZone('America/La_Paz'));
		$registro = $registro->format('Y-m-d');
        if(isset($_POST["txtNombre"])){
            $this->password = $_POST["txtCi"];
            $this->nombre = $_POST["txtNombre"];
            $this->paterno = $_POST["txtPaterno"];
            $this->materno = $_POST["txtMaterno"];
            $this->sexo = $_POST["txtSexo"];
            $this->edad = $_POST["txtEdad"];
            $this->grado = $_POST["txtGrado"];
            $this->salon = 0;
            $this->fecha = $registro;
            $this->ci = $_POST["txtCi"];
            $this->direccion = $_POST["txtDireccion"];
            $this->telefono = $_POST["txtTelefono"];
            $this->estado = $_POST["txtEstado"];
            $this->gestion = $_POST["txtGestion"];
            $this->correo = null;
            $this->extencion = null;
            $this->turno = $_POST["txtTurno"];
            //para guardar
            $insertado = $this->db->insert('alumnos', $this);
             $estado_code = array("http"=>http_response_code(201),
                                "estado"=>"ok");
			//return $this->db->save_queries;
            return $estado_code;
        }else{
            return $estado_code = array("http"=>http_response_code(500),
                                "estado"=>"NO se registro");
        }
    }

    
    public function updateAlumnos()
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


    public function filtroCiAlumnos()
    {
        # code...
        $this->ci = $_POST['txtCiFiltro'];
        $this->db->select('*');
        //$array = array('ci' => $this->ci, 'nombre' => $this->ci);
        $this->db->where('ci =', $this->ci);
        $this->db->or_where('nombre =', $this->ci);
        $query = $this->db->get('alumnos');
        return $query->custom_row_object(0,'Model_alumnos');

    }
    
    public function countAlumnos()
    {
        # code...
        $respuestaTotalAlumnos = array();
        $totalS = 0;
        $this->db->select('*');
        $query = $this->db->get('alumnos');
        $respuesta = $query->result();
        foreach ($respuesta as $respuestas) {
            $totalS = $totalS +1;
        }
       
        return $respuestaTotalAlumnos [] =  array('total_general' => $totalS);
    }

    public function countAlumnosCarrera()
    {
        # code...
        $respuestaTotalAlumnos = array();
        $grado = $_POST["filtroCarrera"];
        $totalS = 0;
        $totalM =0;
        $totalN =0;
        $totalNi =0;
        # code...
        $this->db->select('*');
        $array = array('grado' => $grado);
        $this->db->where($array);
        $query = $this->db->get('alumnos');
        $respuesta = $query->result();
        foreach ($respuesta as $respuestas) {
            if($respuestas->turno === "NOCHE"){
                $totalN = $totalN +1;
            }else if($respuestas->turno === "MAÑANA"){
                $totalM = $totalM +1;
            }else{
                $totalNi = $totalNi +1;
            }
            $totalS = $totalS +1;
        }
       
        return $respuestaTotalAlumnos [] =  array('total' => $totalS,
                                                    'dia' =>$totalM,
                                                'noche' =>$totalN,
                                            'ninguno' => $totalNi);
    }

    public function countAlumnosGeneralCarrera($id)
    {
        # code...
        $respuestaTotalAlumnos = array();
        $totalS = 0;
        # code...
        $this->db->select('*');
        $array = array('grado' => $id);
        $this->db->where($array);
        $query = $this->db->get('alumnos');
        $respuesta = $query->result();
        foreach ($respuesta as $respuestas) {
            $totalS = $totalS +1;
        }
       
        return $respuestaTotalAlumnos [] =  array('total' => $totalS);
    }
    public function listarAlumnos()
    {
        $respuestaTotal = array();
        $respuestaTotalAlumnos = array();
        $activos = array();
        $inactivos = array();
        //$grado = $_POST[];
        $grado = 1;
        # code...
        $this->db->select('*');
        $array = array('grado' => $grado);
        $this->db->where($array);
        $query = $this->db->get('alumnos');
        //return $query->result();
        $respuesta = $query->result();
        foreach ($respuesta as $respuestas) {
            # code...
            
            $respuestaTotalAlumnos [] =  array('nombre' => $respuestas->nombre,
                                        'grado' => $respuestas->grado,
                                    'fechaNaciemto' => $respuestas->fecha);
        }
       
        return $respuestaTotalAlumnos;
    }
    public function listarAlumnosfecha()
    {
        $respuestaTotal = array();
        $respuestaTotalAlumnos = array();
        $activos = array();
        $inactivos = array();
        //$grado = $_POST[];
        $fecha = $_POST["fecha"];
        # code...
        $this->db->select('*');
        $array = array('fecha' => $fecha);
        $this->db->where($array);
        $query = $this->db->get('alumnos');
        //return $query->result();
        $respuesta = $query->result();
        foreach ($respuesta as $respuestas) {
            # code...
            
            $respuestaTotalAlumnos [] =  array('nombre' => $respuestas->nombre,
                                        'fechaInscripcion' => $respuestas->fecha,
                                    'fechaNaciemto' => $respuestas->fecha);
        }
       
        return $respuestaTotalAlumnos;
    }
    
   
}


?>