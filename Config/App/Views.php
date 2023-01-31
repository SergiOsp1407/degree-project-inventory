<!--Connecting Views and the Controller-->
<?php

class Views{

    //Show views
    public function getView($controller, $view)
    {
        $controller = get_class($controller);
        if ($controller == "Home") {
            $view = "Views/".$view.".php";
        }else{
            $view = "Views/".$controller."/".$view.".php";

        }

        require $view;
    }

}

?>