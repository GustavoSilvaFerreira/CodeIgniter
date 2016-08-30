<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Helpers extends CI_Controller {
	
	public function __construct() {
		parent::__construct ();
		$this->load->helper ( "html" );
	}
	
	public function index() {
		$this->load->view( "helpers" );
	}
	//helper html
	public function teste_imagem() {
		echo img ( "http://programmerlab.com/wp-content/uploads/2016/07/codeig.jpg" );
	}
	
	public function teste_titulo() {
		echo heading ( "TreinaWeb cursos - CodeIgniter", 1 );
	}
	
	public function html() {
		// Declaração do tipo de documento. Gera o cabeçalho de documentos XHTML. As opções são: 
		//xhtml11, xhtml1-strict, xhtml1-trans, xhtml1-frame, html5, html4-strict, html4-trans, html4-frame
		echo doctype('xhtml1-trans');
		
		echo heading("TreinaWeb",1); // h1
		echo br(1);
		echo heading("Cursos",2); // h2
		echo link_tag('css/style.css'); // link externo
		echo link_tag('favicon.ico', 'shortcut icon', 'image/ico');
		echo link_tag('feed.xml','alternate', 'application/rss+xml', 'RSS Feed do site');
		echo nbs(4); // espaços em branco
		
		$lista = array(
        	'PHP',
        	'Python',
        	'Java',
        	'Ruby');

		$atributos = array(
        	'class' => 'lista-azul',
        	'id'    => 'cursos');

		echo ul($lista, $atributos); // lista, pode ser ol()
		
		$meta = array(
			array('name' => 'description', 'content' => 'Descrição'),
			array('name' => 'keywords', 'content' => 'treinaweb, codeiginiter, php'),
			array('name' => 'Content-type', 'content' => 'text/html; charset=utf-8', 'type' => 'equiv'));

		echo meta($meta); // meta tags
		
		
		
	}
	
	//helper array
	public function arrays() {
		
		$this->load->helper ( "array" );
		
		//element
		$array = array (
				'nome' => 'TreinaWeb',
				'sobrenome' => 'Cursos'
		);
		
		//random_element
		echo element ( 'nome', $array );
		
		echo "<br />";
		
		if (! element ( 'teste', $array, FALSE ))
			echo "Elemento não encontrado";
		else
			echo "Elemento encontrado. ";
		
		$array_random = array('PHP','Java','Python','C#','C++','Oracle');
			
		echo "<br>" . random_element($array_random);
		
		// elements
		$_POST = array(
				'id' => '20',
				'titulo' => 'Curso de CodeIgniter',
				'token' => '98045jhsadhgsd87342',
				'teste' => '11="187sa',
				'08237423487' => 'aaa'
		);
		
		$resultado = elements( array('id', 'titulo', 'token'), $_POST);
		echo "<br>";
		print_r( $resultado );
	}
	
	// helper date
	public function datas() {
		
		$this->load->helper("date");
		
		//now()
		echo now();
		
		// mdate
		$this->load->helper('date');
		
		$data_string = "Ano: %Y Mês: %m Dia: %d Horas: %H: Minutos: %i Segundos: %s";
		
		echo "<br>" . mdate($data_string, now());
		
		//standard_date()
		echo "<br>" . standard_date('DATE_ATOM', now());
		
		// mysql_to_unix
		$mysql = '2011-05-11 21:10:47';
		
		$unix = mysql_to_unix($mysql);
		
		echo "<br>" . $unix;
		
		// unix_to_human
		$this->load->helper('date');
		
		$now = now();
		
		echo "<br>" . unix_to_human($now) . "<br />"; // U.S. time, sem segundos.
		
		echo unix_to_human($now, TRUE, 'us') . "<br />"; // U.S. time com segundos.
		
		echo unix_to_human($now, TRUE, 'eu'); // Euro time com segundos.
		
		// timezones (fuso horario selecionado)
		echo "<br>" . timezones('UM3');
		
		// timezone_menu (combo com fuso horarios)
		echo "<br>" . timezone_menu('UM3');
	}
	
	// helper directory
	public function diretorios() {
	
		$this->load->helper('directory');
		
		// para exibir tudo, sem arquivo oculto
		$dir = directory_map('./application');
		
		// para exibir sem submenu
		//$dir = directory_map('./application',1);
		
		// para listar toda aplicacao
		//$dir = directory_map('./');
		
		// para exibir arquivo oculto tbm
		//$dir = directory_map('./diretorio',0,TRUE);
	
		print_r( $dir );
	
	}
	
	public function formularios() {
		
		$this->load->helper("form");
		
		
		$opcoes = array(
        	'1'  => 'Curso de PHP',
        	'2'  => 'Curso de CodeIgniter',
        	'3'  => 'Curso de MySQL',
        	'4'  => 'Curso de CakePHP',);
		
		// comboBox
		echo form_dropdown('combo-cursos', $opcoes);
		
		echo "<br>";
		// combo multipla escolha / tem o form_multiselect() q por padrão já é multipla escolha
		$config = array('2', 'large');

		echo form_dropdown('combo-cursos', $opcoes, $config);
		
		echo "<br>";
		// comboBox com select
		$config = array('2');
	
		echo form_dropdown('combo-cursos', $opcoes, $config);
		
		echo "<br>";
		// form_fieldset
		echo form_fieldset('Dados para contato');

    	echo "<p>Telefone residiencial e celular.</p>";
    	echo form_input('telefone', 'Telefone Residencial');
    	echo "<br />";
    	echo form_input('celular', 'Telefone Celular');

		echo form_fieldset_close();
		
		echo "<br>";
		// check Box
		echo form_checkbox('cursos[]', 'PHP Básico', TRUE);
		echo form_checkbox('cursos[]', 'JAVA Básico');
		
		echo "<br>";
		// check box - parametros com array
		$checkbox = array(
		'name'        => 'cursos[]',
		'class'       => 'check-cursos',
		'value'       => 'PHP Básico',
		'checked'     => TRUE);

		echo form_checkbox($checkbox);
		
		echo "<br>";
		// radio
		echo form_radio('compra', '1');
		echo form_radio('compra', '2', TRUE);
		
		echo "<br>";
		//submit
		echo form_submit('btn-submeter', 'Cadastrar');
		
		echo "<br>";
		// label
		echo form_label('Telefone: ', 'txt-telefone');
		echo form_input("txt-telefone","");
		
		echo "<br>";
		// label com 3º parametro
		$atributos = array(
    	'class' => 'classe-label',
	    'style' => 'color: blue;');

		echo form_label('Telefone: ', 'txt-telefone',$atributos);
		echo form_input("txt-telefone","");
		
		echo "<br>";
		// button
		echo form_button('btn-pesquisar','Pesquisar');
		
		echo "<br>";
		// button com atributos
		$resetar = array(
	    	'name' => 'btn-resetar',
    		'type' => 'reset',
    		'content' => 'Resetar');

		echo form_button($resetar);

		$submeter = array(
	    	'name' => 'btn-submeter',
    		'type' => 'submit',
    		'content' => 'Enviar');

		echo form_button($submeter);

		$pesquisar = array(
    		'name' => 'btn-pesquisar',
    		'content' => 'Pesquisar');

		echo form_button($pesquisar);
		
		echo "<br>";
		// set_Value
		// Existem essas tbm e outras: set_select() set_checkbox() set_radio()
		// Se não existir valor no $_POST["txt-postar"], define um "valor inicial"

		$txt_nome = set_value('txt-postar', 'Valor Inicial');

		// Abre a tag de formulário, observe que estamos postando na página mesmo.

		echo form_open('helpers/formularios');

	    	echo form_fieldset("Exemplo de como recuperar dados de um POST");

    			echo form_label("Seu nome: ","txt-nome");

    			// O txt-nome recebe o valor da variável $txt_nome

    			echo form_input("txt-nome",$txt_nome);

    			echo "<br />";

    			echo form_label("Digite um nome: ","txt-postar");
    			echo form_input("txt-postar","");

    			echo "<br />";

    			echo form_submit("btn-submeter","Enviar");

    		echo form_fieldset_close();

		echo form_close();
		
	}
	
	// helper inflector
	public function inflector(){
		$this->load->helper('inflector');

		echo singular("cats"); // Retorna "cat"
		echo "<br />";
		echo plural("cat"); // Retorna "cats"
		
		echo br(1);
		$string = "treinaweb_cursos";
		echo camelize($string); // Retorna "treinawebCursos"
		
		echo br(1);
		$string = "TreinaWeb Cursos";
		echo underscore($string); // Retorna "treinaweb_cursos"
		
		echo br(1);
		$string = "treinaweb_cursos_ensino_inteligente";
		echo humanize($string); // Treinaweb Cursos Ensino Inteligente
	}
	
	// helper number
	public function number(){
		$this->load->helper('number');
		
		// byte_format - formata para KB, MB, GB etc.
		echo byte_format(875) . "<br />"; // 875 Bytes
		echo byte_format(9999) . "<br />"; // 9.8 KB
		echo byte_format(54128) . "<br />"; // 52.9 KB
		echo byte_format(739824) . "<br />"; // 722.5 KB
		echo byte_format(9871246) . "<br />"; // 9.4 MB
		echo byte_format(123456789874) . "<br />"; // 115.0 GB
		echo byte_format(1234567891234545217); // 1,122,833.0 TB
	}
	
	// helper String
	public function string(){
		$this->load->helper('string');
		
		// random_string
		echo random_string('alpha', 12) . "<br />"; // zWjkDopHEVUM - letras Maiusculas e minusculas
		echo random_string('alnum', 15) . "<br />"; // n62DyjqLCUhOXVM - numeros e letras Maiusculas e minusculas
		echo random_string('numeric', 10) . "<br />"; // 1864709523 - numeros
		echo random_string('nozero', 10) . "<br />"; // 8554231774 - numeros sem zero
		echo random_string('unique') . "<br />"; // 3f5b12784a1623d086a0a46d9922e534 - MD5 de 32 caracteres
		echo random_string('sha1'); // 0b7e8e17fabd9c5f8bd3fa1330d602cea088300d - String criptografada usando sha1
		
		// reapeter() - repete string pelo numero de vezes informado
		echo br(2);
		echo "TreinaWeb";
		echo repeater("-", 50);
		echo "Cursos";
		
		// reduce_double_slashes - converte varias / em apenas 1 , menos as encontradas em http://
		echo br(2);
		$string = "http://site.com//produto///8"; // http://site.com/produto/8
		echo reduce_double_slashes($string);
		
		// trim_slashes - remove / do inicio e fim
		echo br(2);
		$string = "//site/curso/php///"; //  site/curso/php
		echo trim_slashes($string);
		
		// reduce_multiples - remove strings que se repetem em sequencia
		echo br(2);
		$string = "PHP, Python, Java, Ruby,,, C#"; // PHP, Python, Java, Ruby, C#
		echo reduce_multiples($string,",");
		echo br(2);
		// com 3º parametro TRUE para remover strings repetidas do inicio e fim
		$string = ",,,PHP, Python, Java, Ruby, C#,"; // PHP, Python, Java, Ruby, C#
		echo reduce_multiples($string,",", TRUE);
		
		// quotes_to_entities - transfoma aspas em caracteres especiais
		echo br(2);
		$string = "string's \"teste\"";
		echo quotes_to_entities($string);

		// strip_quotes - remove todas as aspas
		echo br(2);
		echo strip_quotes($string); // strings teste
	}
	
	// helper text
	public function text(){
		$this->load->helper('text');
		
		// word_limiter - numero de palavras informado
		$string = "TreinaWeb Cursos - Cursos Online de Tecnologia da Informação";
		echo word_limiter($string,5); // TreinaWeb Cursos - Cursos Online…
		
		// character_limiter - numero de caracteres informado sem os espaços
		// no terceiro parametro pode definir o sufixo usado no final da frase
		echo br(2);
		$string = "TreinaWeb Cursos - Cursos Online de Tecnologia da Informação";
		echo character_limiter($string,15); // TreinaWeb Cursos…
		echo br(2);
		$string = "TreinaWeb Cursos - Cursos Online de Tecnologia da Informação";
		echo character_limiter($string,15,":"); // TreinaWeb Cursos:
		
		// ascii_to_entities - converte ASCII para entidades de caracteres
		echo br(2);
		$string = "€ 25,00";
		echo ascii_to_entities($string); // € 25,00
		
		// entities_to_ascii - converte entidades de caracteres para ASCII
		echo br(2);
		$string = "c o";
		echo entities_to_ascii($string);
		
		// word_censor - Habilita a “censura” de palavras dentro de um texto. O primeiro parâmetro conterá a string original. O segundo conterá um array de palavras proibidas. O terceiro parâmetro (opcional) pode conter um valor substituto para as palavras, se esse valor não for informado, as palavras censuradas serão substituidas por “#”. 
		echo br(2);
		$string = "Não fale NÃO. É feio.";
		$proibidas = array('não', 'feio');
		echo word_censor($string, $proibidas, '@'); // @ fale NÃO. É @.
		
		// highlight_code - Colore a sintaxe de códigos PHP e HTML. Essa função é uma versão “estendida” da nativa que já vem implementada no PHP: 
		echo br(2);
		echo highlight_code("<?php echo 'TreinaWeb'; ?>"); /* <?php echo 'TreinaWeb'; ?> */
		
		// highlight_phrase
		echo br(2);
		$string = "O TreinaWeb cursos é";
		echo highlight_phrase($string,
  			"especializado", '<span style="background-color:yellow;">', '</span>');
  		
  		//word_wrap - Quebra o texto no número de caracteres definidos, mantendo a última palavra sempre inteira. no codigo fonte
  		echo br(2);
  		$string = "O TreinaWeb Cursos é especializado em cursos de TI";
		echo word_wrap($string, 14); // O TreinaWeb Cursos é especializado em cursos de TI
		
		//ellipsize
		echo br(2);
		$string = "O TreinaWeb Cursos é especializado em cursos de TI";
		echo ellipsize($string,30,0) . "<br />"; // … especializado em cursos de TI
		echo ellipsize($string,30,0.5) . "<br />"; // O TreinaWeb Cur…em cursos de TI
		echo ellipsize($string,30,1); // O TreinaWeb Cursos é especiali…
		
	}
	
	// helper URL
	public function url(){
		$this->load->helper('url');
		
		// site_url - Retorna a URL do site, conforme configurada no “config.php” no início do curso. 
		echo site_url();
		// Ainda podemos passar como parâmetro um array com segmentos, ou um segmento já montado para a função. 
		echo br(2);
		echo site_url("helpers/url") . "<br />"; // https://php-unicar-estac-gustavoferreira.c9users.io/blog/index.php/helpers/url
		$segmentos = array("helpers","formularios");
		echo site_url($segmentos); // https://php-unicar-estac-gustavoferreira.c9users.io/blog/index.php/helpers/formularios
		// TIRANDO O index.php - ir em config.php e deixar o index page em branco
		
		// https://php-unicar-estac-gustavoferreira.c9users.io/blog/
		// https://php-unicar-estac-gustavoferreira.c9users.io/blog/helpers/url
		// https://php-unicar-estac-gustavoferreira.c9users.io/blog/helpers/formularios
		
		// base_url - url base da aplicação
		echo br(2);
		echo base_url();
		
		// current_url - url da pagina aberta
		echo br(2);
		echo current_url(); // https://php-unicar-estac-gustavoferreira.c9users.io/blog/helpers/url
		
		// uri_string - retorna o segmento da url
		echo br(2);
		echo uri_string(); // helpers/url
		
		// anchor - Retorna um link(html) baseado na URL do site. 
		echo br(2);
		$atributos = array('title' => 'Compra de produtos');
		echo anchor('compra/produto/2', 'Comprar Produto', $atributos); // Comprar Produto (link) <a href="https://php-unicar-estac-gustavoferreira.c9users.io/blog/compra/produto/2" 
		
		// anchor_popup - Cria um link que abre uma popup. Basta definir seus parâmetros. 
		echo br(2);
		$atributos = array(
          'width'      => '800',
          'height'     => '600',
          'scrollbars' => 'yes',
          'status'     => 'yes',
          'resizable'  => 'yes',
          'screenx'    => '0',
          'screeny'    => '0');
		echo anchor_popup('compra/produto/2', 'Comprar', $atributos);
		/* 
		<a href="https://php-unicar-estac-gustavoferreira.c9users.io/blog/compra/produto/2" 
		onclick="window.open('https://php-unicar-estac-gustavoferreira.c9users.io/blog/compra/produto/2', 
		'_blank', 'width=800,height=600,scrollbars=yes,menubar=no,status=yes,resizable=yes,screenx=0,screeny=0'); 
		return false;">Comprar</a>
		*/
		
		// auto_link - Transforma E-mails e url de uma string em links html. 
		echo br(2);
		// Transforma e-mails e urls em links
		$string = "O site é www.treinaweb.com.br e o email é oi@treinaweb.com.br";
		echo auto_link($string) . "<br />"; // O site é www.treinaweb.com.br e o email é oi@treinaweb.com.br

		// Transforma apenas urls em links
		$string = "O site é www.treinaweb.com.br e o email é oi@treinaweb.com.br";
		echo auto_link($string, "url") . "<br />"; // O site é www.treinaweb.com.br e o email é oi@treinaweb.com.br

		// Transforma apenas e-mails em links
		$string = "O site é www.treinaweb.com.br e o email é oi@treinaweb.com.br";
		echo auto_link($string, "email") . "<br />"; // O site é www.treinaweb.com.br e o email é oi@treinaweb.com.br

		// Transforma Urls e E-mails em links que serão abertos em uma nova janela
		$string = "O site é www.treinaweb.com.br e o email é oi@treinaweb.com.br";
		echo auto_link($string, "both", TRUE); // O site é www.treinaweb.com.br e o email é oi@treinaweb.com.br
		
		// url_title - Transforma uma string em uma url amigável. Por exemplo, a descrição de um exemplo, ao invés de: 
		echo br(2);
		// O segundo parâmetro da função define o delimitador, se vai usar “underline” ou “hífen”. O terceiro parâmetro se definido como TRUE imprime o resultado em caixa baixa (minúsculo). 
		$descricao = "Curso de CodeIgniter";
		echo url_title($descricao) . "<br />"; // Curso-de-CodeIgniter
		echo url_title($descricao,'underscore') . "<br />"; // Curso_de_CodeIgniter
		echo url_title($descricao, 'dash', TRUE); // curso-de-codeigniter
		
		// redirect
		// O segundo parâmetro (opcional) permite definirmos o método "location" (padrão, é o mais utilizado) ou o método "refresh". O terceiro parâmetro (opcional) permite que enviemos um determinado HTTP Response Code como, por exemplo, um redirecionamento permanente 301 (Tipos de redirecionamentos são muito vistos em SEO). 
		echo br(2);
		// Redirecionamento "location"
		redirect('/compra/produtos');

		// Redirecionamento "refresh"
		redirect('/compra/produtos', 'refresh');

		// Redirecionamento com o envio de HTTP Responde Code.
		redirect('/compra/produtos', 'location', 301);
		
		
	}
	
	//BIBLIOTECAS
	
	// benchmarking - calcular tempo entre dois pontos da aplicação
	public function performance(){
		
		// Início da operação
		$this->benchmark->mark('loop-inicio');
		for($i=0;$i<5000000;$i++)
    		echo "";
		// Fim da operação
		$this->benchmark->mark('loop-fim');
		// Imprime o resultado
		echo $this->benchmark->elapsed_time('loop-inicio', 'loop-fim');
		
		// verificar tempo de mais de um ponto
		echo br(2);
		// Loop 5 milhões
		$this->benchmark->mark('ponto1');
		for($i=0;$i<5000000;$i++)
    		echo "";

		// Loop 3 milhões
		$this->benchmark->mark('ponto2');
		for($i=0;$i<3000000;$i++)
    		echo "";

		// Loop 1 milhão
		$this->benchmark->mark('ponto3');
		for($i=0;$i<1000000;$i++)
    		echo "";

		// Resultados
		echo "P1 a P3: " . $this->benchmark->elapsed_time('ponto1', 'ponto3') . "<br />";
		echo "P1 a P2: " . $this->benchmark->elapsed_time('ponto1', 'ponto2') . "<br />";
		echo "P2 a P3: " . $this->benchmark->elapsed_time('ponto2', 'ponto3');
		
		// Exibindo um Benchmarking completo da aplicação através da classe “Profiler”
		echo br(2);
		// Ativando a exibição completa do Benchmarking
		$this->output->enable_profiler(TRUE);

		// Operação 1. Observe o "_start" e "_end"
		$this->benchmark->mark('loop5milhoes_start');
		for($i=0;$i<5000000;$i++)
    		echo "";

		$this->benchmark->mark('loop5milhoes_end');

		// Operação 2. Observe o "_start" e "_end"
		$this->benchmark->mark('loop3milhoes_start');
		for($i=0;$i<3000000;$i++)
    		echo "";

		$this->benchmark->mark('loop3milhoes_end');
		
	}
	
	// Calendario
	public function calendario(){
		$this->load->library('calendar');

		echo $this->calendar->generate();
	}
	
	
	
	
}