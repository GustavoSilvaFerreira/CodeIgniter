<?php

// Imprime o Doctype

echo doctype('xhtml1-trans');

?>

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <title>Formulário de Contato - TreinaWeb CodeIgniter</title>
  <style type="text/css">
    .erro,
    .ok{
      padding: 1em;
      color: white;
      margin-bottom: 0.5em;
    }
    
    .erro{
      background-color: #f00;
    }
    
    .ok{
      background-color: green;
    }
  </style>
</head>

<body>

<?php

$contato =& get_instance(); // pegar instancia da super classe CI_Controller

$erro = $contato->session->flashdata('erro');
$ok = $contato->session->flashdata('ok');

if($erro!=""){
  echo "<div class='erro'>" . $erro . "</div>";
}
if($ok!=""){
  echo "<div class='ok'>" . $ok . "</div>";
}

$txt_nome = $this->input->cookie("teste_contato", TRUE);
echo form_open('contato/enviar') . "\n\n";

  echo form_fieldset("Contato") . "\n";

    echo form_label('Nome: ', 'txt-nome') . "<br />\n";
    echo form_input("txt-nome", $txt_nome) . "\n\n";

    echo br(); // <br />

    echo form_label('E-mail: ', 'txt-email') . "<br />\n";
    echo form_input("txt-email") . "\n\n";

    echo br(); // <br />

    echo form_label('Mensagem: ', 'txt-msg') . "<br />\n";
    echo form_textarea( array("name"=>"txt-msg","rows"=>10, "cols"=>50), "") . "\n\n";

    echo br(); // <br />

    echo form_submit("btn-enviar","Enviar") . "\n";

  echo form_fieldset_close() . "\n\n";

echo form_close();

?>

</body>
</html>