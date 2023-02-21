<?php
class Errors extends Controller{
    public function index(){
        
        $this->views->getView($this, 'index');
    }

    public function permissions(){
        
        $this->views->getView($this, 'permissions');
    }
}



?>