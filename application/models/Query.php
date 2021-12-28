
<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Query extends CI_Model{ 

    function __construct(){
        parent::__construct();
    }

    public function addData($type, $data){
        return $this->db->insert($type, $data) ? true : false ;
    }

    public function login($data){
        $this->db->select('id, username');
        $query = $this->db->get_where('admin', array('username' => $data['username'], 'password' => $data['password']))->row();
        return $query;
    }

    public function fetchDataById($id){
        $query = $this->db->get_where('menu', array('id' => $id));
        return $query->row();
    }

    public function fetchMenuByServiceId($id){
        $this->db->select('*');
        $query = $this->db->get_where('menu', array('service_category' => $id));
        return $query->result();
    }

    public function fetchMenuByServiceIdAndType($id, $type){
        $this->db->select('*');
        $this->db->from('menu');
        $this->db->where('service_category="'.$id.'" and (category="'.$type.'" or category="both")');
        $query = $this->db->get();
        return $query->result();
    }

    public function fetchServiceCategoryById($id){
        $query = $this->db->get_where('service_category', array('id' => $id));
        return $query->row();
    }

    public function fetchAll($table){
        $this->db->select('*');
        $query = $this->db->get($table);
        return $query->result();
    }

    public function userupdate($table, $data, $id){
        $this->db->where('id', $id);
        $this->db->update($table, $data); 
        return ($this->db->affected_rows() > 0) ? true : false; 
    }

    public function deleteEntity($table, $id){
        $res = $this->db->delete($table, array('id' => $id)); 
        return $res;
    }

}
?>