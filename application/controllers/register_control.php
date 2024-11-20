<?php
defined('BASEPATH') or exit('No direct script access allowed');

Class Register_control extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('register_model', 'm_register');
        $this->load->library('upload');
    }
   
    public function enregistre_utilisateurs() {
        
        $nom = $this->input->post("nom");
        $email = $this->input->post("email");
        $pwd = $this->input->post("pwd");

    
        if (empty($nom) || empty($email) || empty($pwd)) {
            echo "Erreur : Tous les champs doivent être remplis.";
            return; 
        }

        
        if (empty($pwd)) {
            echo "Erreur : Le mot de passe ne peut pas être vide.";
            return; 
        }

        
        $fichier = null;
        if (!empty($_FILES['fichier']['name'])) {
            $config['upload_path'] = './uploads/';
            $config['allowed_types'] = 'jpg|png|jpeg|pdf';
            $config['max_size'] = 2048;

            $this->upload->initialize($config);

            if ($this->upload->do_upload('fichier')) {
                
                $fichier = $this->upload->data('file_name');
            } else {
                echo $this->upload->display_errors();
                return;
            }
        }

    
        $hashed_password = password_hash($pwd, PASSWORD_DEFAULT);

        log_message('debug', 'Mot de passe haché : ' . $hashed_password);


        $data = [
            "nomE" => $nom,
            "email" => $email,
            "pwd" => $hashed_password,
            "fichier" => $fichier
        ];


        $this->m_register->ajouter_utilisateurs($data);
        
        
        echo "Inscription réussie !";
    }
}
