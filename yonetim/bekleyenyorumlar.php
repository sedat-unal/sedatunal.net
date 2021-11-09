<?php
define('guvenlik', true);
require_once 'inc/ust.php'; ?>
    <!-- Sidebar menu-->
<?php require_once 'inc/sol.php'; ?>

    <main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="fa fa-th-list"></i> Bekleyen Yorumlar</h1>
          <p>Bekleyen Yorumlar</p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item">Yorumlar</li>
          <li class="breadcrumb-item active"><a href="#">Bekleyen Yorumlar</a></li>
        </ul>
      </div>
      <div class="row">

        <div class="clearfix"></div>
        <div class="col-md-12">
          <div class="tile">
              <?php
              $s = @intval(get('s'));
              if (!$s){ $s = 1; }
              $toplam = say('yorumlar','yorum_durum','2');
              $lim    = 25;
              $goster = $s * $lim - $lim;

              $sorgu = $db->prepare("SELECT * FROM yorumlar INNER JOIN yazılar ON yazılar.yazi_id = yorumlar.yorum_yazi_id
                WHERE yorum_durum = :d ORDER BY yorum_id DESC LIMIT :goster, :lim");
              $sorgu->bindValue(':d', (int) 2, PDO::PARAM_INT);
              $sorgu->bindValue(':goster', (int) $goster, PDO::PARAM_INT);
              $sorgu->bindValue(':lim', (int) $lim, PDO::PARAM_INT);
              $sorgu->execute();

              if ($s > ceil($toplam/$lim)){ $s = 1; }
                    if ($sorgu->rowCount()){
              ?>
            <h3 class="tile-title">Bekleyen Yorumlar Listesi</h3>
            <div class="table-responsive table-hover">
              <table class="table">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>YORUMCU İSMİ</th>
                    <th>YORUM YAPILAN YAZI</th>
                    <th>YORUMCU E-POSTA</th>
                    <th>TARİH</th>
                    <th>İŞLEMLER</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($sorgu as $row) { ?>

                      <tr>
                          <td><?php echo $row['yorum_id']; ?></td>
                          <td><?php echo $row['yorum_isim']; ?></td>
                          <td><?php echo $row['yazi_baslik']; ?></td>
                          <td><?php echo $row['yorum_eposta']; ?></td>
                          <td><?php echo date('d.m.Y', strtotime($row['yorum_tarih'])); ?></td>
                          <td><a href="<?php echo $yonetim."/islemler.php?islem=yorumoku&id=".$row['yorum_id']; ?>"><i class="fa fa-eye"></i></a> | Oku
                              <br>
                              <a onclick="return confirm('Onaylıyor musunuz ?');" href="<?php echo $yonetim."/islemler.php?islem=yorumsil&id=".$row['yorum_id']; ?>"><i class="fa fa-eraser"></i></a> | Sil
                          </td>
                      </tr>



                  <?php   } ?>

                </tbody>
              </table>
            </div>
                        <ul class="pagination">
                            <?php
                            if ($toplam > $lim){
                                pagination($s,ceil($toplam/$lim), 'bekleyenyorumlar.php?s=');
                            }

                            ?>
                        </ul>

              <?php }else{
                        echo '<div class="alert alert-info">Bekleyen Yorum Bulunmuyor.</div>';
                    }

                    ?>
          </div>
        </div>
      </div>
    </main>
<?php require_once 'inc/alt.php'; ?>