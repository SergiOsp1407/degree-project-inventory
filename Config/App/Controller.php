<?php
class Controller{

    //public View $views;
    //public readonly Models $model;

    public function __construct()
    {
        $this->views = new Views();
        $this->loadModel();
    }
    //Loading the Model
    public function loadModel()
    {
        $model = get_class($this)."Model";
        $route = "Models/".$model.".php";

        if (file_exists($route)){
            require_once $route;

            $this->model = new $model();
            
            
        }
    }
}
    


?>