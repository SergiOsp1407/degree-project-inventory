<?php
class Users extends Controller{

    public function __construct() {
        session_start();
        parent::__construct();
    }

    public function index()
    {

        $data['cashRegister'] = $this->model->getCashRegister();
        $this->views->getView($this, "index" , $data);
    }

    public function list()
    {
        $data = $this->model->getUsers();

        for ($i=0; $i < count($data); $i++) { 

            if ($data[$i]['status'] == 1) {
                $data[$i]['status'] = '<span class="badge badge-success">Activo</span>';
            }else {
                $data[$i]['status'] = '<span class="badge badge-danger">Inactivo</span>';
            }

            $data[$i]['actions'] = '<div>
            <button class="btn btn-primary" type="button">Editar</button>
            <button class="btn btn-danger" type="button">Eliminar</button>
            </div>'; 
        }
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function validate()
    {
        if (empty($_POST['user']) || empty($_POST['password'])) {
            $message = "Los campos están vacios";
        }else{
            $user = $_POST['user'];
            $password = $_POST['password'];
            $data = $this->model->getUser($user, $password);

            if ($data) {
                $_SESSION['id_user'] = $data['id'];
                $_SESSION['user'] = $data['user'];
                $_SESSION['name'] = $data['name'];
                $message = "It works!";
            }else {
                $message = "Usuario o contraseña";
            }
        }
        echo json_encode($message, JSON_UNESCAPED_UNICODE);
        die();
    }
}

?>

