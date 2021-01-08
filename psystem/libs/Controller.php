<?php  if ( ! defined('ABSPATH')) exit('No direct script access allowed');
 /*
	 * Author: okeny patrick
	 * Email: op58692@gmail.com
	 * This is a Controller class 
*/
class Controller {

    function __construct() {
		Session::init();
        $this->view = Registry::load_class('View');		
    }
	
    /**
     * @param string $name Name of the model
     * @param string $path Location of the models
     */
    public function loadModel($name, $modelPath = '../models/') {
        $path = $modelPath . $name.'_model.php';
        if (file_exists($path)) {
            require $path;
            $modelName = $name . '_Model';
            $this->model = Registry::load_class($modelName);
        }        
    }
    
	
}
