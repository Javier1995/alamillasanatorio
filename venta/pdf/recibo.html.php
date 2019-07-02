<style type="text/css">

    table { vertical-align: top; }
    tr    { vertical-align: top; }
    td    { vertical-align: top; }
    .midnight-blue{
        background:#2c3e50;
        padding: 4px 4px 4px;
        color:white;
        font-weight:bold;
        font-size:12px;
    }
    .silver{
        background:white;
        padding: 3px 4px 3px;
    }
    .clouds{
        background:#ecf0f1;
        padding: 3px 4px 3px;
    }
    .border-top{
        border-top: solid 1px #bdc3c7;

    }
    .border-left{
        border-left: solid 1px #bdc3c7;
    }
    .border-right{
        border-right: solid 1px #bdc3c7;
    }
    .border-bottom{
        border-bottom: solid 1px #bdc3c7;
    }
    table.page_footer {width: 100%; border: none; background-color: white; padding: 2mm;border-collapse:collapse; border: none;}


</style>
<page backtop="15mm" backbottom="15mm" backleft="15mm" backright="15mm" style="font-size: 12pt; font-family: arial" >
    <page_footer>
        <table class="page_footer">
            <tr>

                <td style="width: 50%; text-align: left">
                    P&aacute;gina [[page_cu]]/[[page_nb]]
                </td>
                <td style="width: 50%; text-align: right">
                    &copy; <?=
                    "Sanatorio Alamilla";
                    date('Y');
                    ?>
                </td>
            </tr>
        </table>
    </page_footer>

    <table cellspacing="0" style="width: 100%;">
        <tr>

            <td style="width: 25%; color: #444444;">
                <img style="width: 100%;" src="../../img/logo2.jpg" alt="Logo"><br>

            </td>
            <td style="width: 50%; color: #34495e;font-size:12px;text-align:center">
                <span style="color: #34495e;font-size:14px;font-weight:bold"><?= 'Sanatorio Alamilla' ?></span>
                <br><?= 'Av. Juárez No.612 Col. Centro Comalcalco, Tabasco.' ?><br> 
                Teléfono: <?= '(933) 334 00 78' ?><br>
                Email: <?= 'dralamilla@yahoo.com' ?>

            </td>
            <td style="width: 12%;text-align:right">
                RECIBO Nº<?= $atendio->recibo ?>
            </td>
            <td style="width: 13%;text-align:right"> <qrcode value="<?=RUTA_BASE.'venta/pdf/recibo.pdf.php?pe='.$nota?>" style="border: none; width: 20mm;"></qrcode></td>

        </tr>
    </table>
    <br>





    <br>
    <table cellspacing="0" style="width: 100%; text-align: left; font-size: 11pt;">
        <tr>
            <td style="width:35%;" class='midnight-blue'>ATENDIO</td>
            <td style="width:25%;" class='midnight-blue'>FECHA</td>
            <td style="width:20%;" class='midnight-blue'>FORMA DE PAGO</td>

        </tr>
        <tr>
            <td style="width:35%;"> <?= $atendio->nombre . ' ' . $atendio->apellidos ?></td>
            <td style="width:25%;"><?= $atendio->fecha ?></td>
            <td style="width:20%;" >EFECTIVO</td>
            <td style="width:20%;">
            </td>
        </tr>



    </table>
    <br>

    <table cellspacing="0" style="width: 100%; text-align: left; font-size: 10pt;">
        <tr>
            <th style="width: 10%;text-align:center" class='midnight-blue'>CANT.</th>
            <th style="width: 50%" class='midnight-blue'>DESCRIPCION</th>
            <th style="width: 12%;text-align: right" class='midnight-blue'>PRECIO UNIT.</th>
            <th style="width: 13%;text-align: right" class='midnight-blue'>DESCUENTO</th>
            <th style="width: 12%;text-align: right" class='midnight-blue'>PRECIO TOTAL</th>

        </tr>


        <?php
        $subtotal = 0;
        $descuento = 0;
        $total = 0;
        ?>
        <?php while ($recibo = $pedidos->fetch_object()): ?>
            <tr>
                <td class="silver" style="width: 10%; text-align: center"><?= $recibo->cantidad ?></td>
                <td class="silver" style="width: 50%; text-align: left"><?= $recibo->nombre_comercial . '/' . $recibo->nombre_generico . ' ' . $recibo->presentacion . ' ' . $recibo->unidades_caja . ' ' . $recibo->nombre ?></td>
                <td class="silver" style="width: 12%; text-align: right"><?= $recibo->precio ?></td>
                <td class="silver" style="width: 12%; text-align: right">-$<?= number_format(($recibo->precio * $recibo->cantidad ) * ($recibo->descuento / 100), 2) ?></td>
                <td class="silver" style="width: 12%; text-align: right">$<?= number_format(($recibo->precio * $recibo->cantidad) - ($recibo->precio * $recibo->cantidad) * $recibo->descuento / 100, 2) ?></td>        

            </tr>
            <?php
            $subtotal += $recibo->cantidad * $recibo->precio;
            $descuento += ($recibo->precio * $recibo->cantidad ) * ($recibo->descuento / 100);
            $total += ($recibo->precio * $recibo->cantidad) - ($recibo->precio * $recibo->cantidad) * $recibo->descuento / 100;
            ?>
        <?php endwhile; ?>

        <tr>
            <td colspan="5" style="width: 100%; text-align: right;font-size: 10pt; border-top: black solid 1px">SUBTOTAL &#36; <?= number_format($subtotal, 2) ?></td>

        </tr>

        <tr>
            <td colspan="5" style="width:100%; text-align: right; font-size: 10pt; ">DESCUENTO - &#36;<?= number_format($descuento, 2) ?> </td>

        </tr>

        <tr>
            <td colspan="5" style="width:100%; text-align: right; font-size: 10pt;">TOTAL &#36; <?= number_format($total, 2) ?></td>

        </tr>
        <tr>
            <td colspan="5" style="width:100%; text-align: right; font-size: 10pt;">EFECTIVO $<?= number_format($atendio->dinero, 2) ?></td>

        </tr>
        <tr>
            <td colspan="5" style="width:100%; text-align: right; font-size: 10pt;">CAMBIO $<?= number_format($atendio->dinero - $total, 2) ?></td>

        </tr>
    </table>



    <br>
    <div style="font-size:11pt;text-align:center;font-weight:bold">!Un gusto atenderte!</div>
  
    


</page>

