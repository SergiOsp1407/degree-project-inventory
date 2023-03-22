<?php
class Products extends Controller{

    public function __construct() {
        session_start();        
        parent::__construct();
    }

    public function index(){

        if (empty($_SESSION['active'])){
            header("location: ".base_url);
        }

        $data['measures'] = $this->model->getMeasures();
        $data['categories'] = $this->model->getCategories();
        $this->views->getView($this, "index" , $data);
    }

    public function list(){
        $data = $this->model->getProducts();

        for ($i=0; $i < count($data); $i++) {
            $data[$i]['image'] = '<img class="img-thumbnail" src="'.base_url."Assets/img/".$data[$i]['image'].'" width="100">';

            if ($data[$i]['status'] == 1) {
                $data[$i]['status'] = '<span class="badge bg-success">Activo</span>';

                $data[$i]['actions'] = '<div>
                <button class="btn btn-primary" type="button" onclick="btnEditProduct('.$data[$i]['id'].');"><i class="fas fa-edit"></i></button>
                <button class="btn btn-danger" type="button" onclick="btnDeleteProduct('.$data[$i]['id'].');"><i class="fas fa-trash-alt"></i></button>
                </div>'; 
            }else {
                $data[$i]['status'] = '<span class="badge bg-danger">Inactivo</span>';
                $data[$i]['actions'] = '<div>            
                <button class="btn btn-success" type="button" onclick="btnReenterProduct('.$data[$i]['id'].');"><i class="fas fa-edit"></i></button>
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
        $image = $_FILES['image'];
        $name = $image['name'];
        $temp_name = $image['temp_name'];
    
        $date = date("YmdHis");

        if (empty($code) || empty($description) || empty($purchase_price) || empty($selling_price)) {

            $message = "Debes llenar todos los campos.";

        }else {

            if(!empty($name)){

                $imageName = $date.".jpg";
                $direction = "Assets/img/".$imageName;

            }else if(!empty($_POST['actual_image']) && empty($name)){

                $imageName = $_POST['actual_image'];

            }else{

                $imageName = "default.png";

            }
           
            if($id == ""){
                    $data = $this->model->registerProduct($code, $description, $purchase_price, $selling_price, $measure, $category, $imageName);

                    if ($data == "ok") {
                        if(!empty($name)){
                            move_uploaded_file($temp_name, $direction);
                        }
                        $message = array('message' => 'Producto registrado correctamente.', 'icon' => 'success');
                        
                    } else if ($data == "exists") {
                        $message = array('message' => 'El producto ya esta creado.', 'icon' => 'warning');
                    } else {
                        $message = array('message' => 'Error al registrar el producto', 'icon' => 'error');
                    }
                   
            }else{

                $imageDelete = $this->model->editProduct($id);
                if ($imageDelete['image'] != 'default.jpg') {
                    if (file_exists( "Assets/img/".$imageDelete['image'])) {

                        unlink( "Assets/img/".$imageDelete['image']);
                    }
                }

                $data = $this->model->modifyProduct($code, $description, $purchase_price, $selling_price, $measure, $category, $imageName, $id);

                if ($data == "modificado") {
                    if (!empty($name)) {
                        move_uploaded_file($temp_name, $direction);
                    }
                    $message = array('message' => 'Producto modificado correctamente.', 'icon' => 'success');
                } else {
                    $message = array('message' => 'Error al modificar el producto', 'icon' => 'error');
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
            $message = array('message' => 'Producto eliminado correctamente', 'icon' => 'success');
        } else{
            $message = array('message' => 'Error al eliminar el producto', 'icon' => 'error');
        }

        echo json_encode($message, JSON_UNESCAPED_UNICODE);
        die();
    }   
    public function reenter(int $id){

        $data = $this->model->actionProduct(1, $id);
        if($data == 1){
            $message = array('message' => 'Producto reingresado correctamente.', 'icon' => 'success');
        } else{
            $message = array('message' => 'Error al eliminar el producto', 'icon' => 'error');
        }

        echo json_encode($message, JSON_UNESCAPED_UNICODE);
        die();
    }

}

