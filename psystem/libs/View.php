<?php  if ( ! defined('ABSPATH')) exit('No direct script access allowed');
 /*
	 * Author: okeny patrick
	 * Email: op58692@gmail.com
	 * This is a Controller class 
*/
class View {

    function __construct() {
        //echo 'this is the view';
    }

    public function render($name, $noInclude = false)
    {
        require '../psystem/views/'. $name . '.php';    
    }
	
}

