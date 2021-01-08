<?php  if ( ! defined('ABSPATH')) exit('No direct script access allowed');
 /*
	 * Author: okeny patrick
	 * Email: op58692@gmail.com
	 * This is a Controller class 
*/
class Session
{
    
    public static function init()
    {
		if(empty($_SESSION)){
            session_start();
		}
    }
    
    public static function set($key, $value)
    {
        $_SESSION[$key] = $value;
    }
    
    public static function get($key)
    {
        if (isset($_SESSION[$key]))
        return htmlspecialchars($_SESSION[$key]);
    }
    
    public static function destroy()
    {
        unset($_SESSION);
        session_destroy();
    }
    
}