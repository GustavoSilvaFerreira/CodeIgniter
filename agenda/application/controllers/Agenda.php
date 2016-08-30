<?php

class Agenda extends CI_Controller {
    
    public function __construct(){
        parent::__construct();
        
        // Carrega os Helpers a serem usados
        $this->load->helper(array('url', 'form', 'html'));
        
        // Carrega um Model
        $this->load->model('model_agenda');
        
    }

	public function index(){
		
		// Acessao método get_all()
        $res = $this->model_agenda->get_all();
        if($res->result()){
            foreach( $res->result() as $contato ){
                echo $contato->id . " - " . $contato->nome . " - " . $contato->email . "<br />";
            }
        }else{
            echo "Nenhum resultado encontrado";
        }
        
        $resultado = $this->model_agenda->get_um(1, "Pedro");
        print_r($resultado->result());
        
        // carrega a View
		$this->load->view('agenda_exibir');
	}
}
