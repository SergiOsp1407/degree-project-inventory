<!-- Products Model for manipulation of products -->
<?php
class ProductsModel extends Query{

    private $code, $description, $purchase_price, $selling_price, $id_measure, $id_category, $id, $status, $image;

    public function __construct(){

        parent::__construct();
    }

    public function getMeasures(){
        $sql = "SELECT * FROM measures WHERE status = 1";
        $data = $this->selectAll($sql);
        return $data;
    }

    public function getCategories(){
        $sql = "SELECT * FROM categories WHERE status = 1";

        // Instance from the Query class, to run the query and assign to data var
        $data = $this->selectAll($sql);
        return $data;
    }

    public function getProducts(){

        $sql = "SELECT p.*, m.id AS id_measure, m.name AS measure, c.id AS id_category, c.name AS category FROM products p INNER JOIN measures m ON p.id_measure = m.id INNER JOIN categories c ON p.id_category = c.id";

        // Instance from the Query class, to run the query and assign to data var
        $data = $this->selectAll($sql);
        return $data;
    }

    public function registerProduct(string $code, string $description, string $purchase_price, string $selling_price, int $id_measure, int $id_category, string $image ){
        $this->code = $code;
        $this->description = $description;
        $this->purchase_price = $purchase_price;
        $this->selling_price = $selling_price;
        $this->id_measure = $id_measure;        
        $this->id_category = $id_category;        
        $this->image = $image;        

        //This implementation check if the Product already exists in the DB
        $check = "SELECT * FROM products WHERE code = '$this->code'";
        $exists = $this->select($check);

        if (empty($exists)) {
            $sql = "INSERT INTO products(code, description, purchase_price, selling_price, id_measure, id_category, image ) VALUES (?,?,?,?,?,?,?)";
            $data = array($this->code, $this->description, $this->purchase_price, $this->selling_price, $this->id_measure, $this->id_category, $this->image);
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

    public function modifyProduct(string $code, string $description, string $purchase_price, string $selling_price, int $id_measure, int $id_category, string $image, int $id){

        $this->code = $code;
        $this->description = $description;
        $this->purchase_price = $purchase_price;
        $this->selling_price = $selling_price;
        $this->id_measure = $id_measure;
        $this->id_category = $id_category;
        $this->image = $image;
        $this->id = $id;

        //This implementation check if the Product already exists in the DB

        $sql = "UPDATE products SET code = ?, description = ?, purchase_price = ?, selling_price = ?, id_measure = ?, id_category = ?, image = ? WHERE id = ?";
        $data = array($this->code, $this->description, $this->purchase_price, $this->selling_price, $this->id_measure, $this->id_category, $this->image, $this->id);
        $allData = $this->save($sql, $data);

        if ($allData == 1) {
            $response = "modificado";
        } else {
            $response = "error";
        }
        return $response;
    }

    public function editProduct(int $id){

        $sql = "SELECT * FROM products WHERE id = $id";
        $data = $this->select($sql);

        return $data;

    }


    public function actionProduct( int $status, int $id){

        $this->id = $id;
        $this->status = $status;
        $sql = "UPDATE products SET status = ? WHERE id = ?";
        $data = array($this->status, $this->id);
        $allData = $this->save($sql, $data);

        return $allData;

    }
}