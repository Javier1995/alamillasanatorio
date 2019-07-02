
var showTable = document.getElementsByClassName('corteCaja')[0];
var ShowOrder = document.getElementsByClassName('pedidoList')[0];

showTable.addEventListener("load", PaginationCashOut());
ShowOrder.addEventListener("load",PaginationOrder());


//Alert
$('#corte_caja').on('click', ()=>{

    swal({
        title: "¿Esta seguro de realizar el corte de caja?",
        text: "Una vez efectuado ya no se podra modificar nada",
        icon: "warning",
        buttons: true,
        dangerMode:false,
      })
      .then((willDelete) => {
        if (willDelete) {
         location.href = 'cashout.php';
        }
      });

});

function PaginationCashOut(page = null, limit = null) {
    $.ajax({
        url: 'corte_caja_ajax.php',
        data: {
            page: page,
            limit:limit
        },
        type: 'POST',
        dataType: 'json',
        success: (result) => {
            if (result.pages != 0) {
                var table = '';
                var right = ((result.pages == result.current_page + 1)) ? 'class="disabled"' : 'class="waves-effect"  onclick="PaginationCashOut(' + ((result.current_page + 2)) + ','+result.limit+')"';
                var left = ((result.current_page - 1) == -1) ? 'class="disabled"' : 'class="waves-effect"  onclick="PaginationCashOut(' + ((result.current_page)) + ','+result.limit+')"';

                var fast_back = (result.current_page <= 0) ? 'class="disabled"' : 'class="waves-effect"  onclick="PaginationCashOut(' + ((result.current_page + 1 - result.pages)) + ','+result.limit+')"';
                var fast_forward = ((result.pages == result.current_page + 1)) ? 'class="disabled"' : 'class="waves-effect"  onclick="PaginationCashOut(' + ((result.pages)) + ','+result.limit+')"';


                table = '<div class="card">';
                table += '<div class="card-content">';
                table += '<span class="card-title">Cortes de caja <strong>'+result.rows+' Cortes(s)</strong></span>';
                table += '<div class="row">';
                table += '<div class="col s12 l12">';
                table += '<table class="responsive-table striped centered">';
                table += '<thead>';

                table += '<tr>';
                    for(let d = 0; d < result.header.length; d++ ){
                        table+= '<th>'+result.header[d]+'</th>';
                    }
                table += '</tr>';

                table += '</thead>';

                '<tbody>';

                for (var i = 0; i < result.datos.length; i++) {

                    table += '<tr>';
                    table += '<td>' + result.datos[i].id + '</td>';
                    table += '<td>' + result.datos[i].fecha_corte + '</td>';
                    table += '<td><a href="pedidos_detail?co=' + result.datos[i].id + '" class="btn btn-floating"><i class="material-icons">remove_red_eye</i></a></td>';
                    table += '</tr>';

                }
                table += '</tbody>';

                table += '</table>';
                table += '<ul class="pagination">' +
                    '<li ' + fast_back + '><a href="javascript:void(0)" ><i class="material-icons">fast_rewind</i></a></li>' +
                    '<li ' + left + '><a href="javascript:void(0)"><i class="material-icons">chevron_left</i></a></li>';
            
                table+= paginate( result.current_page, result.pages, result.adjacent, result.limit, 'PaginationCashOut');

                table += '<li ' + right + '><a href="javascript:void(0)"><i class="material-icons">chevron_right</i></a></li>' +
                    '<li ' + fast_forward + '><a href="javascript:void(0)"><i class="material-icons">fast_forward</i></a></li>';
               
                table+='</ul>';
                
                table += '</div>';
                
                table += '</div>';
                table += '<div class="row">';
                table +='<div class="col l2 s2 offset-l10 offset-s10">';
    
                table+='<input type="number" style="width:100%" value="'+result.limit+'" onchange="PaginationCashOut(null, this.value)">';
                table+='</div>';
                table+= '</div>';
                table += '</div>';

                table += '</div>';

            } else {

                table += '<h4>No se encuentra ningún corte de caja</h4>';
            }

            showTable.innerHTML = table;


        },
        error: (errorThrown) => {
            document.write(errorThrown.responseText);
        }


    });

}


function PaginationOrder(page = null, limit = null) {
  $.ajax({
      url: 'lista_pedido_ajax.php',
      data: {
          page: page,
          limit:limit
      },
      type: 'POST',
      dataType: 'json',
      success: (result) => {
        var table = '';
          if (result.pages != 0) {
              
              var right = ((result.pages == result.current_page + 1)) ? 'class="disabled"' : 'class="waves-effect"  onclick="PaginationOrder(' + ((result.current_page + 2)) + ','+result.limit+')"';
              var left = ((result.current_page - 1) == -1) ? 'class="disabled"' : 'class="waves-effect"  onclick="PaginationOrder(' + ((result.current_page)) + ','+result.limit+')"';

              var fast_back = (result.current_page <= 0) ? 'class="disabled"' : 'class="waves-effect"  onclick="PaginationOrder(' + ((result.current_page + 1 - result.pages)) + ','+result.limit+')"';
              var fast_forward = ((result.pages == result.current_page + 1)) ? 'class="disabled"' : 'class="waves-effect"  onclick="PaginationOrder(' + ((result.pages)) + ','+result.limit+')"';


              table = '<div class="card">';
              table += '<div class="card-content">';
              table += '<span class="card-title">Lista de pedidos <strong>'+result.rows+' pedido(s)</strong><span class="badge red white-text">Sin corte de Caja</span></span>';
              table += '<div class="row">';
              table += '<div class="col s12 l12">';
              table += '<table class="responsive-table striped centered">';
              table += '<thead>';

              table += '<tr>';
                  for(let d = 0; d < result.header.length; d++ ){
                      table+= '<th>'+result.header[d]+'</th>';
                  }
              table += '</tr>';

              table += '</thead>';

              '<tbody>';

              for (var i = 0; i < result.datos.length; i++) {

                  table += '<tr>';
                  table += '<td>' + result.datos[i].id + '</td>';
                  table += '<td>' + result.datos[i].fecha + '</td>';
                  table += '<td>' + result.datos[i].n_productos + '</td>';
                  table += '<td>' + result.datos[i].usuario + '</td>';
                  table += '<td><a href="../venta/pedido?pe='+ result.datos[i].id + '" class="btn btn-floating"><i class="material-icons">remove_red_eye</i></a></td>';
                  table += '</tr>';

              }
              table += '</tbody>';

              table += '</table>';
              table += '<ul class="pagination">' +
                  '<li ' + fast_back + '><a href="javascript:void(0)" ><i class="material-icons">fast_rewind</i></a></li>' +
                  '<li ' + left + '><a href="javascript:void(0)"><i class="material-icons">chevron_left</i></a></li>';
          
              table+= paginate( result.current_page, result.pages, result.adjacent, result.limit, 'PaginationOrder');

              table += '<li ' + right + '><a href="javascript:void(0)"><i class="material-icons">chevron_right</i></a></li>' +
                  '<li ' + fast_forward + '><a href="javascript:void(0)"><i class="material-icons">fast_forward</i></a></li>';
             
              table+='</ul>';
              
              table += '</div>';
              
              table += '</div>';
              table += '<div class="row">';
              table +='<div class="col l2 s2 offset-l10 offset-s10">';
  
              table+='<input type="number" style="width:100%" value="'+result.limit+'" onchange="PaginationOrder(null, this.value)">';
              table+='</div>';
              table+= '</div>';
              table += '</div>';

              table += '</div>';

          } else {

              table += '<h4>No hay lista de pedidos actualmente</h4>';
          }

          ShowOrder.innerHTML = table;


      },
      error: (errorThrown) => {
          document.write(errorThrown.responseText);
      }


  });

}


