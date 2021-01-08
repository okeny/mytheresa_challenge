<?php  if ( ! defined('ABSPATH'))  exit('No direct script access allowed');
 /*
	 * Author: okeny patrick
	 * Email: op58692@gmail.com
	 * This is a Controller class 
*/
class Registry {
	
    private static $_instances = array();
  
	public static function get($key, $default = null){
		
		if(isset(self::$_instances[$key])){
			return self::$_instances[$key];
		}
	    return $default;
	}
	
    public static function erase($key){
        unset(self::$_instances[$key]);
    }
	
    public static function load_class($key){
		//print_r(self::$_instances);die;
		$l_key = strtolower($key);
			try{
			     self::$_instances[$l_key] = new $key();
			}catch(Exception $e){
				 throw new Exception("class not found");
			}
		return self::$_instances[$l_key];
    }
}


