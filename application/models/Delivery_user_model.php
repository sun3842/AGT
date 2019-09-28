<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Delivery_user_model extends CI_Model{


    public function is_delivery_user_name_valid_for_add($delivery_user_name){
        $sql='SELECT * FROM delivery_user WHERE delivery_user_user_name="'.$delivery_user_name.'"';
        $result=$this->db->query($sql);
        return $result->row_array();
    }

    public function add_new_delivery_user($params){
        $this->db->insert('delivery_user',$params);
        return $this->db->insert_id();
    }
    public function get_all_delivery_user(){
        $sql='SELECT * FROM delivery_user WHERE delivery_user_active<>0';
        $result=$this->db->query($sql);
        return $result->result_array();
    }
    public function is_delivery_user_name_valid_for_update($delivery_user_name,$delivery_user_id){
        $sql='SELECT * FROM delivery_user WHERE delivery_user_user_name="'.$delivery_user_name.'" AND delivery_user_id<>'.$delivery_user_id;
        $result=$this->db->query($sql);
        return $result->row_array();
    }
    public function update_delivery_user_info_by_user_id($params,$delivery_user_id){
        $this->db->where('delivery_user_id',$delivery_user_id);
        return $this->db->update('delivery_user',$params);
    }
    public function get_delivery_user_all_info_by_user_id($delivery_user_id){
        $sql='SELECT * FROM delivery_user WHERE delivery_user_id='.$delivery_user_id;
        $result=$this->db->query($sql);
        return $result->row_array();
    }
}