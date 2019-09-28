<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Delivery_user_activity_model extends CI_Model{

    public function get_all_delivery_user_activity_within_date_range($start_date,$end_date){
        $sql='SELECT delivery_user.*,(SELECT COUNT(*) FROM ddt_loading_unloading WHERE ref_ddt_with_delivery_user_id=delivery_user.delivery_user_id AND (ddt_loading_date_time>="'.$start_date.'" AND ddt_loading_date_time<="'.$end_date.'")) AS total_delivered,(SELECT COUNT(*) FROM ddt_loading_unloading WHERE ref_loading_ddt_delivery_user_id=delivery_user.delivery_user_id AND (ddt_loading_date_time>="'.$start_date.'" AND ddt_loading_date_time<="'.$end_date.'")) AS  total_loaded,(SELECT COUNT(*) FROM ddt_loading_unloading WHERE ref_transferring_delivery_user_id=delivery_user.delivery_user_id AND (ddt_loading_date_time>="'.$start_date.'" AND ddt_loading_date_time<="'.$end_date.'")) AS total_transfered FROM delivery_user WHERE delivery_user.delivery_user_active=1';
        $result=$this->db->query($sql);
        return $result->result_array();
    }

    public function get_all_delivery_user(){
        $sql='SELECT * FROM delivery_user WHERE delivery_user_active<>0';
        $result=$this->db->query($sql);
        return $result->result_array();
    }
    public function get_delivery_user_activity_by_date($date,$user){
        $sql='SELECT * FROM delivery_user_starting_ending_points WHERE ref_delivery_user_id='.$user.' AND delivery_user_starting_ending_points_date LIKE "'.$date.'"';
        $result=$this->db->query($sql);
        return $result->result_array();
    }
    public function add_user_daily_activity($params){
        $this->db->insert('delivery_user_starting_ending_points',$params);
        return $this->db->insert_id();
    }
    public function update_user_daily_activity($params,$user,$date){
        $this->db->where('ref_delivery_user_id',$user);
        $this->db->like('delivery_user_starting_ending_points_date',$date);
        return $this->db->update('delivery_user_starting_ending_points',$params);
    }
    public function get_all_delivery_user_by_date($date){
        $sql='SELECT * FROM delivery_user_starting_ending_points
 INNER JOIN delivery_user ON delivery_user_id=ref_delivery_user_id
 WHERE delivery_user_starting_ending_points_date LIKE "'.$date.'"';
        $result=$this->db->query($sql);
        return $result->result_array();
    }
    public function get_delivery_user_by_starting_ending_points_id($id){
        $sql='SELECT * FROM delivery_user_starting_ending_points
 INNER JOIN delivery_user ON delivery_user_id=ref_delivery_user_id
 WHERE delivery_user_starting_ending_points_id='.$id;
        $result=$this->db->query($sql);
        return $result->row_array();
    }

    public function get_delivery_user_path_by_date_user_id($date,$id){
        $sql='SELECT ddt_loading_unloading.ddt_loading_lat AS lat,ddt_loading_unloading.ddt_loading_lng AS lng ,ddt_loading_unloading.ddt_loading_date_time AS date_time FROM agt.ddt_loading_unloading WHERE ddt_loading_unloading.ddt_loading_date_time LIKE "%'.$date.'%" AND ddt_loading_unloading.ref_loading_ddt_delivery_user_id='.$id.' UNION ALL 
SELECT ddt_loading_unloading.ddt_unloading_lat AS lat,ddt_loading_unloading.ddt_unloading_lng AS lng ,ddt_loading_unloading.ddt_unloading_date_time AS date_time FROM agt.ddt_loading_unloading WHERE ddt_loading_unloading.ddt_unloading_date_time LIKE "%'.$date.'%" AND ddt_loading_unloading.ref_ddt_with_delivery_user_id='.$id.' ORDER BY date_time';
        $result=$this->db->query($sql);
        return $result->result_array();
    }
}