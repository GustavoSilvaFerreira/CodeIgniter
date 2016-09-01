<?php echo doctype('xhtml1-trans');?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <title>Agenda - Cadastro</title>
  <?php echo link_tag( base_url() . 'css/estilo.css'); ?>
</head>
<body>

<div id="estrutura">

<div id="h1-center">
  <h1 class="h1-login">
  <span>Cadastro - Agenda GSF</span>
  </h1>
</div>

<div id="meio" class="meio-login">

<p>
Cadastro para acesso ao sistema de Agenda
<b>GSF</b>.
</p>

<div>

<?php echo validation_errors();?>

<?php echo form_open('/contatos/inserirCadastro'); ?>

<label for="nome">Nome: </label><br />
<input type="text" name="nome" value="Gustavo" />
<br /><br />

<label for="telefone">Telefone: </label><br />
<input type="tel" name="telefone" value="32323232" />
<br /><br /> 

<label for="celular">Celular: </label><br />
<input type="tel" name="celular" value="982156530" />
<br /><br /> 

<label for="observacoes">Observações: </label><br />
<input type="text" name="observacoes" value="teste" />
<br /><br />

<label for="email">E-mail: </label><br />
<input type="email" name="email" value="guto7626@hotmail.com" />
<br /><br />

<input type="submit" value="Efetuar cadastro" />

<?php echo form_close(); ?>

</div>

</div>

</div>

</body>
</html>