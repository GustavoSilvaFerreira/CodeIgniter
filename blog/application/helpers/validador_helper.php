<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Valida uma informação na sessão
 */

if ( ! function_exists('verifica_sessao'))
{
  function verifica_sessao($valor)
  {
    $ci =& get_instance();

    if( $ci->session->userdata('teste-sessao') == $valor )
    {
      return $valor . " -> está na sessão.";
    }
    else
    {
      return $valor . " -> <b>não</b> está na sessão.";
    }
  }
}