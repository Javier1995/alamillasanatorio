
<ul id="menu" class="side-nav blue darken-5 z-depth-3">
    <li>
        <div class="user-view blue-grey darken-4">
            <div class="background">
            </div>
            <a href="#"><img class="circle" src="../usuarios/<?= $_SESSION['foto']; ?>" alt=""></a>
            <a href="#" class="white-text"><?=$_SESSION['nivel']; ?></a>
            <br>
            <a href="#" class="white-text"><?=$_SESSION['nombre'];?></a>

        </div>
    </li>
    <li class="<?=$recetario?>"><a href="../recetario/" class="waves-effect white-text"><i class="material-icons white-text">call_to_action</i>Recetario</a></li>
</ul>
