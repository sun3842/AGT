<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Delivery_user_activity extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('user_login_id')) {
            $this->load->model('Delivery_user_activity_model');



            if($this->session->userdata('language')){
                if($this->session->userdata('language')=='LANG_EN'){
                    $this->lang->load('layout_en_lang','english');
                    $this->lang->load('delivery_user_activity_en_lang','english');
                }
                else if($this->session->userdata('language')=='LANG_IT'){
                    $this->lang->load('layout_it_lang','italian');
                    $this->lang->load('delivery_user_activity_it_lang','italian');
                }
            }
            else {
                $this->lang->load('layout_en_lang','english');
                $this->lang->load('delivery_user_activity_en_lang','english');
            }


        } else {
            redirect(base_url('login'));
        }
    }

    public function index(){
        echo 'No Path To Go';
    }

    public function delivery_user_activity_list(){
        if(count($_POST)>0){
            $start_date=$this->input->post('start');
            $end_date=$this->input->post('end');
            $start_date=date_format(new DateTime($start_date),'Y-m-d 00:00:00');
            $end_date=date_format(new DateTime($end_date),'Y-m-d 23:59:59');
            $result=$this->Delivery_user_activity_model->get_all_delivery_user_activity_within_date_range($start_date,$end_date);
            $temp_result=$result;
            $temp=0;
            foreach ($result AS $item){
                $temp_result[$temp]['delivery_user_creating_date_time']=date_format(new DateTime($item['delivery_user_creating_date_time']),'d-F-Y');
                $temp++;
            }
            echo json_encode($temp_result);
        }
        else{
            $current_date=date('Y-m-d h:i:s');

            $first_date=date_format(new DateTime($current_date),'Y-m-01 00:00:00');
            $last_date=date_format(new DateTime($current_date),'Y-m-t 23:59:59');
            $data['title']='Delivery User List';
            $data['content']='delivery_user_activity/delivery_user_activity_list';
            $data['delivery_users']=$this->Delivery_user_activity_model->get_all_delivery_user_activity_within_date_range($first_date,$last_date);
            $this->load->vars($data);
            $this->load->view('admin_layout/main');
            $this->load->view('delivery_user_activity/delivery_user_activity_list_js');
        }
    }


    public function add_update_user_daily_activity(){
        if($this->input->post('select_date') && $this->input->post('select_user')){

            $result=$this->Delivery_user_activity_model->get_delivery_user_activity_by_date($this->input->post('select_date'),$this->input->post('select_user'));
            echo json_encode($result);
        }
        else if(count($_POST)>0){

            if($this->input->post('update_activity')){
//                print_r('update');
                $params_update_activity=array(
                    'delivery_user_starting_address'=>$this->input->post('activity_start'),
                    'delivery_user_starting_lat'=>$this->input->post('start_activity_lat'),
                    'delivery_user_starting_lng'=>$this->input->post('start_activity_lng'),
                    'delivery_user_ending_address'=>$this->input->post('activity_end'),
                    'delivery_user_ending_lat'=>$this->input->post('end_activity_lat'),
                    'delivery_user_ending_lng'=>$this->input->post('end_activity_lng'),

                );
                $this->Delivery_user_activity_model->update_user_daily_activity($params_update_activity,$this->input->post('activity_user_name'),$this->input->post('activity_date'));
                $this->session->set_flashdata('message','Activity Updated Successfully');
                redirect(uri_string());
            }
            else if($this->input->post('add_activity')){
//                print_r($_POST);die();
                $params_add_activity=array(
                    'ref_delivery_user_id'=>$this->input->post('activity_user_name'),
                    'delivery_user_starting_address'=>$this->input->post('activity_start'),
                    'delivery_user_starting_lat'=>$this->input->post('start_activity_lat'),
                    'delivery_user_starting_lng'=>$this->input->post('start_activity_lng'),
                    'delivery_user_ending_address'=>$this->input->post('activity_end'),
                    'delivery_user_ending_lat'=>$this->input->post('end_activity_lat'),
                    'delivery_user_ending_lng'=>$this->input->post('end_activity_lng'),
                    'delivery_user_starting_ending_points_date'=>$this->input->post('activity_date')

                );

                $this->Delivery_user_activity_model->add_user_daily_activity($params_add_activity);
                $this->session->set_flashdata('message','Activity Added Successfully');
                redirect(uri_string());
            }

        }
        else{
            $data['title']='ADD/Update User Daily Activity';
            $data['content']='delivery_user_activity/add_update_daily_user_activity';
            $data['delivery_users']=$this->Delivery_user_activity_model->get_all_delivery_user();
            $this->load->vars($data);
            $this->load->view('admin_layout/main');
            $this->load->view('delivery_user_activity/add_update_daily_user_activity_js');
        }
    }

    public function list_of_delivery_point(){

        if(count($_POST)>0){
            $result=$this->Delivery_user_activity_model->get_all_delivery_user_by_date($this->input->post('select_date'));
            $tmp_result=$result;
            $i=0;
            foreach ($result AS $item){
                $tmp_result[$i]['view_details']='<a href="'.base_url('list_of_delivery_details/'.$item['delivery_user_starting_ending_points_id']).'" class="btn btn-success">View Details</a>';
                $i++;
            }
            echo json_encode($tmp_result);
        }
        else{
            $current_date=date('Y-m-d');
            $data['title']='List Of Delivery Point';
            $data['content']='delivery_user_activity/list_of_delivery_point';
            $data['delivery_users']=$this->Delivery_user_activity_model->get_all_delivery_user_by_date($current_date);
            $this->load->vars($data);
            $this->load->view('admin_layout/main');
            $this->load->view('delivery_user_activity/list_of_delivery_point_js');
        }
    }

    public function list_of_delivery_details($delivery_user_starting_ending_points_id){
        if(count($_POST)>0){

        }else{
            $current_date=date('Y-m-d');
            $data['title']='Delivery User ddt PTP Details';
            $data['content']='delivery_user_activity/list_of_delivery_details';
            $data['delivery_user']=$this->Delivery_user_activity_model->get_delivery_user_by_starting_ending_points_id($delivery_user_starting_ending_points_id);
            $data['ddt_ptp']=$this->Delivery_user_activity_model->get_delivery_user_path_by_date_user_id($data['delivery_user']['delivery_user_starting_ending_points_date'],$data['delivery_user']['delivery_user_id']);
            $this->load->vars($data);
            $this->load->view('admin_layout/main');
            $this->load->view('delivery_user_activity/list_of_delivery_details_js');
        }
    }
}