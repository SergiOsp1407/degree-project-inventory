<?php

class PurchasesModel extends Query{

    private $name, $id, $status;

    public function __construct(){

        parent::__construct();
        
    }

    public function getProductCode(string $code){

        $sql = "SELECT * FROM products WHERE code='$code' ";
        $data = $this->select($sql);
        return $data;
    }

    public function getProducts(int $id){

        $sql = "SELECT * FROM products WHERE id = $id ";
        $data = $this->select($sql);
        return $data;

    }

    public function registerDetail(int $id_product,  int $id_user, string $price, int $amount, string $sub_total){

        $sql = "INSERT INTO tmp_details(id_product, id_user, price, amount, sub_total) VALUES (?,?,?,?,?)";
        $data = array($id_product, $id_user, $price, $amount, $sub_total);
        $this->save($sql, $data);
        $allData = $this->save($sql, $data);

        if ($allData == 1) {
            $response = "ok";
        } else {
            $response = "error";
        }

        return $response;


    }

    public function getDetail(int $id){

        $sql = "SELECT d.*, p.id AS id_product, p.description FROM tmp_details d INNER JOIN products p ON d.id_product = p.id WHERE d.id_user = $id";
        $data = $this->selectAll($sql);
        return $data;
    }

    public function calculatePurchase(int $id_user){

        $sql = "SELECT  sub_total, SUM(sub_total) AS total FROM tmp_details WHERE id_user = $id_user";
        $data = $this->select($sql);
        return $data;
    }

    public function deleteDetail(int $id){

        $sql = "DELETE FROM tmp_details WHERE id = ?";
        $data = array($id);
        $allData = $this->save($sql, $data);

        if ($allData == 1) {
            $response = "ok";
        } else {
            $response = "error";
        }

        return $response;

    }

    public function checkDetail(int $id_product, int $id_user){

        $sql = "SELECT * FROM tmp_details WHERE id_product = $id_product AND id_user = $id_user";
        $data = $this->select($sql);
        return $data;

    }

    public function updateDetail(string $price, int $amount, string $sub_total, int $id_product,  int $id_user){

        $sql = "UPDATE tmp_details SET price = ?, amount = ?, sub_total = ? WHERE id_product = ? AND id_user = ?";
        $data = array($price,  $amount, $sub_total, $id_product, $id_user );
        $this->save($sql, $data);
        $allData = $this->save($sql, $data);

        if ($allData == 1) {
            $response = "modificado";
        } else {
            $response = "error";
        }

        return $response;
    }

    public function registerPurchase (string $total){

        $sql = "INSERT INTO purchases (total) VALUES (?)";
        $data = array($total);
        // $this->save($sql, $data);
        $allData = $this->save($sql, $data);

        if ($allData == 1) {
            $response = "ok";
        } else {
            $response = "error";
        }

        return $response;        

    }

    public function id_purchase(){

        $sql = "SELECT MAX(id) AS id FROM purchases";
        $data = $this->select($sql);
        return $data;


    }

    public function registerPurchaseDetail(int $id_purchase, int $id_product,int  $amount,string $product_price,string $sub_total){

        $sql = "INSERT INTO purchases_details (id_purchase, id_product, amount, product_price, sub_total) VALUES (?,?,?,?,?)";
        $data = array($id_purchase, $id_product, $amount, $product_price, $sub_total );
        // $this->save($sql, $data);
        $allData = $this->save($sql, $data);

        if ($allData == 1) {
            $response = "ok";
        } else {
            $response = "error";
        }

        return $response;

    }

    public function getCompany(){

        $sql = "SELECT * FROM configuration";
        $data = $this->select($sql);
        return $data;
    }

    public function cleanDetails(int $id_user){

        $sql = "DELETE FROM tmp_details WHERE id_user = ?";
        $data = array($id_user);
        $allData = $this->save($sql, $data);

        if ($allData == 1) {
            $response = "ok";
        } else {
            $response = "error";
        }

        return $response;

    }

    
}
?>