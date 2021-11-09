<?php define('guvenlik', true);
require_once "inc/header.php";
require_once "inc/menu.php";
        $s = @intval($_GET['s']);
        if (!$s){ $s = 1; }

        $kat = strip_tags($_GET['kat_sef']);
        if (!$kat){
            header("Location:".$arow->site_url);
        }
        $kategoribul = $db->prepare("SELECT * FROM kategoriler WHERE kat_sef = :k");
        $kategoribul->execute([':k'=> $kat]);
        if($kategoribul->rowCount()) {
            $katrow = $kategoribul->fetch(PDO::FETCH_OBJ);
        }else {
            header("Location:".$arow->site_url);
        }
        ?>
            <div class="eskimo-page-title">
                <h1><span><?php echo $katrow->kat_adi; ?> KATEGORİSİ</span></h1>
            </div>
            <div class="eskimo-masonry-grid">
                <div class="eskimo-two-columns" data-columns>
                    <?php
                    $sorgu = $db->prepare("SELECT yazi_kat_id,yazi_durum FROM yazılar
                    INNER JOIN kategoriler ON kategoriler.kat_id = yazılar.yazi_kat_id WHERE yazi_durum = :d AND yazi_kat_id = :kat");
                    $sorgu->execute([':d' => 1, ':kat' => $katrow->kat_id]);
                    $toplam = $sorgu->rowCount();
                    $lim = 6;
                    $goster = $s * $lim - $lim;

                    $sorgu = $db->prepare("SELECT * FROM yazılar INNER JOIN kategoriler ON kategoriler.kat_id = yazılar.yazi_kat_id
                    WHERE yazi_durum = :d AND yazi_kat_id = :kat ORDER BY yazi_id DESC LIMIT :goster, :lim");
                    $sorgu->bindValue(":d", (int) 1, PDO::PARAM_INT);
                    $sorgu->bindValue(":kat", (int) $katrow->kat_id, PDO::PARAM_INT);
                    $sorgu->bindValue(":goster", (int) $goster, PDO::PARAM_INT);
                    $sorgu->bindValue(":lim", (int) $lim, PDO::PARAM_INT);
                    $sorgu->execute();

                    if($s > ceil($toplam/$lim)){
                        $s = 1;
                    }

                    if($sorgu->rowCount()){

                        foreach ($sorgu as $row){
                            ?>
                            <div class="card-masonry">
                                <div class="card">
                                    <a href="<?php echo $arow->site_url; ?>icerik.php?yazi_sef=<?php echo $row['yazi_sef'];?>&id=<?php echo $row['yazi_id']; ?>">
                                        <img class="card-vertical-img" src="images/<?php echo $row['yazi_resim']; ?>" alt="Ketchup Flavored Ice Cream!" />
                                    </a>
                                    <div class="card-border">
                                        <div class="card-body">
                                            <div class="card-category">
                                                <span><a href="category.php?kat_sef=<?php echo $row['kat_sef']; ?>"><?php echo $row['kat_adi'] ?></a></span>
                                            </div>
                                            <h3 class="card-title">
                                                <a href="<?php echo $arow->site_url; ?>icerik.php?yazi_sef=<?php echo $row['yazi_sef'];?>&id=<?php echo $row['yazi_id']; ?>"><?php echo $row['yazi_baslik']; ?></a>
                                            </h3>
                                            <p style="word-wrap: break-word;"><?php echo mb_substr($row['yazi_icerik'], 0,200,'utf8'). '...'; ?></p>
                                        </div>
                                        <div class="card-footer">
                                            <div class="eskimo-author-meta">
                                                <i class="fa fa-eye"></i> <?php echo $row['yazi_goruntulenme']; ?> Görüntülenme
                                            </div>
                                            <div class="eskimo-date-meta">
                                                <?php echo date('d.m.Y',strtotime( $row['yazi_tarih']));?>
                                            </div>
                                            <div class="eskimo-reading-meta"><?php readingTime($row['yazi_icerik']); ?> Okuma Süresi</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                        }
                    ?>
                </div>

                <div class="eskimo-pager">
                    <ul class='pagination flex-wrap'>
                        <?php
                        if ($toplam > $lim){
                            pagination($s,ceil($toplam/$lim), 'category.php?kat_sef='.$kat.'&s=');
                        }
                        ?>
                    </ul>
                </div>
                <?php
                }else {
                    echo '<div class="alert alert-danger" role="alert">Bu Kategoriye Daha Önce Hiç İçerik Eklenmemiş.</div>';
                }
                ?>
            </div>
            <div class="clearfix"></div>
        </div>
    </main>
<?php require_once "inc/footer.php";