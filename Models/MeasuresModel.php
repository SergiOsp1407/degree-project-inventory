<?php
class MeasuresModel extends Query{

    private $name, $short_name, $id, $status;

    public function __construct(){
        parent::__construct();
    }

    public function getMeasure()
    {
        $sql = "SELECT * FROM measures";
        $data = $this->selectAll($sql);
        return $data;
    }

    
    
    public function registerMeasure(string $name, string $short_name){
        
        $this->name = $name;
        $this->short_name = $short_name;
        $check = "SELECT * FROM measures WHERE name = '$this->name'";
        $exists = $this->select($check);

        if (empty($exists)) {
            $sql = "INSERT INTO measures(name, short_name) VALUES (?,?)";
            $data = array($this->name, $this->short_name);
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

    public function modifyMeasure(string $name, string $short_name, int $id)
    {
        $this->name = $name;
        $this->short_name = $short_name;
        $this->id = $id;

        $sql = "UPDATE measures SET name = ?, short_name = ? WHERE id = ?";
        $data = array($this->name, $this->short_name, $this->id);
        $allData = $this->save($sql, $data);

        if ($allData == 1) {
            $response = "modificado";
        } else {
            $response = "error";
        }
        return $response;
    }

    public function editMeasure(int $id){
        $sql = "SELECT * FROM measures WHERE id = $id";
        $data = $this->select($sql);
        return $data;

    }

    public function actionMeasure( int $status, int $id){

        $this->id = $id;
        $this->status = $status;
        $sql = "UPDATE measures SET status = ? WHERE id = ?";
        $data = array($this->status, $this->id);
        $allData = $this->save($sql, $data);
        return $allData;
    }  

    public function verifyPermission(int $id_user, string $permission_name)
    {
        $sql = "SELECT p.id, p.permission, d.id, d.id_user, d.id_permission FROM permissions p INNER JOIN detail_permissions d ON p.id = d.id_permission WHERE d.id_user = $id_user AND p.permission = '$permission_name'";
        $data = $this->selectAll($sql);
        return $data;
    }
}