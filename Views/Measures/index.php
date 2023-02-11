<?php include "Views/Templates/header.php" ?>

<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item active">Metricas</li>
</ol>

<button class="btn btn-primary mb-2" type="button" onclick="frmMeasures();"> <i class="fas fa-plus"></i></button>

<div class="table-responsive">
    <table class="table table-light" id="tblProducts">
        <thead class="thead-dark">
            <tr>
                <th>Id</th>
                <th>Nombre</th>
                <th>Nombre corto</th>
                <th>Status</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>
<div class="modal fade" id="my_modal" tabindex="-1" aria-labelledby="Label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="title"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="frmMeasures" method="post">
                    <div class="form-floating mb-3">
                        <input type="hidden" id="id" name="id">
                        <input type="text" class="form-control" name="name" id="name" placeholder="Nombre">
                        <label for="name">Nombre</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" short_name="name" id="name" placeholder="Nombre corto">
                        <label for="short_name">Nombre corto</label>
                    </div>
                    <button class="btn btn-primary" type="button" onclick="registerMeasure(event)"></button>
                    <button class="btn btn-primary" type="button" data-bs-dismiss="modal">Cancelar</button>
                </form>

            </div>
        </div>
    </div>
</div>
<?php include "Views/Templates/footer.php"; ?>