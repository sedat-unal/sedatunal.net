<?php define('guvenlik', true);
require_once "inc/header.php";
require_once "inc/menu.php";

        $yazisef = strip_tags(trim($_GET['yazi_sef']));
        $yaziid  = strip_tags(trim($_GET['id']));

        if (!$yaziid || !$yazisef){
            header("Location:".$arow->site_url);
        }

        ##sonraki ve önceki postu çeken kod bloğu ##
        $sonrakiid = $yaziid + 1;
        $oncekiid  = $yaziid - 1;

        $sonrakikonubul = $db->prepare("SELECT yazi_id, yazi_sef, yazi_baslik FROM yazılar WHERE yazi_id = :id AND yazi_durum = :d ");
        $sonrakikonubul->execute([':id' => $sonrakiid, ':d' => 1]);
        $sonrakikonurow = $sonrakikonubul->fetch(PDO::FETCH_OBJ);

        $oncekikonubul = $db->prepare("SELECT yazi_id, yazi_sef, yazi_baslik FROM yazılar WHERE yazi_id = :id AND yazi_durum = :d ");
        $oncekikonubul->execute([':id' => $oncekiid,  ':d' => 1]);
        $oncekikonurow = $oncekikonubul->fetch(PDO::FETCH_OBJ);



        $konubul = $db->prepare("SELECT * FROM yazılar INNER JOIN kategoriler ON kategoriler.kat_id = yazılar.yazi_kat_id
        WHERE yazi_sef = :sef AND yazi_id = :id AND yazi_durum = :d");
        $konubul->execute(['sef' => $yazisef, ':id' => $yaziid, ':d' => 1]);
        if ($konubul->rowCount()){
            $row = $konubul->fetch(PDO::FETCH_OBJ);

            $goruntulenme = @$_COOKIE[$row->yazi_id];
            if (!$goruntulenme){
                $okunmasayisi = $db->prepare("UPDATE yazılar SET yazi_goruntulenme = :g WHERE yazi_id = :id");
                $okunmasayisi->execute([':g'=>$row->yazi_goruntulenme + 1, ':id' => $yaziid]);
                setcookie($row->yazi_id, '1', time() + 3600);
            }


             ?>
            <!-- TITLE -->
            <div class="eskimo-page-title">
                <h1><span><?php echo $row->yazi_baslik; ?></span></h1>
                <div class="eskimo-page-title-meta">
                    <div class="eskimo-author-meta">
                        <i class="fa fa-eye"></i> <?php echo $row->yazi_goruntulenme; ?> Görüntülenme
                    </div>
                    <div class="eskimo-cat-meta">
                        <a href="category.php?kat_sef=<?php echo $row->kat_sef; ?>"><?php echo $row->kat_adi; ?></a>
                    </div>
                    <div class="eskimo-date-meta"><?php echo date('d.m.Y',strtotime( $row->yazi_tarih));?></div>
                    <div class="eskimo-reading-meta"><?php readingTime($row->yazi_icerik); ?> OKUMA SÜRESİ</div>
                </div>
            </div>
            <!-- IMAGE -->
            <div class="eskimo-featured-img">
                <img style="height: 600px; width: 1200px;" src="<?php echo $arow->site_url ?>/images/<?php echo $row->yazi_resim; ?>" alt="<?php echo $row->yazi_baslik; ?>" />
            </div>
            <!-- POST -->
            <div class="eskimo-page-content">
                <?php echo $row->yazi_icerik; ?>
                <div class="clearfix"></div>
                <!-- TAGS -->
                <div class="eskimo-meta-tags">
                    <?php
                        $etiketler = explode(",", $row->yazi_etiket);
                        $dizi      = array();
                        foreach ($etiketler as $etiket){
                            $dizi[] = '<span class="badge badge-default"><a href="etiketdetay.php?etiket='.sef_link($etiket).'">'.$etiket.'</a></span>';
                        }
                        $sonuc = implode(' ', $dizi);
                        echo $sonuc;


                    ?>
                </div>
                <!-- Responsive Social Sharing Buttons -- https://github.com/kni-labs/rrssb -->
                <div id="eskimo-share-buttons" class="eskimo-share-buttons">
                    <ul class="rrssb-buttons">
                        <!-- EMAIL -->
                        <li class="rrssb-email">
                            <a href="mailto:<?php echo $arow->site_mail; ?>?Subject=<?php echo $row->yazi_baslik;?>&body=<?php echo $arow->site_url; ?>/icerik.php?yazi_sef=<?php echo $row->yazi_sef;?>&id=<?php echo $row->yazi_id; ?>">
                                    <span class="rrssb-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M21.386 2.614H2.614A2.345 2.345 0 0 0 .279 4.961l-.01 14.078a2.353 2.353 0 0 0 2.346 2.347h18.771a2.354 2.354 0 0 0 2.347-2.347V4.961a2.356 2.356 0 0 0-2.347-2.347zm0 4.694L12 13.174 2.614 7.308V4.961L12 10.827l9.386-5.866v2.347z"/></svg>
                                    </span>
                                <span class="rrssb-text">Email</span>
                            </a>
                        </li>
                        <!-- FACEBOOK -->
                        <li class="rrssb-facebook">
                            <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $arow->site_url; ?>/icerik.php?yazi_sef=<?php echo $row->yazi_sef;?>&id=<?php echo $row->yazi_id; ?>" class="popup">
                                    <span class="rrssb-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 29 29"><path d="M26.4 0H2.6C1.714 0 0 1.715 0 2.6v23.8c0 .884 1.715 2.6 2.6 2.6h12.393V17.988h-3.996v-3.98h3.997v-3.062c0-3.746 2.835-5.97 6.177-5.97 1.6 0 2.444.173 2.845.226v3.792H21.18c-1.817 0-2.156.9-2.156 2.168v2.847h5.045l-.66 3.978h-4.386V29H26.4c.884 0 2.6-1.716 2.6-2.6V2.6c0-.885-1.716-2.6-2.6-2.6z"/></svg>
                                    </span>
                                <span class="rrssb-text">Facebook</span>
                            </a>
                        </li>
                        <!-- TWITTER -->
                        <li class="rrssb-twitter">
                            <a href="https://twitter.com/intent/tweet?text=<?php echo $row->yazi_baslik;?>" class="popup">
                                    <span class="rrssb-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 28 28"><path d="M24.253 8.756C24.69 17.08 18.297 24.182 9.97 24.62a15.093 15.093 0 0 1-8.86-2.32c2.702.18 5.375-.648 7.507-2.32a5.417 5.417 0 0 1-4.49-3.64c.802.13 1.62.077 2.4-.154a5.416 5.416 0 0 1-4.412-5.11 5.43 5.43 0 0 0 2.168.387A5.416 5.416 0 0 1 2.89 4.498a15.09 15.09 0 0 0 10.913 5.573 5.185 5.185 0 0 1 3.434-6.48 5.18 5.18 0 0 1 5.546 1.682 9.076 9.076 0 0 0 3.33-1.317 5.038 5.038 0 0 1-2.4 2.942 9.068 9.068 0 0 0 3.02-.85 5.05 5.05 0 0 1-2.48 2.71z"/></svg>
                                    </span>
                                <span class="rrssb-text">Twitter</span>
                            </a>
                        </li>
                        <!-- LINKEDIN -->
                        <li class="rrssb-linkedin">
                            <a href="http://www.linkedin.com/shareArticle?mini=true&amp;url=<?php echo $arow->site_url; ?>/icerik.php?yazi_sef=<?php echo $row->yazi_sef;?>&id=<?php echo $row->yazi_id; ?>" class="popup">
                                    <span class="rrssb-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 28 28"><path d="M25.424 15.887v8.447h-4.896v-7.882c0-1.98-.71-3.33-2.48-3.33-1.354 0-2.158.91-2.514 1.802-.13.315-.162.753-.162 1.194v8.216h-4.9s.067-13.35 0-14.73h4.9v2.087c-.01.017-.023.033-.033.05h.032v-.05c.65-1.002 1.812-2.435 4.414-2.435 3.222 0 5.638 2.106 5.638 6.632zM5.348 2.5c-1.676 0-2.772 1.093-2.772 2.54 0 1.42 1.066 2.538 2.717 2.546h.032c1.71 0 2.77-1.132 2.77-2.546C8.056 3.593 7.02 2.5 5.344 2.5h.005zm-2.48 21.834h4.896V9.604H2.867v14.73z"/></svg>
                                    </span>
                                <span class="rrssb-text">Linkedin</span>
                            </a>
                        </li>
                    </ul>
                </div>
                <!-- POST NAVIGATION -->
                <div class="eskimo-post-nav-wrapper">
                    <!-- PREVIOUS POST -->
                    <div class="eskimo-post-nav-left-row">
                        <?php if ($oncekikonubul->rowCount()){ ?>
                        <div class="eskimo-post-nav-table">
                            <a class="eskimo-post-nav" href="<?php echo $arow->site_url; ?>icerik.php?yazi_sef=<?php echo $oncekikonurow->yazi_sef;?>&id=<?php echo $oncekikonurow->yazi_id; ?>">
                                <i class="fa fa-chevron-left"></i>
                            </a>
                            <div class="eskimo-post-nav-link">
                                <a class="eskimo-post-nav" href="<?php echo $arow->site_url; ?>icerik.php?yazi_sef=<?php echo $oncekikonurow->yazi_sef;?>&id=<?php echo $oncekikonurow->yazi_id; ?>"><?php echo $oncekikonurow->yazi_baslik; ?></a>
                            </div>
                        </div>
                        <?php }else {
                            ?>
                            <div class="eskimo-post-nav-link">
                                <a class="eskimo-post-nav" href="<?php echo $arow->site_url; ?>">Bir önceki konu henüz eklenmemiş.</a>
                            </div>
                        <?php
                        } ?>
                    </div>
                    <!-- NEXT POST -->
                    <div class="eskimo-post-nav-right-row">
                        <div class="eskimo-post-nav-table">
                            <?php if($sonrakikonubul->rowCount()){  ?>
                            <div class="eskimo-post-nav-link">
                                <a class="eskimo-post-nav" href="<?php echo $arow->site_url; ?>icerik.php?yazi_sef=<?php echo $sonrakikonurow->yazi_sef;?>&id=<?php echo $sonrakikonurow->yazi_id; ?>"><?php echo $sonrakikonurow->yazi_baslik; ?></a>
                            </div>
                            <a class="eskimo-post-nav" href="<?php echo $arow->site_url; ?>icerik.php?yazi_sef=<?php echo $sonrakikonurow->yazi_sef;?>&id=<?php echo $sonrakikonurow->yazi_id; ?>">
                                <i class="fa fa-chevron-right"></i></a>
                            <?php }else {
                            ?>
                                <div class="eskimo-post-nav-link">
                                    <a class="eskimo-post-nav" href="<?php echo $arow->site_url; ?>">Bir sonraki konu henüz eklenmemiş.</a>
                                </div>
                            <?php
                            }  ?>
                        </div>
                    </div>
                </div>
                <hr />
                <!-- COMMENTS -->
                <div id="eskimo-comments-wrapper">
                    <div id="eskimo_comments_block" class="eskimo_comments_block">
                        <h3 class="eskimo-title-with-border">
                            <span>Yorumlar</span>
                        </h3>
                        <div class="eskimo_commentlist">

                            <?php

                            $yorumlar = $db->prepare("SELECT * FROM yorumlar WHERE yorum_yazi_id = :id AND yorum_durum = :d");
                            $yorumlar->execute([':id' => $row->yazi_id, ':d' => 1]);
                            if ($yorumlar->rowCount()){
                                ?>
                                <?php foreach ($yorumlar as $yor){ ?>
                                <div class="eskimo_comment_wrapper">
                                    <div class="eskimo_comments">
                                        <div class="eskimo_comment">
                                            <div class="eskimo_comment_inner">
                                                <div class="eskimo_comment_right">
                                                    <div class="eskimo_comment_right_inner ">
                                                        <cite class="eskimo_fn">
                                                            <p>Yorum Sahibi : <?php echo $yor['yorum_isim'] ?></p>
                                                        </cite>
                                                        <div class="eskimo_comment_links">
                                                            <i class="fa fa-clock-o" style="margin-right: 3px;"></i>Yorum Tarihi : <?php echo date('d.m.Y',strtotime($yor['yorum_tarih'])) ?>
                                                        </div>
                                                        <div class="eskimo_comment_text">
                                                            <p><?php echo $yor['yorum_icerik'] ?></p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php } ?>



                                <?php

                            }else{
                                echo '<div><p>Henüz yorum yapılmamış, ilk yorumu yapan sen ol.</p></div>';
                            }



                            ?>




                        </div>
                    </div>
                </div>
                <div id="eskimo_comment_form" class="eskimo_comment_form">
                    <h3>Yorum Yaz</h3>
                    <form action="" method="POST" onsubmit="return false;" id="yorumformu">
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="upper" for="name">Ad Soyad</label>
                                    <input class="form-control required" name="adsoyad" placeholder="İsim giriniz." id="name">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="upper" for="name">E-posta</label>
                                    <input class="form-control required email" name="eposta" placeholder="Yayınlanmayacak sadece güvenlik gereği." id="email">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="upper" for="name">Website</label>
                                    <input class="form-control website" name="website" placeholder="Eğer varsa websitenizin ismini giriniz." id="website">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <p><textarea id="comment" name="yorum" cols="45" rows="8" required="required" placeholder="Yorumunuz.."></textarea></p>
                                    <input type="hidden" value="<?php echo $row->yazi_id; ?>" name="yaziid" />
                                    <input name="submit" type="submit" id="submit" class="btn btn-default" onclick="yorumyap();" value="Yorum Yap" />
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            </div>
            </main>
            <?php

        }else {
            header("Location:".$arow->site_url);
        }
        require_once "inc/footer.php";