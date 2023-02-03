<?php
class Products extends Controller{

    public function __construct() {

        session_start();
        
        parent::__construct();
    }

    public function index()
    {

        if (empty($_SESSION['activo'])){
            header("location: ".base_url);
        }

        $data['measures'] = $this->model->getMeasures();
        $data['categories'] = $this->model->getCategories();
        $this->views->getView($this, "index" , $data);
    }

    public function list(){
        $data = $this->model->getProducts();

        for ($i=0; $i < count($data); $i++) { 

            if ($data[$i]['status'] == 1) {
                $data[$i]['status'] = '<span class="badge badge-success">Activo</span>';
                $data[$i]['actions'] = '<div>
                <button class="btn btn-primary" type="button" onclick="btnEditProduct('.$data[$i]['id'].');"><i class="fas fa-edit"></i></button>
                <button class="btn btn-danger" type="button" onclick="btnDeleteProduct('.$data[$i]['id'].');"><i class="fas fa-trash-alt"></button>
                </div>'; 
            }else {
                $data[$i]['status'] = '<span class="badge badge-danger">Inactivo</span>';
                $data[$i]['actions'] = '<div>            
                <button class="btn btn-success" type="button" onclick="btnReenterProduct('.$data[$i]['id'].');"><i class="fas fa-edit"></button>
                </div>'; 
            }

            
        }
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function register(){
        $code = $_POST['code'];
        $description = $_POST['description'];
        $purchase_price = $_POST['purchase_price'];
        $selling_price = $_POST['selling_price'];
        $measure = $_POST['measure'];
        $category = $_POST['category'];
        $id = $_POST['id'];

        if (empty($code) || empty($description) || empty($purchase_price) || empty($selling_price)) {

            $message = "Debes llenar todos los campos.";
        }else {

            if($id == ""){

                    $data = $this->model->registerProduct($code, $description, $purchase_price, $selling_price, $measure, $category );

                    if ($data == "ok") {
                        $message = "Si";
                    } else if ($data == "exists") {
                        $message = "El usuario ya existe";
                    } else {
                        $message = "Error al registar el usuario";
                    }
                   
            }else{
                $data = $this->model->modifyProduct($code, $description, $purchase_price, $selling_price, $measure, $category, $id);

                if ($data == "modificado") {
                    $message = "modificado";
                }else {
                    $message = "Error al modificar el usuario";
                }
            }            
        }
        echo json_encode($message, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function edit(int $id){

        $data = $this->model->editProduct($id);
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();

    }
    
    public function delete(int $id){

        $data = $this->model->actionProduct(0, $id);
        if($data == 1){
            $message = "ok";
        } else{
            $message = "Error al eliminar el usuario";
        }

        echo json_encode($message, JSON_UNESCAPED_UNICODE);
        die();
    }   
    public function reenter(int $id){

        $data = $this->model->actionProduct(1, $id);
        if($data == 1){
            $message = "ok";
        } else{
            $message = "Error al reingresar el producto";
        }

        echo json_encode($message, JSON_UNESCAPED_UNICODE);
        die();
    }

}

?>

