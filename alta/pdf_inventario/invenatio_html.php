<link rel="stylesheet" href="../../css/materialize.min.css" type="text/css">
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
    .red {
        background: #ffcccc;
    }
    .green {
        background: #bfff00;
    }
    .yellow{
        background: yellow;
     }
</style>

<page >
    

        <h1>Inventario</h1>
    <br>
    <table border="1" cellspacing="0" style="width: 100%; text-align: center; font-size: 11pt;">
            <tr>
                <td style="width:1%;" class='midnight-blue'>#</td>
                <td style="width:15%;" class='midnight-blue'>Codigo</td>
                <td style="width:15%;" class='midnight-blue'>Nombre Comercial</td>
                <td style="width:15%;" class='midnight-blue'>Formula</td>
                <td style="width:10%;" class='midnight-blue'>Presentacion</td>
                <td style="width:10%;" class='midnight-blue'>Categoria</td>
                <td style="width:5%;" class='midnight-blue'>precio Entrada</td>
                <td style="width:5%;" class='midnight-blue'>precio Salida</td>
                <td style="width:5%;" class='midnight-blue'>Inventario</td>

            </tr>
            <?php $i = 1;  ?>
            <?php
            while($medicamento = $medicamentos->fetch_assoc()): 
              $med->setCve_medicamento($medicamento['cve_medicamento']);
              $medicamento['inventario'] = $med->medicationStock();
              $color = '';
            ?>

            <?php 
            
            if($medicamento['inventario'] == 0) {
                $color ='red' ;
            }  elseif( (int)$medicamento['inventario'] > (int)$medicamento['stock_minimo']) {
                $color = 'green' ; 
            } else {
                $color = 'yellow';
            }
            
            
            ?>
            <tr>
                <td style="width:4%;" class="silver"><?=$i?></td>
                <td style="width:10%;" class="silver"><?=$medicamento['cve_medicamento']?></td>
                <td style="width:10%;" class="silver"><?=$medicamento['nombre_comercial']?></td>
                <td style="width:10%;" class="silver"><?=$medicamento['nombre_generico']?></td>
                <td style="width:10%;" class="silver"><?=$medicamento['presentacion']?></td>
                <td style="width:10%;" class="silver"><?=$medicamento['categoria']?></td>
                <td style="width:10%;" class="silver"><?=$medicamento['precio_adquisitivo']?> </td>
                <td style="width:10%;" class="silver"><?=$medicamento['precio_venta']?></td>
                <td style="width:10%;" class="silver <?=$color?>"><?=$medicamento['inventario']?></td>
            </tr>
            <?php $i++?>
<?php endwhile;?>
    </table>
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
  </page>