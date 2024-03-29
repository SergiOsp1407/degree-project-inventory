<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Ingreso - SpeedBikers</title>
        <link href="<?php echo base_url; ?>Assets/css/styles.css" rel="stylesheet"/>
    </head>
    <body class="bg-primary">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-5">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header text-center">
                                        <h3 class="font-weight-light my-4">Bienvenido!</h3>
                                        <!--Se agrega logo de SpeedBikers formato png-->
                                        <img src="<?php echo base_url; ?>Assets/img/cebiche.png" class="img-fluid rounded" alt="logo" width="150">
                                    </div>
                                    <div class="card-body">
                                        <!-- The frmLogin id is used to work with Ajax and the requests to Database -->
                                        <form id="frmLogin">
                                            <div class="form-floating mb-3">
                                                <input class="form-control" id="user" type="text" name="user" placeholder="Usuario"/>
                                                <label for="user"><i class="fas fa-user"></i> Usuario</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input class="form-control" id="password" type="password" name="password" placeholder="Contraseña" />
                                                <label for="password"><i class="fas fa-key"></i> Contraseña</label>
                                            </div>
                                            <!--Alert in login form if theres an bad input data -->
                                            <div class="alert alert-danger text-center d-none" id="alerts" role="alert"></div>

                                            <!-- <div class="form-check mb-3">
                                                <input class="form-check-input" id="inputRememberPassword" type="checkbox" value=""/>
                                                <label class="form-check-label" for="inputRememberPassword">Recordar contraseña</label>
                                            </div> -->
                                            <button type="button" class="btn btn-primary" onclick="frmLogin(event)">Iniciar Sesion</button>
                                            <!-- <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                                <a class="small" href="password.html">¿Olvidaste tu contraseña?</a>
                                                <!-- <button type="button" class="btn btn-primary"  onclick="frmLogin(event)"><a class="btn btn-primary" href="index.html" >Ingresar</a></button>
                                            </div> -->
                                        </form>
                                    </div>
                                    <!-- <div class="card-footer text-center py-3">
                                        <div class="small"><a href="register.html">¿No tienes usuario? Registrate!</a></div>
                                    </div> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
            <div id="layoutAuthentication_footer">
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; SpeedBikers <?php echo date("Y");?></div>
                            <div>
                                <a href="#">Política de privacidad</a>
                                &middot;
                                <a href="#">Terminos &amp; Condiciones</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="<?php echo base_url; ?>Assets/js/bootstrap.bundle.min.js"></script>
        <script src="<?php echo base_url; ?>Assets/js/scripts.js"></script>
        <script>
            const base_url = '<?php echo base_url; ?>';
        </script>
        <script src="<?php echo base_url; ?>Assets/js/login.js"></script>
    </body>
</html>
