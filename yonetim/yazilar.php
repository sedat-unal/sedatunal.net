<?php
define('guvenlik', true);
require_once 'inc/ust.php'; ?>
    <!-- Sidebar menu-->
<?php require_once 'inc/sol.php'; ?>

    <main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="fa fa-th-list"></i> Yazılar</h1>
          <p>Yazı Listesi</p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item">Yazılar</li>
          <li class="breadcrumb-item active"><a href="#">Yazı Listesi</a></li>
        </ul>
      </div>
      <div class="row">

        <div class="clearfix"></div>
        <div class="col-md-12">
          <div class="tile">
              <?php
              $s = @intval(get('s'));
              if (!$s){ $s = 1; }
              $toplam = say('yazılar');
              $lim    = 25;
              $goster = $s * $lim - $lim;

              $sorgu = $db->prepare("SELECT * FROM yazılar INNER JOIN kategoriler ON kategoriler.kat_id = yazılar.yazi_kat_id
                ORDER BY yazi_id DESC LIMIT :goster, :lim");
              $sorgu->bindValue(':goster', (int) $goster, PDO::PARAM_INT);
              $sorgu->bindValue(':lim', (int) $lim, PDO::PARAM_INT);
              $sorgu->execute();

              if ($s > ceil($toplam/$lim)){ $s = 1; }
                    if ($sorgu->rowCount()){
              ?>
            <h3 class="tile-title">Yazı Listesi</h3>
            <div class="table-responsive table-hover">
              <table class="table">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>RESİM</th>
                      <th>BAŞLIK</th>
                    <th>KATEGORİ</th>
                    <th>TARİH</th>
                    <th>DURUM</th>
                    <th>İŞLEMLER</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($sorgu as $row) { ?>

                      <tr>
                          <td><?php echo $row['yazi_id']; ?></td>
                          <td><img src="../images/<?php echo $row['yazi_resim']; ?>" width="100" height="100" class="img-responsive" /></td>
                          <td><?php echo $row['yazi_baslik']; ?></td>
                          <td><?php echo $row['kat_adi']; ?></td>
                          <td><?php echo date('d.m.Y',strtotime($row['yazi_tarih'])); ?></td>
                          <td><?php echo $row['yazi_durum'] = 1 ? '<div style="color: green; font-weight: bold;">Aktif</div>' : '<div style="color : red; font-weight: bold;">Pasif</div>'; ?></td>
                          <td><a href="<?php echo $yonetim."/islemler.php?islem=yaziduzenle&id=".$row['yazi_id']; ?>"><i class="fa fa-edit"></i></a> | Düzenle <br>  <a onclick="return confirm('Yazı silindiği zaman siteden yedeksiz bir şekilde kaldırılacaktır onaylıyor musunuz ?');" href="<?php echo $yonetim."/islemler.php?islem=yazisil&id=".$row['yazi_id']; ?>"><i class="fa fa-eraser"></i></a> | Sil
                          </td>
                      </tr>



                  <?php   } ?>

                </tbody>
              </table>
            </div>
                        <ul class="pagination">
                            <?php
                            if ($toplam > $lim){
                                pagination($s,ceil($toplam/$lim), 'kategoriler.php?s=');
                            }

                            ?>
                        </ul>

              <?php }else{
                        echo '<div class="alert alert-info">Daha Önce Yazı Eklenmemiş veya Aktif Durumda Yazı Bulunmuyor.</div>';
                    }

                    ?>
          </div>
        </div>
      </div>
    </main>
<?php require_once 'inc/alt.php'; ?>