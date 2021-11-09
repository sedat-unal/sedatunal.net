<?php
echo !defined('guvenlik') ? die() :null; ?>
<!-- FOOTER -->
<footer id="eskimo-footer">
    <div class="container">
        <div class="row eskimo-footer-wrapper">
            <!-- FOOTER WIDGET 1 -->
            <div class="col-12 col-lg-6 mb-4 mb-lg-0">
                <h5 class="eskimo-title-with-border"><span>Hakkımda</span></h5>
                <p><?php echo mb_substr($hrow->hakkimda_icerik, 0,150, 'utf8'); ?></p>
                <p><a href="<?php echo $arow->site_url; ?>/about.php" class="btn btn-default">Devam Et</a></p>
            </div>
            <!-- FOOTER WIDGET 2 -->
            <div class="col-12 col-lg-6">
                <h5 class="eskimo-title-with-border"><span>Abonelik Listesi</span></h5>
                <form id="aboneformu" method="post" action="" onsubmit="return false;">
                    <label>Yeni yazılardan haberdar olmak için kayıt olman yeterli.</label>
                    <div class="input-group">
                        <input type="email" class="form-control" name="eposta" placeholder="E-posta adresi" required />
                        <div class="input-group-append">
                            <input onclick="aboneol();" type="submit" value="Kayıt Ol"  class="btn btn-default" />
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- CREDITS -->
        <div class="eskimo-footer-credits">
            <p>
                Designed by <a href="https://sedatunal.net" target="_blank">Sedat Ünal</a>
            </p>
        </div>
    </div>
</footer>
</div>
<!-- GO TO TOP BUTTON -->
<a id="eskimo-gototop" href="#"><i class="fa fa-chevron-up"></i></a>
<!-- SLIDE PANEL OVERLAY -->
<div id="eskimo-overlay"></div>
<!-- SLIDE PANEL -->
<div id="eskimo-panels">
    <aside id="eskimo-panel" class="eskimo-panel">
        <div class="eskimo-panel-inner">
            <!-- CLOSE SLIDE PANEL BUTTON -->
            <a href="#" class="eskimo-panel-close"><i class="fa fa-times"></i></a>
            <!-- AUTHOR BOX -->
            <div class="eskimo-author-box eskimo-widget">
                <div class="eskimo-author-img">
                    <img style="height: 100px;width: 110px;" src="images/<?php echo $arow->site_icon; ?>" alt="<?php echo $arow->site_baslik; ?>" />
                </div>
                <h3><span><?php echo $hrow->hakkimda_isim; ?></span></h3>
                <p class="eskimo-author-subtitle"><?php echo $hrow->hakkimda_meslek; ?></p>
                <p class="eskimo-author-description"><?php echo mb_substr($hrow->hakkimda_icerik, 0, 150, 'utf8'); ?></p>
                <div class="eskimo-author-box-btn">
                    <a class="btn btn-default" href="<?php echo $arow->site_url; ?>about.php">Devamı</a>
                </div>
            </div>
            <!-- RECENT POSTS -->
            <div class="eskimo-recent-entries eskimo-widget">
                <h5 class="eskimo-title-with-border"><span>Popüler Yazılar</span></h5>
                <ul>
                    <?php
                        $populer = $db->prepare("SELECT * FROM yazılar WHERE yazi_durum = :d ORDER BY yazi_goruntulenme DESC LIMIT :lim");
                        $populer->bindValue(':d', (int) 1, PDO::PARAM_INT);
                        $populer->bindValue(':lim', (int) 3, PDO::PARAM_INT);
                        $populer->execute();
                        if($populer->rowCount()){
                            foreach ($populer as $item){
                                ?>
                                <li>
                                    <a href="<?php echo $arow->site_url; ?>icerik.php?yazi_sef=<?php echo $item['yazi_sef'];?>&id=<?php echo $item['yazi_id']; ?>"><?php echo $item['yazi_baslik']; ?></a>
                                    <span class="post-date"><?php echo date('d.m.Y',strtotime( $item['yazi_tarih']));?></span>
                                </li>
                                <?php
                            }
                        }
                    ?>
                </ul>
            </div>
            <!-- CATEGORIES -->
            <div class="eskimo-categories eskimo-widget">
                <h5 class="eskimo-title-with-border"><span>Kategoriler</span></h5>
                <ul>
                    <?php
                        $kategoriler = $db->prepare("SELECT * FROM kategoriler");
                        $kategoriler->execute();
                        if($kategoriler->rowCount()){
                            foreach ($kategoriler as $row){
                                echo '<li><a href="'.$arow->site_url.'category.php?kat_sef='.$row['kat_sef'].'" title="">'.$row['kat_adi'].'</a></li>';
                            }
                        }

                    ?>

                </ul>
            </div>
            <!-- TAGS -->
            <div class="eskimo-widget">
                <h5 class="eskimo-title-with-border"><span>Etiketler</span></h5>
                <div class="eskimo-tag-cloud">
                    <?php echo etiketler(); ?>
                </div>
            </div>
        </div>
    </aside>
</div>
<!-- FULLSCREEN SEARCH -->
<div id="eskimo-fullscreen-search">
    <div id="eskimo-fullscreen-search-content">
        <a href="#" id="eskimo-close-search"><i class="fa fa-times"></i></a>
        <form role="search" method="get" action="ara.php" class="eskimo-lg-form">
            <div class="input-group">
                <input type="text" class="form-control form-control-lg" placeholder="Ne aramıştınız..." name="q" />
                <div class="input-group-append">
                    <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- JS FILES -->
<script src="js/jquery-3.3.1.min.js"></script>
<script src="js/rrssb.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/salvattore.min.js"></script>
<script src="js/slick.min.js"></script>
<script src="js/panel.js"></script>
<script src="js/reading-position-indicator.js"></script>
<script src="js/custom.js"></script>
<script src="js/ajax.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<!-- POST SLIDER -->
<script>
    (function($) {
        "use strict";
        $(document).ready(function() {
            $('#eskimo-post-slider').slick({
                autoplay: true,
                autoplaySpeed: 5000,
                slidesToScroll: 1,
                adaptiveHeight: true,
                slidesToShow: 1,
                arrows: true,
                dots: false,
                fade: true
            });
        });
        $(window).on('load', function() {
            $('#eskimo-post-slider').css('opacity', '1');
            $('#eskimo-post-slider').parent().removeClass('eskimo-bg-loader');
        });
    })(jQuery);
</script>
<!-- POST CAROUSEL -->
<script>
    (function($) {
        "use strict";
        $(document).ready(function() {
            $('#eskimo-post-carousel').slick({
                infinite: false,
                slidesToScroll: 1,
                arrows: true,
                dots: false,
                slidesToShow: 3,
                responsive: [{
                    breakpoint: 992,
                    settings: {
                        slidesToShow: 2
                    }
                }, {
                    breakpoint: 576,
                    settings: {
                        slidesToShow: 1
                    }
                }]

            });
            $('#eskimo-post-carousel').css('opacity', '1');
        });
    })(jQuery);
</script>


<?php echo $arow->analiytcs_kodu; ?>

</body>
</html>
