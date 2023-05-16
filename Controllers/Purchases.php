<?php
class Purchases extends Controller{
    public function __construct(){
        session_start();
        parent::__construct();        
    }

    public function index(){
        $this->views->getView($this, "index");
    }

    public function sales(){
        $data = $this->model->getClients();
        $this->views->getView($this, "sales", $data);
    }

    public function sales_history(){        
        $this->views->getView($this, "sales_history");
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
        $price = $data['purchase_price'];
        $amount = $_POST['amount'];      
        $check = $this->model->checkDetail('tmp_purchases', $id_product, $id_user);
        if(empty($check)){
            $sub_total = $price * $amount;
            $allData = $this->model->registerDetail('tmp_purchases',$id_product, $id_user, $price, $amount, $sub_total);
            if ($allData == "ok") {
                $message = array('message' => 'Producto ingresado a la compra', 'icon' => 'success');
            } else {
                $message = array('message' => 'Error al ingresar el producto a la compra', 'icon' => 'error');
            }
        }else{
            $total_amount = $check['amount'] + $amount;
            $sub_total = $total_amount * $price;
            $allData = $this->model->updateDetail('tmp_purchases', $price, $total_amount, $sub_total, $id_product, $id_user);
            if ($allData == "modificado") {
                $message = array('message' => 'Producto modificado correctamente', 'icon' => 'success');
            } else {
                $message = array('message' => 'Error al modificar el producto', 'icon' => 'error');
            }
        }
        echo json_encode($message, JSON_UNESCAPED_UNICODE);
        die();        
    }

    public function inputSale(){
        $id = $_POST['id'];
        $data = $this->model->getProducts($id);
        $id_product = $data['id'];
        $id_user = $_SESSION['id_user'];
        $price = $data['selling_price'];
        $amount = $_POST['amount'];        
        $check = $this->model->checkDetail('tmp_sales', $id_product, $id_user);
        if(empty($check)){
            if ($data['amount'] >= $amount) {
                $sub_total = $price * $amount;
                $allData = $this->model->registerDetail('tmp_sales', $id_product, $id_user, $price, $amount, $sub_total);
                if ($allData == "ok") {
                    $message = array('message' => 'Producto añadido a la venta', 'icon' => 'success');
                } else {
                    $message = array('message' => 'Error al ingresar el producto a la venta', 'icon' => 'error');
                }
            }else {
                $message = array('message' => 'No hay stock del producto, actualmente solo hay '.$data['amount'].' unidades.', 'icon' => 'warning');
            }
        }else{
            $total_amount = $check['amount'] + $amount;
            $sub_total = $total_amount * $price;
            if ($data['amount'] < $total_amount) {
                $message = array('message' => 'No hay stock del producto', 'icon' => 'warning');
            }else {
                $allData = $this->model->updateDetail('tmp_sales',$price, $total_amount, $sub_total, $id_product, $id_user);
                if ($allData == "modificado") {
                    $message = array('message' => 'Venta modificada correctamente', 'icon' => 'success');
                } else {
                    $message = array('message' => 'Error al modificar la venta', 'icon' => 'error');
                }
            }
        }
        echo json_encode($message, JSON_UNESCAPED_UNICODE);
        die();        
    }

    public function list($table){
        $id_user = $_SESSION['id_user'];
        $data['detail'] = $this->model->getDetail($table,$id_user);
        $data['total_pay'] = $this->model->calculatePurchase($table, $id_user);
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function delete($id){
        $data = $this->model->deleteDetail('tmp_purchases',$id);
        if($data == 'ok'){
            $message = array('message' => 'Producto eliminado correctamente', 'icon' => 'success');
        }else{
            $message = array('message' => 'Producto no se elimino correctamente', 'icon' => 'error');
        }
        echo json_encode($message);
        die();
    }

    public function deleteSale($id){
        $data = $this->model->deleteDetail('tmp_sales',$id);
        if($data == 'ok'){
            $message = array('message' => 'Producto eliminado correctamente', 'icon' => 'success');
        }else{
            $message = array('message' => 'Producto no se elimino correctamente', 'icon' => 'error');
        }
        echo json_encode($message);
        die();
    }

    public function registerPurchase(){
        $id_user = $_SESSION['id_user'];
        $total = $this->model->calculatePurchase('tmp_purchases',$id_user);
        $data = $this->model->registerPurchase($total['total']);
        if($data == 'ok'){
            $detail = $this->model->getDetail('tmp_purchases',$id_user);
            $id_purchase = $this->model->getId('purchases');
            foreach ($detail as $row){
                $amount = $row['amount'];
                $price = $row['price'];
                $id_product = $row['id_product'];
                $sub_total = $amount * $price;
                $this->model->registerPurchaseDetail($id_purchase['id'], $id_product, $amount, $price, $sub_total);
                $actual_stock = $this->model->getProducts($id_product);
                $stock = $actual_stock['amount'] + $amount;
                $this->model->updateStock($stock, $id_product);
            }            
            $clean = $this->model->cleanDetails('tmp_purchases',$id_user);
            if($clean == 'ok'){
                $message = array('message' => 'ok', 'id_purchase' => $id_purchase['id']);
            }
        }else{
            $message = array('message' => 'Error al realizar la compra', 'icon' => 'error');
        }
        echo json_encode($message);
        die();
    }

    public function registerSale($id_client){
        $id_user = $_SESSION['id_user'];
        $check = $this->model->checkCashRegister($id_user);
        if (empty($check)) {
            $message = array('message' => 'La caja esta cerrada', 'icon' => 'warning');
        }else{            
            $sale_date = date('Y-m-d');
            $time_hours = date('H:i:s'); 
            $total_sales = $this->model->calculatePurchase('tmp_sales',$id_user);
            $data = $this->model->registerSale($id_user, $id_client, $total_sales['total'], $sale_date, $time_hours);
            if($data == 'ok'){
                $detail = $this->model->getDetail('tmp_sales',$id_user);
                $id_sale = $this->model->getId('sales');
                foreach ($detail AS $row){
                    $amount = $row['amount'];
                    $discount = $row['discount'];
                    $price = $row['price'];
                    $id_product = $row['id_product'];
                    $sub_total = ($amount * $price) - $discount;
                    $this->model->registerSaleDetail($id_sale['id'], $id_product, $amount, $discount,$price, $sub_total);
                    $actual_stock = $this->model->getProducts($id_product);
                    $stock = $actual_stock['amount'] - $amount;
                    $this->model->updateStock($stock, $id_product);
                }
                $clean = $this->model->cleanDetails('tmp_sales',$id_user);    
                if($clean == 'ok'){
                    $message = array('message' => 'ok', 'id_sale' => $id_sale['id']);
                }
            }else{
                $message = array('message' => 'Error al realizar la venta', 'icon' => 'error');
            }
        }
        echo json_encode($message);
        die();
    }

    
    public function triggerPDF($id_purchase ){

        $company = $this->model->getCompany(); 
        $products = $this->model->getProductPurchase($id_purchase); 
        

        ob_start();        
        require('Libraries/fpdf/fpdf.php');
         
        $pdf = new FPDF('P','mm','Letter' );
        $pdf->AddPage();
        $pdf->SetTitle('Reporte de compra');

        
        $pdf->SetFont('Arial', 'B', 14);
        $pdf->Cell(65, 10, utf8_decode( $company['name']), 0, 1, 'C');
        $pdf->Ln();        
        $pdf->Image(base_url . 'Assets/img/cebiche.png', 150,10,30,30);
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
        $pdf->Cell(46,5, 'Orden de Compra Nro:', 0, 0, 'L');        
        $pdf->SetFont('Arial', '', 11);
        $pdf->Cell(20,5, $id_purchase, 0, 1, 'L');
        $pdf->Ln();
        
        
        $pdf->SetFillColor(220,53,69);
        $pdf->SetTextColor(255,255,255);
        $pdf->Cell(25,5, 'Id Producto', 0, 0, 'C', true);
        $pdf->Cell(80,5, utf8_decode('Descripción'), 0, 0, 'C', true);
        $pdf->Cell(20,5, 'Cantidad', 0, 0, 'C', true);
        $pdf->Cell(33,5, 'Precio', 0, 0, 'C', true);
        $pdf->Cell(35,5, 'Subtotal', 0, 1, 'C', true);
        
        $pdf->SetFillColor(233,236,239);
        $pdf->SetTextColor(0,0,0);
        $fill = false;
        
        
        $total = 0.00;
        foreach ($products as $row){
            $total = $total + $row['sub_total'];
            $pdf->Cell(25,5, $row['id_product'], 0, 0, 'C',$fill);
            $pdf->Cell(80,5, utf8_decode($row['description']), 0, 0, 'L',$fill);
            $pdf->Cell(20,5, $row['amount'], 0, 0, 'C',$fill);
            $pdf->Cell(33,5, $row['price'], 0, 0, 'C',$fill);
            $pdf->Cell(35,5, number_format( $row['sub_total'], 2, ',', '.'), 0, 0, 'C',$fill);
            $pdf->Ln();
            $fill = !$fill;
        }
        $pdf->Ln();
        
        $pdf->SetFillColor(220,53,69);
        $pdf->SetFont('Arial', 'B', 11);
        $pdf->Cell(190,6,'Total a pagar', 0, 1, 'R');
        $pdf->Cell(190,6,number_format($total, 2, ',' , '.'), 0, 1, 'R');

        $pdf->Output();
        ob_end_flush();    

    }

    public function history(){
        $this->views->getView($this, "history");
    }

    public function list_history(){

        $data = $this->model->getPurchaseHistory();
        for ($i=0; $i < count($data); $i++) {            
            if ($data[$i]['status'] == 1) {
                $data[$i]['status'] = '<span class="badge bg-success">Completado</span>';
                $data[$i]['actions'] = '<div><button class="btn btn-warning" onclick="btnCancelPurchase('.$data[$i]['id'].')"><i class="fas fa-ban"></i></button><a class="btn btn-danger" href="'.base_url."Purchases/triggerPDF/".$data[$i]['id'].'" target="_blank"><i class="fas fa-file-pdf"></i></a></div>';
            }else {

                $data[$i]['status'] = '<span class="badge bg-danger">Anulado</span>';
                $data[$i]['actions'] = '<div><a class="btn btn-danger" href="'.base_url. "Purchases/triggerPDF/".$data[$i]['id'].'" target="_blank"><i class="fas fa-file-pdf"></i></a></div>';
            }
        }
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function list_sales_history(){

        $data = $this->model->getSalesHistory();
        for ($i=0; $i < count($data); $i++) { 
            $data[$i]['actions'] = '<div><a class="btn btn-danger" href="'.base_url."Purchases/triggerPDFSale/".$data[$i]['id'].'" target="_blank"><i class="fas fa-file-pdf"></i></a></div>';
        }
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }


    public function triggerPDFSale($id_sale){

        $company = $this->model->getCompany(); 
        $discount = $this->model->getDiscount($id_sale); 
        $products = $this->model->getProductSale($id_sale); 
        

        ob_start();        
        require('Libraries/fpdf/fpdf.php');
         
        $pdf = new FPDF('P','mm','Letter' );
        $pdf->AddPage();
        $pdf->SetTitle('Factura de venta');

        
        $pdf->SetFont('Arial', 'B', 14);
        $pdf->Cell(65, 10, utf8_decode( $company['name']), 0, 1, 'C');
        $pdf->Ln();        
        $pdf->Image(base_url . 'Assets/img/cebiche.png', 150,10,30,30);
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
        $pdf->Cell(20,5, $id_sale, 0, 1, 'L');
        $pdf->Ln();

        
        $pdf->SetFillColor(220,53,69);
        $pdf->SetTextColor(255,255,255);
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(40,5, 'Cliente', 0, 0, 'C', true);
        $pdf->Cell(31,5, utf8_decode('Teléfono'), 0, 0, 'C', true);
        $pdf->Cell(60,5, utf8_decode('Dirección'), 0, 1, 'C', true);        
        $pdf->SetTextColor(0,0,0);
        $clients = $this->model->clientsSale($id_sale);
        
        
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(40,5, utf8_decode($clients['name']), 0, 0, 'L');
        $pdf->Cell(31,5, $clients['phone'], 0, 0, 'L');
        $pdf->Cell(60,5, utf8_decode($clients['address']), 0, 1, 'L');
        $pdf->Ln();
        
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->SetFillColor(220,53,69);
        $pdf->SetTextColor(255,255,255);
        $pdf->Cell(31,5, 'Id Producto', 0, 0, 'C', true);
        $pdf->Cell(52,5, utf8_decode('Descripción'), 0, 0, 'C', true);
        $pdf->Cell(20,5, 'Cantidad', 0, 0, 'C', true);
        $pdf->Cell(32,5, 'Precio', 0, 0, 'C', true);
        $pdf->Cell(30,5, 'Descuento', 0, 0, 'C', true);
        $pdf->Cell(32,5, 'Subtotal', 0, 1, 'C', true);
        
        $pdf->SetFillColor(233,236,239);
        $pdf->SetTextColor(0,0,0);
        $pdf->SetFont('Arial', '', 10);
        $fill = false;
        
        $total = 0.00;
        foreach ($products as $row){

            $total = $total + $row['sub_total'];
            $pdf->Cell(31,5, $row['id'], 0, 0, 'C',$fill);
            $pdf->Cell(52,5, utf8_decode($row['description']), 0, 0, 'L',$fill);
            $pdf->Cell(20,5, $row['amount'], 0, 0, 'C',$fill);
            $pdf->Cell(32,5, number_format($row['price'], 2, ',', '.'), 0, 0, 'L',$fill);
            $pdf->Cell(30,5, number_format($row['discount'], 2, ',', '.'), 0, 0, 'L',$fill);
            $pdf->Cell(32,5, number_format($row['sub_total'], 2, ',', '.'), 0, 0, 'L',$fill);
            $pdf->Ln();
            $fill = !$fill;

        }
        $pdf->Ln();

        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(195,3,'Descuento total', 0, 1, 'R');
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(195,8,number_format($discount['total'], 2, ',' , '.'), 0, 1, 'R');
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(195,3,'Total a pagar', 0, 1, 'R');
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(195,8,number_format($total, 2, ',' , '.'), 0, 1, 'R');

        $pdf->Output();       
        ob_end_flush(); 
    }

    public function calculateDiscount($data){
        $array = explode(",", $data);
        $id = $array[0];
        $discount = $array[1];
        if (empty($id) || empty($discount)) {
            $message = array('message' => 'Error', 'icon' => 'error');
        }else{
            $actual_discount = $this->model->checkDiscount($id);
            $total_discount = $actual_discount['discount'] + $discount;
            $sub_total = ($actual_discount['amount'] * $actual_discount['price']) - $total_discount ;
            $allData = $this->model->updateDiscount($total_discount, $sub_total,$id);

            if ($allData == 'ok') {
                $message = array('message' => 'Descuento aplicado', 'icon' => 'success');
            }else{
                $message = array('message' => 'Error al aplicar el descuento', 'icon' => 'error');
            }
        }

        echo json_encode($message, JSON_UNESCAPED_UNICODE);
        die();

    }

    public function cancelPurchase($id_purchase){
        
        $data = $this->model->getCancelPurchase($id_purchase);
        $cancel = $this->model->getCancel($id_purchase);

        foreach ($data as $row) {
            $actual_stock = $this->model->getProducts($row['id_product']);
            $stock = $actual_stock['amount'] - $row['amount'];
            $this->model->updateStock($stock, $row['id_product']);
        }

        if ($cancel == 'ok') {
            $message = array('message' => 'Compra Anulada', 'icon' => 'success');
        }else {
            $message = array('message' => 'Error al anular la compra', 'icon' => 'error');
        }

        echo json_encode($message, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function generate_numbers($start, $count, $digits){
        $result = array();
        for ($n=$start; $n < $start + $count; $n++) { 
            $result[] = str_pad($n, $digits, "0", STR_PAD_LEFT);
        }
        return $result;
    }
    
    public function saleViewPDF( ){               
        $from_date = $_POST['from_date'];
        $to_date = $_POST['to_date'];

        if (empty($from_date) || empty($to_date)) {
            $data = $this->model->getSalesHistory();
        }else {
            $data = $this->model->getSalesDates($from_date, $to_date);
        }
        
        ob_start();        
        require('Libraries/fpdf/fpdf.php');
         
        $pdf = new FPDF('P','mm','Letter');
        $pdf->AddPage();
        $pdf->SetTitle('Reporte de ventas por fecha');

        
        $pdf->SetFillColor(220,53,69);
        $pdf->SetTextColor(0,0,0);
        $pdf->SetDrawColor(128,0,0);
        $pdf->SetLineWidth(3);
        $pdf->SetFont('Arial', 'B', 20);
        $pdf->Cell(200,10, 'Historial de ventas',0,1,'C');
        $pdf->Ln();
        
        $pdf->SetFont('Arial', 'B', 14);
        $pdf->SetTextColor(255,255,255);
        $pdf->Cell(31,5, 'Id Venta', 0, 0, 'C', true);
        $pdf->Cell(56,5, 'Cliente', 0, 0, 'C', true);
        $pdf->Cell(55,5, 'Total venta', 0, 0, 'C', true);
        $pdf->Cell(52,5, 'Fecha/Hora', 0, 1, 'C', true);

        $pdf->SetFillColor(233,236,239);
        $pdf->SetFont('Arial', '',12);
        $pdf->SetTextColor(0,0,0);
        $fill = false;

        foreach ($data as $row) {
            $pdf->Cell(31,5, $row['id'], 0, 0, 'C',$fill);
            $pdf->Cell(56,5, $row['name'], 0, 0, 'C',$fill);
            $pdf->Cell(55,5, number_format($row['total_sales'],2,',','.'), 0, 0, 'C',$fill);
            $pdf->Cell(52,5, $row['sale_date'], 0, 0, 'C',$fill);
            $pdf->Ln();
            $fill = !$fill;
        }

        $pdf->Output();
        ob_end_flush();
    }
}
