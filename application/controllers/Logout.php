<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Logout extends CI_Controller{

    public function __construct()
    {
        parent::__construct();
    }

    public function index(){
        redirect('logout');
    }
    public function logout(){
        $this->session->sess_destroy();
        redirect(base_url('login'));
    }
}