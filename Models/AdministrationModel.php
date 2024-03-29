<?php
class AdministrationModel extends Query
{

    public function __construct(){
        
        parent::__construct();
    }

    public function getCompany(){
        $sql = "SELECT * FROM configuration";
        $data = $this->select($sql);
        return $data;
    }

    public function getData(string $table){
        $sql = "SELECT COUNT(*) AS total FROM $table";
        $data = $this->select($sql);
        return $data;
    }

    public function getSales(){
        $sql = "SELECT COUNT(*) AS total FROM sales WHERE sale_date > CURDATE()";
        $data = $this->select($sql);
        return $data;
    }

    public function modify(string $id_company, string $name, string $phone, string $address, string $message, int $id){       

        $sql = "UPDATE configuration SET id_company = ?, name = ?, phone = ?, address = ?, message = ? WHERE id=?";
        $data = array($id_company, $name, $phone, $address, $message, $id);
        $allData = $this->save($sql, $data);

        if ($allData == 1) {
            $response = "ok";
        } else {
            $response = "error";
        }
        
        return $response;
    }

    public function getMinimumStock(){

        $sql = "SELECT * FROM products WHERE amount < 15 ORDER BY amount DESC LIMIT 10";
        $data = $this->selectAll($sql);
        return $data;
    }

    public function getSoldProducts(){

        $sql = "SELECT d.id_product, d.amount, p.id, p.description, SUM(d.amount) AS total FROM sales_details d INNER JOIN products p ON p.id = d.id_product GROUP BY d.id_product ORDER BY d.amount DESC LIMIT 10";
        $data = $this->selectAll($sql);
        return $data;
    }

    public function verifyPermission(int $id_user, string $permission_name)
    {
        $sql = "SELECT p.id, p.permission, d.id, d.id_user, d.id_permission FROM permissions p INNER JOIN detail_permissions d ON p.id = d.id_permission WHERE d.id_user = $id_user AND p.permission = '$permission_name'";
        $data = $this->selectAll($sql);
        return $data;
    }

    
}
