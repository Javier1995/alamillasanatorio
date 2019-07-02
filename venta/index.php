<?php include_once './selected.php'; ?>
<?php include_once '../extend/header.php'; ?>
<?php if ($_SESSION['nivel'] == 'ADMINISTRADOR' || $_SESSION['nivel'] == 'VENTA'): ?>
    <div class="row">
        <div class="col s12 l3 fadeInUp  animated fast delay-2s">
            <div class="card blue lighten-3 ">
                <div class="card-content">
                    <span class="card-title">Ventas <i class="material-icons small left">
                            shopping_cart
                        </i></span>
                    <div class="row">
                        <div class="col s6 112">

                            <h3>33</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col s12 l3 fadeInUp  animated fast delay-2s">
            <div class="card orange lighten-3 ">
                <div class="card-content">
                    <span class="card-title">Medicamentos<i class="fa fa-medkit left" aria-hidden="true"></i></span>
                    <div class="row">
                        <div class="col s6 112">

                            <h3>33</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


   <?=dirname(__FILE__)?>

    <div class="fixed-action-btn animated zoomIn delay-2s">
        <a class="btn-floating btn-large blue pulse" href="compra">
            <i class="material-icons large">
                add_shopping_cart
            </i>
        </a>
    </div>

    <?php include_once '../extend/errorMessage.php' ?>
    <?php include '../extend/scripts.php'; ?>
    <?php include_once '../extend/footer.php'; ?>
    <script type="text/javascript"  src="../js/validacion_user.js"></script>
    </body>
    </html>
<?php endif; ?>

<?php Elimina_id_url(); ?>