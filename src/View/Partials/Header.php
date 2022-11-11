<?php
$uriRequest = $_SERVER['REQUEST_URI'];
$flag = 0;
if ($uriRequest === '/mini_forms/home' || $uriRequest === '/mini_forms/')
{
    $flag = 1;
} elseif ($uriRequest === '/mini_forms/data')
{
    $flag = 2;
} elseif ($uriRequest === '/mini_forms/stats')
{
    $flag = 3;
}

?>

<nav id="navbar">
    <div id="navbar_logo">
        <p class="navbar_logo">MINI FORMS</p>
    </div>
    <div id="navbar_toggle">
        <i class="typcn typcn-th-menu-outline"></i>
    </div>
    <div id="menus" class="menu menu_collapsed">
        <label for="nav_item_home" class="nav_item <?= ($flag===1)?'active':'' ?>">
            <a href="<?= URL . 'home' ?>" id="nav_item_home" class="nav_link"">
            <i class="item_icon typcn typcn-home-outline"></i>
            Inicio
            </a>
        </label>
        <label for="nav_item_data" class="nav_item <?= ($flag===2)?'active':'' ?>">
            <a href="<?= URL . 'data' ?>" id="nav_item_data" class="nav_link"">
            <i class="item_icon typcn typcn-document-text"></i>
            Datos
            </a>
        </label>
        <label for="nav_item_stats" class="nav_item <?= ($flag===3)?'active':'' ?>">
            <a href="<?= URL . 'stats' ?>" id="nav_item_stats" class="nav_link"">
            <i class="item_icon typcn typcn-chart-pie-outline"></i>
            Estadisticas
            </a>
        </label>
    </div>
</nav>

<script src="<?= URL . 'src/View/Partials/Header.js' ?>"></script>