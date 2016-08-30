<?php

// Imprime o Doctype

echo doctype('xhtml1-trans');

?>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <title>Cadastro - TreinaWeb CodeIgniter</title>
  <meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
  <style type="text/css">
  small.erro{display: block;padding: 0.2em;
  background-color: #990000; color: white; margin: 0.2em;}
  </style>
</head>
<body>

<?php
echo form_open('cadastro') . "\n\n";
echo form_fieldset("Cadastro") . "\n";
?>

<label for="nome">Nome: </label><br />
<?php echo form_error('nome'); ?>
<input type="text" name="nome" value="<?php echo set_value('nome','');?>" size="50" />
<br />

<label for="email">E-mail: </label><br />
<?php echo form_error('email'); ?>
<input type="text" name="email" value="<?php echo set_value('email','');?>" size="50" />
<br />

<label for="senha">Senha: </label><br />
<?php echo form_error('senha'); ?>
<input type="password" name="senha" value="" />
<br />

<label for="senha-confirma">Confirme a senha: </label><br />
<?php echo form_error('senha-confirma'); ?>
<input type="password" name="senha-confirma" value="" />
<br /><br />

<input type="submit" value="Efetuar Cadastro" />

<?php
echo form_fieldset_close() . "\n\n";
echo form_close();
?>

<?php
// Imprime todos os erros encontrados

echo validation_errors();
?>

</body>
</html>