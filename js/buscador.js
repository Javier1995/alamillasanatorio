$('#buscar').keyup(function(){
  may(this.value, this.id);
  var contenido = new RegExp($(this).val(),'i');
  $('tbody tr').hide();
  $('tbody tr').filter(function(){
    return contenido.test($(this).text());
  }).show();
});
