<?php
class CashRegister extends Controller{

    public function __construct() {
        session_start();
        if (empty($_SESSION['active'])){
            header("location: ".base_url);
        }
        parent::__construct();
    }

    public function index(){
        $this->views->getView($this, "index");
    }


    public function cash_balance(){
        $this->views->getView($this, "cash_balance");
    }

    public function list(){
        $data = $this->model->getCashRegister('cash_register');

        for ($i=0; $i < count($data); $i++) { 
            if ($data[$i]['status'] == 1) {
                $data[$i]['status'] = '<span class="btn btn-success">Activo</span>';
                $data[$i]['actions'] = '<div>
                <button class="btn btn-primary" type="button" onclick="btnEditCashRegister('.$data[$i]['id'].');"><i class="fas fa-edit"></i></button>
                <button class="btn btn-danger" type="button" onclick="btnDeleteCashRegister('.$data[$i]['id'].');"><i class="fas fa-trash-alt"></i></button>                
                </div>';
            }else {
                $data[$i]['status'] = '<span class="btn btn-danger">Inactivo</span>';
                $data[$i]['actions'] = '<div>
                <button class="btn btn-success" type="button" onclick="btnReenterCashRegister('.$data[$i]['id'].');"><i class="fas fa-edit"></i></button>
                </div>';
            }            
        }
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function list_balance(){
        $data = $this->model->getCashRegister('cash_balance');
        for ($i=0; $i < count($data); $i++) { 
            if ($data[$i]['status'] == 1) {
                $data[$i]['status'] = '<span class="btn btn-success">Abierta</span>';
            }else {
                $data[$i]['status'] = '<span class="btn btn-danger">Cerrada</span>';
            }            
        }
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function register(){
        
        $cashRegister = $_POST['cash_register'];
        $id = $_POST['id'];    

        if (empty($cashRegister)) {
            $message = array('message' => 'Debes llenar todos los campos', 'icon' => 'warning');
        }else {
            if($id == ""){
                $data = $this->model->registerCashRegister($cashRegister);
                if ($data == "ok") {
                    $message = array('message' => 'Caja registrada con exito', 'icon' => 'success');
                } else if ($data == "exists") {
                    $message = array('message' => 'La caja ya existe', 'icon' => 'warning');
                } else {
                    $message = array('message' => 'Error al crear la caja', 'icon' => 'error');
                }               
            }else{
                $data = $this->model->modifyCashRegister($cashRegister, $id);
                if ($data == "modificado") {
                    $message = array('message' => 'Caja modificada con exito', 'icon' => 'success');
                }else {
                    $message = array('message' => 'Error al modificar la caja', 'icon' => 'error');
                }
            }            
        }
        echo json_encode($message, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function openBalance(){
        
        $initial_amount = $_POST['initial_amount'];
        $opening_date = date('Y-m-d');
        $id_user = $_SESSION['id_user'];
        $id = $_POST['id'];

        if (empty($initial_amount)) {
            $message = array('message' => 'Debes llenar todos los campos', 'icon' => 'warning');
        }else {
            if ($id == '') {
                $data = $this->model->registerBalance($id_user,$initial_amount, $opening_date);
                if ($data == "ok") {
                    $message = array('message' => 'Caja abierta con exito', 'icon' => 'success');
                } else if ($data == "exists") {
                    $message = array('message' => 'La caja ya esta abierta', 'icon' => 'warning');
                } else {
                    $message = array('message' => 'Error al abrir la caja', 'icon' => 'error');
                }      
            }else{
                // if (empty($final_amount) ) {
                //     $final_amount['total_sales'] = 0;
                // }else{
                //     $final_amount = $this->model->getSales($id_user);
                // }
                $final_amount = $this->model->getSales($id_user);    
                $total_sales = $this->model->getTotalSales($id_user);
                $initial_amount = $this->model->getInitialAmount($id_user);
                $general = $final_amount['total_sales'] + $initial_amount['initial_amount'];
                $data = $this->model->updateBalance($final_amount['total_sales'], $opening_date, $total_sales['total_sales'],$general, $initial_amount['id'] );

                if ($data == "ok") {
                    $this->model->updateOpening($id_user);
                    $message = array('message' => 'Caja cerrada con exito', 'icon' => 'success');
                } else {
                    $message = array('message' => 'Error al cerrar la caja', 'icon' => 'error');
                }      
            }                          
        }
        echo json_encode($message, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function edit(int $id){
        $data = $this->model->editCashRegister($id);
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }
    
    public function delete(int $id){

        $data = $this->model->actionCashRegister(0, $id);
        if($data == 1){
            $message = array('message' => 'Caja eliminada con exito', 'icon' => 'success');
        } else{
            $message = array('message' => 'Error al eliminar caja', 'icon' => 'error');
        }
        echo json_encode($message, JSON_UNESCAPED_UNICODE);
        die();
    }   
    
    public function reenter(int $id){
        $data = $this->model->actionCashRegister(1, $id);
        if($data == 1){
            $message = array('message' => 'Caja reingresada con exito', 'icon' => 'success');
        } else{
            $message = array('message' => 'La caja no fue reingresada', 'icon' => 'error');
        }
        echo json_encode($message, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function getSales(){
        $id_user = $_SESSION['id_user'];
        $data['total_sales_value'] = $this->model->getSales($id_user);
        $data['total_number_sales'] = $this->model->getTotalSales($id_user);
        $data['initial'] = $this->model->getInitialAmount($id_user);
        $data['general_amount'] = $data['initial']['initial_amount'] + $data['total_sales_value']['total_sales'];
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();        
    }
}



