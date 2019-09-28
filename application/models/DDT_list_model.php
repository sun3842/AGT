<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DDT_list_model extends CI_Model{

    var $table="ddt";
    var $select_column=array("ddt_id","ddt_qr_code_image_location","ddt_created_date_time","ddt_active");
    var $order_column=array("ddt_id");

    function make_query(){
        $this->db->select($this->select_column);
        $this->db->from($this->table);
        if(isset($_POST['search']['value'])){
            $this->db->where("ddt_id LIKE '%".$_POST['search']['value']."%'");
            $this->db->or_where("ddt_created_date_time LIKE '%".$_POST['search']['value']."%'");
        }
        if(isset($_POST['order'])){
            $this->db->order_by($this->order_column[$_POST['order']['0']['column']],$_POST['order']['0']['dir']);
        }
        else{
            $this->db->order_by("ddt_id","DESC");
        }
    }

    function make_data_table(){
        $this->make_query();
        if($_POST['length']!=-1){
            $this->db->limit($_POST['length'],$_POST['start']);
        }
        $query=$this->db->get();
        return $query->result();
    }

    function get_filtered_data(){
        $this->make_query();
        $query=$this->db->get();
        return $query->num_rows();
    }

    function get_all_data(){

        $this->db->select('*');
        $this->db->where('ddt_active<>',0);
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }
}