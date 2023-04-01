<?php
class HomeModel{
    public function __construct()
    {
        echo "Conectado";        
    }

    public function getData($param){

        return 'Message from model'.$param;
    }
}
?>