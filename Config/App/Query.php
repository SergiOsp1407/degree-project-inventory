<!-- Methods to Consult the Database -->
<?php
class Query extends Connection{ 

    private $pdo, $con, $sql, $data;


    public function __construct() {
        $this->pdo = new Connection();
        $this->con = $this->pdo->connecting();
    }

    // Invocation of query function to select a value from tables
    public function select(string $sql)
    {
        $this->sql = $sql;
        $result = $this->con->prepare($this->sql);
        $result->execute();
        $data = $result->fetch(PDO::FETCH_ASSOC);
        return $data;
    }

    // Invocation of query function to select all values from tables
    public function selectAll(string $sql)
    {
        $this->sql = $sql;
        $result = $this->con->prepare($this->sql);
        $result->execute();
        $data = $result->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }
    // Invocation of query to save the data
    public function save(string $sql, array $data)
    {
        $this->sql = $sql;
        $this->data = $data;
        $insert = $this->con->prepare($this->sql);
        $allData = $insert->execute($this->data);

        if ($allData) {
            $response = 1;
        }else{
            $response = 0;
        }
        return $response;

    }

}
?>