<?php include "Views/Templates/header.php" ?>

<div class="card">
    <div class="card-header bg-primary text-white">
        <h4>Nueva Venta</h4>
    </div>

    <div class="card-body">
        <form class="frmSale">
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="code"><i class="fas fa-barcode"></i> Código de barras</label>
                        <input type="hidden" id="id" name="id">
                        <input id="code" type="text" class="form-control" name="code" placeholder="Codigo de barras" onkeyup="searchCodeSale(event)">
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
                        <input id="amount" type="number" class="form-control" name="amount" onkeyup="calculateSalPrice(event)" disabled>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="sale_price">Precio</label>
                        <input id="sale_price" type="number" class="form-control" name="sale_price" placeholder="Precio venta" disabled>
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
            <th>Tipo descuento</th>
            <th>Descuentos aplicados</th>
            <th>Precio</th>
            <th>Subtotal</th>
            <th></th>
        </tr>
    </thead>
    <tbody id="tblSales">

    </tbody>
</table>
<div class="row">

    <div class="cl-md-4">
        <div class="from-group">
            <label for="client">Seleccionar cliente</label>
            <select name="client" id="client" class="form-control">
                <?php foreach ($data as $row) { ?>
                <option value="<?php echo $row['id']?>"><?php echo $row['name']?></option>
                <?php } ?>
            </select>
        </div>
    </div>    

    <div class="col-md-3 ml-auto">
        <div class="form-group">
            <label for="total" class="font-weight-bold">Total</label>
            <input id="total" type="text" class="form-control" name="total" placeholder="Total" disabled>
            <button class="btn btn-primary mt-2 btn-block" type="button" onclick="triggerTransaction(0)">Generar venta</button>
        </div>        
    </div>
</div>

<?php include "Views/Templates/footer.php" ?>