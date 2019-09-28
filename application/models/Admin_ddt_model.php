<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_ddt_model extends CI_Model{




    public function get_all_ddt(){
        $sql='SELECT * FROM ddt
LEFT JOIN admin_user ON ddt_qr_created_admin_user_id=admin_user_id
LEFT JOIN delivery_user ON ddt_qr_created_delivery_user_id=delivery_user_id
WHERE ddt_active=1 ORDER BY ddt_id DESC ';
        $result=$this->db->query($sql);
        return $result->result_array();
    }

    public function get_all_ddt_with_deleted(){
        $sql='SELECT * FROM ddt
LEFT JOIN admin_user ON ddt_qr_created_admin_user_id=admin_user_id
LEFT JOIN delivery_user ON ddt_qr_created_delivery_user_id=delivery_user_id
ORDER BY ddt_id DESC ';
        $result=$this->db->query($sql);
        return $result->result_array();
    }

    public function add_new_ddt($params){
        $this->db->insert('ddt',$params);
        return $this->db->insert_id();
    }


    public function update_ddt_by_id($ddt_info,$ddt_id){

        $this->db->where('ddt_id',$ddt_id);
        return $this->db->update('ddt',$ddt_info);
    }

    public function get_ddt_by_ddt_id($ddt_id){
//        $sql='SELECT ddt.*, c_admin.admin_user_name AS c_admin_user,e_admin.admin_user_name AS e_admin_user FROM ddt
//LEFT JOIN admin_user AS c_admin ON ddt_qr_created_admin_user_id=c_admin.admin_user_id
//LEFT JOIN admin_user AS e_admin ON ddt_edited_admin_user_id=e_admin.admin_user_id
//LEFT JOIN delivery_user ON ddt_qr_created_delivery_user_id=delivery_user_id
//WHERE ddt_active=1 AND ddt_id='.$ddt_id;
        $sql='SELECT ddt.*, c_admin.admin_user_name AS c_admin_user,ddt_loading_unloading.*,deliver_user.delivery_user_user_name AS delivery_user_name,transfer_user.delivery_user_user_name AS transfer_user_name,load_user.delivery_user_user_name AS load_user_name FROM ddt
LEFT JOIN ddt_loading_unloading ON ddt_id=ref_ddt_id
LEFT JOIN delivery_user AS deliver_user ON  ddt_loading_unloading.ref_ddt_with_delivery_user_id=deliver_user.delivery_user_id
LEFT JOIN delivery_user AS transfer_user ON  ddt_loading_unloading.ref_transferring_delivery_user_id=transfer_user.delivery_user_id
LEFT JOIN delivery_user AS load_user ON  ddt_loading_unloading.ref_loading_ddt_delivery_user_id=load_user.delivery_user_id
LEFT JOIN admin_user AS c_admin ON ddt_qr_created_admin_user_id=c_admin.admin_user_id
WHERE ddt_id='.$ddt_id;
        $result=$this->db->query($sql);
        return $result->row_array();
    }

}