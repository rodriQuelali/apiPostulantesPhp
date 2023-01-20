<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH.'/libraries/REST_Controller.php';

class Alumnos extends REST_Controller
{
    function __construct() {
        parent::__construct();
		$this->load->database();
		$this->load->model('Model_alumnos');
    }

    public function loginAlumno_post()
    {
        # code...
        $data = $this->Model_alumnos->loginAlumno();
             if($data){
                 $respuesta = array(
                     'err' => false,
                     'desc' => "Inicio de sección correcto.",
                     'alumnos' => $data
                 );
             }else{
                 $respuesta = array(
                     'err' => true,
                     'desc' => "El alumno o código son incorrectos.",
                     'alumnos' => null
                 );
             }
             $this->response($respuesta);
    }
    
   public function listAlumnosGestion_post()
   {
       # code...
       $dato= $this->Model_alumnos->listarAlumnosGestionModel();
       $this->response($dato);
   }

   public function guardar_post()
  {
      # code...
    $dato = $this->Model_alumnos->guardaAlumnos();
    $this->response($dato);

  }

  public function update_post()
  {
	  # code...
	$dato = $this->Model_alumnos->updateAlumnos();
	$this->response($dato);
  }

  public function countStudent_post()
  {
	$arrayGe = array();
	$dato= $this->Model_alumnos->countAlumnosCarrera();
  $datosEs= $this->Model_alumnos->listarAlumnosGestionModel();
    
    $arrayGe = array(
      'total'=> $dato,
      'cuerpo'=> $datosEs
    );
    $this->response($arrayGe);
  }

  public function countStudentFinal_post()
  {
	
	  $dato= $this->Model_alumnos->countAlumnos();
    $this->response($dato);
  }

  public function countGeneral_get()
  {
    $genera = array();
    $respuesta = array();
    $carre = ["SISTEMAS INFORMÁTICOS", "CONSTRUCCIÓN CIVIL", "ELECTRICIDAD INDUSTRIAL", "INDUSTRIA TEXTIL Y CONFECCIÓN", "MECANICA AUTOMOTRÍZ", "REDES DE GAS Y SOLDADURA EN DUCTOS", "GASTRONOMIA"];
    for ($i=1; $i <= 7; $i++) { 
      # code...
      $dato= $this->Model_alumnos->countAlumnosGeneralCarrera($i);
    
      $respuesta [] = array("nombre"=> $carre[$i-1],
      "datos"=>$dato);
    }
	  $dato= $this->Model_alumnos->countAlumnos();
  
    $genera = array("total" => $dato,
                  "carreras" => $respuesta);
    $this->response($genera);
  }

   public function filtroAlumnos_post()
   {
       # code...
       $data = $this->Model_alumnos->filtroCiAlumnos();
			if($data){
				$respuesta = array(
					'err' => false,
					'desc' => "Datos encontrados",
					'alumnos' => $data
				);
			}else{
				$respuesta = array(
					'err' => true,
					'desc' => "No se encontro datos",
					'alumnos' => null
				);
			}
			$this->response($respuesta);
   }
   public function listAlumnosfecha_post()
   {
       # code...
       $dato= $this->Model_alumnos->listarAlumnosfecha();
       $this->response($dato);
   }
  
  
   
}



?>