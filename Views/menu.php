<div class="desktop_menu">
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
            <li><a href="\admin"><i class="icon fa fa-crown fa-2x"></i><span> Admin</span></a></li>
            <?php
        }
        ?>
    </ul>
</div>
<div class="mobile_menu">
    <span class="mobile_menu_toggle">
        <i class="mobile_menu_open fa fa-bars fa-lg"></i>
        <i class="mobile_menu_close fa fa-times fa-lg"></i>
    </span>
    <span class="mobile_menu_first_separator"></span>
    <ul class="mobile_menu_items">
        <li><a href="\home"><span> ACCUEIL</span></a></li>
        <span class="mobile_menu_separator"></span>
        <li><a href="\biography"><span> BIOGRAPHIE</span></a></li>
        <span class="mobile_menu_separator"></span>
        <li><a href="\blog"><span> BLOG</span></a></li>
        <?php
        if(isset($_SESSION['grade']) && $_SESSION['grade']==='admin'){
            ?>
            <span class="mobile_menu_separator"></span>
            <li><a href="\admin"><span> ADMIN</span></a></li>
            <?php
        }
        ?>
    </ul>
</div>
