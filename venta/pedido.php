<?php require_once '../conexion/conexion.php'; ?>
<?php include_once './selected.php'; ?>
<?php require_once '../extend/helpers.php'; ?>
<?php include_once '../extend/header.php'; ?>
<?php if ($_SESSION['nivel'] == 'ADMINISTRADOR' || $_SESSION['nivel'] == 'VENTA'): ?>
    <?php
    $datos = recibo_pedido(filter_input(INPUT_GET, 'pe'));
    $pedidos = datos_pedidos(filter_input(INPUT_GET, 'pe'));
    ?>
    <div class="row">

        <div class="col l12 s12">

            <div class="card">

                <div class="card-content">
                    <span class="card-title">Resumen de compra <strong>N° <?= $datos->recibo ?></strong> Atendio: <?= $datos->nombre . ' ' . $datos->apellidos ?> <span class=" white-text green badge"><strong>Fecha <?= $datos->fecha ?></strong></span></span>
                    <button class="btn green" onclick="printJS({printable: '<?= RUTA_BASE ?>venta/pdf/recibo.pdf.php?pe=<?= $_GET['pe'] ?>', type: 'pdf', showModal: true})" > <i class="material-icons left">print</i>Imprimir</button>
                    <div class="row">

                        <div class="col s12 l12">

                            <table class="responsive-table striped centered">

                                <thead>

                                    <tr>
                                        <th>#</th>
                                        <th>Nombre Generico</th>
                                        <th>Presentacion</th>
                                        <th>Precio U.</th>
                                        <th>Cantidad</th>
                                        <th>Subtotal</th>
                                        <th>Importe</th>
                                        <th>Desc(%)</th>
                                        <th>Desc($)</th>

                                    </tr>

                                </thead>

                                <tbody>
                                    <?php
                                    $con = 1;
                                    $descuento = 0;
                                    $subtotal = 0;
                                    $total = 0;
                                    ?>
                                    <?php while ($pedido = $pedidos->fetch_object()): ?>
                                        <tr>
                                            <td><?= $con ?></td>
                                            <td><?= $pedido->nombre_generico ?></td>
                                            <td><?= $pedido->presentacion ?></td>
                                            <td>$<?= $pedido->precio ?></td>
                                            <td><?= $pedido->cantidad ?></td>
                                            <td>$<?= number_format($pedido->cantidad * $pedido->precio, 2) ?></td>
                                            <td>$<?= number_format(($pedido->precio * $pedido->cantidad) - ($pedido->precio * $pedido->cantidad) * $pedido->descuento / 100, 2) ?></td>
                                            <td>-<?= $pedido->descuento ?> %</td>
                                            <td>-$<?= number_format(($pedido->precio * $pedido->cantidad ) * ($pedido->descuento / 100), 2) ?></td>


                                        </tr>

                                        <?php
                                        $subtotal += $pedido->cantidad * $pedido->precio;
                                        $descuento += ($pedido->precio * $pedido->cantidad ) * ($pedido->descuento / 100);
                                        $total += ($pedido->precio * $pedido->cantidad) - ($pedido->precio * $pedido->cantidad) * $pedido->descuento / 100;
                                        $con++;

                                    endwhile;
                                    ?>
                                </tbody>


                            </table>
                        </div>

                    </div>
                </div>

            </div>

        </div>
    </div>

    <div class="row">
        <div class="col l4 s12">
            <div class="card grey lighten-4">

                <div class="card-content">

                    <div class="row">
                        <div class="col l12 s12">
                            <hr>
                            <h5>Sub-total: <strong>$<?= number_format($subtotal, 2) ?></strong></h5>
                            <h5>Descuento: <strong>$<?= number_format($descuento, 2) ?></strong></h5>
                            <h5>Total: <strong>$<?= number_format($total, 2) ?></strong></h5>
                            <h5>Efectivo: <strong>$<?= number_format($datos->dinero, 2) ?></strong></h5>
                            <h5>Cambio: <strong>$<?= number_format($datos->dinero - $total, 2) ?></strong></h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="fixed-action-btn animated zoomIn">
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