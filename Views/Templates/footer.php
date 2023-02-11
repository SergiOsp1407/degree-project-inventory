</div>
            </main>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; SpeedBikers 2023</div>
                            <div>
                                <a href="#">Política de Privacidad</a>
                                &middot;
                                <a href="#">Terminos &amp; Condiciones</a>
                            </div>
                        </div>
                    </div>
                </footer>
                <!--Pendig create this div
                <div id="changePassword" class="modal fade" tabindex+="-1" role="dialog" aria-label=""> </div>
                -->
            </div>
        </div>

        <div id="changePassword" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="navbarDropdown">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-dark text-white">
                        <h5 class="modal-title" id="my-modal-title">Cambiar contraseña</h5>
                        <button class="close" data-dismis="model" aria-label="Close" >
                            <span aria-hidden="true" >&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="frmChangePassword" onsubmit="frmChangePassword(event);">
                            <div class="form-group">
                                <label for="actualPassword">Contraseña actual</label>
                                <input id="actualPassword" class="form-control" type="password" name="actualPassword" placeholder="Contraseña actual">
                            </div>
                            <div class="form-group">
                                <label for="newPassword">Contraseña nueva</label>
                                <input id="newPassword" class="form-control" type="password" name="newPassword" placeholder="Contraseña nueva">
                            </div>
                            <div class="form-group">
                                <label for="confirmPassword">Confirmar contraseña</label>
                                <input id="confirmPassword" class="form-control" type="password" name="confirmPassword" placeholder="Confirmar contraseña">
                            </div>
                            <button class="btn btn-primary" type="submit" >Cambiar contraseña</button>

                        </form>
                    </div>
                </div>
            </div>
        </div>
        <script src="<?php echo base_url; ?>Assets/js/chart.min.js"></script>
        <script src="<?php echo base_url; ?>Assets/js/jquery-3.6.3.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url; ?>Assets/DataTables/datatables.min.js"></script>
        <script src="<?php echo base_url; ?>Assets/js/scripts.js"></script>
        <script src="<?php echo base_url; ?>Assets/js/select2.min.js"></script>
        <script src="<?php echo base_url; ?>Assets/js/sweetalert2.all.min.js"></script>
        <script>
            const base_url = '<?php echo base_url; ?>';
        </script>
        <script src="<?php echo base_url; ?>Assets/js/functions.js"></script>
    </body>
</html>


