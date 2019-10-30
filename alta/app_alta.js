$(document).ready(function(){
    $('.dropdown-button').dropdown();
    $(document).on("click", ".select-wrapper", function (event) { event.stopPropagation(); });
});


//Registro de medicamento


var showListMedication = $("#list-medication");
var inputSearch = $("#search_med");
const refreshButton = $("#refrescar");

//Lista de entradas de medicamentos
var inputEntrySearch = $("#search_entry");
var showEntries = $("#list-entries");


//Cuando carga a la entrada del dato
$(document).ready(() => {

    //Carga de las lista de medicamento
    PaginationMedicationList(null, null, inputSearch.val());
    inputSearch.focus();
    //carga de la lista de entrada
    PaginationEntryList(null, null, inputEntrySearch.val());
});

refreshButton.on('click', function(){
    console.log('refresh');
    PaginationEntryList(null, null, inputEntrySearch.val());
});


inputEntrySearch.on('keyup', (event) => {
    var code = event.keyCode || event.which;
    let search = inputEntrySearch.val();
    if (code == 13) {
        PaginationEntryList(null, null, search);
    }

    if (search.length == 0) {
        PaginationEntryList(null, null, search)
    }
});




//Cuando hace un un levantamiento de dato
inputSearch.on('keyup', (event) => {
    var code = event.keyCode || event.which;
    let search = inputSearch.val();
    if (code == 13) {
        PaginationMedicationList(null, null, search);
    }

    if (search.length == 0) {
        PaginationMedicationList(null, null, search)
    }
});

function PaginationMedicationList(page = null, limit = null, search = null) {

    $.ajax({
        url: 'medicamento_lista_ajax.php',
        data: {
            page: page,
            limit: limit,
            search: search
        },
        type: 'POST',
        dataType: 'json',
        beforeSend: function () {
            let loading = '';
            loading += '<div class="col s12 l12 center-align">';
            loading += '<div class="preloader-wrapper big active">';
            loading += '<div class="spinner-layer spinner-blue">';
            loading += '<div class="circle-clipper left">';
            loading += '<div class="circle"></div>';
            loading += '</div><div class="gap-patch">';
            loading += '<div class="circle"></div>';
            loading += '</div><div class="circle-clipper right">';
            loading += '<div class="circle"></div>';
            loading += '</div>';
            loading += '</div>';
            loading += '</div>';
            loading += '</div>';
            showListMedication.html(loading);
        },
        success: (result) => {
            console.log(result);
            var table = '';
            if (result.pages != 0) {

                var right = ((result.pages == result.current_page + 1)) ? 'class="disabled"' : 'class="waves-effect"  onclick="PaginationMedicationList(' + ((result.current_page + 2)) + ',' + result.limit + ',\'' + result.search + '\')"';
                var left = ((result.current_page - 1) == -1) ? 'class="disabled"' : 'class="waves-effect"  onclick="PaginationMedicationList(' + ((result.current_page)) + ',' + result.limit + ',\'' + result.search + '\')"';

                var fast_back = (result.current_page <= 0) ? 'class="disabled"' : 'class="waves-effect"  onclick="PaginationMedicationList(' + ((result.current_page + 1 - result.pages)) + ',' + result.limit + ',\'' + result.search + '\')"';
                var fast_forward = ((result.pages == result.current_page + 1)) ? 'class="disabled"' : 'class="waves-effect"  onclick="PaginationMedicationList(' + ((result.pages)) + ',' + result.limit + ',\'' + result.search + '\')"';


                table += '<div class="col s12 l12">';
                table += '<table class="responsive-table striped centered">';
                table += '<thead>';

                table += '<tr>';
                for (let d = 0; d < result.header.length; d++) {
                    table += '<th>' + result.header[d] + '</th>';
                }
                table += '</tr>';

                table += '</thead>';

                '<tbody>';
                var color = '';
                for (var i = 0; i < result.datos.length; i++) {
                    
                    
                    if(parseInt(result.datos[i].inventario )== 0) {
                        color ='red lighten-4' ;
                    }  else if( parseInt(result.datos[i].inventario) > parseInt(result.datos[i].stock_minimo)) {
                        color = 'light-green accent-1' ; 
                    } else {
                        color = 'yellow lighten-1';
                    }

                    table += `<tr class="${color}">`;
                    table += '<td>' + result.datos[i].cve_medicamento + '</td>';
                    table += '<td>' + result.datos[i].nombre_comercial + '</td>';
                    table += '<td>' + result.datos[i].nombre_generico + '</td>';
                    table += '<td>' + result.datos[i].presentacion + '</td>';
                    table += '<td>' + result.datos[i].categoria + '</td>';
                    table += '<td>' + result.datos[i].precio_adquisitivo + '</td>';
                    table += '<td>' + result.datos[i].precio_venta + '</td>';
                    table += '<td>' + result.datos[i].stock_minimo + '</td>';
                    table += '<td>' +result.datos[i].inventario + '</td>';
                    table += `<td><a href="edit_medicamento.php?q=${result.datos[i].cve_medicamento}" class="btn-floating blue"><i class="material-icons">edit</i></a></td>`;
                    table += '</tr>';

                }
                table += '</tbody>';

                table += '</table>';
                table += '<ul class="pagination">' +
                    '<li ' + fast_back + '><a href="javascript:void(0)" ><i class="material-icons">fast_rewind</i></a></li>' +
                    '<li ' + left + '><a href="javascript:void(0)"><i class="material-icons">chevron_left</i></a></li>';

                table += paginate(result.current_page, result.pages, result.adjacent, result.limit, 'PaginationMedicationList', "" + result.search + "");

                table += '<li ' + right + '><a href="javascript:void(0)"><i class="material-icons">chevron_right</i></a></li>' +
                    '<li ' + fast_forward + '><a href="javascript:void(0)"><i class="material-icons">fast_forward</i></a></li>';

                table += '</ul>';

                table += '</div>';
                table += '<div class="row">';
                table += '<div class="col l2 s2 offset-l10 offset-s10">';
                table += '<label for="row">Numero de Filas</label>';
                table += '<input id="row" type="number" style="width:100%" value="' + result.limit + '" onchange="PaginationMedicationList(null,this.value,  \'' + result.search + '\')">';
                table += '</div>';
                table += '</div>';



            } else {

                table += '<h4>No hay ningún resultado</h4>';
            }

            showListMedication.slideUp(10).fadeIn(200).html(table);


        },
        error: function (errorThrown) {
            document.write(errorThrown.responseText);
        }


    });

}

//Lista de entradas

function PaginationEntryList(page = null, limit = null, search = null) {

    $.ajax({
        url: 'entrada_lista_ajax.php',
        data: {
            page: page,
            limit: limit,
            search: search
        },
        type: 'POST',
        dataType: 'json',
        beforeSend: function () {
            let loading = '';
            loading += '<div class="col s12 l12 center-align">';
            loading += '<div class="preloader-wrapper big active">';
            loading += '<div class="spinner-layer spinner-blue">';
            loading += '<div class="circle-clipper left">';
            loading += '<div class="circle"></div>';
            loading += '</div><div class="gap-patch">';
            loading += '<div class="circle"></div>';
            loading += '</div><div class="circle-clipper right">';
            loading += '<div class="circle"></div>';
            loading += '</div>';
            loading += '</div>';
            loading += '</div>';
            loading += '</div>';
            showEntries.html(loading);
        },
        success: (result) => {
            console.log(result);
            var table = '';
            if (result.pages != 0) {

                var right = ((result.pages == result.current_page + 1)) ? 'class="disabled"' : 'class="waves-effect"  onclick="PaginationEntryList(' + ((result.current_page + 2)) + ',' + result.limit + ',\'' + result.search + '\')"';
                var left = ((result.current_page - 1) == -1) ? 'class="disabled"' : 'class="waves-effect"  onclick="PaginationEntryList(' + ((result.current_page)) + ',' + result.limit + ',\'' + result.search + '\')"';

                var fast_back = (result.current_page <= 0) ? 'class="disabled"' : 'class="waves-effect"  onclick="PaginationEntryList(' + ((result.current_page + 1 - result.pages)) + ',' + result.limit + ',\'' + result.search + '\')"';
                var fast_forward = ((result.pages == result.current_page + 1)) ? 'class="disabled"' : 'class="waves-effect"  onclick="PaginationEntryList(' + ((result.pages)) + ',' + result.limit + ',\'' + result.search + '\')"';


                table += '<div class="col s12 l12">';
                table += '<table class="responsive-table striped centered">';
                table += '<thead>';

                table += '<tr>';
                for (let d = 0; d < result.header.length; d++) {
                    table += '<th>' + result.header[d] + '</th>';
                }
                table += '</tr>';

                table += '</thead>';

                '<tbody>';

                for (var i = 0; i < result.datos.length; i++) {

                    table += '<tr>';
                    table += '<td>' + result.datos[i].clave + '</td>';
                    table += '<td>' + result.datos[i].nombre_c + '</td>';
                    table += '<td>' + result.datos[i].lote + '</td>';
                    table += '<td>' + result.datos[i].caducidad + '</td>';
                    table += '<td>' + result.datos[i].cantidad + '</td>';
                    table += '<td>' + result.datos[i].alta + '</td>';
                    table += '</tr>';

                }
                table += '</tbody>';

                table += '</table>';
                table += '<ul class="pagination">' +
                    '<li ' + fast_back + '><a href="javascript:void(0)" ><i class="material-icons">fast_rewind</i></a></li>' +
                    '<li ' + left + '><a href="javascript:void(0)"><i class="material-icons">chevron_left</i></a></li>';

                table += paginate(result.current_page, result.pages, result.adjacent, result.limit, 'PaginationEntryList', "" + result.search + "");

                table += '<li ' + right + '><a href="javascript:void(0)"><i class="material-icons">chevron_right</i></a></li>' +
                    '<li ' + fast_forward + '><a href="javascript:void(0)"><i class="material-icons">fast_forward</i></a></li>';

                table += '</ul>';

                table += '</div>';
                table += '<div class="row">';
                table += '<div class="col l2 s2 offset-l10 offset-s10">';
                table += '<label for="row">Numero de Filas</label>';
                table += '<input id="row" type="number" style="width:100%" value="' + result.limit + '" onchange="PaginationEntryList(null,this.value,  \'' + result.search + '\')">';
                table += '</div>';
                table += '</div>';



            } else {

                table += '<h4>No hay ningún resultado</h4>';
            }

            showEntries.slideUp(10).fadeIn(200).html(table);


        },
        error: function (errorThrown) {
            console.log(errorThrown.responseText);
        }


    });

}