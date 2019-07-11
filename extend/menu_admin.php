<?php if(isset($_SESSION['nick']) && $_SESSION['nivel']=='ADMINISTRADOR') : ?>
<style media="screen">
  @media(min-width:1000px){
    .right-nav{
      margin-right: 350px;
    }
  }
</style>

   <ul id="menu" class="side-nav blue darken-5 z-depth-3">
      <li>
        <div class="user-view blue-grey darken-4">
          <div class="background">
          </div>
          <a href="#"><img class="circle" src="../usuarios/<?=$_SESSION['foto'];?>" alt=""></a>
          <a href="#" class="white-text"><?=$_SESSION['nivel'];?></a>
          <br>
          <a href="#" class="white-text"><?=$_SESSION['nombre']; ?></a>

        </div>
      </li>
     
      <li class="<?=$inicio?>"><a href="../inicio" class="waves-effect white-text"><i class="material-icons white-text">dashboard</i>Inicio</a></li>
      <li class="<?=$venta?>"><a href="../venta" class="waves-effect white-text"><i class="material-icons white-text">add_shopping_cart</i>Venta</a></li>
      <li class="<?=$alta?>"><a href="../alta" class="waves-effect white-text"><i class="fa fa-medkit fa-2x white-text" aria-hidden="true" ></i>Productos/Inventario</a></li>
      <li class="<?=$catalogo?>"><a class='dropdown-button white-text' href='#' data-activates='catalogos'><i class="material-icons white-text">list</i>Catalogos</a></li>
      <li class="<?=$caja?>"><a href="../caja/" class="waves-effect white-text"><i class="material-icons white-text">business_center</i>Corte de Caja</a></li>
     <!-- <li><a href="../inventario/" class="waves-effect white-text"><i class="material-icons white-text">library_books</i>Inventario</a></li>-->
      <li class="<?=$recetario?>"><a href="../recetario/" class="waves-effect white-text"><i class="material-icons white-text">call_to_action</i>Recetario</a></li>
   </ul>
 

<!-- Catalogos -->
<ul id='catalogos' class='dropdown-content'>
  <li><a href="../categorias/" class="waves-effect"><i class="material-icons ">list</i>Categorias</a></li>
  <li><a href="#" class="waves-effect"><i class="material-icons ">list</i>Proveedores</a></li>
</ul>
<?php else :?>

<?php header("Location:../");?>

<?php endif; ?>

