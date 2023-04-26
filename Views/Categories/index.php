<?php include "Views/Templates/header.php"; ?>

<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item active">Categories</li>
</ol>

<button class="btn btn-primary mb-2" type="button" onclick="frmCategory();">Nueva categoría <i class="fas fa-plus"></i></button>
<table class="table table-light" id="tblCategories">
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

<div class="modal fade" id="my_modal" tabindex="-1" role="dialog" aria-labelledby="Label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-dark text-white">
                <h5 class="modal-title" id="title">Nueva Categoría</h5>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">                
                <form method="post" id="frmCategory">
                    <div class="form-floating mb-3">                        
                        <input type="hidden" id="id" name="id">
                        <input type="text" class="form-control" name="name" id="name" placeholder="Categoría">
                        <label for="name">Nombre</label>
                    </div>                    
                    <button type="button" class="btn btn-primary" onclick="registerCategory(event);" id="btnAction">Registrar</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                </form>

            </div>
        </div>
    </div>
</div>
<?php include "Views/Templates/footer.php"; ?>