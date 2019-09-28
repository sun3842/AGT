<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Delivery_user extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if($this->session->userdata('user_login_id')){
            $this->load->model('Delivery_user_model');



            if($this->session->userdata('language')){
                if($this->session->userdata('language')=='LANG_EN'){
                    $this->lang->load('layout_en_lang','english');
                    $this->lang->load('delivery_user_en_lang','english');
                }
                else if($this->session->userdata('language')=='LANG_IT'){
                    $this->lang->load('layout_it_lang','italian');
                    $this->lang->load('delivery_user_it_lang','italian');
                }
            }
            else {
                $this->lang->load('layout_en_lang','english');
                $this->lang->load('delivery_user_en_lang','english');
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



    public function add_new_delivery_user(){
        if(count($_POST)>0 && $this->input->post('name')){
            $result=$this->Delivery_user_model->is_delivery_user_name_valid_for_add($this->input->post('name'));
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
                $this->form_validation->set_rules('first_name','first_name','required');
                $this->form_validation->set_rules('last_name','last_name','required');

                if($this->form_validation->run()){
                    $temp=explode('@',$this->input->post('user_email'));
                    $user_name=$temp[0];
                    $rand_password=rand(111111,999999);
                    $user_password=md5($rand_password);
                    $result=$this->Delivery_user_model->is_delivery_user_name_valid_for_add($user_name);
                    $is_valid=sizeof($result);
                    $temp=0;
                    $temp_name=$user_name;
                    while ($is_valid!=0){
                        $temp++;
                        $user_name=$temp_name.$temp;
                        $result=$this->Delivery_user_model->is_delivery_user_name_valid_for_add($user_name);
                        $is_valid=sizeof($result);
                    }

                    $params_new_delivery_user_info=array(
                        'delivery_user_user_name'=>$user_name,
                        'delivery_user_password_value'=>$user_password,
                        'delivery_user_first_name'=>$this->input->post('first_name'),
                        'delivery_user_last_name'=>$this->input->post('last_name'),
                        'delivery_user_email_address'=>$this->input->post('user_email'),
                        'delivery_user_contact_number'=>$this->input->post('user_phone'),
                        'delivery_user_identity_number'=>$this->input->post('user_identity_number'),
                        'delivery_user_active'=>1,
                        'delivery_user_login_active'=>1,
                        'delivery_user_creating_date_time'=>$current_date_time,
                        'delivery_user_editing_date_time'=>$current_date_time
                    );

                    $this->Delivery_user_model->add_new_delivery_user($params_new_delivery_user_info);

                    $data="User Name:<b>".$params_new_delivery_user_info['delivery_user_user_name']."</b></br>  User Password:<b>".$rand_password."</b>";

                    $is_mail_send=$this->send_email($this->input->post('user_email'),$data);
                    if($is_mail_send==1){
                        $this->session->set_flashdata('message',"Delivery User Added Successfully");
                        redirect(base_url('delivery_user_list'));
                    }else{
                        $this->session->set_flashdata('message',"Delivery User Added Successfully");
                        $this->session->set_flashdata('error',"Mail Sending Failed");
                        redirect(base_url('delivery_user_list'));
                    }




                }
                else{
                    $this->session->set_flashdata('error',validation_errors());
                    redirect(uri_string());
                }


            }
            else{

                $this->load->library('form_validation');
                $this->form_validation->set_rules('first_name','first_name','required');
                $this->form_validation->set_rules('last_name','last_name','required');
                $this->form_validation->set_rules('user_email','user_email','required|valid_email');
                $this->form_validation->set_rules('user_name','user_name','required|is_unique[delivery_user.delivery_user_user_name]');
                $this->form_validation->set_rules('user_password','user_password','required|min_length[6]');
                $this->form_validation->set_rules('user_re_type_password','user_re_type_password','required|matches[user_password]');
                if($this->form_validation->run()){
                    $params_new_delivery_user_info=array(
                        'delivery_user_user_name'=>$this->input->post('user_name'),
                        'delivery_user_password_value'=>md5($this->input->post('user_password')),
                        'delivery_user_first_name'=>$this->input->post('first_name'),
                        'delivery_user_last_name'=>$this->input->post('last_name'),
                        'delivery_user_email_address'=>$this->input->post('user_email'),
                        'delivery_user_contact_number'=>$this->input->post('user_phone'),
                        'delivery_user_identity_number'=>$this->input->post('user_identity_number'),
                        'delivery_user_active'=>1,
                        'delivery_user_login_active'=>1,
                        'delivery_user_creating_date_time'=>$current_date_time,
                        'delivery_user_editing_date_time'=>$current_date_time
                    );
                    $this->Delivery_user_model->add_new_delivery_user($params_new_delivery_user_info);


                    $data="User Name:<b>".$params_new_delivery_user_info['delivery_user_user_name']."</b></br> User Password:</b>".$this->input->post('user_password')."</b>";

                    $is_mail_send=$this->send_email($this->input->post('user_email'),$data);
                    if($is_mail_send==1){
                        $this->session->set_flashdata('message',"Delivery User Added Successfully");
                        redirect(base_url('delivery_user_list'));
                    }else{
                        $this->session->set_flashdata('message',"Delivery User Added Successfully");
                        $this->session->set_flashdata('error',"Mail Sending Failed");
                        redirect(base_url('delivery_user_list'));
                    }
                }
                else{
                    $this->session->set_flashdata('error',validation_errors());
                    redirect(uri_string());
                }

            }
        }
        else{
            $data['title']='Add New Delivery User';
            $data['content']='delivery_user/add_new_delivery_user';
            $this->load->vars($data);
            $this->load->view('admin_layout/main');
            $this->load->view('delivery_user/add_new_delivery_user_js');
        }
    }

    public function delivery_user_list(){
        if(count($_POST)>0){

        }else{
            $data['title']='Delivery User List';
            $data['content']='delivery_user/delivery_user_list';
            $data['delivery_users']=$this->Delivery_user_model->get_all_delivery_user();
            $this->load->vars($data);
            $this->load->view('admin_layout/main');
            $this->load->view('delivery_user/delivery_user_list_js');
        }
    }

    public function delivery_user_details($delivery_user_id){
        if(count($_POST)>0 && $this->input->post('name')){
            $temp=explode('fa2a611ef69d2ba1983c46911e8a86f8',$this->input->post('name'));
            $temp_delivery_user_name=$temp[0];
            $temp_delivery_user_id=$temp[1];
            $result=$this->Delivery_user_model->is_delivery_user_name_valid_for_update($temp_delivery_user_name,$temp_delivery_user_id);
            if(sizeof($result)==0){
                echo 'true';
            }else{
                echo 'false';
            }
        }
        else if(count($_POST)>0){

            $this->load->library('form_validation');
            $this->form_validation->set_rules('first_name','first_name','required');
            $this->form_validation->set_rules('last_name','last_name','required');
            $this->form_validation->set_rules('user_email','user_email','required|valid_email');
            $this->form_validation->set_rules('user_name','user_name','required');
            $this->form_validation->set_rules('user_new_password','user_new_password','min_length[6]');
            $this->form_validation->set_rules('user_re_type_password','user_re_type_password','matches[user_new_password]');
            if($this->form_validation->run()){
                $result=$this->Delivery_user_model->is_delivery_user_name_valid_for_update($this->input->post('user_name'),$this->input->post('delivery_user_id'));
                if(sizeof($result)==0){

                    $current_date_time=date('Y-m-d h:i:sa');
                    $params_delivery_user_update_info=array(
                        'delivery_user_user_name'=>$this->input->post('user_name'),
                        'delivery_user_identity_number'=>$this->input->post('user_identity_number'),
                        'delivery_user_editing_date_time'=>$current_date_time
                    );
                    if($this->input->post('user_new_password')!=''){
                        $params_delivery_user_update_info['delivery_user_password_value']=md5($this->input->post('user_new_password'));
                    }
                    $this->Delivery_user_model->update_delivery_user_info_by_user_id($params_delivery_user_update_info,$this->input->post('delivery_user_id'));
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
            $data['title']='Delivery User Details';
            $data['content']='delivery_user/delivery_user_details';
            $data['user_info']=$this->Delivery_user_model->get_delivery_user_all_info_by_user_id($delivery_user_id);
            $this->load->vars($data);
            $this->load->view('admin_layout/main');
            $this->load->view('delivery_user/delivery_user_details_js');
        }
    }

    public function de_active_delivery_user($delivery_user_id){
        $current_date_time=date('Y-m-d h:i:sa');
        $params_delivery_user_update_info=array(
            'delivery_user_login_active'=>0,
            'delivery_user_editing_date_time'=>$current_date_time
        );
        $this->Delivery_user_model->update_delivery_user_info_by_user_id($params_delivery_user_update_info,$delivery_user_id);
        $this->session->set_flashdata('message',"User De-Activated Successfully");
        redirect(base_url('delivery_user_details/'.$delivery_user_id));
    }
    public function active_delivery_user($delivery_user_id){
        $current_date_time=date('Y-m-d h:i:sa');
        $params_delivery_user_update_info=array(
            'delivery_user_login_active'=>1,
            'delivery_user_editing_date_time'=>$current_date_time
        );
        $this->Delivery_user_model->update_delivery_user_info_by_user_id($params_delivery_user_update_info,$delivery_user_id);
        $this->session->set_flashdata('message',"User Activated Successfully");
        redirect(base_url('delivery_user_details/'.$delivery_user_id));
    }
    public function remove_delivery_user($delivery_user_id){
        $current_date_time=date('Y-m-d h:i:sa');
        $params_delivery_user_update_info=array(
            'delivery_user_active'=>0,
            'delivery_user_editing_date_time'=>$current_date_time
        );
        $this->Delivery_user_model->update_delivery_user_info_by_user_id($params_delivery_user_update_info,$delivery_user_id);
        $this->session->set_flashdata('message',"User Removed Successfully");
        redirect(base_url('delivery_user_list'));
    }

}