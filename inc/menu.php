<?php
echo !defined('guvenlik') ? die() :null; ?>

<!-- SITE WRAPPER -->
<div id="eskimo-site-wrapper">
    <!-- MAIN CONTAINER -->
    <main id="eskimo-main-container">
        <div class="container">
            <!-- SIDEBAR -->
            <div id="eskimo-sidebar">
                <div id="eskimo-sidebar-wrapper" class="d-flex align-items-start flex-column h-100 w-100">
                    <!-- LOGO -->
                    <div id="eskimo-logo-cell" class="w-100">
                        <a class="eskimo-logo-link" href="<?php echo $arow->site_url; ?>">
                            <img src="<?php echo $arow->site_url; ?>/images/su-logo.svg" class="eskimo-logo" alt="eskimo" />
                        </a>
                    </div>
                    <!-- MENU CONTAINER -->
                    <div id="eskimo-sidebar-cell" class="w-100">
                        <!-- MOBILE MENU BUTTON -->
                        <div id="eskimo-menu-toggle">MENÜ</div>
                        <!-- MENU -->
                        <nav id="eskimo-main-menu" class="menu-main-menu-container">
                            <ul class="eskimo-menu-ul">
                                <li><a href="<?php echo $arow->site_url; ?>">Anasayfa</a></li>
                                <li><a href="<?php echo $arow->site_url; ?>about.php">Hakkımda</a></li>
                                <li><a href="<?php echo $arow->site_url; ?>blog.php">Blog</a></li>
                            </ul>
                        </nav>
                    </div>
                    <!-- SOCIAL MEDIA ICONS -->
                    <div id="eskimo-social-cell" class="mt-auto w-100">
                        <div id="eskimo-social-inner">
                            <ul class="eskimo-social-icons">
                                <?php
                                    $sosyal_medya = $db->prepare("SELECT * FROM sosyal_medya WHERE sosyal_durum = :d");
                                    $sosyal_medya->execute([':d' => 1]);
                                    if ($sosyal_medya->rowCount()){
                                        foreach ($sosyal_medya as $item){
                                            ?>
                                            <li><a href="<?php echo $item['sosyal_link'] ?>" target="_blank"><i class="fa fa-<?php echo $item['sosyal_ikon'] ?>"></i></a></li>
                                            <?php
                                        }
                                    }
                                ?>
                            </ul>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- TOP ICONS -->
            <ul class="eskimo-top-icons">
                <li id="eskimo-panel-icon">
                    <a href="#eskimo-panel" class="eskimo-panel-open"><i class="fa fa-bars"></i></a>
                </li>
                <li id="eskimo-search-icon">
                    <a id="eskimo-open-search" href="#"><i class="fa fa-search"></i></a>
                </li>
            </ul>
            <div class="clearfix"></div>