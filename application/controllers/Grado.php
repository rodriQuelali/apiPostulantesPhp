<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH.'/libraries/REST_Controller.php';

class Grado extends REST_Controller
{
    function __construct() {
        parent::__construct();
		$this->load->database();
		$this->load->model('Model_grado');
    }

    public function update_post()
  {
	  # code...
    $dato = $this->Model_grado->updateGrado();
    $this->response($dato);
  }
  
}