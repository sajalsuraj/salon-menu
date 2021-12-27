
<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class Get extends CI_Controller{

        public function __construct(){
            parent::__construct();
            header('Content-Type: application/json');
            header('Access-Control-Allow-Origin: *');
            header('Access-Control-Allow-Headers: access_token, Cache-Control, Content-Type');
            header('Access-Control-Allow-Methods: GET, HEAD, POST, PUT, DELETE');
        }

        public function login(){   

            $_POST['password'] = md5($_POST['password']);

            $data = $this->query->login($_POST);  

            if($data){

                $newdata = array(
                    'id'     => $data->id
                );

                $this->session->set_userdata($newdata);  
                echo json_encode(['status' => true, 'message' => 'Successful Login']);

            }
            else{
                echo json_encode(['status' => false, 'message' => 'Unsuccessful Login']);
            }
        
        }//end-function

        public function menu(){
            $categories = $this->query->fetchAll('service_category');
            $finalMenu = [];
            foreach ($categories as $category) {
                $menuObj = (object) [];
                $menMenuObj = (object) [];
                $womenMenuObj = (object) [];

                $menuCategories = $this->query->fetchMenuByServiceId($category->id);
                $menuObj->category_name = $category->name;
                $menuObj->menuData = $menuCategories;
                $finalMenu[] = $menuObj;

                $menuCategories = $this->query->fetchMenuByServiceIdAndType($category->id, 'men');
                $menMenuObj->category_name = $category->name;
                $menMenuObj->menuData = $menuCategories;
                $menMenu[] = $menMenuObj;

                $menuCategories = $this->query->fetchMenuByServiceIdAndType($category->id, 'women');
                $womenMenuObj->category_name = $category->name;
                $womenMenuObj->menuData = $menuCategories;
                $womenMenu[] = $womenMenuObj;
            }

            echo json_encode(['status' => true, 'message' => 'Menu List', 'all_menu' => $finalMenu, 'men_menu' => $menMenu, 'women_menu' => $womenMenu]);
        }


        // public function insertdata(){
        //     $serviceData = $this->query->fetchAll('services');

        //     foreach($serviceData as $service){
        //         $arr = array("name" => $service->name, "price" => $service->price);
        //         $this->query->addData('menu', $arr);
        //     }
        // }
    }
?>