<?php
// SEGURANÇA
class Uri extends CI_Controller {

    public function segment(){
        
        echo $this->uri->segment(5);
        
        $id = (int) $this->uri->segment (5);

        $id = ( $id>0 ) ? $id : 1;

        echo $id;
        
        echo $this->uri->slash_segment(3) . "<br />";
        echo $this->uri->slash_segment(3, 'leading') . "<br />";
        echo $this->uri->slash_segment(3, 'both');
    
    
    }

}

?>