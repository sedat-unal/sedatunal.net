<?php define('guvenlik', true);
require_once "inc/header.php";
require_once "inc/menu.php";
$getData = $db->prepare("SELECT * FROM yazılar");
$getData->execute();
if($getData->rowCount() == 0){
    $getSiteOff = $db->prepare("UPDATE ayarlar SET site_durum = :d WHERE ayar_id = :id");
    $getSiteOff->execute([":d" => 0, ":id" => 1]);
    if($getSiteOff){
        header("Location: hata/index.php");
    }
}
?>


            <!-- SLIDER -->
            <div class="eskimo-carousel-container eskimo-bg-loader">
                <div id="eskimo-post-slider" class="eskimo-slider">
                    <!-- SLIDE 1 -->
                    <?php
                    $slidercek = $db->prepare("SELECT * FROM slider INNER JOIN yazılar ON yazılar.yazi_id = slider.slider_bag
                    INNER JOIN kategoriler ON kategoriler.kat_id = slider.slider_kategori ORDER BY slider_id DESC ");
                    $slidercek->execute();
                    if ($slidercek->rowCount()){

                         foreach ($slidercek as $row){     ?>
                        <div>
                            <a class="eskimo-slider-img" href="<?php echo $arow->site_url; ?>icerik.php?yazi_sef=<?php echo $row['yazi_sef'];?>&id=<?php echo $row['yazi_id']; ?>"></a>
                            <ul class="eskimo-slider-image-meta eskimo-image-meta-post">
                                <li><span class="badge badge-default"><?php echo date('d.m.Y',strtotime($row['yazi_tarih'])); ?></span></li>
                                <li><a href="<?php $arow->site_url;?>category.php?kat_sef=<?php echo $row['kat_sef'];?>"</a><span class="badge badge-default"><?php echo $row['kat_adi'] ?></span></a></li>
                            </ul>
                            <div class="clearfix"></div>
                            <img src="./images/<?php echo $row['slider_resim'] ?>" alt="<?php echo $row['slider_baslik']; ?>" />
                            <div class="eskimo-slider-desc">
                                <div class="eskimo-slider-desc-inner">
                                    <h2 class="card-title"><?php echo mb_substr($row['slider_baslik'],0,50, 'utf8'); ?></h2>
                                    <p><?php echo mb_substr($row['slider_icerik'], 0, 70, 'utf8'); ?>..</p>
                                </div>
                            </div>
                        </div>

                    <?php }
                    } ?>

                </div>
            </div>
            <!-- BLOG POSTS -->
            <!-- POST 1 -->

            <?php
                $s = @intval($_GET['s']);
                if (!$s){
                     $s = 1;
                }
                $sorgu = $db->prepare("SELECT yazi_kat_id,yazi_durum FROM yazılar
                INNER JOIN kategoriler ON kategoriler.kat_id = yazılar.yazi_kat_id WHERE yazi_durum = :d");
                $sorgu->execute([':d' => 1]);
                $toplam = $sorgu->rowCount();
                $lim = 3;
                $goster = $s * $lim - $lim;

                $sorgu = $db->prepare("SELECT * FROM yazılar INNER JOIN kategoriler ON kategoriler.kat_id = yazılar.yazi_kat_id
                WHERE yazi_durum = :d ORDER BY yazi_id DESC LIMIT :goster, :lim");
                $sorgu->bindValue(":d", (int) 1, PDO::PARAM_INT);
                $sorgu->bindValue(":goster", (int) $goster, PDO::PARAM_INT);
                $sorgu->bindValue(":lim", (int) $lim, PDO::PARAM_INT);
                $sorgu->execute();

                if($s > ceil($toplam/$lim)){ $s = 1; }

                if($sorgu->rowCount()){

                        foreach ($sorgu as $row){
                        ?>
                            <div class="card card-horizontal">
                                <div class="card-body">
                                    <div class="card-horizontal-left">
                                        <div class="card-category">
                                            <a href="category.php?kat_sef=<?php echo $row['kat_sef']; ?>"><?php echo $row['kat_adi'] ?></a> </div>
                                        <h3 class="card-title"><a href="<?php echo $arow->site_url; ?>icerik.php?yazi_sef=<?php echo $row['yazi_sef'];?>&id=<?php echo $row['yazi_id']; ?>"><?php echo $row['yazi_baslik']; ?></a></h3>
                                        <div class="card-excerpt">
                                            <?php echo mb_substr($row['yazi_icerik'], 0,200,'utf8'). '...'; ?>
                                        </div>
                                        <div class="card-horizontal-meta">
                                            <div class="eskimo-author-meta">
                                                <i class="fa fa-eye"></i> <?php echo $row['yazi_goruntulenme']; ?> Görüntülenme
                                            </div>
                                            <div class="eskimo-date-meta">
                                                <a href="<?php echo $arow->site_url; ?>icerik.php?yazi_sef=<?php echo $row['yazi_sef'];?>&id=<?php echo $row['yazi_id']; ?>"><?php echo date('d.m.Y',strtotime( $row['yazi_tarih']));?></a>
                                            </div>
                                            <div class="eskimo-reading-meta"><?php readingTime($row['yazi_icerik']); ?> Okuma Süresi</div>
                                        </div>
                                    </div>
                                    <div class="card-horizontal-right" data-img="images/<?php echo $row['yazi_resim']; ?>">
                                        <a class="card-featured-img" href="<?php echo $arow->site_url; ?>icerik.php?yazi_sef=<?php echo $row['yazi_sef'];?>&id=<?php echo $row['yazi_id']; ?>"></a>
                                    </div>
                                </div>
                            </div>
                        <?php
                        }
                }else {
                    echo '<div class="alert alert-danger" role="alert">Daha Önce Hiç İçerik Eklenmemiş.</div>';
                }
            ?>


            <!-- VIEW ALL BUTTON -->
            <div class="eskimo-view-more">
                <a class="btn btn-default" href="<?php echo $arow->site_url; ?>/blog.php">DİĞER SAYFAYA GEÇ</a>
            </div>

            <!-- DIVIDER -->
            <hr class="section-divider" />

            <!-- CAROUSEL -->
            <div class="eskimo-widget-title">
                <h3 class="eskimo-carousel-title"><span>POPÜLER YAZILAR</span></h3>
            </div>

            <div class="eskimo-carousel-container">
                <div class="eskimo-carousel-view-more">
                    <a href="<?php echo $arow->site_url; ?>/blog.php">DAHASI</a>
                </div>

                <div id="eskimo-post-carousel" class="eskimo-carousel">
                    <!-- CAROUSEL ITEM 1 -->
                    <?php
                    $yazicek = $db->prepare("SELECT * FROM yazılar WHERE yazi_durum = :d ORDER BY yazi_goruntulenme DESC LIMIT :lim");
                    $yazicek->bindValue(':d', (int)1, PDO::PARAM_INT);
                    $yazicek->bindValue(':lim', (int) 6, PDO::PARAM_INT);
                    $yazicek->execute();

                    if ($yazicek->rowCount()){
                        foreach ($yazicek as $item) {
                            ?>

                            <div>
                                <div class="card-masonry card-small">
                                    <div class="card">
                                        <a href="<?php echo $arow->site_url; ?>icerik.php?yazi_sef=<?php echo $item['yazi_sef'];?>&id=<?php echo $item['yazi_id']; ?>">
                                            <img class="card-vertical-img" style="height: 200px;" src="images/<?php echo $item['yazi_resim']; ?>" alt="<?php echo $item['yazi_baslik']; ?>>" />
                                        </a>
                                        <div class="card-border">
                                            <div class="card-body">
                                                <div class="card-category">
                                                    <a href="<?php echo $arow->site_url; ?>single-post.html"><?php echo date('d.m.Y', strtotime($item['yazi_tarih'])); ?></a>
                                                </div>
                                                <h5 class="card-title"><a href="<?php echo $arow->site_url; ?>icerik.php?yazi_sef=<?php echo $item['yazi_sef'];?>&id=<?php echo $item['yazi_id']; ?>"><?php echo $item['yazi_baslik']; ?></a></h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>




                            <?php

                        }
                    }


                    ?>





                </div>
            </div>
        </div>
    </main>

<?php require_once "inc/footer.php";