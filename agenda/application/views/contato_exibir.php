<?php echo doctype('xhtml1-trans');?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <title>Agenda - <?php echo $nome; ?></title>
  <?php echo link_tag( base_url() . 'css/estilo.css'); ?>
</head>
<body>

<div id="estrutura">

<div id="h1-center">
  <h1>
  <img src="<?php echo $img_dir;?>/agenda-title.png" />
  <span>Visualizar / Editar - <?php echo $nome; ?></span>
  <a href="<?php echo site_url('/contatos'); ?>"><button> &lt; Voltar para os Contatos</button></a>
  </h1>
</div>

<div id="meio">

<?php echo validation_errors();?>

<?php echo form_open('/contatos/atualizar'); ?>

<input type="hidden" name="id" value="<?php echo $id; ?>" />

<strong>Nome: </strong><br />
<input type="text" name="nome" size="65" value="<?php echo $nome; ?>" />
<br /><br />

<strong>Telefone: </strong><br />
<input type="text" name="telefone" size="35" value="<?php echo $telefone; ?>" />
<br /><br />

<strong>Celular: </strong><br />
<input type="text" name="celular" size="35" value="<?php echo $celular; ?>" />
<br /><br />

<strong>E-mail: </strong><br />
<input type="text" name="email" size="65" value="<?php echo $email; ?>" />
<br /><br />

<strong>Observações: </strong><br />
<textarea rows="7" cols="65" name="observacoes"><?php echo $observacoes; ?></textarea>
<br /><br />

<input type="submit" value="Atualizar">

<?php echo form_close(); ?>

<div class="clear"></div>

</div>

</div>

</body>
</html>