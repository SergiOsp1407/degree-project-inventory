<?php include "Views/Templates/header.php" ?>

<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item active">Clients</li>
</ol>

<button class="btn btn-primary mb-2" type="button" onclick="frmClient();">Nuevo usuario <i class="fas fa-plus"></i></button>

<table class="table table-light" id="tblClients">
    <thead class="thead-dark">
        <tr>
            <th>Id</th>
            <th>DNI Cliente</th>
            <th>Nombre</th>
            <th>Teléfono</th>
            <th>Dirección</th>
            <th>Estado</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
    </tbody>
</table>

<!--Format of the New Users table-->
<div class="modal fade" id="new_client" tabindex="-1" role="dialog" aria-labelledby="Label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-dark text-white">
                <h5 class="modal-title" id="title">Nuevo Cliente</h5>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                
                <form method="post" id="frmClient">
                    <div class="form-floating mb-3">                        
                        <input type="hidden" id="id" name="id">
                        <input type="text" class="form-control" name="dni" id="dni" placeholder="Documento de identidad">
                        <label for="dni">DNI</label>
                    </div>
                    <div class="form-floating mb-3">                        
                        <input type="text" class="form-control" name="name" id="name" placeholder="Nombre">
                        <label for="name">Nombre</label>
                    </div>
                    <div class="form-floating mb-3">                        
                        <input type="text" class="form-control" name="phone" id="phone" placeholder="Teléfono">
                        <label for="phone">Teléfono</label>
                    </div>
                    <div class="form-floating mb-3">                        
                        <textarea class="form-control" name="address" id="address" placeholder="Dirección" rows="3"></textarea>
                        <label for="address">Dirección</label>
                    </div>
                    
                    
                    <button type="button" class="btn btn-primary" onclick="registerClient(event);" id="">Registrar</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                </form>

            </div>
            <!-- In the video 31 this modal is deleted
                 <div class="modal-footer">
                <button type="button" class="btn btn-secondary">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div> -->
        </div>
    </div>
</div>
<?php include "Views/Templates/footer.php" ?>