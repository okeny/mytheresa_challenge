<?php  if ( ! defined('ABSPATH')) exit('No direct script access allowed');
 /*
	 * Author: okeny patrick
	 * Email: op58692@gmail.com
	 * This is a Controller class 
*/
class Model {
   
    public function __construct() {
		
    }
	 public function loadhelper($name) {
            $helperName = $name . '_helper';
            $this->helper->$name = new $helperName();  
    }
	
}
