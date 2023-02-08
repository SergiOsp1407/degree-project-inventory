<?php
class Clients extends Controller{

    public function __construct() {
        session_start();
        if (empty($_SESSION['activo'])){
            header("location: ".base_url);
        }
        parent::__construct();
    }

    public function index(){
        $this->views->getView($this, "index");
    }

    public function list(){
        $data = $this->model->getClients();

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
        $dni = $_POST['dni'];
        $name = $_POST['name'];
        $phone = $_POST['phone'];
        $address = $_POST['address'];    
        $id = $_POST['id'];


        if (empty($dni) || empty($name) || empty($phone) || empty($address)) {

            $message = "Debes llenar todos los campos.";

        }else {

            if($id == ""){

                $data = $this->model->registerClient($dni, $name, $phone, $address);

                if ($data == "ok") {
                    $message = "Si";
                } else if ($data == "exists") {
                    $message = "El Documento de identificación ya existe";
                } else {
                    $message = "Error al registar el Cliente";
                }
               
            }else{
                $data = $this->model->modifyClient($dni, $name, $phone,$address, $id);

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

        $data = $this->model->editClient($id);
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();

    }
    
    public function delete(int $id){

        $data = $this->model->actionClient(0, $id);
        if($data == 1){
            $message = "ok";
        } else{
            $message = "Error al eliminar el Cliente";
        }

        echo json_encode($message, JSON_UNESCAPED_UNICODE);
        die();
    }   
    public function reenter(int $id){

        $data = $this->model->actionClient(1, $id);
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

