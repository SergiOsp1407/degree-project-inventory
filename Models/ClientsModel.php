<?php
class ClientsModel extends Query
{

    private $dni_client, $name, $phone, $address, $id, $status;

    public function __construct()
    {

        parent::__construct();
    }

    public function getClients()
    {
        $sql = "SELECT * FROM clients";
        // Instance from the Query class, to run the query and assign to data var
        $data = $this->selectAll($sql);
        return $data;
    }

    public function registerClient(string $dni_client, string $name, string $phone, String $address)
    {
        $this->dni_client = $dni_client;
        $this->name = $name;
        $this->phone = $phone;
        $this->address = $address;        

        //This implementation check if the dni_client already exists in the DB
        $check = "SELECT * FROM clients WHERE dni_client = '$this->dni_client'";
        $exists = $this->select($check);

        if (empty($exists)) {

            $sql = "INSERT INTO clients(dni_client, name, phone, address) VALUES (?,?,?,?)";
            $data = array($this->dni_client, $this->name, $this->phone, $this->address);
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

    public function modifyClient(string $dni_client, string $name, string $phone ,string $address, int $id)
    {
        $this->dni_client = $dni_client;
        $this->name = $name;
        $this->phone = $address;
        $this->address = $address;
        $this->id = $id;

        //This implementation check if the dni already exists in the DB and update the Client
        $sql = "UPDATE clients SET dni_client = ?, name = ?, phone = ?, address = ? WHERE id = ?";
        $data = array($this->dni_client, $this->name, $this->phone, $this->address, $this->id);
        $allData = $this->save($sql, $data);

        if ($allData == 1) {
            $response = "modificado";
        } else {
            $response = "error";
        }
        return $response;
    }

    public function editClient(int $id){

        $sql = "SELECT * FROM clients WHERE id = $id";
        $data = $this->select($sql);

        return $data;

    }


    public function actionClient( int $status, int $id){
        $this->id = $id;
        $this->status = $status;
        $sql = "UPDATE clients SET status = ? WHERE id = ?";
        $data = array($this->status, $this->id);
        $allData = $this->save($sql, $data);
        return $allData;

    }

    public function verifyPermission(int $id_user, string $permission_name){
        $sql = "SELECT p.id, p.permission, d.id, d.id_user, d.id_permission FROM permissions p INNER JOIN detail_permissions d ON p.id = d.id_permission WHERE d.id_user = $id_user AND p.permission = '$permission_name'";
        $data = $this->selectAll($sql);
        return $data;
    }
}