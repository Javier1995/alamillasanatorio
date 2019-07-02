$(document).ready(function(){

    function cargar_cambio_contrasena(id){
        var url ="vista_modal_cambio_contrasena.php";
        $.ajax({
            method: "POST",
            url: url,
            data:{id:id},
            success:(data)=>{
                $("#resultado_cambio").html(data);
            }
        });

    }
});