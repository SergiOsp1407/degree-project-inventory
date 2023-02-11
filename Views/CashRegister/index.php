<?php include "Views/Templates/header.php"; ?>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item active">Cajas</li>
</ol>
<button class="btn btn-primary mb-2" type="button" onclick="frmCashRegister();"></button>
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
<!--Format of the Cash Register table-->
<div class="new_cashRegister" id="my_modal" tabindex="-1" role="dialog" aria-labelledby="Label" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-dark text-white">
                <h5 class="modal-title" id="title">Nueva Caja</h5>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- aqui se debe agregar el codigo recortado-->
                <form method="post" id="frmCashRegister">                    
                    <div class="form-group">                        
                        <input type="hidden" name="id" id="id">
                        <label for="name">Nombre</label>
                        <input type="text" name="name" id="name">
                    </div>                    
                    <button type="button" class="btn btn-primary" onclick="registerCashRegister(event);" id="btnAction">Registrar</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php include "Views/Templates/footer.php"; ?>