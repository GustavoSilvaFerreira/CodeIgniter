<?php echo doctype('xhtml1-trans');?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <title>Agenda - Login</title>
  <?php echo link_tag( base_url() . 'css/estilo.css'); ?>
</head>
<body>

<div id="estrutura">

<div id="h1-center">
  <h1 class="h1-login">
  <span>Login - Seja bem vindo(a)!</span>
  </h1>
</div>

<div id="meio" class="meio-login">

<p>
Acesso ao sistema de Agenda
<b>GSF</b>.
</p>

<div>

<?php echo validation_errors();?>

<?php echo form_open('/login'); ?>

<label for="email">E-mail: </label><br />
<input type="text" name="email" value="" />
<br /><br /> 

<label for="senha">Senha: </label><br />
<input type="password" name="senha" value="" />
<br /><br />
<p style="color: green"><b>Entre com login abaixo:</b></p>
<p>E-mail: teste@teste.com.br</p>
<p>Senha: 123</p>
<input type="submit" value="Efetuar login" />

<?php echo form_close(); ?>

</div>

</div>

</div>

</body>
</html>