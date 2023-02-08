<?php
class AdministrationModel extends Query
{

    public function __construct(){
        
        parent::__construct();
    }

    public function getCompany()
    {
        $sql = "SELECT * FROM configuration";
        $data = $this->select($sql);
        return $data;
    }

    public function modify(string $name, string $phone, string $address, string $message, int $id){       

        $sql = "UPDATE configuration SET name = ?, phone = ?, address = ?, message = ? WHERE id=?)";
        $data = array($name, $phone, $address, $message, $id);
        $allData = $this->save($sql, $data);

        if ($allData == 1) {
            $response = "ok";
        } else {
            $response = "error";
        }
        
        return $response;



    }

    
}
