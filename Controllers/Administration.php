<?php
class Administration extends Controller{

    public function __construct() {
        session_start();
        // if (empty($_SESSION['active'])){
        //     header("location: " . base_url);
        // }
        parent::__construct();
    }

    public function index(){

        $id_user = $_SESSION['id_user'];
        $check = $this->model->verifyPermission($id_user, 'configuracion');
        if (!empty($check) || $id_user == 1) {
            $data = $this->model->getCompany();
            $this->views->getView($this, "index", $data);
        }else {
            header('Location: '.base_url. 'Errors/permissions');
        }
        
    }

    public function home(){

        $data['users'] = $this->model->getData('users');
        $data['clients'] = $this->model->getData('clients');
        $data['products'] = $this->model->getData('products');
        $data['sales'] = $this->model->getSales();
        $this->views->getView($this, "home", $data);
    }

    public function modify(){

        $id_company = $_POST['id_company'];
        $name = $_POST['name'];
        $phone = $_POST['phone'];
        $address = $_POST['address'];
        $message = $_POST['message'];
        $id = $_POST['id'];

        $data = $this->model->modify($id_company,$name, $phone, $address, $message, $id);

        if($data == 'ok'){
            $message = 'ok';
        }else{
            $message = 'error';
        }

        echo json_encode($message);
        die();
    }

    public function reportStock(){
        $data = $this->model->getMinimumStock();
        echo json_encode($data);
        die();
    }

    public function soldProducts(){
        $data = $this->model->getSoldProducts();
        echo json_encode($data);
        die();
    }
}

?>