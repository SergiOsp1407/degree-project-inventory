<?php include "Views/Templates/header.php"; ?>

<div class="card">
    <div class="card-header bg-dark text-white">
        Datos de la empresa
    </div>
    <div class="card-body">
        <form id="frmCompany">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-floating mb-3">
                        <input id="id" class="form-control" type="hidden" name="id" value="<?php echo $data['id']?>">
                        <input id="id_company" class="form-control" type="text" name="id_company" placeholder="Documento cliente" value="<?php echo $data['id_company']?>">
                        <label for="id_client">NIT</label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-floating mb-3">
                        <input id="name" class="form-control" type="text" name="name" placeholder="Nombre" value="<?php echo $data['name']?>">
                        <label for="name">Nombre</label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-floating mb-3">
                        <input id="phone" class="form-control" type="text" name="phone" placeholder="Teléfono" value="<?php echo $data['phone']?>">
                        <label for="phone">Teléfono</label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-floating mb-3">
                        <input id="address" class="form-control" type="text" name="address" placeholder="Dirección" value="<?php echo $data['address']?>">
                        <label for="address">Dirección</label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-floating mb-3">
                        <textarea name="message" id="message" class="form-control" placeholder="Mensaje" rows="3"><?php echo $data['message']?></textarea>
                        <label for="message">Mensaje</label>
                    </div>
                </div>
            </div>
            <button class="btn btn-primary" type="button" onclick="modifyCompany()">Modificar</button>
        </form>
    </div>
</div>
<?php include "Views/Templates/footer.php"; ?>