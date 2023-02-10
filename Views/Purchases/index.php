<?php include "Views/Templates/header.php" ?>

<!-- <ol class="breadcrumb mb-4">
    <li class="breadcrumb-item active">Nueva compra</li>
</ol> -->

<div class="card">
    <div class="card-header bg-primary text-white">
        <h4>Nueva Compra</h4>
    </div>

    <div class="card-body">
        <form class="frmPurchase">
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="code"><i class="fas fa-barcode"></i> Código de barras</label>
                        <input type="hidden" id="id" name="id">
                        <input id="code" type="text" class="form-control" name="code" placeholder="Codigo de barras" onkeyup="searchCode(event)">
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="form-group">
                        <label for="description">Descripción</label>
                        <input id="description" type="text" class="form-control" name="description" placeholder="Descripción de productos" disabled>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="amount">Cantidad</label>
                        <input id="amount" type="number" class="form-control" name="amount" onkeyup="calculatePrice(event)" disabled>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="purchase_price">Precio</label>
                        <input id="purchase_price" type="number" class="form-control" name="purchase_price" placeholder="Precio compra" disabled>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="subtotal">Subtotal</label>
                        <input id="subtotal" type="number" class="form-control" name="subtotal" placeholder="Precio compra" disabled>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<table class="table table-light table-bordered table-hover">
    <thead class="thead-dark">
        <tr>
            <th>Id</th>
            <th>Descripción</th>
            <th>Cantidad</th>
            <th>Precio</th>
            <th>Subtotal</th>
            <th> </th>
        </tr>
    </thead>
    <tbody id="tblDetail">

    </tbody>
</table>
<div class="row">
    <div class="col-md-4 ml-auto">
        <div class="form-group">
            <label for="total" class="font-weight-bold">Total</label>
            <input id="total" type="text" class="form-control" name="total" placeholder="Total" disabled>
            <button class="btn btn-primary mt-2 btn-block" type="button" onclick="triggerTransaction(1)">Generar compra</button>
        </div>        
    </div>
</div>

<?php include "Views/Templates/footer.php" ?>