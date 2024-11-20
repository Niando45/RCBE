<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Page extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }


    public function index() {
        $data['page_name'] = 'login';  
        $this->load->view('interface/index', $data);  
    }

    
    public function create_account() {
        $data['page_name'] = 'register';
        $this->load->view('interface/index', $data);
    }

 
    public function menu() {
        $data['page_name'] = 'menu';
        $this->load->view('interface/index', $data);
    }

    public function otp(){
        $data['page_name']='otp';
        $this->load->view('interface/index', $data);
    }
}

