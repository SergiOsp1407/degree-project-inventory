<?php
    class Home extends Controller{

        public function __construct(){

            // session_start();
            // if (!empty($_SESSION['active'])){
            //     header("location: ".base_url. "Users");
            // }


            parent::__construct();
            
        }

        public function index()
        {
            $this->views->getView($this, "index");            
            //echo "The method works";
        }

        
        
    }    

?>