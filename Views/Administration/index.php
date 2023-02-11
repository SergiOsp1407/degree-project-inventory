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
                        <input id="id" class="form-control" type="hidden" name="id" value="<? echo $data['id']?>">
                        <input id="id_client" class="form-control" type="text" name="id_client" placeholder="Documento cliente" value="<? echo $data['id_client']?>">
                        <label for="id_client">Documento Cliente</label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-floating mb-3">
                        <input id="name" class="form-control" type="text" name="name" placeholder="Nombre" value="<? echo $data['name']?>">
                        <label for="name">Nombre</label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-floating mb-3">
                        <input id="phone" class="form-control" type="text" name="phone" placeholder="Teléfono" value="<? echo $data['phone']?>">
                        <label for="phone">Teléfono</label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-floating mb-3">
                        <input id="address" class="form-control" type="text" name="address" placeholder="Dirección" value="<? echo $data['address']?>">
                        <label for="address">Dirección</label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-floating mb-3">
                        <textarea name="message" id="message" rows="3" class="form-control" placeholder="Mensaje" value="<? echo $data['message']?>"></textarea>
                        <label for="message">Mensaje</label>
                    </div>
                </div>
            </div>


            <button class="btn btn-primary" type="button" onclick="modifyCompany()">Modificar</button>
        </form>
    </div>
</div>




<?php include "Views/Templates/footer.php"; ?>