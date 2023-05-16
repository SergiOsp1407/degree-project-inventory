<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Panel Administrativo</title>
        <link href="<?php echo base_url; ?>Assets/css/styles.css" rel="stylesheet" />
        <link href="<?php echo base_url; ?>Assets/DataTables/datatables.min.css"/>
        <link href="<?php echo base_url; ?>Assets/css/select2.min.css" rel="stylesheet"/>
        <link href="<?php echo base_url; ?>Assets/css/personalStyles.css" rel="stylesheet"/>
        <script src="<?php echo base_url; ?>Assets/js/all.min.js"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark"><br>
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="<?php echo base_url; ?>Administration/home"><img src="<?php echo base_url; ?>Assets/img/cebiche.png" class="img-fluid rounded" alt="logo" width="69">Speed Bikers</a>
            
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
            <!-- Navbar Search-->
            <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
                <div class="input-group">
                    <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..." aria-describedby="btnNavbarSearch" />
                    <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button>
                </div>
            </form>
            <!-- Navbar -- If We decide to delete the search bar, we have to put this in the navbar of perfil (mb-2 mb-lg-0)-->
            <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#changePassword">Cambiar contraseña</a></li>
                        <li><a class="dropdown-item" href="<?php echo base_url; ?>Administration">Configuración</a></li>
                        <!-- <li><hr class="dropdown-divider" /></li>                         -->
                        <li><a class="dropdown-item" href="<?php echo base_url; ?>Users/logout">Cerrar Sesión</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                            <div class="nav">
                            <!-- Dashboard that maybe can work in the future -->
                            <div class="sb-sidenav-menu-heading">Core</div>
                            <a class="nav-link" href="<?php echo base_url; ?>Administration/home">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt fa-2x text-danger"></i></div>
                                Dashboard
                            </a>

                            <div class="sb-sidenav-menu-heading">Interface</div>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-cogs fa-2x text-danger"></i></div>
                                Administración
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="<?php echo base_url; ?>Users"><i class="fas fa-user mr-2"></i>&nbsp;Usuarios</a>
                                    <a class="nav-link" href="<?php echo base_url; ?>Administration"><i class="fas fa-tools mr-2"></i>&nbsp;Configuración</a>
                                </nav>
                            </div>

                            <!--Products-->
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseProduct" aria-expanded="false" aria-controls="collapseProduct">
                                <div class="sb-nav-link-icon"><i class="fab fa-codepen fa-2x text-danger"></i></div>
                                Productos
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseProduct" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="<?php echo base_url; ?>Products"><i class="bi bi-boxes"></i>&nbsp;Productos</a>
                                    <a class="nav-link" href="<?php echo base_url; ?>Categories"><i class="bi bi-tags-fill"></i>&nbsp;Categorias</a>
                                    <a class="nav-link" href="<?php echo base_url; ?>Measures"><i class="bi bi-rulers"></i>&nbsp;Medidas</a>
                                </nav>
                            </div>

                            <!--Cash Register (Cajas)-->
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseCashRegister" aria-expanded="false" aria-controls="collapseCashRegister">
                                <div class="sb-nav-link-icon"><i class="fas fa-box fa-2x text-danger"></i></div>
                                Cajas - Balances
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseCashRegister" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="<?php echo base_url; ?>CashRegister"><i class="bi bi-cash-coin"></i>&nbsp;Cajas</a>
                                    <a class="nav-link" href="<?php echo base_url; ?>CashRegister/cash_balance"><i class="bi bi-plus-slash-minus"></i>&nbsp;Balances</a>
                                </nav>
                            </div>

                            <!-- Clients -->
                            <a class="nav-link" href="<?php echo base_url; ?>Clients">
                                <div class="sb-nav-link-icon"><i class="fas fa-users fa-2x text-danger"></i></div>
                                Clientes
                            </a>

                            <!--Purchases (Entradas)-->
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePurchases" aria-expanded="false" aria-controls="collapsePurchases">
                                <div class="sb-nav-link-icon"><i class="fas fa-shipping-fast fa-2x text-danger"></i></div>
                                Compras
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapsePurchases" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="<?php echo base_url; ?>Purchases"><i class="bi bi-receipt-cutoff "></i>&nbsp;Nueva Compra</a>
                                    <a class="nav-link" href="<?php echo base_url; ?>Purchases/history"><i class="bi bi-clock-history "></i>&nbsp;Historial Compras</a>
                                </nav>
                            </div>

                            <!--Sales (Ventas)-->
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseSales" aria-expanded="false" aria-controls="collapseSales">
                                <div class="sb-nav-link-icon"><i class="fas fa-cash-register fa-2x text-danger"></i></div>
                                Ventas
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseSales" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="<?php echo base_url; ?>Purchases/sales"><i class="fas fa-shopping-cart mr-2"></i>&nbsp;Nueva venta</a>
                                    <a class="nav-link" href="<?php echo base_url; ?>Purchases/sales_history"><i class="bi bi-clock-history"></i>&nbsp;Historial Ventas</a>
                                </nav>
                            </div>

                        <!-- Addons or puglins to create report like Chart (grafica pastel) or Tables
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                                <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                                Pages
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseAuth" aria-expanded="false" aria-controls="pagesCollapseAuth">
                                        Authentication
                                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                    </a>
                                    <div class="collapse" id="pagesCollapseAuth" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                                        <nav class="sb-sidenav-menu-nested nav">
                                            <a class="nav-link" href="login.html">Login</a>
                                            <a class="nav-link" href="register.html">Register</a>
                                            <a class="nav-link" href="password.html">Forgot Password</a>
                                        </nav>
                                    </div>
                                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseError" aria-expanded="false" aria-controls="pagesCollapseError">
                                        Error
                                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                    </a>
                                    <div class="collapse" id="pagesCollapseError" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                                        <nav class="sb-sidenav-menu-nested nav">
                                            <a class="nav-link" href="401.html">401 Page</a>
                                            <a class="nav-link" href="404.html">404 Page</a>
                                            <a class="nav-link" href="500.html">500 Page</a>
                                        </nav>
                                    </div>
                                </nav>
                            </div>
                            <div class="sb-sidenav-menu-heading">Addons</div>
                            <a class="nav-link" href="charts.html">
                                <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                                Charts
                            </a>
                            <a class="nav-link" href="tables.html">
                                <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                                Tables
                            </a> -->
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small" style="color:#E5383B; font-weight: bold;">Usuario en sesión:</div>
                        <span style="color:whitesmoke">
                            <?php echo $_SESSION['user']; ?>
                        </span>
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4 mt-4">
                        
                        
                        