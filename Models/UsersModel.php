<!-- Users Model for creation and saving o users -->
<?php
class UsersModel extends Query{

    private $user, $name, $password, $id_cash_register;

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
        $sql = "INSERT INTO users(user, name, password, id_cash_register) VALUES (?,?,?,?)";
        $data = array($this->user, $this->name, $this->password, $this->id_cash_register);
        $allData = $this->save($sql, $data);
        
        if ($data == 1) {
            $response = "ok";
        }else{
            $res = "error";
        }
        return $response;
    }
}
?>