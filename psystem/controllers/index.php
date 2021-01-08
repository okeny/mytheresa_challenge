<?php  if ( ! defined('ABSPATH')) exit('No direct script access allowed');

class Index extends Controller {

	public function __construct() {
	   parent::__construct();
    }

	public function index() {
		
		echo "Server up and running...";
	}  	
	
}
