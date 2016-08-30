<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Olamundo extends CI_Controller {

  public function index()
	{
		$this->load->view('olamundo');
	}

  public function categoria($categoria=""){

    // Adicionando no Array $dados a categoria selecionada

    $dados["categoria"] = $categoria;

    // Tratando os dados recebidos e armazenando no Array $dados os cursos

    switch ($categoria) {
      case "banco-de-dados":
        $dados["cursos"][] = "Oracle";
        $dados["cursos"][] = "SQL Server";
      ;
      break;
      case "programacao":
        $dados["cursos"][] = "CodeIgniter";
        $dados["cursos"][] = "PHP";
      ;
      break;

      default:
        $dados["cursos"][] = "Nenhuma categoria foi informada.";
        $dados["categoria"] = "Sem categoria.";
        ;
      break;
    }

    // Invocando a View categoria_cursos e enviando para ela o Array $dados

    $this->load->view("categoria_cursos",$dados);

  }
  
  public function tags($tag="all", $quantidade=10){
  	
  	$dados["tag"] = $tag;
  	$dados["quantidade"] = $quantidade;
  	
  	$this->load->view("topo");
  	$this->load->view("menu");
  	$this->load->view("show_tags", $dados);
  	$this->load->view("rodape");
  	
  }

}