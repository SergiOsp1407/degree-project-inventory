<?php include "Views/Templates/header.php"; ?>

<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item active">Balance</li>
</ol>
<button class="btn btn-primary mb-2" type="button" onclick="cashBalance();">Abrir caja</button>
<button class="btn btn-dark mb-2" type="button" onclick="closeCashRegister();">Cerrar caja</button>
<table class="table table-light" id="t_balance">
    <thead class="thead-dark">
        <tr>
            <th>Id</th>
            <th>Moto inicial</th>
            <th>Monto final</th>
            <th>F. Apertura</th>
            <th>F. Cierre</th>
            <th>Numero ventas</th>
            <th>Total ventas</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>        
    </tbody>
</table>
<div class="modal fade" id="open_cashRegister" tabindex="-1" role="dialog" aria-labelledby="Label" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-dark text-white">
                <h5 class="modal-title" id="title">Balance de caja</h5>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                <form method="post" id="frmOpenCashRegister" onsubmit="openBalance(event);">                  
                    <div class="form-group">                        
                        <input type="hidden" name="id" id="id">
                        <label for="initial_amount">Monto Inicial</label>
                        <input type="text" name="initial_amount" id="initial_amount" class="form-control" placeholder="Monto inicial" require>
                    </div>
                    <div id="hide_fields">
                        <div class="form-group">
                            <label for="final_amount">Monto Final</label>
                            <input id="final_amount" class="form-control" type="text" disabled>
                        </div> 
                        <div class="form-group">
                            <label for="total_sales">Cantidad ventas</label>
                            <input id="total_sales" class="form-control" type="text" disabled>
                        </div>
                        <div class="form-group">
                            <label for="general_amount">Monto total</label>
                            <input id="general_amount" type="text" class="form-control" disabled>
                        </div>
                    </div>
                                      
                    <button type="submit" class="btn btn-primary mb-2" id="btnAction">Abrir</button>
                    <button type="button" class="btn btn-dark mb-2" data-bs-dismiss="modal">Cancelar</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php include "Views/Templates/footer.php"; ?>