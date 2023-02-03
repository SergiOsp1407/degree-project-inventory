<?php
class Users extends Controller{

    public function __construct() {

        session_start();
        
        parent::__construct();
    }

    public function index()
    {

        if (empty($_SESSION['activo'])){
            header("location: ".base_url);
        }

        $data['cashRegister'] = $this->model->getCashRegister();
        $this->views->getView($this, "index" , $data);
    }

    public function list(){
        $data = $this->model->getUsers();

        for ($i=0; $i < count($data); $i++) { 

            if ($data[$i]['status'] == 1) {
                $data[$i]['status'] = '<span class="badge badge-success">Activo</span>';
                $data[$i]['actions'] = '<div>
                <button class="btn btn-primary" type="button" onclick="btnEditUser('.$data[$i]['id'].');"><i class="fas fa-edit"></i></button>
                <button class="btn btn-danger" type="button" onclick="btnDeleteUser('.$data[$i]['id'].');"><i class="fas fa-trash-alt"></button>
                </div>'; 
            }else {
                $data[$i]['status'] = '<span class="badge badge-danger">Inactivo</span>';
                $data[$i]['actions'] = '<div>            
                <button class="btn btn-success" type="button" onclick="btnReenterUser('.$data[$i]['id'].');"><i class="fas fa-edit"></button>
                </div>'; 
            }

            
        }
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function validate(){

        if (empty($_POST['user']) || empty($_POST['password'])) {
            $message = "Los campos están vacios";
        }else{
            $user = $_POST['user'];
            $password = $_POST['password'];
            $hash = hash("SHA256", $password);
            $data = $this->model->getUser($user, $hash);

            if ($data) {
                $_SESSION['id_user'] = $data['id'];
                $_SESSION['user'] = $data['user'];
                $_SESSION['name'] = $data['name'];
                $_SESSION['active'] = true;
                $message = "It works!";
            }else {
                $message = "Usuario o contraseña incorrecta";
            }
        }
        echo json_encode($message, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function register()
    {
        $user = $_POST['user'];
        $name = $_POST['name'];
        $password = $_POST['password'];
        $confirmPassword = $_POST['confirmPassword'];
        $cashRegister = $_POST['cashRegister'];
        $id = $_POST['id'];

        //Encrypting password
        $hash = hash("SHA256", $password);

        if (empty($user) || empty($name) || /*empty($password) ||*/ empty($cashRegister)) {

            $message = "Debes llenar todos los campos.";
        }/*else if ($password != $confirmPassword) {

            $message = "Las contraseñas no coinciden!";
            
        }*/else {

            if($id == ""){

                if($password != $confirmPassword){
                    $message = "Las contraseñas no coinciden!";

                }else{

                    $data = $this->model->registerUser($user, $name, $hash, $cashRegister);

                    if ($data == "ok") {
                        $message = "Si";
                    } else if ($data == "exists") {
                        $message = "El usuario ya existe";
                    } else {
                        $message = "Error al registar el usuario";
                    }
                }                
            }else{
                $data = $this->model->modifyUser($user, $name, $cashRegister, $id);

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

        $data = $this->model->editUser($id);
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();

    }
    
    public function delete(int $id){

        $data = $this->model->actionUser(0, $id);
        if($data == 1){
            $message = "ok";
        } else{
            $message = "Error al eliminar el usuario";
        }

        echo json_encode($message, JSON_UNESCAPED_UNICODE);
        die();
    }   
    public function reenter(int $id){

        $data = $this->model->actionUser(1, $id);
        if($data == 1){
            $message = "ok";
        } else{
            $message = "Error al reingresar el usuario";
        }

        echo json_encode($message, JSON_UNESCAPED_UNICODE);
        die();
    }
    
    public function logout(){
        session_destroy();
        header("location: ".base_url);
    }
}

?>

