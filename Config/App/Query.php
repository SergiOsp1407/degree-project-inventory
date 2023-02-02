<!-- Methods to Consult the Database -->
<?php
class Query extends Connection{ 

    private $pdo, $con, $sql;


    public function __construct() {
        $this->pdo = new Connection();
        $this->con = $this->pdo->connecting();
    }

    public function select(string $sql)
    {
        $this->sql = $sql;
        $result = $this->con->prepare($this->sql);
        $result->execute();
        $data = $result->fetch(PDO::FETCH_ASSOC);
        return $data;
    }

    public function selectAll(string $sql)
    {
        $this->sql = $sql;
        $result = $this->con->prepare($this->sql);
        $result->execute();
        $data = $result->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }

}
?>