<?php  if ( ! defined('ABSPATH')) exit('No direct script access allowed');

class Products extends Controller {

	public function __construct() {
	   parent::__construct();
    }

	public function index() {
        
        $cat_id = trim($_GET['cat_id']);
        if(!is_numeric($cat_id)){
            http_response_code(400);
            echo json_encode("Bad Request Sent");
            return;
        }
        
        if(isset($_GET['priceLessThan'])){
            $priceLessThan = trim($_GET['priceLessThan']);
            if(!is_numeric($cat_id)){
                http_response_code(400);
                echo json_encode("Bad Request Sent");
                return;
            }
        }else{
            $priceLessThan =0;
        }
         
        $data = $this->model->getProducts($cat_id, $priceLessThan);
        if(count($data) ==0){
            http_response_code(404);
            echo json_encode("No product found");
            return;
        }
        
        http_response_code(200);
        echo json_encode($data);
        return;
	}  	
	
}
