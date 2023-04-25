<?php
class CashRegisterModel extends Query{

    private $cash_register, $id, $status;

    public function __construct(){        
        parent::__construct();
    }

    public function getCashRegister(string $table){

        $sql = "SELECT * FROM $table";
        $data = $this->selectAll($sql);
        return $data;
    }

    public function registerCashRegister(string $cash_register){
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

    public function registerBalance(int $id_user,string $initial_amount, string $opening_date){    
 
        $check = "SELECT * FROM cash_balance WHERE id_user = '$id_user' AND status = 1";
        $exists = $this->select($check);

        if (empty($exists)) {
            $sql = "INSERT INTO cash_balance(id_user, initial_amount, opening_date) VALUES (?,?,?)";
            $data = array($id_user,$initial_amount, $opening_date);
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

    public function getSales(int $id_user){  

        $sql = "SELECT total_sales, SUM(total_sales) AS total_sales FROM sales WHERE id_user = $id_user AND status = 1 AND opening = 1";
        $data = $this->select($sql);
        return $data;        
    }

    public function getTotalSales(int $id_user){
        $sql = "SELECT COUNT(total_sales) AS total_sales FROM sales WHERE id_user = $id_user AND status = 1 AND opening = 1";
        $data = $this->select($sql);
        return $data;
    }


    public function getInitialAmount(int $id_user){

        $sql = "SELECT id, initial_amount FROM cash_balance WHERE id_user = $id_user AND status = 1";
        $data = $this->select($sql);
        return $data;
    }

    public function updateBalance(string $final_amount, string $close, string $sales, string $general, int $id){
        
            $sql = "UPDATE cash_balance SET final_amount=?, closing_date=?, total_sales=?, total_sales_amount=?, status=? WHERE id = ?";
            $data = array($final_amount,$close, $sales, $general, 0,  $id);
            $allData = $this->save($sql, $data);

            if ($allData == 1) {
                $response = "ok";
            } else {
                $response = "error";
            }
        return $response;
    }

    

    public function updateOpening(int $id){  
        
        $sql = "UPDATE sales SET opening = ? WHERE id_user = ?";
        $data = array(0,  $id);
        $this->save($sql, $data);

    }
}