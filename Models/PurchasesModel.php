<?php

class PurchasesModel extends Query{

    private $name, $id, $status;

    public function __construct(){

        parent::__construct();
        
    }

    public function getClients(){
        $sql = "SELECT * FROM clients WHERE status = 1";
        $data = $this->selectAll($sql);
        return $data;
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

    public function registerDetail(string $table,int $id_product,  int $id_user, string $price, int $amount, string $sub_total){

        $sql = "INSERT INTO $table(id_product, id_user, price, amount, sub_total) VALUES (?,?,?,?,?)";
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

    public function getDetail(string $table,int $id){

        $sql = "SELECT d.*, p.id AS id_product, p.description FROM $table d INNER JOIN products p ON d.id_product = p.id WHERE d.id_user = $id";
        $data = $this->selectAll($sql);
        return $data;
    }

    public function calculatePurchase(string $table,int $id_user){

        $sql = "SELECT  sub_total, SUM(sub_total) AS total FROM $table WHERE id_user = $id_user";
        $data = $this->select($sql);
        return $data;

    }

    public function deleteDetail(string $table, int $id){

        $sql = "DELETE FROM $table WHERE id = ?";
        $data = array($id);
        $allData = $this->save($sql, $data);

        if ($allData == 1) {
            $response = "ok";
        } else {
            $response = "error";
        }
        return $response;
    }

    public function checkDetail(string $table, int $id_product, int $id_user){

        $sql = "SELECT * FROM $table WHERE id_product = $id_product AND id_user = $id_user";
        $data = $this->select($sql);
        return $data;

    }

    public function updateDetail(string $table,string $price, int $amount, string $sub_total, int $id_product,  int $id_user){

        $sql = "UPDATE $table SET price = ?, amount = ?, sub_total = ? WHERE id_product = ? AND id_user = ?";
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
    

    public function getId(string $table){

        $sql = "SELECT MAX(id) AS id FROM $table";
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

    public function registerSaleDetail(int $id_sale, int $id_product,int  $amount,string $discount,string $price,string $sub_total){

        $sql = "INSERT INTO sales_details (id_sale, id_product, amount, discount, price, sub_total) VALUES (?,?,?,?,?,?)";
        $data = array($id_sale, $id_product, $amount, $discount, $price, $sub_total );
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

    public function cleanDetails(string $table, int $id_user){

        $sql = "DELETE FROM $table WHERE id_user = ?";
        $data = array($id_user);
        $allData = $this->save($sql, $data);

        if ($allData == 1) {
            $response = "ok";
        } else {
            $response = "error";
        }

        return $response;

    }

    public function getProductPurchase(int $id_purchase){

        $sql = "SELECT c.*, d.*, p.id, p.description FROM purchases c INNER JOIN purchases_details d ON  c.id = d.id_purchase INNER JOIN products p ON p.id = d.id_product WHERE c.id = $id_purchase";
        $data = $this->selectAll($sql);
        return $data;

    }

    public function getProductSale(int $id_sale){

        $sql = "SELECT s.*, d.*, p.id, p.description FROM sales s INNER JOIN sales_details d ON  s.id = d.id_sale INNER JOIN products p ON p.id = d.id_product WHERE s.id = $id_sale";
        $data = $this->selectAll($sql);
        return $data;

    }

    public function getPurchaseHistory(){

        $sql = "SELECT * FROM purchases";
        $data = $this->selectAll($sql);
        return $data;

    }


    public function getSalesHistory(){

        $sql = "SELECT c.id, c.name, s.* FROM clients c INNER JOIN sales s ON s.id_client = c.id";
        $data = $this->selectAll($sql);
        return $data;

    }

    
    public function updateStock(int $amount, int $id_product){

        $sql = "UPDATE products SET amount = ? WHERE id = ?";
        $data = array($amount,$id_product);
        // $this->save($sql, $data);
        $allData = $this->save($sql, $data);

        return $allData;

    }

    public function registerSale (int $id_user, int $id_client, string $total_sales, string $sale_date, string $time_hours){

        $sql = "INSERT INTO sales (id_user, id_client, total_sales, sale_date, time_hours) VALUES (?,?,?,?,?)";
        $data = array($id_user, $id_client, $total_sales, $sale_date, $time_hours);
        $allData = $this->save($sql, $data);

        if ($allData == 1) {
            $response = "ok";
        } else {
            $response = "error";
        }

        return $response;        

    }

    public function clientsSale(int $id){

        $sql = "SELECT s.id, s.id_client, c.* FROM sales s INNER JOIN clients c ON c.id = s.id_client WHERE s.id = $id";
        $data = $this->select($sql);
        return $data;

    }

    public function checkDiscount(int $id)
    {
        $sql = "SELECT * FROM tmp_purchases WHERE id = $id";
        $data = $this->select($sql);
        return $data;
    }

    public function updateDiscount (string $discount, string $sub_total, int $id){

        $sql = "UPDATE tmp_purchases SET discount = ?, sub_total = ? WHERE id = ?";
        $data = array($discount, $sub_total, $id);
        $allData = $this->save($sql, $data);

        if ($allData == 1) {
            $response = "ok";
        } else {
            $response = "error";
        }

        return $response;        

    }

    public function getDiscount(int $id_sale){

        $sql = "SELECT  discount, SUM(discount) AS total FROM sales_details WHERE id_sale = $id_sale";
        $data = $this->select($sql);
        return $data;

    }

    public function cancelPurchase(int $id_purchase)
    {
        $sql = "SELECT c.*, d.* FROM purchases c INNER JOIN purchases_details d ON  c.id = d.id_purchase WHERE c.id = $id_purchase";
        $data = $this->selectAll($sql);
        return $data;
    }

    public function getCancel(int $id_purchase){

        $sql = "UPDATE purchases SET status = ? WHERE id = ?";
        $data = array(0,$id_purchase);
        $allData = $this->save($sql, $data);

        if ($allData == 1) {
            $response = "ok";
        } else {
            $response = "error";
        }

        return $response;        

    }

    public function checkCashRegister(int $id_user){

        $sql = "SELECT * FROM cash_balance WHERE id_user = $id_user AND status = 1";
        $data = $this->select($sql);
        return $data;
        
    }


    public function getSalesDates(string $from_date, string $to_date)
    {
        $sql = "SELECT c.id, c.name, s.* FROM clients c INNER JOIN sales s ON s.id_client = c.id WHERE s.sale_date BETWEEN '$from_date' AND '$to_date'";
        $data = $this->selectAll($sql);
        return $data;
    }
}