<?php include "Views/Templates/header.php" ?>

<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item active">Products</li>
</ol>

<button class="btn btn-primary mb-2" type="button" onclick="frmProduct();">Nuevo producto <i class="fas fa-plus"></i></button>
<div class="table-responsive">
<table class="table table-light" id="tblProducts">
    <thead class="thead-dark">
        <tr>
            <th>Id</th>
            <th>Imagen</th>
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
</div>
<div class="modal fade" id="my_modal" tabindex="-1" aria-labelledby="Label" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-dark text-white">
                <h5 class="modal-title" id="title">Nuevo Producto</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <!-- <span aria-hidden="true">&times;</span> -->
                </button>                
            </div>
            <div class="modal-body">
            <form method="post" id="frmProduct">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-floating mb-3">
                            <input type="hidden" id="id" name="id">
                            <input type="text" class="form-control" name="code" id="code" placeholder="Codigo">
                            <label for="code">Código de barras</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" name="description" id="description" placeholder="Descripción">
                            <label for="description">Descripción</label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-floating mb-3">
                            <input type="purchase_price" class="form-control" name="purchase_price" id="purchase_price" placeholder="Precio compra">
                            <label for="purchase_price">Precio Compra</label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-floating mb-3">
                            <input type="selling_price" class="form-control" name="selling_price" id="selling_price" placeholder="Precio venta">
                            <label for="selling_price">Precio venta</label>
                        </div>
                    </div>
                    <div class="col-md-4">
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
                    <div class="col-md-5">
                        <div class="form-floating mb-3">
                            <select name="category" id="category" class="form-control">
                                <?php
                                foreach ($data['categories'] as $row) { ?>
                                    <option value="<?php echo $row['name']; ?>"></option>
                                <?php } ?>
                            </select>
                            <label for="category">Categorías</label>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-floating mb-3">
                            <label>Imagen</label>
                            <div class="card border-primary">
                                <div class="card-body">
                                    <label for="image" id="icon-image" class="btn btn-primary"><i class="fas fa-image"></i></label>
                                    <span id="icon-close"></span>
                                    <input id="image" class="d-none" type="file" name="image" onchange="preview(event)">
                                    <input type="hidden" id="actual_image" name="actual_image">
                                    <img class="img-thumbnail" id="img-preview">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <button type="button" class="btn btn-primary" onclick="registerProduct(event);" id="btnAction">Registrar</button>
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
            </form>                
            </div>            
        </div>
    </div>
</div>
<?php include "Views/Templates/footer.php"; ?>