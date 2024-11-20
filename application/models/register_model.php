<?php
class Register_model extends CI_model{
    public function ajouter_utilisateurs($data){
        $this->db->insert('inscription',$data);
    }
}