<?php
class Measures extends Controller{

    public function __construct() {

        session_start();

        
        parent::__construct();
    }

    public function index(){

        if (empty($_SESSION['active'])){
            header("location: ".base_url);
        }
        
        $this->views->getView($this, "index");
    }

    public function list(){
        $data = $this->model->getMeasure();

        for ($i=0; $i < count($data); $i++) { 

            if ($data[$i]['status'] == 1) {
                $data[$i]['status'] = '<span class="badge bg-success">Activo</span>';
                $data[$i]['actions'] = '<div>
                <button class="btn btn-primary" type="button" onclick="btnEditMeasure('.$data[$i]['id'].');"><i class="fas fa-edit"></i></button>
                <button class="btn btn-danger" type="button" onclick="btnDeleteMeasure('.$data[$i]['id'].');"><i class="fas fa-trash-alt"></i></button>                
                </div>';
            }else {
                $data[$i]['status'] = '<span class="badge bg-danger">Inactivo</span>';
                $data[$i]['actions'] = '<div>
                <button class="btn btn-success" type="button" onclick="btnReenterMeasure('.$data[$i]['id'].');"><i class="fas fa-edit"></i></button>
                </div>'; 
            }

            
        }
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function register(){

        $id = $_POST['id'];
        $name = $_POST['name'];
        $short_name = $_POST['short_name'];

        if (empty($name) || empty($short_name)) {
            $message = "Debes llenar todos los campos.";
        }else {
            if($id == ""){
                $data = $this->model->registerMeasure($name, $short_name);

                if ($data == "ok") {
                    $message = array('message' => 'Medida registrada correctamente.', 'icon' => 'success');
                } else if ($data == "exists") {
                    $message = array('message' => 'La medida ya existe', 'icon' => 'warning');
                } else {
                    $message = array('message' => 'Error al registrar la medida', 'icon' => 'error');
                }
               
            }else{
                $data = $this->model->modifyMeasure($name, $short_name,$id);

                if ($data == "modificado") {
                    $message = array('message' => 'Medida modificada correctamente.', 'icon' => 'success');
                }else {
                    $message = array('message' => 'Error al modificar la medida', 'icon' => 'error');
                }
            }            
        }
        echo json_encode($message, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function edit(int $id){

        $data = $this->model->editMeasure($id);
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();

    }
    
    public function delete(int $id){

        $data = $this->model->actionMeasure(0, $id);
        if($data == 1){
            $message = array('message' => 'Medida eliminada correctamente.', 'icon' => 'success');
        } else{
            $message = array('message' => 'Error al eliminar la medida', 'icon' => 'error');
        }

        echo json_encode($message, JSON_UNESCAPED_UNICODE);
        die();
    }   
    public function reenter(int $id){

        $data = $this->model->actionMeasure(1, $id);
        if($data == 1){
            $message = array('message' => 'Medida reingresada correctamente.', 'icon' => 'success');
        } else{
            $message = array('message' => 'La medida no se pudo reingresar', 'icon' => 'error');
        }

        echo json_encode($message, JSON_UNESCAPED_UNICODE);
        die();
    }

}

