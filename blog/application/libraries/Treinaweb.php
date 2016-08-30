<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Treinaweb {

  public $ci;

  /**
   * Método construtor
   *
   * A propriedade 'ci' receberá a instância da superclasse CI_Controller
  */

  public function __construct()
  {
    $this->ci =& get_instance();
  }

  /**
   * Retorna os cursos formatados em lista
   *
   * @access  public
   * @param  mixed
   * @param  bool
   * @return  string
   */

  public function formata_cursos_lista($cursos = array(), $ordenada=FALSE)
  {
    // Carrega o Helper 'html'
    $this->ci->load->helper('html');

    // Processa o Array de cursos, formatando-os em HTML
    if( $ordenada )
    {
      return ol($cursos);
    }
    else
    {
      return ul($cursos);
    }
    }

  /**
   * Retorna os bytes formatados em Kb/Mb/Gb ...
   *
   * @access  public
   * @param  integer
   * @return  string
  */

    public function formata_byte($tamanho=0)
    {
    // Carrega o Helper 'number'
    $this->ci->load->helper('number');

    // Retorna o resultado
    return byte_format($tamanho);
  }
}