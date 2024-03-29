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
        $check = $this->model->verifyPermission($id_user, 'categorias');
        if (!empty($check) || $id_user == 1) {
            $this->views->getView($this, "index");
        }else {
            header('Location: '.base_url.'Errors/permissions');
        }
        
    }

    public function list(){
        $data = $this->model->getCategories();
        for ($i=0; $i < count($data); $i++) { 
            if ($data[$i]['status'] == 1) {
                $data[$i]['status'] = '<span class="badge bg-success">Activo</span>';
                $data[$i]['actions'] = '<div>
                <button class="btn btn-primary" type="button" onclick="btnEditCategory('.$data[$i]['id'].');"><i class="fas fa-edit"></i></button>
                <button class="btn btn-danger" type="button" onclick="btnDeleteCategory('.$data[$i]['id'].');"><i class="fas fa-trash-alt"></i></button>                
                </div>';
            }else {
                $data[$i]['status'] = '<span class="badge bg-danger">Inactivo</span>';
                $data[$i]['actions'] = '<div>
                <button class="btn btn-success" type="button" onclick="btnReenterCategory('.$data[$i]['id'].');"><i class="fas fa-edit"></i></button>
                </div>'; 
            }
        }
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function register(){
        $name = $_POST['name'];   
        $id = $_POST['id'];
        
        if (empty($name)) {
            $message = array('message' => 'Debes llenar todos los campos!', 'icon' => 'warning');
        }else {
            if($id == ""){
                $data = $this->model->registerCategory($name);
                if ($data == "ok") {
                    $message = array('message' => 'Categoria registrada correctamente.', 'icon' => 'success');
                } else if ($data == "exists") {
                    $message = array('message' => 'La categoria ya existe.', 'icon' => 'warning');
                } else {
                    $message = array('message' => 'La categoria no se registro correctamnte', 'icon' => 'error');
                }               
            }else{
                $data = $this->model->modifyCategory($name, $id);
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

        $data = $this->model->editCategory($id);
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

