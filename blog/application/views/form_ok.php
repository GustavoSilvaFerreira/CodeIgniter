<html>
<head>
  <title>Seja bem vindo!</title>
  <meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
  <style>
  body{
    font-family: Verdana, Arial, Helvetica, sans-serif;
  }
  #estrutura{
  width: 100%; font-family: verdana; font-size: 16px;
  }
  #center{
    width:730px;margin:0 auto;padding:1em; border: solid 1px #eeeeee;
  }
  </style>
</head>
<body>

<div id="estrutura">
<div id="center">

  <img src="http://www.treinaweb.com.br/treinamentos/arquivos/img/cadastro-ok.png" alt="" />
  <br />

  <p>
    Cadastro realizado com sucesso. Seja bem vindo ao curso de CodeIgniter do TreinaWeb!
    
    <?php echo $mensagem ?>
  </p>

  <p>
    <?php echo anchor("/cadastro/","Voltar"); ?>
  </p>

</div>
</div>  

</body>
</html>