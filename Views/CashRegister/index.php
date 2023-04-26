<?php include "Views/Templates/header.php"; ?>

<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item active">Cajas</li>
</ol>

<button class="btn btn-primary mb-2" type="button" onclick="frmCashRegister();">Nueva caja <i class="fas fa-plus"></i></button>
<table class="table table-light" id="tblCashRegister">
    <thead class="thead-dark">
        <tr>
            <th>Id</th>
            <th>Nombre</th>
            <th>Estado</th>
            <th></th>
        </tr>
    </thead>
    <tbody>        
    </tbody>
</table>
<div class="modal fade" id="new_cashRegister" tabindex="-1" role="dialog" aria-labelledby="Label" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-dark text-white">
                <h5 class="modal-title" id="title">Nueva Caja</h5>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                <form method="post" id="frmCashRegister">                    
                    <div class="form-group">                        
                        <input type="hidden" name="id" id="id">
                        <label for="cash_register">Nombre de caja:</label>
                        <input id="cash_register" class="form-control" type="text" name="cash_register" >
                    </div><br>                    
                    <button type="button" class="btn btn-primary" onclick="registerCashRegister(event);" id="btnAction">Registrar</button>
                    <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Cancelar</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php include "Views/Templates/footer.php"; ?>