<?php

class CategoriesModel extends Query{

    private $name, $id, $status;

    public function __construct(){

        parent::__construct();
        
    }

    public function getCategories(){

        $sql = "SELECT * FROM categories";
        $data = $this->selectAll($sql);
        return $data;

    }

    public function registerCategory(string $name){
        $this->name = $name;
        $check = "SELECT * FROM categories WHERE name = '$this->name'";
        $exists = $this->select($check);
        if (empty($exists)) {
            $sql = "INSERT INTO categories(name) VALUES (?)";
            $data = array($this->name);
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

    public function modifyCategory(string $name, int $id){

        $this->name = $name;
        $this->id = $id;
        $sql = "UPDATE categories SET name = ? WHERE id = ?";
        $data = array($this->name, $this->id);
        $allData = $this->save($sql, $data);

        if ($allData == 1) {
            $response = "modificado";
        } else {
            $response = "error";
        }
        return $response;

    }

    public function editCategory(int $id){

        $sql = "SELECT * FROM categories WHERE id = $id";
        $data = $this->select($sql);
        return $data;

    }

    public function actionCategory(int $status, int $id){
        
        $this->id = $id;
        $this->status = $status;
        $sql = "UPDATE categories SET status = ? WHERE id = ?";
        $data = array($this->status, $this->id);
        $allData = $this->save($sql,$data);
        return $data;

    }

    public function verifyPermission(int $id_user, string $permission_name)
    {
        $sql = "SELECT p.id, p.permission, d.id, d.id_user, d.id_permission FROM permissions p INNER JOIN detail_permissions d ON p.id = d.id_permission WHERE d.id_user = $id_user AND p.permission = '$permission_name'";
        $data = $this->selectAll($sql);
        return $data;
    }
}
