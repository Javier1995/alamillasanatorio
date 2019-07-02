//Datos por ajax
$('#nick').change(function(){
  $.post('ajax_validacion_nick.php',{
     nick:$('#nick').val(),
     beforeSend: function(){
       $('.validacion').html("<div class=\"preloader-wrapper small active\"><div class=\"spinner-layer spinner-green-only\"><div class=\"circle-clipper left\"><div class=\"circle\"></div></div><div class=\"gap-patch\"><div class=\"circle\"></div></div><div class=\"circle-clipper right\"><div class=\"circle\"></div></div></div></div>");
     }
   }, function(respuesta){
       $('.validacion').html(respuesta);
   });
});

//Verificacion de contraseña
$('#pass2').change(function(event){

   if($('#pass1').val() == $('#pass2').val()){
     swal({
     title: "Bien hecho..",
     text: "La contraseñas coinciden",
     icon: "success",
     });
     $('#btn_guardar').show();
   }else{
     swal({
     title: "¡Oh no!",
     text: "Las contraseñas no coinciden",
     icon: "error",
     });
     $('#btn_guardar').hide();
   }
});

//bloqueo de la tecla retorno de carro

$('form').keypress(function(e){
  if(e.keyCode==13){

    return false;
  }
});
