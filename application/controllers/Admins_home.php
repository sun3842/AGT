<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Admins_home extends CI_Controller{
    public function __construct()
    {
        parent::__construct();
        if($this->session->userdata('user_login_id')){
            $this->load->model('Admin_ddt_model');
            $this->load->model('Admin_report_model');




            if($this->session->userdata('language')){
                if($this->session->userdata('language')=='LANG_EN'){
                    $this->lang->load('layout_en_lang','english');
                    $this->lang->load('admin_home_en_lang','english');
                }
                else if($this->session->userdata('language')=='LANG_IT'){
                    $this->lang->load('layout_it_lang','italian');
                    $this->lang->load('admin_home_it_lang','italian');
                }
            }
            else {
                $this->lang->load('layout_en_lang','english');
                $this->lang->load('admin_home_en_lang','english');
            }


        }else{
            redirect(base_url('login'));
        }
    }


    public function index(){
        echo "No Path To Go";
    }

    public function admins_home(){
        $current_date=date('Y-m-d');
        $start_date=date_format(new DateTime($current_date),'Y-m-01 00:00:00');
        $end_date=date_format(new DateTime($current_date),'Y-m-t 23:59:59');
        $start_time=date_format(new DateTime($current_date),'Y-m-d 00:00:00');
        $end_time=date_format(new DateTime($current_date),'Y-m-d 23:59:59');
        $data['title']='Home';
        $data['content']="admin_home/admin_home";
        $data['ddt_load_unload']=$this->Admin_report_model->get_loaded_ddt_with_date_range($start_time,$end_time);
        $data['ddt_delivery_users']=$this->Admin_report_model->get_delivery_user_summery();
        $data['qr_codes']=$this->Admin_report_model->get_all_craeted_qr_code_by_date_range($start_date,$end_date);
//        $data['used_qr_codes']=$this->Admin_report_model->get_loaded_ddt_with_date_range($start_date,$end_date);
        $this->load->vars($data);
        $this->load->view('admin_layout/main');
    }
}