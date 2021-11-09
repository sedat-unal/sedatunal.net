<?php define('guvenlik', true);
require_once "inc/header.php";
require_once "inc/menu.php"; ?>
                <div class="clearfix"></div>
                <!-- PAGE TITLE -->
                <div class="eskimo-page-title">
                    <h1><span><?php echo $hrow->hakkimda_isim; ?></span></h1>
                    <p class="eskimo-page-subtitle"><?php echo $hrow->hakkimda_meslek; ?></p>
                </div>
                <!-- ABOUT ME -->
                <div class="row">
                    <div class="col-12 col-lg-7 order-2 order-lg-1">
                        <p style="word-wrap: break-word;"><?php echo $hrow->hakkimda_icerik; ?></p>
                    </div>
                    <div class="col-12 col-lg-5 order-1 order-lg-2 mb-5 mb-lg-0">
                        <img style="height: 350px;" src="images/<?php echo $hrow->hakkimda_resim; ?>" alt="<?php echo $hrow->hakkimda_isim; ?>" class="img-fluid mx-auto d-block eskimo-img-shadow"/>
                    </div>
                </div>

                <!-- DIVIDER -->
                <hr />
                <!-- TABS -->
                <h2>EĞİTİM & KURS & DENEYİM</h2>
                <!-- TABS -->
                <!-- TABS NAVIGATION -->
                <ul class="nav nav-tabs">
                    <!-- TAB 1 -->
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#mp-tab-1" aria-expanded="true">
                            <i class="fa fa-microphone"></i> Eğitim
                        </a>
                    </li>
                    <!-- TAB 2 -->
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#mp-tab-2" aria-expanded="false">
                            <i class="fa fa-rocket"></i> Sertifika & Kurs
                        </a>
                    </li>
                    <!-- TAB 3 -->
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#mp-tab-3" aria-expanded="false">
                            <i class="fa fa-android"></i> İş Deneyimi
                        </a>
                    </li>
                </ul>
                <!-- TABS CONTENT -->
                <div class="eskimo-tabs-content tab-content">
                    <!-- TAB 1 -->
                    <div class="tab-pane fade active show" id="mp-tab-1" role="button" aria-expanded="true">
                        <?php
                        $egitimcek = $db->prepare("SELECT * FROM egitim ORDER BY egitim_id DESC");
                        $egitimcek->execute();
                        if ($egitimcek->rowCount()){
                            foreach ($egitimcek as $item){
                                ?>

                                <p class="font-italic"><?php echo $item['egitim_tarih']; ?></p>
                                <h3><?php echo $item['egitim_baslik']; ?></h3>
                                <p><?php echo $item['egitim_icerik'];  ?></p>
                                <hr />

                                <?php

                            }
                        }
                        ?>

                    </div>
                    <!-- TAB 2 -->
                    <div class="tab-pane fade " id="mp-tab-2" role="button" aria-expanded="false">

                        <?php
                        $egitimcek = $db->prepare("SELECT * FROM sertifika ORDER BY sertifika_id DESC");
                        $egitimcek->execute();
                        if ($egitimcek->rowCount()){
                            foreach ($egitimcek as $item){
                                ?>

                                <p class="font-italic"><?php echo $item['sertifika_tarih']; ?></p>

                                <h3><?php echo $item['sertifika_baslik']; ?></h3>

                                <p><?php echo $item['sertifika_icerik'];  ?></p>
                                <hr />
                                <?php
                            }
                        }
                        ?>

                    </div>
                    <!-- TAB 3 -->
                    <div class="tab-pane fade " id="mp-tab-3" role="button" aria-expanded="false">

                        <?php
                        $egitimcek = $db->prepare("SELECT * FROM deneyim ORDER BY deneyim_id DESC");
                        $egitimcek->execute();
                        if ($egitimcek->rowCount()){
                            foreach ($egitimcek as $item){
                                ?>

                                <p class="font-italic"><?php echo $item['deneyim_tarih']; ?></p>
                                <h3><?php echo $item['deneyim_baslik']; ?></h3>

                                <p><?php echo $item['deneyim_icerik'];  ?></p>
                                <hr />
                                <?php
                            }
                        }
                        ?>

                    </div>
                </div>
                <!-- DIVIDER -->
                <hr />
                <!-- DIVIDER -->
                <hr />
                <h2>Bana Yaz</h2>
                <p>Daha detaylı bilgi ve randevu için <a href="mailto:hilal@hilalyildirim.com"><?php echo $arow->site_mail; ?></a> mail adresinden ulaşabilirsiniz. </p>
                <p><?php echo $hrow->hakkimda_iletisim; ?></p>
                <!-- CONTACT FORM -->
                <form id="iletisimformu" onsubmit="return false;" role="form" action="" method="post">
                    <div class="row">
                        <div class="col-12 col-lg-6">
                            <p>
                                <label>Ad Soyad</label><br />
                                <input type="text" name="isim" class="form-control" required="required" placeholder="Adınız Soyadınız" />
                            </p>
                            <p>
                                <label>E-posta</label><br />
                                <input type="email" name="eposta" class="form-control" required="required" placeholder="E-postanız" />
                            </p>
                            <p>
                                <label>Konu</label><br />
                                <input type="text" name="konu" class="form-control" placeholder="Konu" />
                            </p>
                        </div>
                        <div class="col-12 col-lg-6">
                            <p>
                                <label>Mesaj</label><br />
                                <textarea name="mesaj" required="required" class="form-control form-fixed-height" placeholder="Mesajınız.."></textarea>
                            </p>
                            <button id="sendbutton" onclick="mesajgonder();" type="submit" class="btn btn-lg w-100">Gönder</button>
                        </div>
                    </div>
                </form>
                <div id="form-messages"></div>
            </div>
        </main>
       <?php require_once "inc/footer.php";