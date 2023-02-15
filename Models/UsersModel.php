
<?php
class UsersModel extends Query
{

    private $user, $name, $password, $id_cash_register, $id, $status;

    public function __construct()
    {

        parent::__construct();
    }

    public function getUser(string $user, string $password)
    {
        $sql = "SELECT * FROM users WHERE user = '$user' AND  password = '$password'";

        // Instance from the Query class, to run the query and assign to data var
        $data = $this->select($sql);
        return $data;
    }

    public function getCashRegister()
    {
        $sql = "SELECT * FROM cash_register WHERE status = 1";

        // Instance from the Query class, to run the query and assign to data var
        $data = $this->selectAll($sql);
        return $data;
    }

    public function getUsers()
    {
        $sql = "SELECT u.*, c.id AS id_cash_register, c.cash_register FROM users u INNER JOIN cash_register c WHERE u.id_cash_register = c.id";

        // Instance from the Query class, to run the query and assign to data var
        $data = $this->selectAll($sql);
        return $data;
    }

    public function registerUser(string $user, string $name, string $password, int $id_cash_register)
    {
        $this->user = $user;
        $this->name = $name;
        $this->password = $password;
        $this->id_cash_register = $id_cash_register;        

        //This implementation check if the user already exists in the DB
        $check = "SELECT * FROM users WHERE user = '$this->user'";
        $exists = $this->select($check);

        if (empty($exists)) {

            $sql = "INSERT INTO users(user, name, password, id_cash_register) VALUES (?,?,?,?)";
            $data = array($this->user, $this->name, $this->password, $this->id_cash_register);
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

    public function modifyUser(string $user, string $name, int $id_cash_register, int $id)
    {
        $this->user = $user;
        $this->name = $name;
        $this->id = $id;
        $this->id_cash_register = $id_cash_register;

        //This implementation check if the user already exists in the DB

        $sql = "UPDATE users SET user = ?, name = ?, id_cash_register = ? WHERE id = ?";
        $data = array($this->user, $this->name, $this->id_cash_register, $this->id);
        $allData = $this->save($sql, $data);

        if ($allData == 1) {
            $response = "modificado";
        } else {
            $response = "error";
        }
        return $response;
    }

    public function editUser(int $id){

        $sql = "SELECT * FROM users WHERE id = $id";
        $data = $this->select($sql);

        return $data;

    }

    public function getPassword(string $password, int $id){

        $sql = "SELECT * FROM users WHERE password = $'password' AND id = $id";
        $data = $this->select($sql);

        return $data;

    }


    public function actionUser( int $status, int $id){

        $this->id = $id;
        $this->status = $status;
        $sql = "UPDATE users SET status = ? WHERE id = ?";
        $data = array($this->status, $this->id);
        $allData = $this->save($sql, $data);

        return $allData;

    }

    public function modifyPassword(string $password, int $id){

        $sql = "UPDATE users SET password = ? WHERE id = ?";
        $data = array($password, $id);
        $allData = $this->save($sql, $data);

        return $allData;

    }

    public function getPermissions()
    {
        // $sql = "SELECT users AS usuarios, configuration AS configuracion, cash_register AS caja, balance AS balances, clients AS clientes, measures AS medidas, categories AS categorias, products AS productos, new_purchase AS compras, purchase_history AS historialcompras, new_sale AS ventas, historialventas AS historial_Ventas FROM permissions";

        $sql = "SELECT * FROM permissions";

        // Instance from the Query class, to run the query and assign to data var
        $data = $this->selectAll($sql);
        return $data;
    }

  
}
?>