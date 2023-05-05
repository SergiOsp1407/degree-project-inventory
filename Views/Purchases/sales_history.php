<?php include "Views/Templates/header.php"; ?>
<form action="<?php echo base_url; ?>Purchases/saleViewPDF" method="POST" target="_blank">    
    <div class="row">
        <div class="col-md-3">
            <div class="form-group">
                <label for="from_date">Desde</label>
                <input type="date" id="from_date" name="from_date" value="<?php echo date('Y-m-d'); ?>">
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="to_date">Hasta</label>
                <input type="date" id="to_date" name="to_date" value="<?php echo date('Y-m-d'); ?>">
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <button type="submit" class="btn btn-danger">Export PDF</button>
            </div>
        </div>
    </div>
</form>

<div class="card my-2">
    <div class="card">
        <div class="card-header bg-dark text-white">
            Ventas
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover" id="t_history_sale">
                    <thead class="thead-dark">
                        <tr>
                            <th>#</th>
                            <th>Clientes</th>
                            <th>Total</th>
                            <th>Fecha Compra</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php include "Views/Templates/footer.php"; ?>