<?php
class Connection{
    private $connect;

    public function __construct()
    {
        $pdo = "mysql:host=".host.";dbname=".database.";.charset.";
        try {
            $this->connect = new PDO($pdo, user, password);
            $this->connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            echo 'Connected';
        } catch (PDOException $e) {
            echo "Error connecting to Database:".$e->getMessage();
        }
    }

    public function connecting()
    {
        return $this->connect;
    }
}

?>