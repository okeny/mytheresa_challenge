<?php  if ( ! defined('ABSPATH')) exit('No direct script access allowed');
 /*
	 * Author: okeny patrick
	 * Email: op58692@gmail.com
*/

class Products_Model extends Model{

    public function __construct(){
        parent::__construct();
    }

    public function getProducts($categoryID, $priceLessThan){
        //check if the priceless than is set
        if($priceLessThan ==0){
            $products = $this->getProductsByCategory($categoryID);
        }else{
            $products = $this->getProductByPrice($categoryID, $priceLessThan);
        }
        //this loops through the products to check for discount and category
        foreach($products as $key =>$value){
            //items category boots has a 30% discount
            $discount = $this->checkForDiscount($value['category_id'] , $value['sku']);
            //echo $discount;die;
            $discountPrice = $discount/100 * $value["price"];
            $finalPrice = $value['price'] - $discountPrice;
            $products[$key]["price"] = array("original"=>$value['price'], "final"=>$finalPrice,
                "discount_percentage"=> $discount+" %");
        }
	    return $products;
    }
    
    //This takes in a category ID and returns products by category
    public function getProductsByCategory($categoryID){
        $products = Database::select("SELECT p.name, p.sku, p.price, p.category_id, p.currency FROM `products` AS p 
        LEFT JOIN category AS c ON p.category_id = c.id WHERE p.category_id = :catID LIMIT 5 ", array("catID"=> $categoryID));
        return $products;
    }
    
    //This takes in a category ID and a price and gets products that are lessthan or equal to
    public function getProductByPrice($categoryID, $priceLessThan){
       // echo $priceLessThan;die;
        $products = Database::select("SELECT p.name, p.sku, p.price, p.category_id, c.name as category, p.currency FROM `products` AS p 
        LEFT JOIN category AS c ON p.category_id = c.id WHERE p.category_id = :catID AND p.price <= :priceLessThan LIMIT 5 ", 
        array("catID"=> $categoryID, "priceLessThan"=> $priceLessThan));
        return $products;
    }
    
    //This takes in a category ID and a sku and determines a discount to be applied
    public function checkForDiscount($categoryID, $sku){
        if(($categoryID == 1) && ($sku == "000003")){
            $discount = 15;
        }elseif(($categoryID == 1) && ($sku != "000003")){
            $discount = 30;
        }else{
            $discount = 0;
        }
        return $discount;
    }

}

	
