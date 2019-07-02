
<ul id="menu" class="side-nav blue darken-5 z-depth-3">
    <li>
        <div class="user-view blue-grey darken-4">
            <div class="background">
            </div>
            <a href="#"><img class="circle" src="../usuarios/<?php echo $_SESSION['foto']; ?>" alt=""></a>
            <a href="#" class="white-text"><?=$_SESSION['nivel']; ?></a>
            <br>
            <a href="#" class="white-text"><?=$_SESSION['nombre'] ?></a>

        </div>
    </li>
    <li class="<?=$venta?>"><a href="../venta/" class="waves-effect white-text"><i class="material-icons white-text">add_shopping_cart</i>Venta</a></li>
</ul>
