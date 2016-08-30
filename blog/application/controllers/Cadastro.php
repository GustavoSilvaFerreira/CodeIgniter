<?php

class Cadastro extends CI_Controller
{
  function index()
  {
    // Carrega a biblioteca de validação de formulários

    $this->load->library('form_validation');

    // Carrega os helpers a serem usados

    $this->load->helper(array('form', 'html', 'url'));

    // Define as regras de validação
    /*
    $this->form_validation->set_rules('nome', 'nome', 'required');
    $this->form_validation->set_rules('email', 'e-mail', 'required');
    $this->form_validation->set_rules('senha', 'senha', 'required');
    $this->form_validation->set_rules('senha-confirma', 'confirme a senha', 'required');
    */
    
    // Define as regras de validação
    /*
    $regras = array(
        array(
          'field'    =>  'nome',
          'label'    =>  'nome',
          'rules'    =>  'required'),
        array(
          'field'    =>  'email',
          'label'    =>  'e-mail',
          'rules'    =>  'required'),
        array(
          'field'    =>  'senha',
          'label'    =>  'senha',
          'rules'    =>  'required'),
        array(
          'field'    =>  'senha-confirma',
          'label'    =>  'confirme a senha',
          'rules'    =>  'required')
    );
    
    $this->form_validation->set_rules($regras);
    */
    
    // Define as regras de validação
    /*
    $this->form_validation->set_rules('nome', 'nome',
    'required|min_length[3]|max_length[50]');

    $this->form_validation->set_rules('email', 'e-mail',
    'required|valid_email');

    $this->form_validation->set_rules('senha', 'senha',
    'required|min_length[4]|max_length[25]');

    $this->form_validation->set_rules('senha-confirma', 'confirme a senha',
    'required|matches[senha]');
    */
    /*
    $this->form_validation->set_rules('nome', 'nome',
    'trim|required|min_length[3]|max_length[50]|xss_clean');

    $this->form_validation->set_rules('email', 'e-mail',
    'trim|required|valid_email');

    $this->form_validation->set_rules('senha', 'senha',
    'trim|required|min_length[4]|max_length[25]|md5');

    $this->form_validation->set_rules('senha-confirma', 'confirme a senha',
    'trim|required|matches[senha]');
    */
    
    // vem de application/config/form_validation.php
    //$this->form_validation->run();
    
    // Define como os erros serão impressos, neste caso, dentro de um <small>

    $this->form_validation->set_error_delimiters('<small class="erro">', '</small>');

    // A validação passou?

    if ( $this->form_validation->run())
    {
      // Aqui, cadastraríamos o usuário
      $this->load->view('form_ok');
    }
    else
    {
      // Erro de validação, portanto, volta para o cadastro
      $this->load->view('form_cadastro');
    }
  }
  
    public function usuario_ja_cadastrado($email){
        if( $email=="teste@treinaweb.com.br" ){
            $this->form_validation->set_message('usuario_ja_cadastrado',
            'E-mail já cadastrado no sistema.');
            return FALSE;
        }else{
            return TRUE;
        }
    }

    public function validar_nome($nome){
        if( $nome=="teste" ){
            $this->form_validation->set_message('validar_nome',
            'O campo %s não pode ser definido como "teste"');
            return FALSE;
        }else{
            return TRUE;
        }
    }
    
    public function teste_validador(){
      // Carrega o nosso Helper

      $this->load->helper( array('url','validador') );

      // Coloca uma informação na sessão

      $valor = 'treinaweb';

      $this->session->set_userdata('teste-sessao',$valor);

      // Usa o Helper 'verifica_sessao' e imprime o resultado na View

      $dados['mensagem'] = verifica_sessao($valor);

      $this->load->view('form_ok',$dados);
    }

}