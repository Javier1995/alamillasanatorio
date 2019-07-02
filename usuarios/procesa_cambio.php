<?php
require("../conexion/conexion.php");

if($_SERVER['REQUEST_METHOD']=='POST'){
 $newPass = $_POST['newpass'];
 $confirmPass = $_POST['confipass'];
 $id = $_POST['id'];


 //encriptacion 

 $newPassSha1 = sha1($newPass);
if($newPass == $confirmPass) {
    $queryUpdate = $con->query("UPDATE usuarios SET pass = '$newPassSha1' WHERE id = '$id'");
    if($queryUpdate) {
        echo "<script>swal('Muy bien..','La contrasena ha sido modificado','success')</script>";
    } else {
        echo "<script>swal('oh oh..','La contrasena no ha sido modificado','error')</script>";
    }



} else {

    echo "<script>swal('Error','No coincide las contrasenas','error')</script>";

}
 

} else {
    header("Location:index.php");
}