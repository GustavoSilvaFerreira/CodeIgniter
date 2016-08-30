<?php

$config = array(
  'cadastro/index' =>
    array(
      array(
        'field' => 'nome',
        'label' => 'nome',
        'rules' => 'trim|required|min_length[3]|max_length[50]|xss_clean|callback_validar_nome'
         ),
      array(
        'field' => 'email',
        'label' => 'e-mail',
        'rules' => 'trim|required|valid_email|callback_usuario_ja_cadastrado'
         ),
      array(
        'field' => 'senha',
        'label' => 'senha',
        'rules' => 'trim|required|min_length[4]|max_length[25]|md5'
         ),
      array(
        'field' => 'senha-confirma',
        'label' => 'confirme a senha',
        'rules' => 'trim|required|matches[senha]|md5'
         )
      )
    );
    
?>