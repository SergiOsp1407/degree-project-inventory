<?php

class Purchases extends Controller {



    public function __construct(){

        session_start();

        parent::__construct();
        
    }

    public function index(){

        $this->views->getView($this, "index");
    }

    public function searchCode($code){

        $data = $this->model->getProductCode($code);
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();

    } 

    public function inputInfo(){

        $id = $_POST['id'];
        $data = $this->model->getProducts($id);
        $id_product = $data['id'];
        $id_user = $_SESSION['id_user'];
        $price = $data['price'];
        $amount = $_POST['amount'];
        
        $check = $this->model->checkDetail($id_product, $id_user);

        if(empty($check)){
            $sub_total = $price * $amount;
            $allData = $this->model->registerDetail($id_product, $id_user, $price, $amount, $sub_total, $id_product);
            if ($allData == "ok") {
                $message = "ok";
            } else {
                $message = "Error al ingresar el producto ";
            }
        }else{
            $total_amount = $check['amount'] + $amount;
            $sub_total = $total_amount * $price;
            $allData = $this->model->updateDetail($price, $total_amount, $sub_total, $id_product, $id_user);
            if ($allData == "modificado") {
                $message = "modificado";
            } else {
                $message = "Error al modificar el producto ";
            }
        }

        echo json_encode($message, JSON_UNESCAPED_UNICODE);
        die();        
    }

    public function list(){

        $id_user = $_SESSION['id_user'];
        $data['detail'] = $this->model->getDetail($id_user);
        $data['total_pay'] = $this->model->calculatePurchase($id_user);
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();

    }

    public function delete($id){

        $data = $this->model->deleteDetail($id);

        if($data == 'ok'){
            $message = 'ok';
        }else{
            $message = 'error';
        }

        echo json_encode($message);
        die();


    }

    public function registerPurchase(){

        $id_user = $_SESSION['id_user'];
        $total = $this->model->calculatePurchase($id_user);
        $data = $this->model->registerPurchase($total['total']);

        if($data == 'ok'){
            $detail['detail'] = $this->model->getDetail($id_user);
            $id_purchase = $this->model->id_purchase();
            foreach ($detail AS $row){
                $id_product = $row['id_product'];
                $amount = $row['amount'];
                $product_price = $row['product_price'];
                $sub_total = $amount * $product_price;
                $this->model->registerPurchaseDetail($id_purchase['id'], $id_product, $amount, $product_price, $sub_total);
            }

            //Clean the Details of the purchase to print new info in the invoice
            $clean = $this->model->cleanDetails($id_user);

            if($clean == 'ok'){
                $message = array('message' => 'ok', 'id_purchase' => $id_purchase['id']);
            }

        }else{
            $message = 'Error al realizar la compra';
        }
        echo json_encode($message);
        die();
    }

    // Function to generate PDF in order to get invoices(facturas)
    public function triggerPDF($id_purchase ){

        $company = $this->model->getCompany(); 

        ob_start();        
        require('Libraries/fpdf/fpdf.php');
         
        $pdf = new FPDF('P','mm',/*array(80,200)*/'Letter' );
        $pdf->AddPage();
        $pdf->SetTitle('Factura o reporte de compra');

        //Header
        $pdf->SetFont('Arial', 'B', 14);
        $pdf->Cell(65, 10, utf8_decode( $company['name']), 0, 1, 'C');        
        $pdf->Image(base_url . 'Assets/img/companyLogo.png', 150,10,30,30);
        $pdf->SetFont('Arial', 'B', 11);
        $pdf->Cell(25,5, 'Nit: ', 0, 0, 'L');        
        $pdf->SetFont('Arial', '', 11);
        $pdf->Cell(20,5, $company['id_company'], 0, 1, 'L');
        
        $pdf->SetFont('Arial', 'B', 11);
        $pdf->Cell(25,5, utf8_decode('Teléfono: '), 0, 0, 'L');        
        $pdf->SetFont('Arial', '', 11);
        $pdf->Cell(20,5, $company['phone'], 0, 1, 'L');

        $pdf->SetFont('Arial', 'B', 11);
        $pdf->Cell(25,5, utf8_decode('Dirección: '), 0, 0, 'L');        
        $pdf->SetFont('Arial', '', 11);
        $pdf->Cell(20,5, utf8_decode($company['address']), 0, 1, 'L'); 
    
        $pdf->SetFont('Arial', 'B', 11);
        $pdf->Cell(25,5, 'Factura Nro:', 0, 0, 'L');        
        $pdf->SetFont('Arial', '', 11);
        $pdf->Cell(20,5, $id_purchase, 0, 1, 'L');        
        $pdf->Output();
        

        //Body

        ob_end_flush(); 

        

    }

}
