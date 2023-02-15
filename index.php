<?php

    require_once 'Config/Config.php';

    // // Hide routes!!!
    $route = !empty($_GET['url']) ? $_GET['url'] : "Home/index";

    $arrayIndex = explode("/", $route);
    $controller = $arrayIndex[0];
    $method = "index";
    $param = "";

    //Verify if $method exists

    if (!empty($arrayIndex[1])) {
        
        if(!empty($arrayIndex[1] != "")){
            $method = $arrayIndex[1];
        }
    }
    if (!empty($arrayIndex[2])) {
        
        if(!empty($arrayIndex[2] != "")){
            for ($i = 2; $i < count($arrayIndex); $i++) { 
                $param .= $arrayIndex[$i] . ",";
            }
            $param = trim($param, ",");
        }
    }

    require_once 'Config/App/autoload.php';

    //Store the folders route of Controller directory
    $dirControllers = "Controllers/" . $controller . ".php";
    if (file_exists($dirControllers)) {
        require_once $dirControllers;
        $controller = new $controller();
        if (method_exists($controller, $method)) {
            $controller->$method($param);
        }else {
            header('Location: '.base_url.'Errors');
        }
    }else {
        header('Location: '.base_url.'Errors');
    }
    



?>
