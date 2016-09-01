<?php

class Login extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();

		// Carrega a biblioteca de validação e os Helpers
		
		$this->load->helper(array('form', 'url', 'html'));
		$this->load->library('form_validation');
				
	    // Se o usuário estiver logado, redireciona para /contatos

		if( $this->session->userdata('user_logado') )
		{
			redirect('/contatos', 'refresh');			
		}
	}
	
	public function index(){
		$this->form_validation->set_error_delimiters('<div class="erro">','</div>');
		
		// Regras de validação
		
		# xss_clean -> Filtra e limpa o dado recebido.
		
		$this->form_validation->set_rules('email','email','required|trim|valid_email');//|xss_clean
		
		# Observe que a senha já é transformada em MD5
		
		$this->form_validation->set_rules('senha','senha','trim|md5|callback_r_valida_login');	
		
		if( $this->form_validation->run()==FALSE ){
			
			# Não passou nas validações. Abre o formulário de login
			$this->load->view('login_form');
		}else{
			
			# Passou nas validações e o usuário foi logado com sucesso.
			redirect('/contatos');
		}
	}	
	
	// Regra que valida junto ao banco de dados se esse usuário existe
	public function r_valida_login($senha){
		
		// Carrega o Model de verificação de Login
		$this->load->model('model_login');
		
		// Obtêm apenas o E-mail pois a senha já foi recuperada através do parâmetro $senha
		
		$email = $this->input->post('email', TRUE);
		
		// A partir do método verifica_login() do Model, valida se esse usuário realmente existe
		
		$resultado = $this->model_login->verifica_login($email, $senha);
		
		// $resultado retorna o objeto de get() com alguns valores e um deles é o num_rows
		  
		if( $resultado==FALSE ){
			
			$this->form_validation->set_message('r_valida_login', 'Não encontramos seu cadastro no sistema.');
			return FALSE;	
		}else{
			
			// O usuário existe. Coloca na sessão o seu ID e uma variável 'user_logado'
			$dados_login = array(
							'user_logado' => TRUE, 
							'user_id' => $resultado
							);

			$this->session->set_userdata($dados_login);			

			// Retorna TRUE para que a validação seja realizada com sucesso.
			return TRUE;
		}
	}
	
}