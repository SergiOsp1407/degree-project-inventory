<?php
class Categories extends Controller{

    public function __construct() {
        session_start();
        if (empty($_SESSION['active'])){
            header("location: ".base_url);
        }
        parent::__construct();
    }

    public function index(){

        $id_user = $_SESSION['id_user'];
        $check = $this->model->verifyPermission($id_user, 'categories');
        if (!empty($check) || $id_user == 1) {
            $this->views->getView($this, "index");
        }else {
            header('Location: '.base_url. 'Errors/permissions');
        }
        
    }

    public function list(){
        $data = $this->model->getCategory();

        for ($i=0; $i < count($data); $i++) { 

            if ($data[$i]['status'] == 1) {
                $data[$i]['status'] = '<span class="badge badge-success">Activo</span>';
                $data[$i]['actions'] = '<div>
                <button class="btn btn-primary" type="button" onclick="btnEditClient(' . $data[$i]['id'] . ');"><i class="fas fa-edit"></i></button>
                <button class="btn btn-danger" type="button" onclick="btnDeleteClient(' . $data[$i]['id'] . ');"><i class="fas fa-trash-alt"></button>                
                </div>';
            }else {
                $data[$i]['status'] = '<span class="badge badge-danger">Inactivo</span>';
                $data[$i]['actions'] = '<div>
                <button class="btn btn-success" type="button" onclick="btnReenterClient('.$data[$i]['id'].');"><i class="fas fa-edit"></button>
                </div>'; 
            }

            
        }
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function register(){
        $dni_client = $_POST['dni_client'];
        $name = $_POST['name'];
        $phone = $_POST['phone'];
        $address = $_POST['address'];    
        $id = $_POST['id'];


        if (empty($dni_client) || empty($name) || empty($phone) || empty($address)) {

            $message = "Debes llenar todos los campos.";

        }else {

            if($id == ""){

                $data = $this->model->registerCategory($dni_client, $name, $phone, $address);

                if ($data == "ok") {
                    $message = array('message' => 'Categoria registrada correctamente.', 'icon' => 'success');
                } else if ($data == "exists") {
                    $message = array('message' => 'La categoria ya existe.', 'icon' => 'warning');
                } else {
                    $message = array('message' => 'La categoria no se registro correctamnte', 'icon' => 'error');
                }
               
            }else{
                $data = $this->model->modifyCategory($dni_client, $name, $phone,$address, $id);

                if ($data == "modificado") {
                    $message = array('message' => 'Categoria modificada correctamente.', 'icon' => 'success');
                }else {
                    $message = array('message' => 'Error al modificar la categoria.', 'icon' => 'error');
                }
            }            
        }
        echo json_encode($message, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function edit(int $id){

        $data = $this->model->editClient($id);
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();

    }
    
    public function delete(int $id){

        $data = $this->model->actionCategory(0, $id);
        if($data == 1){
            $message = array('message' => 'Categoria eliminada correctamente.', 'icon' => 'success');
        } else{
            $message = array('message' => 'La categoria no se elimino correctamente', 'icon' => 'error');
        }

        echo json_encode($message, JSON_UNESCAPED_UNICODE);
        die();
    }   
    public function reenter(int $id){

        $data = $this->model->actionCategory(1, $id);
        if($data == 1){
            $message = array('message' => 'Categoria reingresada correctamente', 'icon' => 'success');
        } else{
            $message = array('message' => 'Error al reingresar la categoria', 'icon' => 'error');
        }

        echo json_encode($message, JSON_UNESCAPED_UNICODE);
        die();
    }

}

?>

