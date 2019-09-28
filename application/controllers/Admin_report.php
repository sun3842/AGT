<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Admin_report extends CI_Controller{

    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('user_login_id')) {
//            $this->load->model('Admin_ddt_model');
            $this->load->model('Admin_report_model');


            if($this->session->userdata('language')){
                if($this->session->userdata('language')=='LANG_EN'){
                    $this->lang->load('layout_en_lang','english');
                    $this->lang->load('admin_report_en_lang','english');
                }
                else if($this->session->userdata('language')=='LANG_IT'){
                    $this->lang->load('layout_it_lang','italian');
                    $this->lang->load('admin_report_it_lang','italian');
                }
            }
            else {
                $this->lang->load('layout_en_lang','english');
                $this->lang->load('admin_report_en_lang','english');
            }


        } else {
            redirect(base_url('login'));
        }
    }

    public function index(){
        echo 'No Path To Go';
    }

    public function ddt_load_unload_report(){

        if(count($_POST)>0){

            $start_date=$this->input->post('start');
            $end_date=$this->input->post('end');
            $start_date=date_format(new DateTime($start_date),'Y-m-d 00:00:00');
            $end_date=date_format(new DateTime($end_date),'Y-m-d 23:59:59');
            $result=$this->Admin_report_model->get_loaded_ddt_with_date_range($start_date,$end_date);
            $temp_result=$result;
            $temp=0;
            $temp_ddt_from='';
            $temp_ddt_is_delivered='';
            foreach ($result AS $ddt){
                $temp_result[$temp]['date']=date_format(new DateTime($ddt['ddt_loading_date_time']),'d-F-Y');
                $temp_result[$temp]['time']=date_format(new DateTime($ddt['ddt_loading_date_time']),'h:ia');
                if($ddt['ddt_loading_from']==0){
                    $temp_ddt_from='Inventory';
                }
                else if($ddt['ddt_loading_from']==1){
                    $temp_ddt_from='Customer';
                }
                $temp_result[$temp]['ddt_from']=$temp_ddt_from;

                if($ddt['ddt_unloading_date_time']==''){
                    $temp_ddt_is_delivered='<b><span style="color: red">'.$this->lang->line('pending').'</span></b>';
                }
                else{
                    $temp_ddt_is_delivered='<span style="color: green">'.$this->lang->line('delivered').'</span>';
                }
                $temp_result[$temp]['ddt_is_delivered']=$temp_ddt_is_delivered;
                $temp++;
            }
            echo json_encode($temp_result);
        }
        else{
            $current_date=date('Y-m-d h:i:s');

            $first_date=date_format(new DateTime($current_date),'Y-m-01 00:00:00');
            $last_date=date_format(new DateTime($current_date),'Y-m-t 23:59:59');

            $data['load_ddts']=$this->Admin_report_model->get_loaded_ddt_with_date_range($first_date,$last_date);
            $data['title']='DDT Load Report';
            $data['content']='admin_report/ddt_load_unload_report';
            $this->load->vars($data);
            $this->load->view('admin_layout/main');
            $this->load->view('admin_report/ddt_load_unload_report_js');
        }

    }

    public function single_ddt_loading_unloading_details($ddt_id){
        $data['title']='DDT Loading Unloading Details';
        $data['content']='admin_report/single_ddt_loading_unloading_details';
        $data['ddt_details']=$this->Admin_report_model->get_ddt_loading_unloading_details_by_ddt_id($ddt_id);
        $this->load->vars($data);
        $this->load->view('admin_layout/main');
        $this->load->view('admin_report/single_ddt_loading_unloading_details_js');
    }

    public function print_report(){
        $first_date=$this->input->post('start_date');
        $last_date=$this->input->post('end_date');
        $load_ddts=$this->Admin_report_model->get_loaded_ddt_with_date_range($first_date,$last_date);
        $this->load->library('Pdf');
        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
        $pdf->SetFont('helvetica', '', 9);
        $pdf->AddPage();

        $html='<!DOCTYPE html><head></head><body>';
//        '.base_url('assets/app_assets/images/logo.png').'
        $html=$html.'<div style="width: 100%;text-align: center"><img  src="'.base_url('assets/app_assets/images/logo.png').'" style="width: 100px" >
<h1 style="text-align: center">Report For AGT FROM '.date_format(new DateTime($first_date),'d-F-Y').' To '.date_format(new DateTime($last_date),'d-F-Y').'</h1><div>';

        $html = $html.'<table border="1">
<thead>
<tr>
<th style="text-align: center">DDT ID</th>
<th style="text-align: center">Load Date</th>
<th style="text-align: center">Load Time</th>
<th style="text-align: center">Load User Name</th>
<th style="text-align: center">Delivery User Name</th>
<th style="text-align: center">DDT From</th>
<th style="text-align: center">DDT Status</th>
</tr>
</thead>
<tbody>';
        $ddt_from='';
        $ddt_status='';
        foreach ($load_ddts AS $ddt){
            if ($ddt['ddt_loading_from'] == 0) $ddt_from='storage'; else if ($ddt['ddt_loading_from'] == 1) $ddt_from='customer';
            if ($ddt['ddt_unloading_date_time'] == "")  $ddt_status='<b><span style="color: red">' . $this->lang->line('pending') . '</span></b>'; else   $ddt_status='<span style="color: green">' . $this->lang->line('delivered') . '</span>';
            $html=$html.'<tr><td style="text-align: center;padding-left: 2px">'.$ddt['ref_ddt_id'].'</td><td style="text-align: center">'.date_format(new DateTime($ddt['ddt_loading_date_time']),'d-F-Y').'</td><td style="text-align: center">'.date_format(new DateTime($ddt['ddt_loading_date_time']),'h:ia').'</td><td style="text-align: center">'.$ddt['loading_user_name'].'</td><td style="text-align: center">'.$ddt['delivery_user_name'].'</td><td style="text-align: center">'.$ddt_from.'</td><td style="text-align: center">'.$ddt_status.'</td></tr>';
        }
        $html=$html.'</tbody></table></body></html>';
        $pdf->writeHTML($html, true, 0, true, 0);
        $pdf->lastPage();
        $pdf->Output('DDT_AGT_REPORT.pdf', 'I');


    }
}