<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        if($this->session->userdata('user_login_id')){
            redirect(base_url('admins_home'));
        }else{
            if($this->session->userdata('language')){
                if($this->session->userdata('language')=='LANG_EN'){
                    $this->lang->load('login_en_lang','english');

                }
                else if($this->session->userdata('language')=='LANG_IT'){
                    $this->lang->load('login_it_lang','italian');

                }
            }
            else {
                $this->lang->load('login_en_lang','english');

            }
        }
    }

    public function index()
	{
        redirect(base_url('login'));
	}

	public function login(){
	    if(count($_POST)>0){

            $this->load->library('form_validation');
            $this->form_validation->set_rules('login_name','login_name','required');
            $this->form_validation->set_rules('login_password','login_password','required');

            if($this->form_validation->run()){
                $params_user_login_info=array(
                    'admin_user_name'=>$this->input->post('login_name'),
                    'admin_user_password_hash_value'=>md5($this->input->post('login_password'))
                );

                $result=$this->Common_model->is_user_valid($params_user_login_info);
                $is_user_valid=sizeof($result);
                if($is_user_valid==0){
                    $this->session->set_flashdata('error','User Name Or Password Is Incorrect');
                    redirect(uri_string());
                }
                else{
                    $this->session->set_userdata('user_login_id',$result['admin_user_id']);
                    $this->session->set_userdata('user_type_id',$result['admin_user_ref_user_type_id']);
                    $this->session->set_userdata('user_login_name',$result['admin_user_name']);
                    redirect(base_url('admins_home'));
                }
            }
            else{
                $this->session->set_flashdata('error',validation_errors());
                redirect(uri_string());
            }


        }
        else{
            $this->load->view('login.php');
        }
    }

    public function send_email($to,$data){
        $config = Array(
            'protocol' => 'smtp',
            'smtp_host' => 'ssl://smtp.googlemail.com',
            'smtp_port' => 465,
            'smtp_user' => 'demotestsun@gmail.com',
            'smtp_pass' => '74189632',
            'mailtype'  => 'html',
            'charset' => 'utf-8',
            'wordwrap' => TRUE

        );
        $this->load->library('email', $config);
        $this->email->set_mailtype("html");
        $this->email->set_newline("\r\n");
        $email_body =$data;
        $this->email->from('demotestsun@gmail.com', 'AGT Password Recover');

        $list = array($to);
        $this->email->to($list);
        $this->email->subject('Recover Password');

        $this->email->message($email_body);


        if($this->email->send()){
            return 1;
        }else{
            return 0;
        }
    }

    public function forgot_password(){

	    if($this->input->post('email_address')){
            $result=$this->Common_model->get_admin_user_by_mail($this->input->post('email_address'));
            echo json_encode($result);
        }

        else if(count($_POST)>0){
//	        print_r($_POST);die();
            if($this->input->post('forgot_username')){
                $this->load->library('form_validation');
                $this->form_validation->set_rules('forgot_email','forgot_email','required|valid_email');
                $this->form_validation->set_rules('forgot_username','forgot_username','required');
                if($this->form_validation->run()){
                    $result=$this->Common_model->get_admin_user_by_mail_and_user_name($this->input->post('forgot_email'),$this->input->post('forgot_username'));
                    if(sizeof($result)==0){
                        $this->session->set_flashdata('error','Mail Is not Registered Yet');
                        redirect(uri_string());
                    }
                    else{
                        $new_password=rand(100000,999999);
                        $user_name=$this->input->post('forgot_username');
                        $data="User Name:<b>".$user_name."</b></br>  User Password:<b>".$new_password."</b>";

                        $is_mail_send=$this->send_email($this->input->post('forgot_email'),$data);

                        if($is_mail_send==1){
                            $params=array(
                                'admin_user_password_hash_value'=>md5($new_password),
                            );
                            $this->Common_model->update_admin_user_info_by_user_login_name($params,$this->input->post('forgot_username'));
                            $this->session->set_flashdata('message','Your New Password has been send to your Mail');
                            redirect(base_url('login'));
                        }else{
                            $this->session->set_flashdata('error','Mail Sending Failed, Password Can not be updated.Try Again Later');
                            redirect(uri_string());
                        }


                    }

                }
                else{
                    $this->session->set_flashdata('error',validation_errors());
                    redirect(uri_string());
                }

            }
            else{
                $this->session->set_flashdata('error',"No User Name Found With This Name");
                redirect(uri_string());
            }


        }
        else{
            $this->load->view('forgot_password');
        }
    }
}
