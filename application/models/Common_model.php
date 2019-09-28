<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Common_model extends CI_Model{


    public function is_user_valid($params){
        $sql='SELECT * FROM admin_user WHERE admin_user_active=1 AND admin_user_name="'.$params['admin_user_name'].'" AND admin_user_password_hash_value="'.$params['admin_user_password_hash_value'].'"';
        $result=$this->db->query($sql);
        return $result->row_array();
    }

    public function get_user_all_info_by_user_id($user_id){

        $sql='SELECT * FROM admin_user WHERE admin_user_id='.$user_id;
        $result=$this->db->query($sql);
        return $result->row_array();
    }

    public function is_user_name_valid_for_update($user_name,$user_id){
        $sql='SELECT * FROM admin_user WHERE admin_user_name="'.$user_name.'" AND admin_user_id<>'.$user_id;
        $result=$this->db->query($sql);
        return $result->row_array();
    }

    public function update_admin_user_info_by_user_id($params,$user_id){
        $this->db->where('admin_user_id',$user_id);
        return $this->db->update('admin_user',$params);
    }

    public function is_user_name_valid_for_add($user_name){
        $sql='SELECT * FROM admin_user WHERE admin_user_name="'.$user_name.'"';
        $result=$this->db->query($sql);
        return $result->row_array();
    }

    public function add_new_admin_user($params){
        $this->db->insert('admin_user',$params);
        return $this->db->insert_id();
    }
    public function get_all_admin_user(){
        $sql='SELECT * FROM admin_user WHERE admin_user_active<>-1 AND admin_user_ref_user_type_id<>1';
        $result=$this->db->query($sql);
        return $result->result_array();
    }

    public function get_admin_user_by_mail($email){
        $sql='SELECT * FROM admin_user WHERE admin_user_email_address="'.$email.'" And admin_user_active=1';
        $result=$this->db->query($sql);
        return $result->result_array();
    }

    public function update_admin_user_info_by_user_login_name($params,$user_login_name){
        $this->db->where('admin_user_name',$user_login_name);
        return $this->db->update('admin_user',$params);
    }
    public function get_admin_user_by_mail_and_user_name($email,$user_name){
        $sql='SELECT * FROM admin_user WHERE admin_user_name="'.$user_name.'" AND admin_user_email_address="'.$email.'" And admin_user_active=1';
        $result=$this->db->query($sql);
        return $result->result_array();
    }
}