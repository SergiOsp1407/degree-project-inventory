<?php
class CashRegisterModel extends Query
{

    private $dni_client, $cash_register, $phone, $address, $id, $status;

    public function __construct(){
        
        parent::__construct();
    }

    public function getCashRegister()
    {
        $sql = "SELECT * FROM cash_register";
        $data = $this->selectAll($sql);
        return $data;
    }

    public function registerCashRegister(string $cash_register)
    {
        $this->cash_register = $cash_register;        
        $check = "SELECT * FROM cash_register WHERE cash_register = '$this->cash_register'";
        $exists = $this->select($check);

        if (empty($exists)) {

            $sql = "INSERT INTO cash_register(cash_register) VALUES (?)";
            $data = array($this->cash_register);
            $allData = $this->save($sql, $data);

            if ($allData == 1) {
                $response = "ok";
            } else {
                $response = "error";
            }
        }else{
            $response = "exists";
        }
        return $response;
    }

    public function modifyCashRegister(string $cash_register, int $id)
    {
        $this->cash_register = $cash_register;
        $this->id = $id;

        $sql = "UPDATE cash_register SET cash_register = ? WHERE id = ?";
        $data = array($this->cash_register, $this->id);
        $allData = $this->save($sql, $data);

        if ($allData == 1) {
            $response = "modificado";
        } else {
            $response = "error";
        }
        return $response;
    }

    public function editCashRegister(int $id){

        $sql = "SELECT * FROM cash_register WHERE id = $id";
        $data = $this->select($sql);

        return $data;

    }


    public function actionCashRegister( int $status, int $id){

        $this->id = $id;
        $this->status = $status;
        $sql = "UPDATE cash_register SET status = ? WHERE id = ?";
        $data = array($this->status, $this->id);
        $allData = $this->save($sql, $data);

        return $allData;

    }
}
?>