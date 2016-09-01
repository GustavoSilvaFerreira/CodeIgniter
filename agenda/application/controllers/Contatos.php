<?php

class Contatos extends MY_Controller{
	// Número de contatos por página
	
	private $contatos_pagina = 9;
	
	// Diretório da pasta onde as imagens estão localizadas
	
	private $img_dir = "";
	
	// Método construtor
	
	public function __construct(){
		parent::__construct();
		
		# Carrega os Helpers
		
		$this->load->helper(array('url','html','form'));
		$this->load->library('form_validation');
		
		# Carrega na propriedade a configuração 'pasta_img' config/config.php
		
		$this->img_dir = base_url() . $this->config->item('pasta_img');	 
		
		# Carrega o Model da aplicação

		$this->load->model('model_agenda');	
	}
	
	// Index. Redireciona para 'contatos/all' 
	
	public function index()
	{
		// 'Delega' para o método all() logo abaixo

		$this->all();
	}
	
	// Exibe todos os contatos
	
	public function all($de_paginacao=0)
	{
		# Preparando o limite da paginação

		$de_paginacao = ( $de_paginacao < 0 || $de_paginacao == 1 ) ? 0 : (int) $de_paginacao;         

		# Carrega as bibliotecas
		
		$this->load->library(array('pagination','table'));
	
		# Acessa o Model, executa a função get_all() e recebe os contatos
		
		$contatos = $this->model_agenda->get_all($de_paginacao, $this->contatos_pagina);
		
        # Paginação
        
		$config_paginacao['base_url'] 	= site_url('contatos/all/');
        $config_paginacao['total_rows'] = $this->model_agenda->count_rows();
	    $config_paginacao['per_page'] = $this->contatos_pagina;
        
	    $this->pagination->initialize($config_paginacao);
	    
        $dados['html_paginacao'] = $this->pagination->create_links();
		
		# img_dir
		
		$dados['img_dir'] = $this->img_dir;
		        
		# Itera sobre os contatos retornados e gera uma tabela HTML

		$this->table->set_heading('Nome', 'Telefone', 'Email', 'Operações');
		
		foreach ($contatos->result() as $contato)
		{
			$this->table->add_row
			( 
				$contato->nome, 
				$contato->telefone, 
				$contato->email,
				'<div class="center">
				<a class="c-view" href="'.site_url('/contatos/visualizar') . '/' . $contato->id . 
				'" title="Visualizar"><img src="'.$dados['img_dir'].'/visualizar.png" /> </a>' .
				
				'<a class="c-del" href="'.site_url('/contatos/remover') . '/' . $contato->id . 
				'" title="Deletar"><img src="'.$dados['img_dir'].'/deletar.png" /> </a>
				<div>'
			);
		}
		
		$dados['html_contatos'] = $this->table->generate();
		
		# Carrega a view 'agenda'
		$this->load->view('agenda_exibir', $dados);
	}
	
	// Abre a View de visualizar / editar
	
	public function visualizar($id)
	{
		# Acessa o Model
		
		$contatos = $this->model_agenda->get_by_id($id);
		
		# Se não encontrou esse contato, o Model retorna FALSE
		
		if( $contatos==FALSE )
		{
			redirect('/contatos','refresh');
		}
		
		# Coloca os dados no Array que será enviado para a View
		
		$dados['id'] = $contatos->row(0)->id; 		
		$dados['nome'] = $contatos->row(0)->nome; 
		$dados['telefone'] = $contatos->row(0)->telefone; 
		$dados['celular'] = $contatos->row(0)->celular; 
		$dados['email'] = $contatos->row(0)->email; 
		$dados['observacoes'] = $contatos->row(0)->observacoes; 
		
		# img_dir
		
		$dados['img_dir'] = $this->img_dir;		
		
		# Abre a View
		
		$this->load->view('contato_exibir',$dados);
	}
	
	// Processa uma atualização
	
	public function atualizar()
	{
		$this->form_validation->set_error_delimiters('<div class="erro">','</div>');
		
		# -- Exercício: Implemente aqui uma validação de dados
		$this->form_validation->set_rules('nome','nome','required|trim');
		$this->form_validation->set_rules('telefone','telefone','required|trim');
		$this->form_validation->set_rules('celular','celular','required|trim');
		$this->form_validation->set_rules('email','email','required|trim|valid_email');
		$this->form_validation->set_rules('observacoes','observacoes','required|trim');
		
		$id_contato = (int) $this->input->post('id', TRUE);
		
		if( $this->form_validation->run()==FALSE ){
			
			$contatos = $this->model_agenda->get_by_id($id_contato);
			
			$dados['id'] = $contatos->row(0)->id; 		
			$dados['nome'] = $contatos->row(0)->nome; 
			$dados['telefone'] = $contatos->row(0)->telefone; 
			$dados['celular'] = $contatos->row(0)->celular; 
			$dados['email'] = $contatos->row(0)->email; 
			$dados['observacoes'] = $contatos->row(0)->observacoes;
			$dados['img_dir'] = $this->img_dir;
			# Não passou nas validações. Abre o formulário de login
			$this->load->view('contato_exibir', $dados);
		}else{
			
			# Objeto. Também poderíamos enviar um array associativo chave => valor
			$dados_contato = new stdClass();
			$dados_contato->nome = $this->input->post('nome', TRUE);
			$dados_contato->telefone = $this->input->post('telefone', TRUE);
			$dados_contato->celular = $this->input->post('celular', TRUE);
			$dados_contato->email = $this->input->post('email', TRUE);
			$dados_contato->observacoes = $this->input->post('observacoes', TRUE);	
			$dados_contato->dt_atualizacao = date("Y-m-d",time());									
				
			# Chama o Model e pede para atualizar o contato
			
			$resultado = $this->model_agenda->update($id_contato, $dados_contato);
		
			# Seta uma sessão com o resultado do Update ( True ou False )

			if( $resultado==TRUE ){
				$this->session->set_flashdata('update-ok', 'Dados atualizados com sucesso.');	
			}

			# Redireciona
		
			redirect('/contatos', 'refresh');
		}
				
	}

	// Remove um contato
	
	public function remover($id)
	{
		$resultado = $this->model_agenda->delete($id);
		
		if( $resultado==TRUE )
		{
			$this->session->set_flashdata('delete-ok', 'Contato removido com sucesso.');
		}

		# Redireciona
		
		redirect('/contatos', 'refresh');	
	}
	
	public function cadastrar(){
		
		$this->load->view('cadastro_form');
	}
	
	// Insere um novo contato
	public function inserirCadastro(){
		
		# -- Exercício: Crie o processo de cadastro, bem como a View.
		$this->form_validation->set_error_delimiters('<div class="erro">','</div>');
		
		// Regras de validação
		
		# xss_clean -> Filtra e limpa o dado recebido.
		$this->form_validation->set_rules('nome','nome','required|trim');
		$this->form_validation->set_rules('telefone','telefone','required|trim');
		$this->form_validation->set_rules('celular','celular','required|trim');
		$this->form_validation->set_rules('observacoes','observacoes','trim');
		$this->form_validation->set_rules('email','email','required|trim|valid_email');
		
		if( $this->form_validation->run()==FALSE ){
			
			# Não passou nas validações. Abre o formulário de cadastro
			$this->load->view('cadastro_form');
		}else{
			
			$dados_contato = new stdClass();
			$dados_contato->nome = $this->input->post('nome', TRUE);
			$dados_contato->telefone = $this->input->post('telefone', TRUE);
			$dados_contato->celular = $this->input->post('celular', TRUE);
			$dados_contato->email = $this->input->post('email', TRUE);
			$dados_contato->observacoes = $this->input->post('observacoes', TRUE);
			$dados_contato->dt_atualizacao = date('Y-m-d H-i-s');
			
			$resultado = $this->model_agenda->insere($dados_contato);
		
			# Seta uma sessão com o resultado do Update ( True ou False )

			if( $resultado==TRUE ){
				$this->session->set_flashdata('inserir-ok', 'Dados inseridos com sucesso.');	
			}
			
			redirect('/contatos', 'refresh');
		}

		/*
		
		Você pode fazer parecido com o que foi feito em Login, 
		verificando se os dados foram postados com sucesso, 
		se não foram, abre a view de cadastro.
		
		Quando um cadastro for submetido corretamente, ele vai passar aqui na validação,
		aí sim, executa o método do modelo que fará a inserção dos dados.
		
		É importante que você faça essa etapa sozinho, para entender e praticar.
		 
		*/
	}
	
	// Sair do sistema
	public function sair(){
		
		if($this->session->userdata('user_logado')){
			$this->session->sess_destroy();
			redirect('/contatos', 'refresh');
		}
	}
}