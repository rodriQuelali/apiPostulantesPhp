<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH.'/libraries/REST_Controller.php';

class Notas extends REST_Controller
{
    function __construct() {
        parent::__construct();
		$this->load->database();
		$this->load->model('Model_notas');
    }

    public function filtroNotaAlumnos_post()
   {
       # code...
       $respuesta = $this->Model_notas->filtroNotaAlumnosModel();
	   $this->response($respuesta);
   }

}