<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class Delete extends CI_Controller{

        public function __construct(){
            parent::__construct();
            header('Content-Type: application/json');
            header('Access-Control-Allow-Origin: *');
            header('Access-Control-Allow-Headers: access_token, Cache-Control');
            header('Access-Control-Allow-Methods: GET, HEAD, POST, PUT, DELETE');
        }

        public function user(){
            if($this->admin->deleteEntity($_POST['type'], $_POST['id'])){
                echo json_encode(['status' => true, 'message' => 'User deleted successfully']);
            }
            else{
                echo json_encode(['status' => false, 'message' => 'Unable to delete']);
            }
        }

        public function menuitem(){
            $data = $this->query->deleteEntity('menu', $_POST['id']);
            if($data){
                echo json_encode(['status' => true, 'message' => 'Service successfully deleted']);
            }
            else{
                echo json_encode(['status' => false, 'message' => 'Error, not deleted']);
            }
        }

        public function servicecategory(){
            $data = $this->query->deleteEntity('service_category', $_POST['id']);
            if($data){
                echo json_encode(['status' => true, 'message' => 'Sub category successfully deleted']);
            }
            else{
                echo json_encode(['status' => false, 'message' => 'Error, not deleted']);
            }
        }
    }
?>