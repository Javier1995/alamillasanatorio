<?php

require_once'../conexion/conexion.php';

$oldPass = $con->real_escape_string(htmlentities($_POST['pass']));
$nick    = $con->real_escape_string(htmlentities($_POST['nick']));
$sha1    = sha1($oldPass);
$sel = $con->query("SELECT pass FROM usuarios WHERE nick = '$nick' ");

while($fetch = $sel->fetch_assoc()) {
    $passDB = $fetch['pass'];
}

if( $passDB == $sha1 ) {
    echo '1';
} else {
    echo '0';
    
}