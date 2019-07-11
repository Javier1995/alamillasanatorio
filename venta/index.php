<?php include_once './selected.php'; ?>
<?php include_once '../extend/header.php'; ?>
<?php if ($_SESSION['nivel'] == 'ADMINISTRADOR' || $_SESSION['nivel'] == 'VENTA'): ?>

<div class="row">
    <div class="col s12 l3 ">
        <div class="card orange lighten-3 ">
            <div class="card-content">
                <span class="card-title">Monto vendido<i class="small material-icons left" aria-hidden="true">monetization_on</i></span>
                <div class="row">
                    <div class="col s6 112">
                        <h3><div id="total_vendido"></div></h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col s12 l3">
            <div class="card blue lighten-3 ">
                <div class="card-content">
                    <span class="card-title">Compras <i class="material-icons small left">
                        view_list
                        </i></span>
                    <div class="row">
                        <div class="col s6 112">
                            <h3><div id="pedidos"></div></h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col s12 l3">
            <div class="card orange lighten-3 ">
                <div class="card-content">
                    <span class="card-title">Productos <i class="material-icons small left">
                    shopping_cart
                        </i></span>
                    <div class="row">
                        <div class="col s12 112">
                            <h3><div id="productos"></div></h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>


      


<div class="row">
    <div class="col l12 s12">
        <div id="lista_pedidos"></div>
    </div>
</div>




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
<script src="../js/Pagination.js"></script>
<script src="app_venta.js"></script>
<script type="text/javascript" src="../js/validacion_user.js"></script>

</body>

</html>
<?php endif; ?>

<?php Elimina_id_url(); ?>