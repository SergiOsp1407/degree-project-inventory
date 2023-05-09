<?php include "Views/Templates/header.php"; ?>
<div class="row">
    <div class="col-xl-3 col-md-6">
        <div class="card bg-dark text-white mb-4">
            <div class="card-body">
                <i class="fas fa-user fa-2x"></i>
                Usuarios
            </div>
            <div class="card-footer d-flex align-items-center justify-content-between">
                <a class="small text-white stretched-link" href="<?php echo base_url; ?>Users">Ver detalle</a>
                <span class="text-white"><?php echo $data['users']['total']?></span>
                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card bg-danger text-white mb-4">
            <div class="card-body">
                <i class="fas fa-users fa-2x"></i>
                Clientes
            </div>
            <div class="card-footer d-flex align-items-center justify-content-between">
                <a class="small text-white stretched-link" href="<?php echo base_url; ?>Clients">Ver detalle</a>
                <span class="text-white"><?php echo $data['clients']['total']?></span>
                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card bg-secondary text-white mb-4">
            <div class="card-body">
                <i class="fab fa-codepen fa-2x"></i>
                Productos
            </div>
            <div class="card-footer d-flex align-items-center justify-content-between">
                <a class="small text-white stretched-link" href="<?php echo base_url; ?>Products">Ver detalle</a>
                <span class="text-white"><?php echo $data['products']['total']?></span>
                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card bg-dark  text-white mb-4">
            <div class="card-body">
                <i class="fas fa-cash-register fa-2x"></i>
                Ventas por dia
            </div>
            <div class="card-footer d-flex align-items-center justify-content-between">
                <a class="small text-white stretched-link" href="<?php echo base_url; ?>Purchases/sales_history">Ver detalle</a>
                <span class="text-white"><?php echo $data['sales']['total']?></span>
                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card bg-danger text-white mb-4">
            <div class="card-body">
                <i class="fas fa-cash-register fa-2x"></i>
                Otros
            </div>
            <div class="card-footer d-flex align-items-center justify-content-between">
                <a class="small text-white stretched-link" href="<?php echo base_url; ?>Purchases/#">Ver detalle</a>
                <span class="text-white"><?php echo $data['products']['total']?></span>
                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xl-6">
        <div class="card mb-4">
            <div class="card-header bg-dark text-white">
                <i class="fas fa-chart-area me-1"></i>
                Productos con poca existencia en Inventario
            </div>
            <div class="card-body"><canvas id="minimumStock" width="100%" height="40"></canvas></div>
        </div>
    </div>
    <div class="col-xl-6">
        <div class="card mb-4">
            <div class="card-header bg-dark text-white">
                <i class="fas fa-chart-bar me-1"></i>
                Producto más vendidos
            </div>
            <div class="card-body"><canvas id="soldProducts" width="100%" height="40"></canvas></div>
        </div>
    </div>
</div>

<?php include "Views/Templates/footer.php"; ?>