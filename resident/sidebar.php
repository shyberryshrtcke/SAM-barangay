<?php
    $current_page = $_SERVER['PHP_SELF'];
    $current_page = basename(parse_url($_SERVER['PHP_SELF'], PHP_URL_PATH));
?>

<style>
    .side.active {
        background-color: #144e73!important;
        color: #ffffff;
    }

</style>

<aside class="main-sidebar sidebar-dark-primary elevation-4 shadow" style="background:#053c5e !important;">
    <a href="#" class="brand-link text-decoration-none" style="background:#053c5e !important;">
        <img src="../sam.png"  class="brand-image img-circle elevation-3" style="opacity: .9">
        <span class="brand-text">Talk to SAM now!</span>
    </a>

    <div class="sidebar">
        <nav class="mt-4">
            <ul class="nav nav-pills nav-sidebar flex-column text-white fw-light" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item user-panel pt-1">
                    <a href="res_homepage.php" class="nav-link side <?php if ($current_page == 'res_homepage.php') { echo 'active'; } ?>">
                        <i class="nav-icon fa-solid fa-house"></i>
                        <p>Homepage</p>
                    </a>
                </li>
                <li class="nav-item user-panel pt-1">
                    <a href="#" class="nav-link side ">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-item user-panel pt-1">
                    <a href="res_services.php" class="nav-link side <?php if ($current_page == 'res_services.php') { echo 'active'; } ?>" id="services">
                        <i class="nav-icon fas fa-solid fa-file-pen ps-1"></i>
                        <p>Services</p>
                    </a>
                </li>
                <li class="nav-item user-panel pt-1 has-treeview">
                    <a href="#" class="nav-link side">
                        <i class="nav-icon fas fa-solid fa-gear"></i>
                        <p>Settings<i class="right fas fa-angle-down"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="" class="nav-link side ">
                                <i class="nav-icon far fa-circle"></i>
                                <p>Update Credentials</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link side">
                                <i class="nav-icon far fa-circle"></i>
                                <p>Change Password</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item user-panel pt-1">
                    <a href="#" class="nav-link side">
                        <i class="nav-icon fas fa-solid fa-comment"></i>
                        <p>Report</p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>
