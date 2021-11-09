<?php
define('guvenlik', true);
require_once 'inc/ust.php'; ?>
    <!-- Sidebar menu-->
<?php require_once 'inc/sol.php'; ?>

    <main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="fa fa-th-list"></i> Hakkımda</h1>
          <p>Hakkımda Sayfası</p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item">Hakkımda</li>
          <li class="breadcrumb-item active"><a href="#">Hakkımda Sayfası</a></li>
        </ul>
      </div>
      <div class="row">

        <div class="clearfix"></div>
        <div class="col-md-12">
          <div class="tile">
            <h3 class="tile-title">Hakkımda Sayfası</h3>
              <?php
              $about = $db->prepare("SELECT * FROM hakkimda");
              $about->execute();
              $row = $about->fetch(PDO::FETCH_OBJ);

              if (isset($_POST['duzenle'])){
                  require 'inc/class.upload.php';

                  $isim     = post('isim');
                  $meslek   = post('meslek');
                  $icerik   = post('icerik');
                  $iletisim = post('iletisim');

                      $image = new Upload($_FILES['resim']);
                      if ($image->uploaded){
                          $rname = md5(uniqid());
                          $image->allowed = array("image/*");
                          $image->image_convert = "webp";
                          $image->file_new_name_body = $rname;
                          $image->process("../images");

                          if ($image->processed){
                              $guncelle = $db->prepare("UPDATE hakkimda SET
                                hakkimda_isim = :i,
                                hakkimda_meslek = :m,
                                hakkimda_resim = :r,
                                hakkimda_icerik = :y,
                                hakkimda_iletisim = :il WHERE hakkimda_id = :id");
                              $guncelle->execute([
                                  ':i' => $isim,
                                  ':m' => $meslek,
                                  ':r' => $rname.".webp",
                                  ':y' => $icerik,
                                  ':il' => $iletisim,
                                  ':id' => 1
                              ]);

                              if ($guncelle->rowCount()){
                                  echo '<div class="alert alert-success">Hakkımda Sayfası Başarıyla Güncellendi.</div>';
                                  header("Refresh:2;url=".$_SERVER['HTTP_REFERER']);

                              }else {
                                  echo '<div class="alert alert-danger">Hakkımda Sayfası Güncellenirken Hata Oluştu.</div>';
                              }

                          }else {
                              echo '<div class="alert alert-danger">Resim Yüklenemedi...</div>';
                          }

                      }else{
                          $guncelle2 = $db->prepare("UPDATE hakkimda SET
                            hakkimda_isim = :i,
                            hakkimda_meslek = :m,
                            hakkimda_icerik = :y,
                            hakkimda_iletisim = :il WHERE hakkimda_id = :id");
                          $guncelle2->execute([
                            ':i' => $isim,
                            ':m' => $meslek,
                            ':y' => $icerik,
                            ':il' => $iletisim,
                            ':id' => 1
                            ]);

                          if ($guncelle2->rowCount()){
                              echo '<div class="alert alert-success">Hakkımda Sayfası Resim Değiştirilmeden Başarıyla Güncellendi.</div>';
                              header("Refresh:2;url=".$_SERVER['HTTP_REFERER']);
                          }else {
                              echo '<div class="alert alert-success">Hakkımda Sayfası Güncellenirken Hata Oluştu.</div>';
                          }
                      }

              }
              ?>
              <form class="form-horizontal" action="" method="POST" enctype="multipart/form-data">
                  <div class="tile-body">
                      <div class="form-group row">
                          <label class="control-label col-md-3">Sayfa Başlığı</label>
                          <div class="col-md-8">
                              <input value="<?php echo $row->hakkimda_isim; ?>" class="form-control" name="isim">
                          </div>
                      </div>
                      <div class="form-group row">
                          <label class="control-label col-md-3">Sayfa 2. Başlık</label>
                          <div class="col-md-8">
                              <input value="<?php echo $row->hakkimda_meslek; ?>" class="form-control" name="meslek">
                          </div>
                      </div>
                      <div class="form-group row">
                          <label class="control-label col-md-3">Sayfa Resim</label>
                          <div class="col-md-8">
                                  <img src="<?php echo $arow->site_url; ?>/images/<?php echo $row->hakkimda_resim; ?>" width="100" height="100" />
                                  <hr />
                                  <input class="form-control" type="file" name="resim">
                          </div>
                      </div>
                      <div class="form-group row">
                          <label class="control-label col-md-3">Hakkımda İçerik</label>
                          <div class="col-md-8">
                              <textarea name="icerik" class="ckeditor"><?php echo $row->hakkimda_icerik; ?></textarea>
                          </div>
                      </div>
                      <div class="form-group row">
                          <label class="control-label col-md-3">İletişim İçerik</label>
                          <div class="col-md-8">
                              <textarea name="iletisim" class="ckeditor"><?php echo $row->hakkimda_iletisim; ?></textarea>
                          </div>
                      </div>

                  </div>
                  <div class="tile-footer">
                      <div class="row">
                          <div class="col-md-8 col-md-offset-3">
                              <button class="btn btn-primary" type="submit" name="duzenle"><i class="fa fa-fw fa-lg fa-check-circle"></i>Hakkımda'yı Düzenle </button>&nbsp;&nbsp;&nbsp;
                              <a class="btn btn-secondary" href="<?php echo $yonetim; ?>"><i class="fa fa-fw fa-lg fa-arrow-left"></i>Anasayfa'ya Dön</a>
                          </div>
                      </div>
                  </div>
              </form>

          </div>
        </div>
      </div>
    </main>
<?php require_once 'inc/alt.php'; ?>