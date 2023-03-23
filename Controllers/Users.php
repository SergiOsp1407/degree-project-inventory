<?phpsession
class Users extends Controller{

    public function __construct() {

        session_start();
        
        parent::__construct();
    }

    public function index(){
        
        //This encrypt the url
        if (empty($_SESSION['active'])){
            header("location: ".base_url);
        }
        
        $data['cashRegister'] = $this->model->getCashRegister();
        $this->views->getView($this, "index" , $data);
    }

    public function list(){
        $data = $this->model->getUsers();

        for ($i=0; $i < count($data); $i++) { 
            
            if ($data[$i]['status'] == 1) {
                $data[$i]['status'] = '<span class="badge bg-success">Activo</span>';
                
                if ($data[$i]['id_user'] == 1) {
                    $data[$i]['actions'] = '<div>            
                    <span class="badge bg-primary">Administrador</span>
                    </div>';
                }else {
                    $data[$i]['actions'] = '<div>
                    <a class="btn btn-dark" href="'.base_url.'Users/permissions/'.$data[$i]['id'].'"><i class="fas fa-key"></i></a>
                    <button class="btn btn-primary" type="button" onclick="btnEditUser('.$data[$i]['id'].');"><i class="fas fa-edit"></i></button>
                    
                    <button class="btn btn-danger" type="button" onclick="btnDeleteUser('.$data[$i]['id'].');"><i class="fas fa-trash-alt"></i></button>
                    </div>'; 
                }
            }else {
                $data[$i]['status'] = '<span class="badge bg-danger">Inactivo</span>';
                $data[$i]['actions'] = '<div>            
                <button class="btn btn-success" type="button" onclick="btnReenterUser('.$data[$i]['id'].');"><i class="fas fa-edit"></i></button>
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
            $data = $this->model->getUser($user, $password);
            
            if ($data) {
                $_SESSION['id'] = $data['id_user'];
                $_SESSION['user'] = $data['user'];
                $_SESSION['name'] = $data['name'];
                $_SESSION['active'] = true;
                $message = "It works!";
            }else {
                $message = "Usuario o contraseña incorrecta";
            }
        }
        echo json_encode($message, JSON_UNESCAPED_UNICODE);
        // print_r($data);
        die();
    }

    public function register(){
        
        $user = $_POST['user'];
        $name = $_POST['name'];
        $password = $_POST['password'];
        $confirmPassword = $_POST['confirmPassword'];
        $cashRegister = $_POST['cashRegister'];
        $id = $_POST['id'];

        //Encrypting password
        $hash = hash("SHA256", $password);

        if (empty($user) || empty($name) || empty($password) || empty($cashRegister)) {

            $message = array('message' => 'Debes llenar todos los campos!', 'icon' => 'warning');

        }else {

            if($id == ""){

                if($password != $confirmPassword){
                    $message = array('message' => 'Las contraseñas no coinciden', 'icon' => 'warning');

                }else{

                    $data = $this->model->registerUser($user, $name, $hash, $cashRegister);

                    if ($data == "ok") {
                        $message = array('message' => 'Usuario registrado correctamente.', 'icon' => 'success');
                    } else if ($data == "exists") {
                        $message = array('message' => 'El usuario ya existe', 'icon' => 'warning');
                    } else {
                        $message = array('message' => 'Error al registrar el usuario', 'icon' => 'error');
                    }
                }                
            }else{
                $data = $this->model->modifyUser($user, $name, $cashRegister, $id);

                if ($data == "modificado") {
                    $message = array('message' => 'Usuario modificado correctamente.', 'icon' => 'success');
                }else {
                    $message = array('message' => 'Error al modificar el usuario', 'icon' => 'error');
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
            $message = array('message' => 'Usuario eliminado correctamente.', 'icon' => 'success');
        } else{
            $message = array('message' => 'Error al eliminar el usuario', 'icon' => 'error');
        }

        echo json_encode($message, JSON_UNESCAPED_UNICODE);
        die();
    }   
    public function reenter(int $id){

        $data = $this->model->actionUser(1, $id);
        if($data == 1){
            $message = array('message' => 'Usuario reingresado correctamente.', 'icon' => 'success');
        } else{
            $message = array('message' => 'El usuario no se pudo reingresar', 'icon' => 'error');
        }

        echo json_encode($message, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function changePassword(){

        $actualPassword = $_POST['actualPassword'];
        $newPassword = $_POST['newPassword'];
        $confirmPassword = $_POST['confirmPassword'];

        if(empty($actualPassword) || empty($newPassword) || empty($confirmPassword)){

            $message = array('message' => 'Todos los campos son obligatorios.', 'icon' => 'warning');

        }else {
            if ($newPassword != $confirmPassword) {
                $message = array('message' => 'Las contraseñas no coinciden', 'icon' => 'warning');
            }else{
                $id = $_SESSION['id_user'];
                $hash = hash("SHA256", $actualPassword);
                $data = $this->model->getPassword($hash,$id);

                if(!empty($data)){
                    $check = $this->model->modifyPassword(hash("SHA256", $newPassword), $id);

                    if($check == 1){
                        $message = array('message' => 'Contraseña modificada con éxito', 'icon' => 'success');
                    }else{

                        $message = array('message' => 'Error al cambiar la contraseña.', 'icon' => 'error');
                    }

                }else{

                    $message = array('message' => 'Contraseña actual incorrecta.', 'icon' => 'warning');

                }
            }
        }

        echo json_encode($message), JSON_UNESCAPED_UNICODE;
        die();

    }

    public function permissions($id)
    {
        
        if (empty($_SESSION['active'])){
            header("location: ".base_url);
        }

        
        $data['allData'] = $this->model->getPermissions();
        $permissions = $this->model->getDetailPermissions($id);
        $data['assigned'] = array();
        foreach ($permissions as $permission) {
            $data['assigned'][$permission['id_permission']] = true;
        }

        $data['id_user'] = $id;
        $this->views->getView($this, "permissions" , $data);


    }

    public function registerPermissions(){

        $id_user = $_POST['id_user'];
        $delete = $this->model->deletePermissions($id_user);
        $message = '';

        if ($delete == 'ok') {
            foreach ($_POST['permissions'] as $id_permission) {
                $message = $this->model->registerPermissions($id_user,$id_permission);
            }
            if ($message == 'ok') {
                $message = array('message' => 'Permisos asignados', 'icon' => 'success');
            } else {
                $message = array('message' => 'Error al asignar los permisos', 'icon' => 'error');
            }
            
        } else {
            $message = array('message' => 'Error al eliminar los permisos', 'icon' => 'error');
        }

        echo json_encode($message, JSON_UNESCAPED_UNICODE);
       
        
    }
    
    public function logout(){
        session_destroy();
        header("location: ".base_url);
    }
}

?>

