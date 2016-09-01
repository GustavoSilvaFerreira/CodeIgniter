<?php
/**
* 
*/
class Agenda extends CI_Controller
{
	
  public function __construct()
  {
    parent::__construct();

    // Carrega os Helpers a serem usados

    $this->load->helper(array('url','form', 'html'));

    // Carrega o Model da aplicação

    $this->load->model('Model_agenda');
  }

public function index ()
  {
    $resultado = $this->Model_agenda->get_all();

   // print_r( $resultado );

    // Carrega a View

    $this->load->view('agenda_exibir', $resultado);
  }


}