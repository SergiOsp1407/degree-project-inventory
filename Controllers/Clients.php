<?php
class Clients extends Controller{

    public function __construct() {
        session_start();        
        if (empty($_SESSION['active'])){
            header("location: ".base_url);
        }
        parent::__construct();
    }

    public function index(){
        $id_user = $_SESSION['id_user'];
        $check = $this->model->verifyPermission($id_user, 'clientes');
        if (!empty($check) || $id_user == 1) {
            $this->views->getView($this, "index");
        }else {
            header('location: '.base_url.'Errors/permissions');
        }       
    }

    public function list(){
        $data = $this->model->getClients();
        for ($i=0; $i < count($data); $i++) { 
            if ($data[$i]['status'] == 1) {
                $data[$i]['status'] = '<span class="badge bg-success">Activo</span>';                
                $data[$i]['actions'] = '<div>
                <button class="btn btn-primary" type="button" onclick="btnEditClient('.$data[$i]['id'].');"><i class="fas fa-edit"></i></button>
                <button class="btn btn-danger" type="button" onclick="btnDeleteClient('.$data[$i]['id'].');"><i class="fas fa-trash-alt"></i></button>                
                </div>';
            }else {
                $data[$i]['status'] = '<span class="badge bg-danger">Inactivo</span>';
                $data[$i]['actions'] = '<div>
                <button class="btn btn-success" type="button" onclick="btnReenterClient('.$data[$i]['id'].');"><i class="fas fa-edit"></i></button>
                </div>'; 
            }
        }
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function register(){
        $id_user = $_SESSION['id_user'];
        $check = $this->model->verifyPermission($id_user, 'registrar_clientes');
        if (!empty($check) || $id_user == 1) {
            $dni_client = $_POST['dni_client'];  
            $name = $_POST['name'];
            $phone = $_POST['phone'];
            $address = $_POST['address'];    
            $id = $_POST['id'];

            if (empty($dni_client) || empty($name) || empty($phone) || empty($address)) {
                $message = array('message' => 'Debes llenar todos los campos.', 'icon' => 'success');
            }else {
                if($id == ""){
                    $data = $this->model->registerClient($dni_client, $name, $phone, $address);
                    if ($data == "ok") {
                        $message = array('message' => 'Cliente creado correctamente.', 'icon' => 'success');
                    } else if ($data == "exists") {
                        $message = array('message' => 'El documento de identificacion ya existe', 'icon' => 'warning');
                    } else {
                        $message = array('message' => 'Error al registrar el Cliente', 'icon' => 'error');
                    }               
                }else{
                    $data = $this->model->modifyClient($dni_client, $name, $phone,$address, $id);

                    if ($data == "modificado") {
                        $message = array('message' => 'Cliente modificado correctamente.', 'icon' => 'success');
                    }else {
                        $message = array('message' => 'Error al modificar el cliente.', 'icon' => 'error');
                    }
                }            
            }            
        }else {
            $message = array('message' => 'No tienes permisos para registrar clientes', 'icon' => 'warning');            
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
            $message = array('message' => 'Cliente eliminado correctamente.', 'icon' => 'success');
        } else{
            $message = array('message' => 'Error al eliminar al cliente.', 'icon' => 'error');
        }

        echo json_encode($message, JSON_UNESCAPED_UNICODE);
        die();
    }   
    public function reenter(int $id){

        $data = $this->model->actionClient(1, $id);
        if($data == 1){
            $message = array('message' => 'Cliente reingresado correctamente.', 'icon' => 'success');
        } else{
            $message = array('message' => 'Error al eliminar al cliente.', 'icon' => 'error');
        }

        echo json_encode($message, JSON_UNESCAPED_UNICODE);
        die();
    }

}

