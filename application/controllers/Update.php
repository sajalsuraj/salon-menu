<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class Update extends CI_Controller{

        public function __construct(){
            parent::__construct();
            header('Content-Type: application/json');
            header('Access-Control-Allow-Origin: *');
            header('Access-Control-Allow-Headers: access_token, Cache-Control, Content-Type');
            header('Access-Control-Allow-Methods: GET, HEAD, POST, PUT, DELETE');
        }

        public function menuitem()
        {
            if ($this->query->userupdate('menu', $_POST, $_POST['id'])) {
                echo json_encode(['status' => true, 'message' => "Menu Item updated"]);
            } else {
                echo json_encode(['status' => false, 'message' => "Error, Not Updated"]);
            }
        }
    
    }
?>