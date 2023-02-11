<?php include "Views/Templates/header.php" ?>

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

<!--Format of the New Users table-->
<div class="modal fade" id="my_modal" tabindex="-1" role="dialog" aria-labelledby="Label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-dark text-white">
                <h5 class="modal-title" id="title">Nueva Categoría</h5>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- aqui se debe agregar el codigo recortado-->
                <form method="post" id="frmCategory">
                    <div class="form-floating mb-3">                        
                        <input type="hidden" id="id" name="id">
                        <input type="text" class="form-control" name="category" id="category" placeholder="Categoría">
                        <label for="user">Nombre</label>
                    </div>                    
                    <button type="button" class="btn btn-primary" onclick="registerCategory(event);" id="">Registrar</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                </form>

            </div>
        </div>
    </div>
</div>
<?php include "Views/Templates/footer.php"; ?>