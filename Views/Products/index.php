<?php include "Views/Templates/header.php" ?>

<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item active">Products</li>
</ol>

<button class="btn btn-primary mb-2" type="button" onclick="frmProduct();">Nuevo producto <i class="fas fa-plus"></i></button>


<table class="table table-light" id="tblProducts">
    <thead class="thead-dark">
        <tr>
            <th>Id</th>
            <th>Codigo</th>
            <th>Descripción</th>
            <th>Precio</th>
            <th>Cantidad</th>
            <th>Estado</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
    </tbody>
</table>

<!--Format of the New Products table-->
<div class="modal fade" id="my_modal" tabindex="-1" role="dialog" aria-labelledby="Label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-dark text-white">
                <h5 class="modal-title" id="title">Nuevo Producto</h5>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- aqui se debe agregar el codigo recortado-->
                <form method="post" id="frmProduct">
                    <div class="form-floating mb-3">
                        <input type="hidden" id="id" name="id">
                        <input type="text" class="form-control" name="code" id="code" placeholder="Codigo">
                        <label for="code">Código</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="description" id="description" placeholder="Descripción">
                        <label for="description">Descripción</label>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="purchase_price" class="form-control" name="purchase_price" id="purchase_price" placeholder="Precio compra">
                                <label for="purchase_price">Precio Compra</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="selling_price" class="form-control" name="selling_price" id="selling_price" placeholder="Precio venta">
                                <label for="selling_price">Precio venta</label>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-floating mb-3">
                                <select name="measure" id="measure" class="form-control">
                                    <?php
                                    foreach ($data['measures'] as $row) { ?>
                                        <option value="<?php echo $row['name'] ?>"></option>
                                    <?php } ?>
                                </select>
                                <label for="measure">Medidas</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating mb-3">
                                <select name="category" id="category" class="form-control">
                                    <?php
                                    foreach ($data['categories'] as $row) { ?>
                                        <option value="<?php echo $row['name'] ?>"></option>
                                    <?php } ?>
                                </select>
                                <label for="category">Categorías</label>
                            </div>
                        </div>
                    </div>

                    <button type="button" class="btn btn-primary" onclick="registerProduct(event);" id="">Registrar</button>
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