<?php
define('guvenlik', true);
require_once 'sistemyonetim/fonksiyon.php';
require_once 'inc/ust.php'; ?>
    <!-- Sidebar menu-->
    <?php require_once 'inc/sol.php'; ?>


    <main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="fa fa-dashboard"></i> Yönetim Paneli</h1>
          <p>Blog Sitesi | Yönetim Paneli</p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="#">Ana Sayfa</a></li>
        </ul>
      </div>
      <div class="row">
        <div class="col-md-6 col-lg-3">
          <div class="widget-small primary coloured-icon"><i class="icon fa fa-users fa-3x"></i>
            <div class="info">
              <h4>Aboneler</h4>
              <p><b><?php echo say('aboneler'); ?> Adet</b></p>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-lg-3">
          <div class="widget-small info coloured-icon"><i class="icon fa fa-comment fa-3x"></i>
            <div class="info">
              <h4>Yorumlar</h4>
              <p><b><?php echo say('yorumlar'); ?> Adet</b></p>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-lg-3">
          <div class="widget-small warning coloured-icon"><i class="icon fa fa-files-o fa-3x"></i>
            <div class="info">
              <h4>Yazılar</h4>
              <p><b><?php echo say('yazılar'); ?> Adet</b></p>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-lg-3">
          <div class="widget-small danger coloured-icon"><i class="icon fa fa-envelope fa-3x"></i>
            <div class="info">
              <h4>Mesajlar</h4>
              <p><b><?php echo say('mesajlar'); ?> Adet</b></p>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6">
          <div class="tile">
            <h3 class="tile-title">Son 10 Mesaj</h3>
            <?php
            $sonmesaj = $db->prepare("SELECT * FROM mesajlar WHERE mesaj_durum=  :d ORDER BY mesaj_id DESC
             LIMIT :lim");
            $sonmesaj->bindValue(':d', (int) 2, PDO::PARAM_INT);
            $sonmesaj->bindValue(':lim', (int) 10, PDO::PARAM_INT);
            $sonmesaj->execute();
            if ($sonmesaj->rowCount()){
                ?>
                <div class="table-responsive table-hover">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>#ID</th>
                            <th>İSİM</th>
                            <th>KONU</th>
                            <th>TARİH</th>
                            <th>İŞLEMLER</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                            foreach ($sonmesaj as $son){ ?>
                                <tr>
                                    <td><?php echo $son['mesaj_id']; ?></td>
                                    <td><?php echo $son['mesaj_isim']; ?></td>
                                    <td><?php echo $son['mesaj_konu']; ?></td>
                                    <td><?php echo date('d.m.Y', strtotime($son['mesaj_tarih'])); ?></td>
                                    <td><a href="<?php echo $yonetim; ?>/islemler.php?islem=mesajoku&id=<?php echo $son['mesaj_id']; ?>"><i class="fa fa-eye"></i></a></td>
                                </tr>


                               <?php
                            }

                        ?>

                        </tbody>
                    </table>
                </div>


                <?php

            }else {
                echo '<div class="alert alert-danger">Hiç Mesaj Yok.</div>';
            }
            ?>
          </div>
        </div>
        <div class="col-md-6">
          <div class="tile">
            <h3 class="tile-title">Son Yeni 10 Yorum</h3>
              <?php
              $sonyorum = $db->prepare("SELECT * FROM yorumlar INNER JOIN yazılar ON yazılar.yazi_id = yorumlar.yorum_yazi_id
                WHERE yorum_durum=  :d ORDER BY yorum_id DESC LIMIT :lim");
              $sonyorum->bindValue(':d', (int) 2, PDO::PARAM_INT);
              $sonyorum->bindValue(':lim', (int) 10, PDO::PARAM_INT);
              $sonyorum->execute();
              if ($sonyorum->rowCount()){
                  ?>
                  <div class="table-responsive table-hover">
                      <table class="table">
                          <thead>
                          <tr>
                              <th>#ID</th>
                              <th>İSİM</th>
                              <th>KONU</th>
                              <th>TARİH</th>
                              <th>İŞLEMLER</th>
                          </tr>
                          </thead>
                          <tbody>
                          <?php
                          foreach ($sonyorum as $son){ ?>
                              <tr>
                                  <td><?php echo $son['yorum_id']; ?></td>
                                  <td><?php echo $son['yorum_isim']; ?></td>
                                  <td><?php echo $son['yorum_icerik']; ?></td>
                                  <td><?php echo date('d.m.Y', strtotime($son['yorum_tarih'])); ?></td>
                                  <td><a href="<?php echo $yonetim; ?>/islemler.php?islem=yorumoku&id=<?php echo $son['yorum_id']; ?>"><i class="fa fa-eye"></i></a></td>
                              </tr>


                              <?php
                          }

                          ?>

                          </tbody>
                      </table>
                  </div>


                  <?php

              }else {
                  echo '<div class="alert alert-danger">Hiç Yorum Yok.</div>';
              }
              ?>
          </div>
        </div>
      </div>
    </main>


<?php require_once 'inc/alt.php'; ?>