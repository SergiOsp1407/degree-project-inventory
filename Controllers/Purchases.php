<?php

class Purchases extends Controller {

    public function __construct(){

        session_start();

        parent::__construct();
        
    }

    public function index(){

        $this->views->getView($this, "index");
    }

    public function searchCode($code){

        $data = $this->model->getProductCode($code);
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();

    } 

    public function inputInfo(){

        $id = $_POST['id'];
        $data = $this->model->getProducts($id);
        $id_product = $data['id'];
        $id_user = $_SESSION['id_user'];
        $purchase_price = $data['purchase_price'];
        $amount = $_POST['amount'];
        $sub_total = $price * $amount;
        $allData = $this->model->registerDetail($id_product, $id_user, $price, $amount, $sub_total);
        if($allData == "ok"){
            $message = "ok";
        }else{
            $message = "Error al ingresar el producto ";
        }

        echo json_encode($message, JSON_UNESCAPED_UNICODE);
        die();        
    }

    public function list(){

        $id_user = $_SESSION['id_user'];
        $data = $this->model->getDetail($id_user);
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();

    }
}
?>