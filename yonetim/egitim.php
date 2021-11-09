<?php
define('guvenlik', true);
require_once 'inc/ust.php'; ?>
    <!-- Sidebar menu-->
<?php require_once 'inc/sol.php'; ?>

    <main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="fa fa-th-list"></i> Bilgiler Listesi</h1>
          <p>Bilgiler Listesi</p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item">Bilgiler Listesi</li>
          <li class="breadcrumb-item active"><a href="#">Bilgiler Listesi</a></li>
        </ul>
      </div>
      <div class="row">

        <div class="clearfix"></div>
        <div class="col-md-12">
          <div class="tile">
              <?php
              $s = @intval(get('s'));
              if (!$s){ $s = 1; }
              $toplam = say('egitim');
              $lim    = 25;
              $goster = $s * $lim - $lim;

              $sorgu = $db->prepare("SELECT * FROM egitim ORDER BY egitim_id DESC LIMIT :goster, :lim");
              $sorgu->bindValue(':goster', (int) $goster, PDO::PARAM_INT);
              $sorgu->bindValue(':lim', (int) $lim, PDO::PARAM_INT);
              $sorgu->execute();

              if ($s > ceil($toplam/$lim)){ $s = 1; }
                    if ($sorgu->rowCount()){
              ?>
            <h3 class="tile-title">Eğitim Bilgileri Listesi</h3>
            <div class="table-responsive table-hover">
              <table class="table">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>EĞİTİM TARİHİ</th>
                    <th>KURUM ADI</th>
                    <th>İŞLEMLER</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($sorgu as $row) { ?>

                      <tr>
                          <td><?php echo $row['egitim_id']; ?></td>
                          <td><?php echo $row['egitim_tarih']; ?></td>
                          <td><?php echo $row['egitim_baslik']; ?></td>
                          <td><a href="<?php echo $yonetim."/islemler.php?islem=egitimduzenle&id=".$row['egitim_id']; ?>"><i class="fa fa-edit"></i></a> | <a onclick="return confirm('Bu eğitimin silinmesini onaylıyor musunuz ?');" href="<?php echo $yonetim."/islemler.php?islem=egitimsil&id=".$row['egitim_id']; ?>"><i class="fa fa-eraser"></i></a></td>
                      </tr>



                  <?php   } ?>

                </tbody>
              </table>
            </div>

              <?php }else{
                        echo '<div class="alert alert-info">Eğitim Bilgisi Bulunmuyor.</div>';
                    }

                    ?>
          </div>
        </div>
      </div>
        <div class="row">
            <div class="clearfix"></div>
            <div class="col-md-12">
                <div class="tile">
                    <?php
                    $s = @intval(get('s'));
                    if (!$s){ $s = 1; }
                    $toplam = say('sertifika');
                    $lim    = 25;
                    $goster = $s * $lim - $lim;

                    $sorgu = $db->prepare("SELECT * FROM sertifika ORDER BY sertifika_id DESC LIMIT :goster, :lim");
                    $sorgu->bindValue(':goster', (int) $goster, PDO::PARAM_INT);
                    $sorgu->bindValue(':lim', (int) $lim, PDO::PARAM_INT);
                    $sorgu->execute();

                    if ($s > ceil($toplam/$lim)){ $s = 1; }
                    if ($sorgu->rowCount()){
                        ?>
                        <h3 class="tile-title">Sertifika & Kurs Bilgileri Listesi</h3>
                        <div class="table-responsive table-hover">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>SERTİFİKA & KURS TARİHİ</th>
                                    <th>SERTİFİKA & KURS ADI</th>
                                    <th>İŞLEMLER</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($sorgu as $row) { ?>

                                    <tr>
                                        <td><?php echo $row['sertifika_id']; ?></td>
                                        <td><?php echo $row['sertifika_tarih']; ?></td>
                                        <td><?php echo $row['sertifika_baslik']; ?></td>
                                        <td><a href="<?php echo $yonetim."/islemler.php?islem=sertifikaduzenle&id=".$row['sertifika_id']; ?>"><i class="fa fa-edit"></i></a> | <a onclick="return confirm('Bu bilginin silinmesini onaylıyor musunuz ?');" href="<?php echo $yonetim."/islemler.php?islem=sertifikasil&id=".$row['sertifika_id']; ?>"><i class="fa fa-eraser"></i></a></td>
                                    </tr>



                                <?php   } ?>

                                </tbody>
                            </table>
                        </div>

                    <?php }else{
                        echo '<div class="alert alert-info">Bilgi Bulunmuyor.</div>';
                    }

                    ?>
                </div>
            </div>
        </div>

        <div class="row">

            <div class="clearfix"></div>
            <div class="col-md-12">
                <div class="tile">
                    <?php
                    $s = @intval(get('s'));
                    if (!$s){ $s = 1; }
                    $toplam = say('deneyim');
                    $lim    = 25;
                    $goster = $s * $lim - $lim;

                    $sorgu = $db->prepare("SELECT * FROM deneyim ORDER BY deneyim_id DESC LIMIT :goster, :lim");
                    $sorgu->bindValue(':goster', (int) $goster, PDO::PARAM_INT);
                    $sorgu->bindValue(':lim', (int) $lim, PDO::PARAM_INT);
                    $sorgu->execute();

                    if ($s > ceil($toplam/$lim)){ $s = 1; }
                    if ($sorgu->rowCount()){
                        ?>
                        <h3 class="tile-title">İş Deneyim Bilgileri Listesi</h3>
                        <div class="table-responsive table-hover">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>İŞ DENEYİM TARİHİ</th>
                                    <th>İŞ DENEYİM ADI</th>
                                    <th>İŞLEMLER</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($sorgu as $row) { ?>

                                    <tr>
                                        <td><?php echo $row['deneyim_id']; ?></td>
                                        <td><?php echo $row['deneyim_tarih']; ?></td>
                                        <td><?php echo $row['deneyim_baslik']; ?></td>
                                        <td><a href="<?php echo $yonetim."/islemler.php?islem=deneyimduzenle&id=".$row['deneyim_id']; ?>"><i class="fa fa-edit"></i></a> | <a onclick="return confirm('Bu bilginin silinmesini onaylıyor musunuz ?');" href="<?php echo $yonetim."/islemler.php?islem=deneyimsil&id=".$row['deneyim_id']; ?>"><i class="fa fa-eraser"></i></a></td>
                                    </tr>



                                <?php   } ?>

                                </tbody>
                            </table>
                        </div>


                    <?php }else{
                        echo '<div class="alert alert-info">Bilgi Bulunmuyor.</div>';
                    }

                    ?>
                </div>
            </div>
        </div>


    </main>
<?php require_once 'inc/alt.php'; ?>