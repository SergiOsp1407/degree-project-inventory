<?php
class Administration extends Controller{

    public function __construct() {
        session_start();
        if (empty($_SESSION['activo'])){
            header("location: ".base_url);
        }
        parent::__construct();
    }

    public function index(){

        $data = $this->model->getCompany();
        $this->views->getView($this, "index", $data);
    }

    public function modify(){

        $name = $_POST['name'];
        $phone = $_POST['phone'];
        $address = $_POST['address'];
        $message = $_POST['message'];
        $id = $_POST['id'];

        $data = $this->model->modify($name, $phone, $address, $message, $id);

        if($data == 'ok'){
            $message = 'ok';
        }else{
            $message = 'error';
        }

        echo json_encode($message);
        die();


    }



}

?>