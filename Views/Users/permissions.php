<?php include "Views/Templates/header.php" ?>
<div class="col-md-8 mx-auto">
    <div class="card">
        <div class="card-header text-center bg-primary text-white">
            Permisos
        </div>
        <div class="card-body">
            <form id="form" onsubmit="registerPermissions(event)">
                <div class="row">
                    <?php foreach ($data['allData'] as $row) { ?>
                        <div class="col-md-4 text-center text-capitalize p-2">
                            <label for=""><?php echo $row['permission']; ?></label><br>              
                            <input type="checkbox" name="permissions[]" value="<?php echo $row['id']; ?>" <?php echo isset($data['assigned'][$row['id']]) ? 'checked' : '' ; ?>>
                        </div>
                    <?php } ?>
                    <input type="hidden" value="<?php echo $data['id_user']; ?>" name="id_user">
                </div>
                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-outline-primary">Asignar permisos</button>
                    <a  class="btn btn-outline-danger" href="<?php echo base_url;?>Users">Regresar</a>
                </div>
            </form>
        </div>
    </div>
</div>
<?php include "Views/Templates/footer.php" ?>
