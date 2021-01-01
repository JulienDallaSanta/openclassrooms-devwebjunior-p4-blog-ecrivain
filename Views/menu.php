<span class="menu_toggle">
    <i class="menu_open fa fa-bars fa-lg"></i>
    <i class="menu_close fa fa-times fa-lg"></i>
</span>
<ul class="menu_items">
    <li><a href="\home"><i class="icon fa fa-home fa-2x"></i><span> Accueil</span></a></li>
    <li><a href="\biography"><i class="icon fas fa-portrait fa-2x"></i><span> Biographie</span></a></li>
    <li><a href="\blog"><i class="icon fa fa-blog fa-2x"></i><span> Blog</span></a></li>
    <?php
    if(isset($_SESSION['grade']) && $_SESSION['grade']==='admin'){
        ?>
        <li><a href="/admin"><i class="icon fa fa-crown fa-2x"></i><span> Admin</span></a></li>
        <?php
    }
    ?>
</ul>
