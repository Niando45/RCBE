<?php

Class Connexion_model extends CI_model {

    public function get_users_by_nifonline($nifonline) {
        $this->db->where('nifonline', $nifonline);
        $query = $this->db->get('inscription');
        return $query->result();
    }

    public function update_otp($user_id, $otp) {
        $this->db->where('id', $user_id);  // Utilisation de 'id' pour identifier l'utilisateur
        $this->db->update('inscription', ['otp' => $otp]);
    }

    public function get_otp($user_id) {
        $this->db->where('id', $user_id);  // Utilisation de 'id' pour récupérer l'OTP
        $query = $this->db->get('inscription');
        return $query->row()->otp;  // Retourne l'OTP stocké
    }

}
?>
