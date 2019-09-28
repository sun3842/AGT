<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Admin_user extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if($this->session->userdata('user_login_id') && $this->session->userdata('user_type_id')==1){




            if($this->session->userdata('language')){
                if($this->session->userdata('language')=='LANG_EN'){
                    $this->lang->load('layout_en_lang','english');
                    $this->lang->load('admin_user_en_lang','english');
                }
                else if($this->session->userdata('language')=='LANG_IT'){
                    $this->lang->load('layout_it_lang','italian');
                    $this->lang->load('admin_user_it_lang','italian');
                }
            }
            else {
                $this->lang->load('layout_en_lang','english');
                $this->lang->load('admin_user_en_lang','english');
            }



        }
        else{
            redirect(base_url('login'));
        }
    }


    public function index()
    {
        redirect(base_url('add_new_user'));
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
        $this->email->from('demotestsun@gmail.com', 'New AGT Account');

        $list = array($to);
        $this->email->to($list);
        $this->email->subject('New Account');
        $this->email->message($email_body);


        if($this->email->send()){
            return 1;
        }else{
           return 0;
        }
    }

    public function add_new_admin_user(){
        if(count($_POST)>0 && $this->input->post('name')){
            $result=$this->Common_model->is_user_name_valid_for_add($this->input->post('name'));
            if(sizeof($result)==0){
                echo 'true';
            }else{
                echo 'false';
            }
        }
        else if(count($_POST)>0){

            //print_r($_POST);die();
            $current_date_time=date('Y-m-d h:i:sa');
            if($this->input->post('is_auto_create_user')=='on'){
                $this->load->library('form_validation');
                $this->form_validation->set_rules('user_email','user_email','required|valid_email');

                if($this->form_validation->run()){
                    $temp=explode('@',$this->input->post('user_email'));
                    $user_name=$temp[0];
                    $rand_password=rand(111111,999999);
                    $user_password=md5($rand_password);
                    $result=$this->Common_model->is_user_name_valid_for_add($user_name);
                    $is_valid=sizeof($result);
                    $temp=0;
                    $temp_name=$user_name;
                    while ($is_valid!=0){
                        $temp++;
                        $user_name=$temp_name.$temp;
                        $result=$this->Common_model->is_user_name_valid_for_add($user_name);
                        $is_valid=sizeof($result);
                    }

                    $params_new_admin_info=array(
                        'admin_user_name'=>$user_name,
                        'admin_user_ref_user_type_id'=>2,
                        'admin_user_password_hash_value'=>$user_password,
                        'admin_user_first_name'=>$this->input->post('first_name'),
                        'admin_user_last_name'=>$this->input->post('last_name'),
                        'admin_user_email_address'=>$this->input->post('user_email'),
                        'admin_user_contact_number'=>$this->input->post('user_phone'),
                        'admin_user_active'=>1,
                        'admin_user_update_date_time'=>$current_date_time
                    );

                    $this->Common_model->add_new_admin_user($params_new_admin_info);

                    $data="User Name:<b>".$params_new_admin_info['admin_user_name']."</b> \r\n User Password:<b>".$rand_password."</b>";

                    $is_mail_send=$this->send_email($this->input->post('user_email'),$data);
                    if($is_mail_send==1){
                        $this->session->set_flashdata('message',"Admin User Added Successfully");
                        redirect(base_url('admin_user_list'));
                    }else{
                        $this->session->set_flashdata('message',"Admin User Added Successfully");
                        $this->session->set_flashdata('error',"Mail Sending Failed");
                        redirect(base_url('admin_user_list'));
                    }




                }
                else{
                    $this->session->set_flashdata('error',validation_errors());
                    redirect(uri_string());
                }


            }
            else{

                $this->load->library('form_validation');
                $this->form_validation->set_rules('user_email','user_email','required|valid_email');
                $this->form_validation->set_rules('user_name','user_name','required|is_unique[admin_user.admin_user_name]');
                $this->form_validation->set_rules('user_password','user_password','required|min_length[6]');
                $this->form_validation->set_rules('user_re_type_password','user_re_type_password','required|matches[user_password]');
                if($this->form_validation->run()){
                    $params_new_admin_info=array(
                        'admin_user_name'=>$this->input->post('user_name'),
                        'admin_user_ref_user_type_id'=>2,
                        'admin_user_password_hash_value'=>md5($this->input->post('user_password')),
                        'admin_user_first_name'=>$this->input->post('first_name'),
                        'admin_user_last_name'=>$this->input->post('last_name'),
                        'admin_user_email_address'=>$this->input->post('user_email'),
                        'admin_user_contact_number'=>$this->input->post('user_phone'),
                        'admin_user_active'=>1,
                        'admin_user_update_date_time'=>$current_date_time
                    );
                    $this->Common_model->add_new_admin_user($params_new_admin_info);


                    $data="User Name:<b>".$params_new_admin_info['admin_user_name']."</b></br> User Password:<b>".$this->input->post('user_password')."</b>";

                    $is_mail_send=$this->send_email($this->input->post('user_email'),$data);
                    if($is_mail_send==1){
                        $this->session->set_flashdata('message',"Admin User Added Successfully");
                        redirect(base_url('admin_user_list'));
                    }else{
                        $this->session->set_flashdata('message',"Admin User Added Successfully");
                        $this->session->set_flashdata('error',"Mail Sending Failed");
                        redirect(base_url('admin_user_list'));
                    }
                }
                else{
                    $this->session->set_flashdata('error',validation_errors());
                    redirect(uri_string());
                }

            }
        }
        else{
            $data['title']='Add New Admin User';
            $data['content']='admin_user/add_new_admin_user';
            $this->load->vars($data);
            $this->load->view('admin_layout/main');
            $this->load->view('admin_user/add_new_admin_user_js');
        }
    }

    public function admin_user_list(){
        if(count($_POST)>0){

        }else{
            $data['title']='Admin User List';
            $data['content']='admin_user/admin_user_list';
            $data['admin_users']=$this->Common_model->get_all_admin_user();
            $this->load->vars($data);
            $this->load->view('admin_layout/main');
            $this->load->view('admin_user/admin_user_list_js');
        }
    }

    public function admin_user_details($admin_user_id){
        if(count($_POST)>0 && $this->input->post('name')){
            $temp=explode('fa2a611ef69d2ba1983c46911e8a86f8',$this->input->post('name'));
            $temp_admin_name=$temp[0];
            $temp_admin_id=$temp[1];
            $result=$this->Common_model->is_user_name_valid_for_update($temp_admin_name,$temp_admin_id);
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
                $result=$this->Common_model->is_user_name_valid_for_update($this->input->post('user_name'),$this->input->post('admin_user_id'));
                if(sizeof($result)==0){

                    $current_date_time=date('Y-m-d h:i:sa');
                    $params_admin_user_update_info=array(
                        'admin_user_name'=>$this->input->post('user_name'),
                        'admin_user_update_date_time'=>$current_date_time
                    );
                    if($this->input->post('user_new_password')!=''){
                        $params_admin_user_update_info['admin_user_password_hash_value']=md5($this->input->post('user_new_password'));
                    }
                    $this->Common_model->update_admin_user_info_by_user_id($params_admin_user_update_info,$this->input->post('admin_user_id'));
                    $this->session->set_flashdata('message',"User Information Updated Successfully");
                    redirect(uri_string());

                }
                else{
                    $this->session->set_flashdata('error','User Name Already Exist');
                    redirect(uri_string());
                }

            }else{
                $this->session->set_flashdata('error',validation_errors());
                redirect(uri_string());
            }

        }
        else{
            $data['title']='Admin User Details';
            $data['content']='admin_user/admin_user_details';
            $data['user_info']=$this->Common_model->get_user_all_info_by_user_id($admin_user_id);
            $this->load->vars($data);
            $this->load->view('admin_layout/main');
            $this->load->view('admin_user/admin_user_details_js');
        }

    }

    public function de_active_admin_user($admin_user_id){
        $current_date_time=date('Y-m-d h:i:sa');
        $params_admin_user_update_info=array(
            'admin_user_active'=>0,
            'admin_user_update_date_time'=>$current_date_time
        );
        $this->Common_model->update_admin_user_info_by_user_id($params_admin_user_update_info,$admin_user_id);
        $this->session->set_flashdata('message',"User De-Activated Successfully");
        redirect(base_url('admin_user_details/'.$admin_user_id));
    }
    public function active_admin_user($admin_user_id){
        $current_date_time=date('Y-m-d h:i:sa');
        $params_admin_user_update_info=array(
            'admin_user_active'=>1,
            'admin_user_update_date_time'=>$current_date_time
        );
        $this->Common_model->update_admin_user_info_by_user_id($params_admin_user_update_info,$admin_user_id);
        $this->session->set_flashdata('message',"User De-Activated Successfully");
        redirect(base_url('admin_user_details/'.$admin_user_id));
    }
    public function remove_admin_user($admin_user_id){
        $current_date_time=date('Y-m-d h:i:sa');
        $params_admin_user_update_info=array(
            'admin_user_active'=>-1,
            'admin_user_update_date_time'=>$current_date_time
        );
        $this->Common_model->update_admin_user_info_by_user_id($params_admin_user_update_info,$admin_user_id);
        $this->session->set_flashdata('message',"User Removed Successfully");
        redirect(base_url('admin_user_list'));
    }
}