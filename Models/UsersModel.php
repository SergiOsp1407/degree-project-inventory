<!-- Users Model for creation and saving o users -->
<?php
class UsersModel extends Query{
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
        $sql = "SELECT u.*, c.id, c.cash_register FROM users u INNER JOIN cash_register c WHERE u.id_cash_register = c.id";

        // Instance from the Query class, to run the query and assign to data var
        $data = $this->selectAll($sql);
        return $data;
        
    }
}
?>