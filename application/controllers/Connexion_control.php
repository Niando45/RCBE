<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Connexion_control extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Connexion_model', 'm_connexion');
        $this->load->library(['session', 'email']); 
    }

    public function authentification_admin() {
        $nifonline = $this->input->post('nifonline');
        $email = $this->input->post('email');
        $password = trim($this->input->post('password'));

        $data = $this->m_connexion->get_users_by_email($email);

        $verificationNif = $this->verification_NIF($nifonline) ;

        // $this->session->set_flashdata('error','nif ='.$verificationNif);
        var_dump($verificationNif); // Vérifier le contenu de la variable (commentena refa mety)

exit;//commentena refa mety 

        if (!$verificationNif['status']){
            $this->session->set_flashdata('error', 'Le Nifinfo ne correspond pas.');
            redirect('Page/index');
        }


        if (count($data) > 0) {
            if ($data[0]->email == $email) {
                if (!empty($data[0]->pwd) && password_verify($password, $data[0]->pwd)) {

                    $otp = random_int(1000, 9999);

                    // Enregistre l'OTP dans la base de données
                    $this->m_connexion->update_otp($data[0]->id, $otp);




                    // Stockage des données utilisateur dans la session
                    $user_data = array(
                        'user_id' => $data[0]->id,   // Stockage de l'ID utilisateur sous 'user_id'
                        'nifonline' => $data[0]->nifonline,
                        'email' => $data[0]->email,
                    );
                    $this->session->set_userdata($user_data);

                    // Envoi de l'OTP par email
                    $this->send_otp_email($email, $otp);

                    // Redirige vers la page de saisie de l'OTP
                    redirect('Page/otp');
                } else {
                    $this->session->set_flashdata('error', 'Mot de passe incorrect.');
                    redirect('Page/index');
                }
            } else {
                $this->session->set_flashdata('error', 'L\'email ne correspond pas.');
                redirect('Page/index');
            }
        } else {
            $this->session->set_flashdata('error', 'Utilisateur non trouvé.');
            redirect('Page/index');
        }
    }

    // Vérification de l'OTP
    public function verify_otp() {
        $input_otp = $this->input->post('otp');
        $user_id = $this->session->userdata('user_id');  // Récupération de l'ID de l'utilisateur depuis la session

        if (!$user_id) {
            $this->session->set_flashdata('error', 'Session invalide. Veuillez vous reconnecter.');
            redirect('Page/index');
        }

        // Récupérer l'OTP de l'utilisateur depuis la base de données
        $stored_otp = $this->m_connexion->get_otp($user_id);

        // Comparer l'OTP saisi avec celui stocké
        if ($stored_otp == $input_otp) {
            // Supprimer l'OTP après validation
            // $this->m_connexion->update_otp($user_id, null);

            // Rediriger l'utilisateur vers le menu principal
            redirect('Page/menu');
        } else {
            $this->session->set_flashdata('error', 'OTP incorrect.');
            redirect('Page/otp');
        }
    }


    private function send_otp_email($email, $otp) {
        
        $config = [
            'protocol' => 'smtp',
            'smtp_host' => 'smtp.gmail.com', 
            'smtp_port' => '465',         
            'mailtype'  => 'html',
            'charset'   => 'utf-8',
            'newline'   => "\r\n",
            'crlf' => "\r\n",
            'smtp_crypto' => 'ssl',
            'smtp_user'=>'tolotra2966@gmail.com',
            'smtp_pass'=>'hulqogurftduvuwy'
        ];

        $this->email->initialize($config);

        $this->email->from('tolotra2966@gmail.com', 'app_rcbe');
        $this->email->to($email);
        $this->email->subject('Code de Confirmation');
        $this->email->message("Bonjour,<br><br>Votre code de confirmation est : <strong>$otp</strong><br>Ce code est valide jusqu'à ce que vous l'utilisiez.<br><br>Cordialement,<br>L'équipe.");

        if (!$this->email->send()) {
            log_message('error', 'Échec de l\'envoi de l\'email OTP : ' . $this->email->print_debugger());
            $this->session->set_flashdata('error', 'Échec de l\'envoi de l\'email. Veuillez réessayer.');
        }
    }

    /**
     * here is the verification NIF
     */

     public function verification_NIF($nif) {

        // $url = 'https://portal.impots.mg/databridge/nifonlinelabo//renseignements/entreprise/principale?nif='.$nif.''; // url for the get action
$url = 'https://portal.impots.mg/databridge/nifonlinelabo/renseignements/entreprise/principale?nif=4002198245';//refa mety ty de commentena de decomentena le eo ambony
        $ch = curl_init();

        // Définir les headers que vous voulez envoyer avec la requête
        $headers = array(
            'DGI-Security-Key:t0aZ34m8AMsxmlCXJXHkWGzE2ghFodBkNX7rUOU9', //solona API key vaovao
            'Content-Type: application/json',
        );

        // Définir les options cURL
        curl_setopt($ch, CURLOPT_URL, $url); // L'URL de l'API
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // Retourner la réponse sous forme de chaîne
        curl_setopt($ch, CURLOPT_HEADER, false); // Ne pas inclure les en-têtes dans la réponse
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers); // Ajouter les headers
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); 
        // Exécuter la requête cURL et obtenir la réponse
        $response = curl_exec($ch);

        // Vérifier si une erreur est survenue
        if (curl_errno($ch)) {
            echo 'Erreur cURL : ' . curl_error($ch);
        }

        // Fermer la session cURL
        curl_close($ch);

        // Décoder la réponse JSON (si l'API retourne du JSON)
        $data = json_decode($response, true);

        // return response data
        return $data;
    }
}
?>
