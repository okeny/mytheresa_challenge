<?php  if ( ! defined('ABSPATH')) exit('No direct script access allowed');
 /*
	 * Author: okeny patrick
	 * Email: op58692@gmail.com
	 * This is the Bootstrap
  */
class Bootstrap {

    private $_url = null;
    private $_controller = null;
    
    private $_controllerPath = './psystem/controllers/'; // Always include trailing slash
    private $_modelPath = './psystem/models/'; // Always include trailing slash
    private $_errorFile = 'error.php';
    private $_defaultFile = 'index';
	private $_status = PUBLISH;
	private $_development = 'welcome';
    
    public function init(){
		
        $this->_getUrl();
        $this->_loadExistingController();
        $this->_callControllerMethod();
    }
	
    private function _getUrl(){
		
        $url = (isset($_GET['url'])) ? $_GET['url'] : null;
        $url = rtrim($url, '/');
        $url = filter_var($url, FILTER_SANITIZE_URL);
        $this->_url = explode('/', $url);
    }
	
    private function _loadExistingController(){
		 
	    if($this->_status == false){
				$this->_url[0] = $this->_development;
				$file = $this->_controllerPath . $this->_url[0] . '.php';
				if (file_exists($file)) {
					require $file;
					$this->_controller = Registry::load_class($this->_url[0]);
					$this->_controller->loadModel($this->_url[0], $this->_modelPath);
				} else { 
					$this->_error();
				}
		}else{
			   //load controller and assumes default controller if none is pressent
			   if (empty($this->_url[0])) { $this->_url[0] = $this->_defaultFile; }
				  $file = $this->_controllerPath . $this->_url[0] . '.php';
				  if (file_exists($file)) 
				  {
					  require $file;
					  $this->_controller = Registry::load_class($this->_url[0]);
					  $this->_controller->loadModel($this->_url[0], $this->_modelPath);
				  } else { $this->_error(); }
		}
    }
	
    private function _callControllerMethod() {
        $length = count($this->_url);
        if ($length > 1) {
            if (!method_exists($this->_controller, $this->_url[1])) { $this->_error();  }
        }
        switch ($length) {
            case 5:
                $this->_controller->{$this->_url[1]}($this->_url[2], $this->_url[3], $this->_url[4]);
                break;
            case 4:
                $this->_controller->{$this->_url[1]}($this->_url[2], $this->_url[3]);
                break;
            case 3:
                $this->_controller->{$this->_url[1]}($this->_url[2]);
                break;
            case 2:
                $this->_controller->{$this->_url[1]}();
                break;
            default:
                $this->_controller->index();
                break;
        }
    }
	
    public function _error() {
        require $this->_controllerPath . $this->_errorFile;
        $this->_controller = Registry::load_class('Error');
        $this->_controller->index();
        exit;
    }
	
    public function setControllerPath($path){ 
	    $this->_controllerPath = trim($path, '/') . '/'; 
	}
	
    public function setModelPath($path){
		 $this->_modelPath = trim($path, '/') . '/';
    }
	
    public function setErrorFile($path){ 
	     $this->_errorFile = trim($path, '/');
	}
	
    public function setDefaultFile($path){ 
	     $this->_defaultFile = trim($path, '/');
    }
}