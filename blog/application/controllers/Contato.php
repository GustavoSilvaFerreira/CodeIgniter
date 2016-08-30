<?php
// SEGURANÇA
class Contato extends CI_Controller {

  public function index(){
    
    // Carregando os Helpers usados
    $this->load->helper('html');
    $this->load->helper('form');
    
		$this->load->view('contato');
	}
	
	// proteção XSS, COOKIE
	public function enviarteste(){
	  
	  // proteção XSS , usar sempre TRUE para evitar que possam enviar um script por exemplo
	  // post()
	  echo $this->input->post("txt-nome", TRUE);  
  
    // get - https://php-unicar-estac-gustavoferreira.c9users.io/blog/contato/enviar?busca=Teste
    echo $this->input->get("busca", TRUE);
    
    // get_post() - primeiro post() e se não houver pega do get()
    $this->input->get_post("nome-do-campo", TRUE);
    
    // post() - array com todos os campos (pode usar com get() e get_post() )
    foreach( $this->input->post() AS $campo => $valor){
      echo $campo . " = " . $valor . "<br />";
    }
    
    // COOKIE
    
    // campos
    $cookie = array(
      'name'    =>  'Nome',
      'value'    =>  'Valor',
      'expire'  =>  '86500', // segundos
      'domain'  =>  '.php-unicar-estac-gustavoferreira.c9users.io',
      'path'    =>  '/',
      'prefix'  =>  'c_',
      'secure'  =>  'TRUE'); //Https


    $this->input->set_cookie($cookie);
    
    //exemplo
    //$nome = $this->input->post("txt-nome");
    //$this->input->set_cookie("teste_contato",$nome, 85600);
    
	}
	
	// ip_address(), valid_ip() e user_agent()
	function input($ip=""){
	  $this->load->helper("html");
    // Obtenção do IP

    echo "<b>Ip:</b> " . $this->input->ip_address() . "<br />";

    // Obtenção do Useragent
    echo "<b>Useragent:</b> " . $this->input->user_agent() . "<br />";

    // Validação de IP
    if( $ip!="" ){
      if( $this->input->valid_ip($ip) )
        echo "<b>Ip Informado:</b> Válido.";
      else
        echo "<b>Ip Informado:</b> Não é um Ip.";
    }
    
    // server()
    echo br(2);
    echo $this->input->server("PHP_SELF");
    
    // request_headers(), get_request_header() e is_ajax_request()
    echo br(2);
    //Imprime todos os Headers
    print_r( $this->input->request_headers());
    echo br(2);
    //Imprime o Header "Connection"
    echo $this->input->get_request_header("Connection", TRUE);
    
    // is_ajax_result() verifica se no cabeçalho se o valor de HTTP_X_REQUESTED_WITH é igual a “XMLHttpRequest”, se sim, é uma requisição ajax, portanto, retorna TRUE. 
    echo br(2);
    if($this->input->is_ajax_request())
      echo "Ajax";

  }
  
  // session
  function session(){
    /*
    $dados = array(
      'session_id'    =>  'Hash Randômico',
      'ip_address'    =>  'Endereço de IP',
      'user_agent'    =>  'String de User Agent',
      'last_activity'    =>  'Data hora da última atividade.');
    */
    // CRIANDO SESSAO
    $dados = array(
      'id' => 2,
      'nome' => 'Gustavo',
      'logado' => TRUE);

    $this->session->set_userdata($dados);
    
    // ou
    //$this->session->set_userdata(array('id' => 2));
    
    //RECUPERAR VALOR DE UMA SESSAO
    echo "ID" . $this->session->userdata('id');
    echo "NOME" . $this->session->userdata('nome');
    
    
      
  /*
  $config['sess_cookie_name'] = 'treinaweb_blog';
  $config['sess_expiration'] = 7200;
  $config['sess_expire_on_close'] = TRUE;
  $config['sess_encrypt_cookie'] = TRUE;
  $config['sess_use_database'] = FALSE;
  $config['sess_table_name'] = 'ci_sessions';
  $config['sess_match_ip'] = FALSE;
  $config['sess_match_useragent'] = TRUE;
  $config['sess_time_to_update'] = 300;
  */
  }
  
  function unsession(){
    // DELETAR VALOR DE UMA SESSÃO
    $itens = array('id', 'nome');
    $this->session->unset_userdata($itens);
    
    // OU DE UM ITEM SÓ
    //$this->session->unset_userdata('id');
    echo "ID" . $this->session->userdata('id');
    echo "NOME" . $this->session->userdata('nome');
  }
  
  function destroisession(){
    
    // DESTRUIR TODOS OS VALORES DA SESSION
    $this->session->sess_destroy();
  }
  
  // flashData sessoes que expiram na proxima consulta no servidor
  function flashData(){
    
    $this->session->set_flashdata('erro', 'E-mail inválido.');
    echo "erro: " . $this->session->userdata('erro') . "<br>";
    
    // RETORNANDO VALOR DA flashData
    echo $this->session->flashdata('erro');
    
    // CASO QUEIRA QUE A SESSION FIQUE 'VIVA' POR MAIS UMA REQUISIÇÃO NO SERVIDOR
    $this->session->keep_flashdata('erro');
    
    
  }
  
  // RECEBENDO E VALIDANDO DADOS DO FORMULARIO DE CONTATO
  function enviar(){
    
    // carregando biblioteca email
    $this->load->library("email");
    
    // Carregando os Helpers a serem usados
    $this->load->helper("email");
    $this->load->helper("url");

    // Obtenção e tratamento dos dados
    $nome = $this->input->post('txt-nome', TRUE);
    $email = $this->input->post('txt-email', TRUE);
    $mensagem = strip_tags( $this->input->post('txt-msg', TRUE) );

    // Validações
    if( strlen($nome)<4 ){
      $this->session->set_flashdata('erro','O nome deve ser maior que 4 caracteres.');
    }elseif( !valid_email($email) ){
      $this->session->set_flashdata('erro','E-mail inválido.');
    }elseif( strlen($mensagem)<10 ){
      $this->session->set_flashdata('erro','A mensagem deve conter mais que 10 caracteres.');
    }else{
      $this->session->set_flashdata('ok','E-mail enviado. Em breve o responderemos.');
    }
    // De:
      $this->email->from('guto7626@hotmail.com.br', 'Guga');

      // Para:
      $this->email->to('gsf1308@gmail.com');

      // Com cópia para:
      //$this->email->cc('destinatario-copia@dominio.com.br');

      // Cópia oculta para:
      //$this->email->bcc('destinatario-copia-oculta@dominio.com.br');

      // Assunto
      $this->email->subject('Assunto do E-mail');

      // Tipo da mensagem: text ou html
      $this->email->set_mailtype("text");

      // Mensagem
      $this->email->message('Teste de envio de E-mail.');

      // Envia o E-mail
      if( $this->email->send() ){
        echo "E-mail enviado com sucesso!";
      }else{
        // Retorna o resultado de envio e os headers do E-mail
        echo $this->email->print_debugger();
      }

      exit;
    // Volta para o formulário de contato
    redirect("/contato");
  }
  
  function email(){
    
    // carregando biblioteca email
    $this->load->library("email");
    
    // Carregando os Helpers a serem usados
    $this->load->helper("email");
    $this->load->helper("url");
    
    $email['protocol'] = 'smtp';
    $email['smtp_host'] = 'smtp.metasistemas.com.br';
    $email['smtp_user'] = 'gustavo@metasistemas.com.br';
    $email['smtp_pass'] = '';
    $email['mailtype'] = 'html';
    $this->email->initialize($email);

    $this->email->from('gustavo@metasistemas.com.br', 'Gustavo');
    $this->email->to('gsf1308@gmail.com');
    $this->email->cc('gsf1308@gmail.com');
    $this->email->bcc('gsf1308@gmail.com');
    $this->email->subject('Teste codeIgniter');
    $this->email->set_mailtype("text");
    $this->email->message('Teste de envio de E-mail.');

    // Envia o E-mail
    if($this->email->send()){
      echo "E-mail enviado com sucesso!";
    }else{
      // Retorna o resultado de envio e os headers do E-mail
      echo $this->email->print_debugger();
    }
  }
  
}