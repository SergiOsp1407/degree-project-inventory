<?php
class Controller{

    protected $views, $model;

    public function __construct()
    {
        $this->views = new Views();
        $this->loadModel();
    }
    //Loading the Model
    public function loadModel()
    {
        $modelName = get_class($this)."Model";
        $route = "Models/".$modelName.".php";

        if (file_exists($route)){
            require_once $route;
            $this->model = new $modelName();
        }
    }
}
    


?>