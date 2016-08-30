<?php

class Twclass extends CI_Controller {

  public function index()
  {
    // Carrega a biblioteca

    $this->load->library('treinaweb');

    // Define o Array de cursos

    $cursos = array('Python', 'Ruby', 'CodeIgniter');

    // Usa o método formata_cursos_lista() da biblioteca

    echo $this->treinaweb->formata_cursos_lista($cursos, TRUE);

    echo "<br />";

    // Usa o método formata_byte() da biblioteca

    echo $this->treinaweb->formata_byte(87451365);
  }
}