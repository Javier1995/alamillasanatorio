<?php 
     $id = $_POST['id'];
     $nick = $_POST['nick'];

?>
        <h4>Modificar contraseña de "<?php echo $nick; ?>"</h4>
            <div class="row">
                 <div class="col s12 l6 offset-l3">
                   <div class="input-field">
                      <i class="material-icons prefix">vpn_key</i>
                     <input type="password"  id="newPassword1">
                     <label for="newPassword1" class="active">Nueva Contraseña</label>
                     <div id="valNewPass1"></div>
                   </div>
                 </div>
            </div>
            <div class="row">
                 <div class="col s12 l6 offset-l3">
                   <div class="input-field">
                   <i class="material-icons prefix">vpn_key</i>
                     <input type="password" name="confirmPassword1" id="confirmPassword1">
                     <label for="confirmPassword1" class="active">Confirmar Contraseña </label>
                     <div id="valConfirm1"></div>
                   </div>
                 </div>
                
            </div>
            <div class="row">
                 <div class="col s12 l6 offset-l5">
                    <button type="submit" class="btn" id="submit1" >Modificar</button> 
                 </div>
            </div>

            <div id="cambio_user"></div>
            <script>
            
    var confirmaPass = document.getElementById("confirmPassword1"), 
    newPass      = document.getElementById("newPassword1"),
    valConfirm   = document.getElementById("valConfirm1"),
    valNewPass   = document.getElementById("valNewPass1"),
    submit       = document.getElementById("submit1");


newPass.addEventListener("blur", validNewPass);
confirmaPass.addEventListener("keyup", confirmPass);
submit.addEventListener("click", enviar_datos);


function enviar_datos() {
    var newpass = document.getElementById("newPassword1").value,
    confipass = document.getElementById("confirmPassword1").value;
    id = '<?php echo $id ?>';
    url = "procesa_cambio.php";
    
    if(newpass.length >= 4) {
    $.ajax({
        type:"POST",
        url:url,
        data:{newpass:newpass, confipass:confipass,id:id},
        success:(data)=>{
            $("#cambio_user").html(data);
            $("#newPassword1").val("");
            $("#confirmPassword1").val("");
            $("#valConfirm1 p").val(" ");
            $("#valNewPass1 p").val(" ");
        }
    });

    return true;
    } else {

        swal('oh oh..','No ha introducido ninguna contrasena','error');
    return false;
    }
}

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

 
            
            </script>