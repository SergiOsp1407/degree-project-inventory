<?php include "Views/Templates/header.php"; ?>

<div class="card">
    <div class="card-header bg-dark text-white">
        Datos de la empresa
    

    </div>
    <div class="card-body">
        <form id="frmCompany">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <input id="id" class="form-control" type="hidden" name="id" value="<? echo $data['id']?>">
                        <label for="name">Nombre</label>
                        <input id="name" class="form-control" type="text" name="name" placeholder="Nombre" value="<? echo $data['name']?>>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="phone">Teléfono</label>
                        <input id="phone" class="form-control" type="text" name="phone" placeholder="Teléfono" value="<? echo $data['phone']?>>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="address">Dirección</label>
                        <input id="address" class="form-control" type="text" name="address" placeholder="Dirección" value="<? echo $data['address']?>>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="message">Mensaje</label>
                        <textarea name="message" id="message" rows="3" class="form-control" placeholder="Mensaje">value="<? echo $data['message']?></textarea>
                    </div>
                </div>
            </div>


            <button class="btn btn-primary" type="button" onclick="modifyCompany()">Modificar</button>
        </form>
    </div>
</div>




<?php include "Views/Templates/footer.php"; ?>