<?php include_once './selected.php'; ?>
<?php include_once '../extend/header.php'; ?>
<link rel="stylesheet" type="text/css" href="../css/preloader.css" />
<?php if ($_SESSION['nivel'] == 'ADMINISTRADOR' || $_SESSION['nivel'] == 'VENTA'): ?>
    <body>
        <br>

        <div class="col">
            <button class="btn red" onclick="window.history.back()"><i class="material-icons left">arrow_back</i> Regresar</button>
        </div>

        <div class="row">
            <div class="col s12 m12 l6">
                <div class="card horizontal">
                    <div class="card-image blue lighten-2">
                        <img src="../img/bar.png">
                    </div>
                    <div class="card-stacked">
                        <div class="card-content blue darken-4 ">

                            <div class="input-field s12 m6 l12">
                                <input class="white-text autocomplete" type="text" id="code" onkeyup="listar_venta(event)" placeholder="Inserte codigo.." maxlength="13"  autofocus="on">   
                            </div>

                        </div>

                    </div>
                </div>
            </div>

            <div id="info">

            </div>


        </div>
        <div class="row">
            <div class="col s12 m12 l4 offset-l4" >
                <div id="cargando"></div>
            </div>
        </div>



        <div class="row">

            <div class="col l8 s12">

                <div class="card">

                    <div class="card-content">
                        <span class="card-title">Lista de compras</span>
                        <div class="row">

                            <div class="col s12 l12">

                                <table class="responsive-table striped centered">

                                    <thead>

                                        <tr>
                                            <th>#</th>
                                            <th>Codigo</th>
                                            <th>Nombre Generico</th>
                                            <th>Nombre Comercial</th>
                                            <th>Presentacion</th>
                                            <th>Precio U.</th>
                                            <th title="cantidad">Cant.</th>
                                            <th>Importe($)</th>
                                            <th title="Descuento">Desc(%)</th>
                                            <th>Borrar</th>

                                        </tr>

                                    </thead>

                                    <tbody id="tbody">


                                        <?php if (isset($_SESSION['medicamento']['cart'])): ?>
                                            <?php $cont = 1;
                                            $subtotal = 0;
                                            $total = 0;
                                            $descuento = 0;
                                            ?>
        <?php foreach ($_SESSION['medicamento']['cart'] as $index => $value): ?>
                                                <tr>
                                                    <td><?= $cont ?></td>
                                                    <td><?= $value['cve_medicamento'] ?></td>
                                                    <td><?= $value['nombre_generico'] ?></td>
                                                    <td><?= $value['nombre_comercial'] ?></td>
                                                    <td><?= $value['presentacion'] ?></td>
                                                    <td>$<?= $value['precio'] ?></td>
                                                    <td><?= $value['unidad'] ?></td>
                                                    <td>$<?= number_format($value['precio'] * $value['unidad'] - ($value['precio'] * $value['unidad']) * ($value['descuento'] / 100), 2) ?></td>
                                                    <td><input type="text"  onblur="listar_venta(event,<?= $value['cve_medicamento'] ?>, this.value)" max="100" min="0" value="<?= isset($_SESSION['medicamento']['cart']) ? $value['descuento'] : 0 ?>"/></td>
                                                    <td><button class="btn-floating red" onclick="borrar_item(<?= $value['cve_medicamento'] ?>, 1)"><i class="material-icons">cancel</i></button></td>
                                                </tr>
                                                <?php
                                                $cont++;
                                                $subtotal += ($value['precio'] * $value['unidad']);
                                                $descuento += ($value['precio'] * $value['unidad']) * ($value['descuento']/100);
                                                $total+=($value['precio'] * $value['unidad'])-($value['precio'] * $value['unidad']) * $value['descuento']/100;
                                            endforeach;
                                            ?>
    <?php else: ?>
                                            <tr >

                                                <td colspan="10"><h3>No hay ningun producto en la lista de compra</h3></td>
                                            </tr>      
    <?php endif; ?> 
                                    </tbody>


                                </table>
                            </div>

                        </div>
                    </div>

                </div>

            </div>


            <div class="col l4 s12">

                <div class="card grey lighten-4">

                    <div class="card-content">

                        <div class="row">
                            <div class="col l12 s12">
                                <table>
                                    <thead>
                                        <tr>
                                            <th>Subtotal</th>
                                            <th>Descuento($)</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
    <?php if (isset($_SESSION['medicamento']['cart']) && count($_SESSION['medicamento']['cart']) >= 1): ?>
                                            <tr>
                                                <td id="subtotal">$<?= number_format($subtotal, 2) ?></td>
                                                <td id="desc">$<?= number_format($descuento, 2)?></td>
                                                <td id="total">$<?= number_format($total, 2)?></td>
                                            </tr>
    <?php else: ?>
                                            <tr>
                                                <td id="subtotal">$0.00</td>
                                                <td id="desc">$0.00</td>
                                                <td id="total">$0.00</td>
                                            </tr>

    <?php endif; ?>
                                    </tbody>


                                </table>
                            </div>
                        </div>

                        <div class="row">
                            <form action="#" id="cliente_paga">
                                <div id="caja">
                                    <div class="input-field col s6 l6">
                                    <input type="text" id="money" placeholder="Efectivo.." <?= (isset($_SESSION['medicamento']['cart']) && count($_SESSION['medicamento']['cart']) >= 1) ? '' : 'disabled' ?>>
                                    </div>
                                    <div class="input-field col s3 l3">
                                        <button type="submit" class="btn" <?= (isset($_SESSION['medicamento']['cart']) && count($_SESSION['medicamento']['cart']) >= 1) ? '' : 'disabled' ?>><i class="material-icons">
                                                attach_money
                                            </i></button>
                                    </div>
                                    <div class="input-field col s3 l3 ">
                                        <button onclick="borrar_compra()" class="btn red" <?= (isset($_SESSION['medicamento']['cart']) && count($_SESSION['medicamento']['cart']) >= 1) ? '' : 'disabled' ?>><i class="material-icons">
                                                cancel
                                            </i></button></button>
                                    </div>
                                </div>
                            </form>
                        </div>

                    </div>



                </div>

            </div>


        </div>






        <?php include_once '../extend/preloader.php'; ?>
        <?php include_once '../extend/errorMessage.php' ?>
        <?php include '../extend/scripts.php'; ?>
        <script src="app_venta.js"></script>
    <?php include_once '../extend/footer.php'; ?>
    <!--        <script>
            //Notifica el usuario que la compra sera borrada si cambia de pagina
            function cambiar(e) {
                var dialogText = '¿Seguro que quieres salir?';
                e.returnValue = dialogText;
                return dialogText;
            }
            ;

        </script>-->
    </body>
    </html>
<?php else: header("Location:../"); ?>

<?php endif; ?>

<?php Elimina_id_url(); ?>