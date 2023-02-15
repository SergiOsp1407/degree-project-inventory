<?php include "Views/Templates/header.php" ?>
<div class="col-md-8 mx-auto">
    <div class="card">
        <div class="card-header text-center bg-primary text-white">
            Permisos
        </div>
        <div class="card-body">
            <form id="form">
                <div class="row">
                    <?php foreach ($data as $row) { ?>
                        <div class="col-md-4 text-center text-capitalize p-2">
                            <label for=""><?php echo $row['permission']; ?></label><br>              
                            <input type="checkbox">
                        </div>
                    <?php } ?>
                </div>
                <button type="button" class="btn btn-primary">Asignar permisos</button>
            </form>
        </div>
    </div>




</div>
<?php include "Views/Templates/footer.php" ?>
