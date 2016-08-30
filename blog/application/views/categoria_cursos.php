<html>
<head>
<title>Curso de CodeIgniter - TreinaWeb</title>
</head>
<body>

<h1><?php echo $categoria; ?></h1>

  <ul>

    <?php
    foreach ( $cursos AS $curso )
    {
    ?>

    <li><?php echo $curso; ?></li>

    <?php
    }
    ?>

  </ul>

  <a href="http://www.treinaweb.com.br">www.treinaweb.com.br</a>

</body>
</html>