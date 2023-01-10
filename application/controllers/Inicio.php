<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH.'/libraries/REST_Controller.php';

class Inicio extends REST_Controller
{
    public function index_get()
	{
		echo "Sistema API";
	}

	public function prueba_get()
	{
		echo "Prueba Sistema API";
	}
   
}