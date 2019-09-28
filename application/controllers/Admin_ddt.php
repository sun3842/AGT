<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Admin_ddt extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('user_login_id')) {
            $this->load->model('Admin_ddt_model');
            $this->load->model('Delivery_user_model');

            if($this->session->userdata('language')){
                if($this->session->userdata('language')=='LANG_EN'){
                    $this->lang->load('layout_en_lang','english');
                    $this->lang->load('admin_ddt_en_lang','english');
                }
                else if($this->session->userdata('language')=='LANG_IT'){
                    $this->lang->load('layout_it_lang','italian');
                    $this->lang->load('admin_ddt_it_lang','italian');
                }
            }
            else {
                $this->lang->load('layout_en_lang','english');
                $this->lang->load('admin_ddt_en_lang','english');
            }



        } else {
            redirect(base_url('login'));
        }
    }


    public function index()
    {
        redirect(base_url('add_and_list_ddt'));
    }

    public function admin_list_ddt(){
            $data['title']='DDT List';
            $data['content']='admin_ddt/admin_list_ddt';
            $this->load->vars($data);
            $this->load->view('admin_layout/main');
            $this->load->view('admin_ddt/admin_list_ddt_js');
    }


    public function get_ddt_list(){
        $this->load->model('DDT_list_model');
        $fetch_data=$this->DDT_list_model->make_data_table();
        $data=array();
        $temp=1;
        $ddt_status='hi';
        foreach ($fetch_data AS $row){

            if($row->ddt_active==0){
                $ddt_status='<span style="color: red">'.$this->lang->line("lost_deleted").'</span>';
            }
             else if ($row->ddt_active==2){
                $ddt_status='<span style="color: blueviolet">'.$this->lang->line("loaded_from_storage").'</span>';
            }
            else if ($row->ddt_active==3){
                $ddt_status='<span style="color: orange">'.$this->lang->line("delivered").'</span>';
            }
            else if ($row->ddt_active==4){
                $ddt_status='<span style="color: lawngreen">'.$this->lang->line("loaded_from_user").'</span>';
            }
            else if($row->ddt_active==1){
                $ddt_status='<span style="color: green">'.$this->lang->line("active").'</span>';
            }

            $sub_array=array();
            $sub_array[]='<input type="checkbox" datasrc="'.$row->ddt_id.'" id="id_print_ddt_'.$row->ddt_id.'" class="is_print ml-2">';
            $sub_array[]='<span id="ddt_'.$row->ddt_id.'">'.$row->ddt_id.'</span>';
            $sub_array[]="<a target='_blank' href='".base_url().$row->ddt_qr_code_image_location."'><img id='ddt_img_".$row->ddt_id."' src='".base_url().$row->ddt_qr_code_image_location."' height='75px' width='75px'></a>";
            $sub_array[]='<span id="ddt_date_'.$row->ddt_id.'">'.date_format(new DateTime($row->ddt_created_date_time),'Y-m-d').'</span>';
            $sub_array[]=$ddt_status;
            $sub_array[]='<a href="'.base_url("view_ddt/").$row->ddt_id.'" class="btn btn-info mx-1"><i class="fas fa-eye" style="font-size: medium"></i>'.$this->lang->line('view').'</a><a href="'.base_url().$row->ddt_qr_code_image_location.'" class="btn btn-success mx-1" download="'.$row->ddt_id.'png"><i class="fas fa-download" style="font-size: large"></i>'.$this->lang->line('download').'</a><button id="'.$row->ddt_id.'" class="btn btn-primary mx-1 qr-print"><i class="fas fa-print" style="font-size: large"></i>'.$this->lang->line('print').'</button>';
            $data[]=$sub_array;
//            <a href="'.base_url("delete_ddt/").$row->ddt_id.'" class="btn btn-danger deletebutton mx-1">Delete</a> ///*********delete******************************
            $temp++;
        }
        $output=array(
            "draw" => intval($_POST['draw']),
          "recordsTotal"=> $this->DDT_list_model->get_all_data(),
          "recordsFiltered"=>$this->DDT_list_model->get_filtered_data(),
          "data" => $data
        );
        echo json_encode($output);
    }

    public function delete_ddt($ddt_id){
        $current_date_time=date('Y-m-d h:i:s');
        $ddt_info=array(
            'ddt_edited_admin_user_id'=>$this->session->userdata('user_login_id'),
            'ddt_edited_date_time'=>$current_date_time,
            'ddt_active'=>0                                  //**************************ddt_active=0  means  ddt deleted
        );

        $this->Admin_ddt_model->update_ddt_by_id($ddt_info,$ddt_id);
        redirect(base_url('add_and_list_ddt'));
    }
    public function view_ddt($ddt_id){
        if(count($_POST)>0){

            $current_date_time=date('Y-m-d h:i:s');
            $ddt_info=array(
                'ddt_edited_admin_user_id'=>$this->session->userdata('user_login_id'),
                'ddt_edited_date_time'=>$current_date_time,
                'ddt_qr_created_delivery_user_id'=>NULL            //**************************ddt Updated
            );

            if($this->input->post('delivery_user')!=''){
                $ddt_info['ddt_qr_created_delivery_user_id']=$this->input->post('delivery_user');
            }
            $this->Admin_ddt_model->update_ddt_by_id($ddt_info,$this->input->post('ddt_id'));
            redirect(base_url('add_and_list_ddt'));

            print_r($_POST);die();

        }else{
            $data['title']='DDT Details';
            $data['content']='admin_ddt/admin_ddt_details';
            $data['ddt_info']=$this->Admin_ddt_model->get_ddt_by_ddt_id($ddt_id);
//            $data['delivery_users']=$this->Delivery_user_model->get_all_delivery_user();
            $this->load->vars($data);
            $this->load->view('admin_layout/main');
            $this->load->view('admin_ddt/admin_ddt_details_js');
        }
    }

    public function add_new_ddt(){
        if(count($_POST)>0){

            $delivery_user_id=$this->input->post('delivery_user_name');
            $new_ddt_id=$this->input->post('new_ddt_id');
            foreach ($_POST['qr_code_image'] AS $qr_code){
                $current_date_time=date('Y-m-d h:i:sa');
                list($type, $qr_code) = explode(';', $qr_code);
                list(, $qr_code) = explode(',', $qr_code);
                $imgExt = explode('/', $type);
                $ext = end($imgExt);
                $img = base64_decode($qr_code);
                $dir = 'assets/images/ddt_qr_codes/' . $new_ddt_id . "." . $ext;
                file_put_contents($dir, $img);
                $params_ddt_info=array(
                    'ddt_qr_code_image_location'=>$dir,
                    'ddt_qr_created_admin_user_id'=>$this->session->userdata('user_login_id'),
                    'ddt_created_date_time'=>$current_date_time,
                    'ddt_active'=>1,
                    'ddt_edited_admin_user_id'=>$this->session->userdata('user_login_id'),
                    'ddt_edited_date_time'=>$current_date_time
                );
                if($delivery_user_id!=''){
                    $params_ddt_info['ddt_qr_created_delivery_user_id']=$delivery_user_id;
                }
                $this->Admin_ddt_model->add_new_ddt($params_ddt_info);
                $new_ddt_id++;
            }
            $this->session->set_flashdata('message','QR code Generated Successfully');
            redirect(base_url('admin_list_ddt'));

        }else{

            $result=$this->Admin_ddt_model->get_all_ddt_with_deleted();
            $data['new_ddt_id']=1;
            if(sizeof($result)==0){     //***************************if no ddt inserted************************************
                $current_date_time=date('Y-m-d h:i:sa');

                $params_ddt_info=array(
                    'ddt_qr_code_image_location'=>'http://placehold.it/128x128',
                    'ddt_qr_created_admin_user_id'=>$this->session->userdata('user_login_id'),
                    'ddt_created_date_time'=>$current_date_time,
                    'ddt_active'=>0,
                    'ddt_edited_admin_user_id'=>$this->session->userdata('user_login_id'),
                    'ddt_edited_date_time'=>$current_date_time
                );

                $insert_id=$this->Admin_ddt_model->add_new_ddt($params_ddt_info);
                $data['new_ddt_id']=$insert_id+1;
            }else{
                $data['new_ddt_id']=($result[0]['ddt_id'])+1;
            }

            $data['title']='DDT ADD';
            $data['content']='admin_ddt/admin_add_ddt';

//            $data['delivery_users']=$this->Delivery_user_model->get_all_delivery_user();
            $this->load->vars($data);
            $this->load->view('admin_layout/main');
            $this->load->view('admin_ddt/admin_add_ddt_js');
        }
    }

    public function lost_delete_ddt($ddt_id){
        $ddt_info=array(
            'ddt_active'=>0,
        );
        $this->Admin_ddt_model->update_ddt_by_id($ddt_info,$ddt_id);
        $this->session->set_flashdata('message','Operation Successful');
        redirect(base_url('view_ddt/'.$ddt_id));
    }

    public function found_ddt($ddt_id){
        $ddt_info=array(
            'ddt_active'=>1,
        );
        $this->Admin_ddt_model->update_ddt_by_id($ddt_info,$ddt_id);
        $this->session->set_flashdata('message','Operation Successful');
        redirect(base_url('view_ddt/'.$ddt_id));
    }
}