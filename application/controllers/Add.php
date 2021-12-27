
<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class Add extends CI_Controller{

        public function __construct(){
            parent::__construct();
            header('Content-Type: application/json');
            header('Access-Control-Allow-Origin: *');
            header('Access-Control-Allow-Headers: access_token, Cache-Control, Content-Type');
            header('Access-Control-Allow-Methods: GET, HEAD, POST, PUT, DELETE');
        }

        function menuitem(){
            $data = $this->query->addData('menu',$_POST);

            if($data){
                $response = array("status"=>true, "message"=>"Menu item added successfully");
            }
            else{
                $response = array("status"=>false, "message"=>"Not added");
            }

            echo json_encode($response);
        }

        function servicecategory(){
            $data = $this->query->addData('service_category',$_POST);

            if($data){
                $response = array("status"=>true, "message"=>"Sub category added successfully");
            }
            else{
                $response = array("status"=>false, "message"=>"Not added");
            }

            echo json_encode($response);
        }
    }
?>