<?php echo doctype('xhtml1-trans');?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <title>Agenda - GSF</title>
  
  <?php echo link_tag( base_url() . 'css/estilo.css'); ?>
  <?php echo link_tag( base_url() . 'css/jquery.alerts.css'); ?> 
  
  <script type="text/javascript" src="<?php echo base_url() . 'js/jquery.min.js'; ?>"></script>
  <script type="text/javascript" src="<?php echo base_url() . 'js/jquery.alerts.js'; ?>"></script>  
  
  <script type="text/javascript">

  jQuery(document).ready(function(){

	jQuery(".c-del").click(function(e){

		var url = jQuery(this).attr('href');
		
		e.preventDefault();
		
		jConfirm('Deseja mesmo deletar este contato?', 'Confirmação', function(resposta) {

			if( resposta==true )
			{
				document.location.href = url;
			}
			
		});
		
	});
	  
  });
  
  </script>
  
</head>
<body>

<div id="estrutura">

<div id="h1-center">
  <h1>
  <img src="<?php echo $img_dir;?>/agenda-title.png" />
  <span>Agenda GSF</span>
  <a href="<?php echo site_url('contatos/sair/'); ?>"><button>Sair</button></a>
  </h1>
</div>

<div id="meio">

<?php 

if( $this->session->flashdata('delete-ok')!="" ){
	echo "<div class='ok'>".$this->session->flashdata('delete-ok')."</div>";
}

if( $this->session->flashdata('update-ok')!="" ){
	echo "<div class='ok'>".$this->session->flashdata('update-ok')."</div>";
}

if( $this->session->flashdata('inserir-ok')!="" ){
	echo "<div class='ok'>".$this->session->flashdata('inserir-ok')."</div>";
}

?>

<div id="tabela">
	<?php 
		// Imprime a tabela de contatos retornada pelo controlador
		echo $html_contatos;
	?>
</div>

<div class="paginacao">
	<div class="div">
	<?php 
		// Imprime a paginação
		echo $html_paginacao;
	?>
	</div>
	<div class="adicionar">
		<a href="<?php echo site_url('contatos/cadastrar'); ?>" title="Adicionar novo contato">
			<img src="<?php echo $img_dir;?>/add-contato.png" alt="" />
			<span>Novo Contato</span>
		</a>
	</div>
</div>

<div class="clear"></div>

</div>

</div>

</body>
</html>