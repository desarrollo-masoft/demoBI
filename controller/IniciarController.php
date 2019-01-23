<?php

class IniciarController extends ControladorBase{

	public function __construct() {
		parent::__construct();
	}


	public function index(){
	
		session_start();
		
			
					
				$this->view("paginaweb",array(
						""=>""
	
				));
	
			
	
	die();
		
	
	}
	
	
	
	
}
?>