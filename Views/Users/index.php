<?php include "Views/Templates/header.php" ?>

<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item active">Users</li>
</ol>

<button class="btn btn-primary mb-2" type="button" onclick="frmUser();">Nuevo usuario <i class="fas fa-plus"></i></button>


<table class="table table-light" id="tblUsers">
    <thead class="thead-dark">
        <tr>
            <th>Id</th>
            <th>Usuario</th>
            <th>Nombre</th>
            <th>Caja</th>
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
                <h5 class="modal-title" id="title">Nuevo Usuario</h5>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- aqui se debe agregar el codigo recortado-->
                <form method="post" id="frmUser">
                    <div class="form-floating mb-3">                        
                        <input type="hidden" id="id" name="id">
                        <input type="text" class="form-control" name="user" id="user" placeholder="Usuario">
                        <label for="user">Usuario</label>
                    </div>
                    <div class="form-floating mb-3">                        
                        <input type="text" class="form-control" name="name" id="name" placeholder="Nombre">
                        <label for="name">Nombre</label>
                    </div>
                    <div class="row" id="passwords">
                        <div class="col-md-6">
                            <div class="form-floating mb-3">                                
                                <input type="password" class="form-control" name="password" id="password" placeholder="Contraseña">
                                <label for="password">Contraseña</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                        <div class="form-floating mb-3">                                
                                <input type="password" class="form-control" name="confirmPassword" id="confirmPassword" placeholder="Confirmar contraseña">
                                <label for="confirmPassword">Confirmar Contraseña</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-floating mb-3">                        
                        <select name="cashRegister" id="cashRegister" class="form-control">
                        <?php
                            foreach ($data['cashRegister'] as $row) { ?> 
                            <option value="<?php echo $row['id'] ?>"></option>
                            <?php } ?>
                        </select>
                        <label for="cashRegister">Caja</label>
                    </div>
                    <button type="button" class="btn btn-primary" onclick="registerUser(event);" id="">Registrar</button>
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