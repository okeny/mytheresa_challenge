<?php

class Error_404 extends Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        
        $this->view->heading = 'Error 404 Found';   
        echo $this->view->heading;
    }
}
