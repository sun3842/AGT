<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_report_model extends CI_Model{

    public function get_loaded_ddt_with_date_range($start_date,$end_date){
        $sql='SELECT ddt_load_unload.*,delivery.delivery_user_user_name AS delivery_user_name,loading_user.delivery_user_user_name AS loading_user_name,transferring_user.delivery_user_user_name AS transferring_user_name FROM ddt_loading_unloading AS ddt_load_unload
 LEFT JOIN delivery_user AS delivery ON ddt_load_unload.ref_ddt_with_delivery_user_id=delivery.delivery_user_id 
 LEFT JOIN delivery_user AS loading_user ON ddt_load_unload.ref_loading_ddt_delivery_user_id=loading_user.delivery_user_id 
 LEFT JOIN delivery_user AS transferring_user ON transferring_user.delivery_user_id=ddt_load_unload.ref_transferring_delivery_user_id 
WHERE ddt_load_unload.ddt_loading_date_time>="'.$start_date.'" AND ddt_load_unload.ddt_loading_date_time<="'.$end_date.'"';
        $result=$this->db->query($sql);
        return $result->result_array();
    }
    public function get_ddt_loading_unloading_details_by_ddt_id($ddt_id){
        $sql='SELECT ddt_load_unload.*,ddt.ddt_qr_code_image_location AS ddt_image_location,delivery.delivery_user_user_name AS delivery_user_name,loading_user.delivery_user_user_name AS loading_user_name,transferring_user.delivery_user_user_name AS transferring_user_name FROM ddt_loading_unloading AS ddt_load_unload 
INNER JOIN ddt ON ddt_load_unload.ref_ddt_id=ddt_id 
LEFT JOIN delivery_user AS delivery ON ddt_load_unload.ref_ddt_with_delivery_user_id=delivery.delivery_user_id 
LEFT JOIN delivery_user AS loading_user ON ddt_load_unload.ref_loading_ddt_delivery_user_id=loading_user.delivery_user_id 
LEFT JOIN delivery_user AS transferring_user ON transferring_user.delivery_user_id=ddt_load_unload.ref_transferring_delivery_user_id 
WHERE ref_ddt_id='.$ddt_id;
        $result=$this->db->query($sql);
        return $result->row_array();
    }


    public function get_delivery_user_summery(){
        $sql='SELECT * FROM delivery_user WHERE delivery_user_active=1';
        $result=$this->db->query($sql);
        return $result->result_array();
    }

    public function get_all_craeted_qr_code_by_date_range($start_date,$end_date){
        $sql='SELECT * FROM ddt
LEFT JOIN ddt_loading_unloading ON ddt_id=ref_ddt_id
 WHERE ddt_active=1 AND (ddt_created_date_time>="'.$start_date.'" AND ddt_created_date_time<="'.$end_date.'")';
        $result=$this->db->query($sql);
        return $result->result_array();
    }



}
