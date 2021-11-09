<?php
define('guvenlik', true);
require_once 'inc/ust.php'; ?>
    <!-- Sidebar menu-->
<?php require_once 'inc/sol.php'; ?>

    <main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="fa fa-th-list"></i> Mesajlar</h1>
          <p>Okunmuş Mesaj Listesi</p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item">Mesajlar</li>
          <li class="breadcrumb-item active"><a href="#">Okunmuş Mesaj Listesi</a></li>
        </ul>
      </div>
      <div class="row">

        <div class="clearfix"></div>
        <div class="col-md-12">
          <div class="tile">
              <?php
              $s = @intval(get('s'));
              if (!$s){ $s = 1; }
              $toplam = say('mesajlar', 'mesaj_durum', '1');
              $lim    = 25;
              $goster = $s * $lim - $lim;

              $sorgu = $db->prepare("SELECT * FROM mesajlar WHERE mesaj_durum = :d ORDER BY mesaj_id DESC LIMIT :goster, :lim");
              $sorgu->bindValue(':d', (int) 1, PDO::PARAM_INT);
              $sorgu->bindValue(':goster', (int) $goster, PDO::PARAM_INT);
              $sorgu->bindValue(':lim', (int) $lim, PDO::PARAM_INT);
              $sorgu->execute();

              if ($s > ceil($toplam/$lim)){ $s = 1; }
                    if ($sorgu->rowCount()){
              ?>
            <h3 class="tile-title">Okunmuş Mesaj Listesi</h3>
            <div class="table-responsive table-hover">
              <table class="table">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>İSİM</th>
                    <th>KONU</th>
                    <th>E-POSTA</th>
                    <th>TARİH</th>
                    <th>İŞLEMLER</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($sorgu as $row) { ?>

                      <tr>
                          <td><?php echo $row['mesaj_id']; ?></td>
                          <td><?php echo $row['mesaj_isim']; ?></td>
                          <td><?php echo $row['mesaj_konu']; ?></td>
                          <td><?php echo $row['mesaj_eposta']; ?></td>
                          <td><?php echo date('d.m.Y',strtotime($row['mesaj_tarih'])); ?></td>
                          <td><a href="<?php echo $yonetim."/islemler.php?islem=mesajoku&id=".$row['mesaj_id']; ?>"><i class="fa fa-eye"></i></a> | <a onclick="return confirm('Mesaj silinecek onaylıyor musunuz ?');" href="<?php echo $yonetim."/islemler.php?islem=mesajisil&id=".$row['mesaj_id']; ?>"><i class="fa fa-eraser"></i></a></td>
                      </tr>



                  <?php   } ?>

                </tbody>
              </table>
            </div>
                        <ul class="pagination">
                            <?php
                            if ($toplam > $lim){
                                pagination($s,ceil($toplam/$lim), 'okunmusmesajlar?s=');
                            }

                            ?>
                        </ul>

              <?php }else{
                        echo '<div class="alert alert-info">Okunmuş Mesaj Bulunmuyor.</div>';
                    }

                    ?>
          </div>
        </div>
      </div>
    </main>
<?php require_once 'inc/alt.php'; ?>