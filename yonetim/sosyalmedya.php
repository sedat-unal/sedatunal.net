<?php
define('guvenlik', true);
require_once 'inc/ust.php'; ?>
    <!-- Sidebar menu-->
<?php require_once 'inc/sol.php'; ?>

    <main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="fa fa-th-list"></i> Sosyal Medya</h1>
          <p>Sosyal Medya Hesapları</p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item">Sosyal Medya</li>
          <li class="breadcrumb-item active"><a href="#">Sosyal Medya Hesapları</a></li>
        </ul>
      </div>
      <div class="row">

        <div class="clearfix"></div>
        <div class="col-md-12">
          <div class="tile">
              <?php
              $s = @intval(get('s'));
              if (!$s){ $s = 1; }
              $toplam = say('sosyal_medya');
              $lim    = 25;
              $goster = $s * $lim - $lim;

              $sorgu = $db->prepare("SELECT * FROM sosyal_medya ORDER BY sosya_id DESC LIMIT :goster, :lim");
              $sorgu->bindValue(':goster', (int) $goster, PDO::PARAM_INT);
              $sorgu->bindValue(':lim', (int) $lim, PDO::PARAM_INT);
              $sorgu->execute();

              if ($s > ceil($toplam/$lim)){ $s = 1; }
                    if ($sorgu->rowCount()){
              ?>
            <h3 class="tile-title">Sosyal Medya Hesapları</h3>
            <div class="table-responsive table-hover">
              <table class="table">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>SOSYAL MEDYA İKON</th>
                    <th>SOSYAL MEDYA LİNK</th>
                    <th>DURUM</th>
                    <th>İŞLEMLER</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($sorgu as $row) { ?>

                      <tr>
                          <td><?php echo $row['sosya_id']; ?></td>
                          <td><?php echo $row['sosyal_ikon']; ?></td>
                          <td><?php echo $row['sosyal_link']; ?></td>
                          <td><?php echo $row['sosyal_durum'] == 1 ? '<div style="color: green; font-weight: bold;">Aktif</div>' : '<div style="color: darkred; font-weight: bold;">Pasif</div>'; ?></td>
                          <td><a href="<?php echo $yonetim."/islemler.php?islem=sosyalduzenle&id=".$row['sosya_id']; ?>"><i class="fa fa-edit"></i></a> | <a onclick="return confirm('Bu hesap silindiği zaman siteden bağlantı kaldırılacaktır onaylıyor musunuz ?');" href="<?php echo $yonetim."/islemler.php?islem=sosyalsil&id=".$row['sosya_id']; ?>"><i class="fa fa-eraser"></i></a></td>
                      </tr>


                  <?php   } ?>

                </tbody>
              </table>
            </div>
                        <ul class="pagination">
                            <?php
                            if ($toplam > $lim){
                                pagination($s,ceil($toplam/$lim), 'aboneler.php?s=');
                            }

                            ?>
                        </ul>

              <?php }else{
                        echo '<div class="alert alert-info">Abone Bulunmuyor.</div>';
                    }

                    ?>
          </div>
        </div>
      </div>
    </main>
<?php require_once 'inc/alt.php'; ?>