<p>Conteudo</p>
<ul>

<?php

  // Faz com que o valor de quantidade nunca seja maior que 10

  $quantidade = ( $quantidade>10 ) ? 10 : $quantidade;

  // Imprime a tag informada a $quantidade de vezes definida

  for ($i = 0; $i < $quantidade; $i++) {

?>

<li>
  <?php echo $i+1 . " ". $tag; ?>
</li>

<?php

  }

?>

</ul>