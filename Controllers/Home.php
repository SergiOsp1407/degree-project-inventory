<?php
    class Home extends Controller{

        public function index()
        {
            $this->views->getView($this, "index");            
            //echo "The method works";
        }

        
        
    }    

?>