<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Admin_account extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if($this->session->userdata('user_login_id')){

            if($this->session->userdata('language')){
                if($this->session->userdata('language')=='LANG_EN'){
                    $this->lang->load('layout_en_lang','english');
                    $this->lang->load('admin_account_en_lang','english');
                }
                else if($this->session->userdata('language')=='LANG_IT'){
                    $this->lang->load('layout_it_lang','italian');
                    $this->lang->load('admin_account_it_lang','italian');

                }
            }
            else {
                $this->lang->load('layout_en_lang','english');
                $this->lang->load('admin_account_en_lang','english');
            }

        }
        else{
            redirect(base_url('login'));
        }
    }


    public function index()
    {
        redirect(base_url('admin_update_account'));
    }

    public function admin_update_account(){
        if(count($_POST)>0 && $this->input->post('name')){
            $result=$this->Common_model->is_user_name_valid_for_update($this->input->post('name'),$this->session->userdata('user_login_id'));
            if(sizeof($result)==0){
                echo 'true';
            }else{
                echo 'false';
            }
        }
        else if(count($_POST)>0){

            $this->load->library('form_validation');
            $this->form_validation->set_rules('user_email','user_email','required|valid_email');
            $this->form_validation->set_rules('user_name','user_name','required');
            $this->form_validation->set_rules('user_new_password','user_new_password','min_length[6]');
            $this->form_validation->set_rules('user_re_type_password','user_re_type_password','matches[user_new_password]');


            if($this->form_validation->run()){

                $result=$this->Common_model->is_user_name_valid_for_update($this->input->post('user_name'),$this->session->userdata('user_login_id'));
                if(sizeof($result)==0){
                    $current_date_time=date('Y-m-d h:i:sa');
                    $params_admin_user_update_info=array(
                        'admin_user_name'=>$this->input->post('user_name'),
                        'admin_user_first_name'=>$this->input->post('first_name'),
                        'admin_user_last_name'=>$this->input->post('last_name'),
                        'admin_user_email_address'=>$this->input->post('user_email'),
                        'admin_user_contact_number'=>$this->input->post('user_phone'),
                        'admin_user_update_date_time'=>$current_date_time
                    );
                    if($this->input->post('user_new_password')!=''){
                        $params_user_login_info=array(
                            'admin_user_name'=>$this->session->userdata('user_login_name'),
                            'admin_user_password_hash_value'=>md5($this->input->post('user_current_password'))
                        );

                        $result=$this->Common_model->is_user_valid($params_user_login_info);
                        if(sizeof($result)==0){
                            $this->session->set_flashdata('error',"Current Password doesn't match");
                            redirect(uri_string());
                        }
                        else{
                            $params_admin_user_update_info['admin_user_password_hash_value']=md5($this->input->post('user_new_password'));
                        }

                    }
                    $this->Common_model->update_admin_user_info_by_user_id($params_admin_user_update_info,$this->session->userdata('user_login_id'));
                    $this->session->set_userdata('user_login_name',$this->input->post('user_name'));
                    $this->session->set_flashdata('message',"User Information Updated Successfully");
                    redirect(uri_string());
                }
                else{
                    $this->session->set_flashdata('error',"User Name Already Taken");
                    redirect(uri_string());
                }


            }
            else{
                $this->session->set_flashdata('error',validation_errors());
                redirect(uri_string());
            }


        }else{
            $data['title']='Update Account Information';
            $data['content']='admin_account/admin_update_account';
            $data['user_info']=$this->Common_model->get_user_all_info_by_user_id($this->session->userdata('user_login_id'));
            $this->load->vars($data);
            $this->load->view('admin_layout/main');
            $this->load->view('admin_account/admin_update_account_js');
        }
    }
}