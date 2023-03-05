<?php
class Measures extends Controller{

    public function __construct() {
        session_start();
        if (empty($_SESSION['active'])){
            header("location: ".base_url);
        }
        parent::__construct();
    }

    public function index()
    {
        $this->views->getView($this, "index");
    }

    public function list(){
        $data = $this->model->getMeasures();

        for ($i=0; $i < count($data); $i++) { 

            if ($data[$i]['status'] == 1) {
                $data[$i]['status'] = '<span class="badge bg-success">Activo</span>';
                $data[$i]['actions'] = '<div>
                <button class="btn btn-primary" type="button" onclick="btnEditMeasure(' . $data[$i]['id'] . ');"><i class="fas fa-edit"></i></button>
                <button class="btn btn-danger" type="button" onclick="btnDeleteMeasure(' . $data[$i]['id'] . ');"><i class="fas fa-trash-alt"></button>                
                </div>';
            }else {
                $data[$i]['status'] = '<span class="badge bg-danger">Inactivo</span>';
                $data[$i]['actions'] = '<div>
                <button class="btn btn-success" type="button" onclick="btnReenterMeasure('.$data[$i]['id'].');"><i class="fas fa-edit"></button>
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



        if (empty($id) || empty($name) || empty($short_name)) {

            $message = "Debes llenar todos los campos.";

        }else {

            if($id == ""){

                $data = $this->model->registerMeasure($id, $name, $short_name);

                if ($data == "ok") {
                    $message = "Si";
                } else if ($data == "exists") {
                    $message = "El Documento de identificación ya existe";
                } else {
                    $message = "Error al registar el Cliente";
                }
               
            }else{
                $data = $this->model->modifyMeasure($id, $name, $short_name);

                if ($data == "modificado") {
                    $message = "modificado";
                }else {
                    $message = "Error al modificar el cliente";
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
            $message = "ok";
        } else{
            $message = "Error al eliminar el Cliente";
        }

        echo json_encode($message, JSON_UNESCAPED_UNICODE);
        die();
    }   
    public function reenter(int $id){

        $data = $this->model->actionMeasure(1, $id);
        if($data == 1){
            $message = "ok";
        } else{
            $message = "Error al reingresar el Cliente";
        }

        echo json_encode($message, JSON_UNESCAPED_UNICODE);
        die();
    }

}

?>

