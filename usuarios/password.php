<?php 
$inicio = "";
$venta = "";
$alta = "";
$caja = "";
$catalogo = "";
$recetario = "";
$usuario  = "";
$cambio  = "";
?>
<?php include_once '../extend/header.php';?>
<div class="row">
    <div class="col s12 l6 offset-l3">
     <div class="card">
     
        <form action="#" method="POST">

            <div class="card-content">
                <span class="card-title black-text">Cambio de contraseña de <?=ucwords($_SESSION['nombre'])?></span>

                <div class="row">
                 <div class="col s12 l6 offset-l3">
                   <div class="input-field">
                       <input type="password" name="oldPassword" id="oldPassword" autofocus="on">
                     <label for="oldPassword" class="active">Contraseña antigua</label>
                   </div>
                 </div>
                </div>
                <div class="row">
                 <div class="col s12 l6 offset-l3">
                    <div id="validOldPass"></div>
                 </div>
                </div>
                <div class="row">
                 <div class="col s12 l6 offset-l3">
                   <div class="input-field">
                     <input type="password" name="newPassword" id="newPassword">
                     <label for="newPassword" class="active">Nueva Contraseña</label>
                     <div id="valNewPass"></div>
                   </div>
                 </div>
                </div>

                <div class="row">
                 <div class="col s12 l6 offset-l3">
                    <div id="valNewPass"></div>
                 </div>
                </div>

                 <div class="row">
                 <div class="col s12 l6 offset-l3">
                   <div class="input-field">
                     <input type="password" name="confirmPassword" id="confirmPassword">
                     <label for="confirmPassword" class="active">Confirmar Contraseña </label>
                   </div>
                 </div>
                
                </div>
                <div class="row">

                <div class="col s12 l6 offset-l3">
                    <div id="valConfirm"></div>
                </div>
                
                </div>
                <div class="row">
                 <div class="col s12 l6 offset-l4">
                    <button type="submit" class="btn" id="submit" disabled onclick="cambioPassAdmin('<?=$_SESSION['id']?>', event)">Modificar</button> 
                 </div>
                </div>
                

            </div>
            
                 
           

        </form>
      </div>
    </div>
</div>
         

  <?php include_once '../extend/errorMessage.php';?>
  <?php include_once '../extend/scripts.php'; ?>
  <?php include_once '../extend/footer.php'; ?>

<script>
var confirmaPass = document.getElementById("confirmPassword"), 
    newPass      = document.getElementById("newPassword"),
    valConfirm   = document.getElementById("valConfirm"),
    valNewPass   = document.getElementById("valNewPass"),
    validOldPass = document.getElementById("validOldPass");
    oldPassword  = document.getElementById("oldPassword"),
    submit       = document.getElementById("submit"),
    nick         = document.getElementById("nick") ;


newPass.addEventListener("blur", validNewPass);
confirmaPass.addEventListener("blur", confirmPass);
oldPassword.addEventListener("keyup", ValidPassOld);





function confirmPass(){

    if( confirmaPass.value != newPass.value || confirmaPass.value.length < 3 ){

          valConfirm.innerHTML = '<p class="red-text" style="font-size:12px;"><i class="material-icons">close</i> La contraseña no coincide</p>';
          submit.setAttribute("disabled","disabled");
          return false;
       

    } else {

          valConfirm.innerHTML = '<p class="green-text" style="font-size:12px;"><i class="material-icons">check</i> La contraseña coincide</p>';
          submit.removeAttribute("disabled");
          return true;
    }

}

function validNewPass() {
    if(newPass.value.length>= 4) {
        valNewPass.innerHTML = '<p class="green-text" style="font-size:12px;"><i class="material-icons">check</i> Contraseña fuerte</p>';
        submit.removeAttribute("disabled");
        return true;
    } else {

        valNewPass.innerHTML = '<p class="red-text" style="font-size:12px;"><i class="material-icons">close</i>Contraseña muy corta, ingrese al menos 4 digitos</p>';
        submit.setAttribute("disabled","on");
        return false;
    }
}

 function ValidPassOld(){

    var nick = '<?=$_SESSION['nick'];?>';
    var pass = oldPassword.value;
    $.ajax({ 
    type:"post",
    url: "validOldPass.php",
    data:{pass:pass, nick:nick},
    success:(data)=>{
     if(data == 1) {
        validOldPass.innerHTML = '<p class="green-text" style="font-size:12px;"><i class="material-icons">check</i>Contraseña correcta</p>';
        submit.removeAttribute("disabled");
        return true;
       
    } else { 
        validOldPass.innerHTML = '<p class="red-text" style="font-size:12px;"><i class="material-icons">check</i>Contraseña incorrecta</p>';
        submit.setAttribute("disabled","on");
        return false;
    }

    }

    });
} 

function cambioPassAdmin(id, event){
    event.preventDefault()
    var oldPassword = document.getElementById("oldPassword").value,
        newPassword = document.getElementById("newPassword").value,
        confirmPassword = document.getElementById("confirmPassword").value;
    
       $.ajax({
           type:"POST",
           url:"cambio_pass_admin.php",
           data:{oldPassword:oldPassword,
                 newPassword:newPassword,
                 confirmPassword:confirmPassword,
                 id:id
            },
           success: function(data){
               
            console.log(data);
            var errores = JSON.parse(data);
            var showError = "";
            if (errores.length != 0) {
                showError = '<ol>';

                for (var i = 0; i < errores.length; i++) {

                    showError += "<li>" + errores[i] + "</li>";

                }

                showError += '</ol>';

                document.getElementById("m-error").innerHTML = showError;
                $("#errores").modal('open');

            } else {

                document.getElementById("oldPassword").value = "";
                document.getElementById("newPassword").value = "";
                document.getElementById("confirmPassword").value = "";
                document.getElementById("valNewPass").innerHTML = "";
                document.getElementById("validOldPass").innerHTML = "";
                document.getElementById("valConfirm").innerHTML = "";
                swal("Bien", "Se ha guardado correctamente", "success").then(() => {
                    document.getElementById("oldPassword").autofocus;
                });
            }
               
           },
           error: function(){
               alert("Error del servidor");
           }
           
       });
    

}



</script>