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

        $sql = "SELECT d.*, p.id, p.description FROM tmp_details d INNER JOIN products p ON d.id_product = p.id WHERE d.id_user = $id";
        $data = $this->selectAll($sql);
        return $data;
    }

    
}
?>