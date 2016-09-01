<?php

class Model_agenda extends CI_Model{
    
    public function get_all(){
        return $this->db->get('agenda');
    }
    
    public function get_um($id, $nome){
        
        $sql = 'SELECT * FROM tw_agenda WHERE id= ? AND nome= ?';
        $dados = array($id,$nome);

        return $this->db->query($sql, $dados);
    }
}

?>