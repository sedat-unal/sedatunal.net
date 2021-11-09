<?php
define('guvenlik', true);
require_once 'inc/ust.php'; ?>
    <!-- Sidebar menu-->
<?php require_once 'inc/sol.php'; ?>

    <main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="fa fa-th-list"></i> Aboneler</h1>
          <p>Abone Listesi</p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item">Aboneler</li>
          <li class="breadcrumb-item active"><a href="#">Abone Listesi</a></li>
        </ul>
      </div>
      <div class="row">

        <div class="clearfix"></div>
        <div class="col-md-12">
          <div class="tile">
              <?php
              $s = @intval(get('s'));
              if (!$s){ $s = 1; }
              $toplam = say('aboneler');
              $lim    = 25;
              $goster = $s * $lim - $lim;

              $sorgu = $db->prepare("SELECT * FROM aboneler ORDER BY abone_id DESC LIMIT :goster, :lim");
              $sorgu->bindValue(':goster', (int) $goster, PDO::PARAM_INT);
              $sorgu->bindValue(':lim', (int) $lim, PDO::PARAM_INT);
              $sorgu->execute();

              if ($s > ceil($toplam/$lim)){ $s = 1; }
                    if ($sorgu->rowCount()){
              ?>
            <h3 class="tile-title">Abone Listesi</h3>
            <div class="table-responsive table-hover">
              <table class="table">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>ABONE E-POSTA</th>
                    <th>ABONE TARİH</th>
                    <th>ABONE İP</th>
                    <th>İŞLEMLER</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($sorgu as $row) { ?>

                      <tr>
                          <td><?php echo $row['abone_id']; ?></td>
                          <td><?php echo $row['abone_mail']; ?></td>
                          <td><?php echo date('d.m.Y',strtotime($row['abone_tarih'])); ?></td>
                          <td><?php echo $row['abone_ip']; ?></td>
                          <td><a href="<?php echo $yonetim."/islemler.php?islem=aboneduzenle&id=".$row['abone_id']; ?>"><i class="fa fa-edit"></i></a> | Düzenle
                              <br>
                              <a onclick="return confirm('Abone silindiği zaman bu aboneye mail gitmeyecektir onaylıyor musunuz ?');" href="<?php echo $yonetim."/islemler.php?islem=abonesil&id=".$row['abone_id']; ?>"><i class="fa fa-eraser"></i></a> | Sil
                          </td>
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