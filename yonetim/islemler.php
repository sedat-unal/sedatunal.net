<?php
define('guvenlik', true);
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
require_once 'inc/ust.php'; ?>
    <!-- Sidebar menu-->
<?php require_once 'inc/sol.php'; ?>

    <main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="fa fa-th-list"></i> İşlemler</h1>
          <p>İşlem Listesi</p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item">İşlemler</li>
          <li class="breadcrumb-item active"><a href="#">İşlem Listesi</a></li>
        </ul>
      </div>
      <div class="row">

        <div class="clearfix"></div>
        <div class="col-md-12">
          <div class="tile">
            <h3 class="tile-title"><?php echo get('islem'); ?></h3>
              <?php
              $islem = $_GET['islem'];
              if (!$islem){
                  header('Location:'.$yonetim);
              }
              switch ($islem){

                  ## PROFİL İŞLEMLERİ ##
                  case 'cikis':
                      session_destroy();
                      header("Location:".$yonetim);
                      break;
                  case 'profil':
                      if (isset($_POST['profilguncelle'])){
                          $kadi = post('kadi');
                          $eposta = post('eposta');
                          if (!$kadi || !$eposta){
                              echo '<div class="alert alert-danger">Boş Alan Bırakmayınız.</div>';
                          }else {
                              if (!filter_var($eposta, FILTER_VALIDATE_EMAIL)){
                                  echo '<div class="alert alert-danger">E-posta formatı yanlış. Tekrar deneyin.</div>';
                              }else {
                                  $guncelle = $db->prepare("UPDATE yoneticiler SET yonetici_kadi = :k, yonetici_eposta = :e WHERE yonetici_id = :id");
                                  $guncelle->execute([':k' => $kadi, ':e' => $eposta, ':id' => 1]);
                                  if ($guncelle){
                                      echo '<div class="alert alert-success">Başarıyla Güncellendi.</div>';
                                      header('refresh:2;url='.$_SERVER['HTTP_REFERER']);
                                  }else{
                                      echo '<div class="alert alert-danger">Üzgünüm bir hata ile karşılaştım. Tekrar deneyin.</div>';
                                  }

                              }
                          }
                      }
                      $verial = $db->prepare("SELECT yonetici_kadi,yonetici_eposta FROM yoneticiler");
                      $verial->execute();
                      $verial->fetch(PDO::FETCH_OBJ);
                      ?>
                      <form class="form-horizontal" action="" method="POST">
                          <div class="tile-body">
                              <div class="form-group row">
                                  <label class="control-label col-md-3">Kullanıcı Adı</label>
                                  <div class="col-md-8">
                                      <input value="<?php echo $verial->yonetici_kadi; ?>" class="form-control" name="kadi" placeholder="Kullanıcı Adı">
                                  </div>
                              </div>
                              <div class="form-group row">
                                  <label class="control-label col-md-3">E-posta</label>
                                  <div class="col-md-8">
                                      <input value="<?php echo $verial->yonetici_eposta; ?>" class="form-control" name="eposta" placeholder="E-posta">
                                  </div>
                              </div>
                          </div>
                          <div class="tile-footer">
                              <div class="row">
                                  <div class="col-md-8 col-md-offset-3">
                                      <button class="btn btn-primary" type="submit" name="profilguncelle"><i class="fa fa-fw fa-lg fa-check-circle"></i>Profili Güncelle</button>&nbsp;&nbsp;&nbsp;
                                      <a class="btn btn-secondary" href="<?php echo $yonetim; ?>"><i class="fa fa-fw fa-lg fa-arrow-left"></i>Anasayfaya Dön</a>
                                  </div>
                              </div>
                          </div>
                      </form>


                      <?php

                      break;
                  case 'sifredegistir':
                      if (isset($_POST['sifreguncelle'])) {
                          $sifre1 = post('sifre1');
                          $sifre2 = post('sifre2');
                          $sifrele = sha1(md5($sifre1));
                          if (!$sifre1 || !$sifre2) {
                              echo '<div class="alert alert-danger">Boş Alan Bırakmayınız.</div>';
                          } else {
                              if ($sifre1 != $sifre2) {
                                  echo '<div class="alert alert-danger">Girilen şifreler uyuşmuyor. Tekrar deneyin.</div>';
                              } else {
                                  $guncelle = $db->prepare("UPDATE yoneticiler SET yonetici_sifre = :s  WHERE yonetici_id = :id");
                                  $guncelle->execute([':s' => $sifre1, ':id' => 1]);
                                  if ($guncelle) {
                                      echo '<div class="alert alert-success">Şifre Başarıyla Güncellendi.</div>';
                                      header('refresh:2;url=' . $_SERVER['HTTP_REFERER']);
                                  } else {
                                      echo '<div class="alert alert-danger">Üzgünüm bir hata ile karşılaştım. Tekrar deneyin.</div>';
                                  }

                              }
                          }
                      }
                      ?>
                      <form class="form-horizontal" action="" method="POST">
                          <div class="tile-body">
                              <div class="form-group row">
                                  <label class="control-label col-md-3">Yeni Şifre</label>
                                  <div class="col-md-8">
                                      <input class="form-control" type="password" name="sifre1">
                                  </div>
                              </div>
                              <div class="form-group row">
                                  <label class="control-label col-md-3">Yeni Şifre Tekrar</label>
                                  <div class="col-md-8">
                                      <input class="form-control" type="password" name="sifre2">
                                  </div>
                              </div>
                          </div>
                          <div class="tile-footer">
                              <div class="row">
                                  <div class="col-md-8 col-md-offset-3">
                                      <button class="btn btn-primary" type="submit" name="sifreguncelle"><i class="fa fa-fw fa-lg fa-check-circle"></i>Şifreyi Güncelle</button>&nbsp;&nbsp;&nbsp;
                                      <a class="btn btn-secondary" href="<?php echo $yonetim; ?>"><i class="fa fa-fw fa-lg fa-arrow-left"></i>Anasayfaya Dön</a>
                                  </div>
                              </div>
                          </div>
                      </form>


                      <?php

                      break;

                  ## PROFİL BİT ##

                  ## SİLME İŞLEMLERİ ##
                  case 'egitimsil':
                      $id = get('id');
                      if (!$id){
                          header('Location:'.$yonetim."/egitim.php");
                      }
                      $egitimsil = $db->prepare("DELETE FROM egitim WHERE egitim_id = :id");
                      $egitimsil->execute([':id' => $id]);
                      if ($egitimsil){
                          echo '<div class="alert alert-success">Eğitim Başarıyla Silindi.</div>';
                          header("Refresh:2;url=".$yonetim."/egitim.php");
                      }else {
                          echo '<div class="alert alert-danger">Hata Oluştu</div>';
                      }
                      break;
                  case 'sertifikasil':
                      $id = get('id');
                      if (!$id){
                          header('Location:'.$yonetim."/egitim.php");
                      }
                      $sertifikasil = $db->prepare("DELETE FROM sertifika WHERE sertifika_id = :id");
                      $sertifikasil->execute([':id' => $id]);
                      if ($sertifikasil){
                          echo '<div class="alert alert-success">Sertifika Başarıyla Silindi.</div>';
                          header("Refresh:2;url=".$yonetim."/egitim.php");
                      }else {
                          echo '<div class="alert alert-danger">Hata Oluştu</div>';
                      }
                    break;
                  case 'deneyimsil':
                    $id = get('id');
                    if (!$id){
                        header('Location:'.$yonetim."/egitim.php");
                    }
                    $deneyimsil = $db->prepare("DELETE FROM deneyim WHERE deneyim_id = :id");
                    $deneyimsil->execute([':id' => $id]);
                    if ($deneyimsil){
                        echo '<div class="alert alert-success">Deneyim Başarıyla Silindi</div>';
                        header("Refresh:2;url=".$yonetim."/egitim.php");
                    }else{
                        echo '<div class="alert alert-danger">Hata Oluştu.</div>';
                    }
                    break;
                  case 'kategorisil':

                      $id = get('id');
                      if (!$id){
                          header('Location:'.$yonetim."/kategoriler.php");
                      }
                      $kategorisil = $db->prepare("DELETE FROM kategoriler WHERE kat_id = :id");
                      $kategorisil->execute(['id' => $id]);
                      if ($kategorisil){

                          $yazipasif = $db->prepare("UPDATE yazılar SET yazi_durum = :d WHERE yazi_kat_id = :id");
                          $yazipasif->execute([':d' => 2, ':id' => $id]);

                            echo '<div class="alert alert-success">Kategori başarılı bir şekilde silindi ve bu kategoriye ait yazılar pasif konuma getirildi.</div>';
                            header("Refresh:2;url=".$yonetim."/kategoriler.php");
                      }else {
                          echo '<div class="alert alert-danger">HATA OLUŞTU.</div>';
                      }

                      break;
                  case 'mesajisil':

                    $id = get('id');
                    if (!$id){
                        header('Location:'.$yonetim."/okunmusmesajlar.php");
                    }
                    $mesajsil = $db->prepare("DELETE FROM mesajlar WHERE mesaj_id = :id");
                    $mesajsil->execute([':id' => $id]);
                    if ($mesajsil){

                        echo '<div class="alert alert-success">Mesaj başarılı bir şekilde silindi.</div>';
                        header("Refresh:2;url=".$yonetim."/okunmusmesajlar.php");

                    }else {
                        echo '<div class="alert alert-danger">HATA OLUŞTU.</div>';
                    }
                    break;
                  case 'yorumsil':

                      $id = get('id');
                      if (!$id){
                          header('Location:'.$yonetim."/onayliyorumlar.php");
                      }
                      $yorumsil = $db->prepare("DELETE FROM yorumlar WHERE yorum_id = :id");
                      $yorumsil->execute([':id' => $id]);
                      if ($yorumsil){

                          echo '<div class="alert alert-success">Yorum başarılı bir şekilde silindi.</div>';
                          header("Refresh:2;url=".$yonetim."/onayliyorumlar.php");

                      }else {
                          echo '<div class="alert alert-danger">HATA OLUŞTU.</div>';
                      }
                      break;
                  case 'sosyalsil':

                      $id = get('id');
                      if (!$id){
                          header('Location:'.$yonetim."/sosyalmedya.php");
                      }
                      $sosyalsil = $db->prepare("DELETE FROM sosyal_medya WHERE sosya_id = :id");
                      $sosyalsil->execute([':id' => $id]);
                      if ($sosyalsil){

                          echo '<div class="alert alert-success">Sosyal medya hesabı başarılı bir şekilde silindi.</div>';
                          header("Refresh:2;url=".$yonetim."/sosyalmedya.php");

                      }else {
                          echo '<div class="alert alert-danger">HATA OLUŞTU.</div>';
                      }
                      break;
                  case 'yazisil':

                      $id = get('id');
                      if (!$id){
                          header('Location:'.$yonetim."/yazilar.php");
                      }
                      $yazibul = $db->prepare("SELECT * FROM yazılar WHERE yazi_id = :id");
                      $yazibul->execute([':id' => $id]);
                      if ($yazibul->rowCount()){
                          $yazirow = $yazibul->fetch(PDO::FETCH_OBJ);
                          $yazisil = $db->prepare("DELETE FROM yazılar WHERE yazi_id = :id");
                          $yazisil->execute([':id' => $id]);
                          if ($yazisil){

                              $yorumsil = $db->prepare("DELETE FROM yorumlar WHERE yorum_yazi_id = :id");
                              $yorumsil->execute([':id' => $id]);
                              unlink("../images/".$yazirow->yazi_resim);

                              echo '<div class="alert alert-success">Yazı başarılı bir şekilde silindi.</div>';
                              header("Refresh:2;url=".$yonetim."/yazilar.php");

                          }else {
                              echo '<div class="alert alert-danger">HATA OLUŞTU.</div>';
                          }
                      }
                      break;
                  case 'abonesil':

                      $id = get('id');
                      if (!$id){
                          header('Location:'.$yonetim."/aboneler.php");
                      }
                      $abonesil = $db->prepare("DELETE FROM aboneler WHERE abone_id = :id");
                      $abonesil->execute([':id' => $id]);
                      if ($abonesil){

                          echo '<div class="alert alert-success">Abone başarılı bir şekilde silindi.</div>';
                          header("Refresh:2;url=".$yonetim."/aboneler.php");

                      }else {
                          echo '<div class="alert alert-danger">HATA OLUŞTU.</div>';
                      }
                      break;
                  case 'slidersil':

                      $id = get('id');
                      if (!$id){
                          header('Location:'.$yonetim."/slider.php");
                      }
                      $slidercek = $db->prepare("SELECT * FROM slider WHERE slider_id = :id");
                      $slidercek->execute([':id' => $id]);
                      if ($slidercek->rowCount()){
                          $resimrow = $slidercek->fetch(PDO::FETCH_OBJ);
                          $slidersil = $db->prepare("DELETE FROM slider WHERE slider_id = :id");
                          $slidersil->execute([':id' => $id]);
                          if ($slidersil){
                              echo '<div class="alert alert-success">Slider Başarıyla Silindi. Yönlendiriliyorsunuz..</div>';
                              header("Refresh:2;url=".$yonetim."/slider.php");
                          }else{
                              echo '<div class="alert alert-danger">Bir sorunla karşılaştım. Tekrar dener misin ?</div>';
                          }
                      }



                      break;
                  ## SİLME BİT ##

                  ## EKLEME İŞLEMLERİ ##
                  case 'yenikategori':
                      if (isset($_POST['kategoriekle'])){

                          $katadi   = post('katadi');
                          $katsef   = sef_link($katadi);
                          $katkeyw  = post('katkeyw');
                          $katdesc  = post('katdesc');

                          if (!$katadi || !$katkeyw || !$katdesc){
                              
                              echo '<div class="alert alert-danger">Lütfen Tüm Alanları Doldurun.</div>';
                          }else{

                              $varmi = $db->prepare("SELECT * FROM kategoriler WHERE kat_sef = :s");
                              $varmi->execute([':s' => $katsef]);
                              if ($varmi->rowCount()){
                                  echo '<div class="alert alert-danger">Böyle bir kategori mevcut.</div>';
                              }else {
                                  $katekle = $db->prepare("INSERT INTO kategoriler SET
                                    kat_adi = :adi,
                                    kat_sef = :sef,
                                    kat_keyw = :keyw,
                                    kat_desc = :descc                         
                                    ");
                                  $katekle->execute([':adi' => $katadi, ':sef' => $katsef, ':keyw' => $katkeyw, ':descc' => $katdesc]);
                                  if ($katekle->rowCount()){
                                      echo '<div class="alert alert-success">Kategori başarıyla eklendi.</div>';
                                        header('Refresh:2;url='.$yonetim."/kategoriler.php");
                                  }else {
                                      echo '<div class="alert alert-danger">Malesef bir hata ile karşılaştım. Tekrar dener misin ?</div>';
                                  }
                              }
                          }
                      }
                      ?>
                            <form class="form-horizontal" action="" method="POST">
                                <div class="tile-body">
                                      <div class="form-group row">
                                          <label class="control-label col-md-3">Kategori Adı</label>
                                          <div class="col-md-8">
                                              <input class="form-control" name="katadi" placeholder="Kategori Adı Giriniz.">
                                          </div>
                                      </div>
                                      <div class="form-group row">
                                          <label class="control-label col-md-3">Kategori Anahtar Kelimeler</label>
                                          <div class="col-md-8">
                                              <input class="form-control" name="katkeyw" placeholder="Kategori Anahtar Kelimeler.">
                                              <small class="form-text" id="">Kategorinizin SEO ayarları için maksimum 5 kelime ve aralarına virgül koyunuz.</small>
                                          </div>
                                      </div>
                                      <div class="form-group row">
                                          <label class="control-label col-md-3">Kategori Açıklaması</label>
                                          <div class="col-md-8">
                                              <input class="form-control" name="katdesc" placeholder="Kategori Açıklaması Giriniz.">
                                              <small class="form-text" id="">Kategorinizin SEO ayarları için maksimum 200 harf giriniz.</small>
                                          </div>
                                      </div>
                                </div>
                                  <div class="tile-footer">
                                      <div class="row">
                                          <div class="col-md-8 col-md-offset-3">
                                              <button class="btn btn-primary" type="submit" name="kategoriekle"><i class="fa fa-fw fa-lg fa-check-circle"></i>Kategori Ekle</button>&nbsp;&nbsp;&nbsp;
                                              <a class="btn btn-secondary" href="<?php echo $yonetim; ?>/kategoriler.php"><i class="fa fa-fw fa-lg fa-arrow-left"></i>Listeye Dön</a>
                                          </div>
                                      </div>
                                  </div>
                            </form>
                      <?php
                          break;
                  case 'yenisosyalmedya':
                      if (isset($_POST['sosyalmedyaekle'])){

                          $ikon   = post('ikon');
                          $link  = post('link');

                          if (!$ikon || !$link){
                              echo '<div class="alert alert-danger">Lütfen Tüm Alanları Doldurun.</div>';
                          }else{

                              $varmi = $db->prepare("SELECT * FROM sosyal_medya WHERE sosyal_ikon = :s");
                              $varmi->execute([':s' => $ikon]);
                              if ($varmi->rowCount()){
                                  echo '<div class="alert alert-danger">Bu sosyal medya hesabı zaten mevcut.</div>';
                              }else {
                                  $sosyalekle = $db->prepare("INSERT INTO sosyal_medya SET
                                    sosyal_ikon = :ikon,
                                    sosyal_link = :link                        
                                    ");
                                  $sosyalekle->execute([':ikon' => $ikon, ':link' => $link]);
                                  if ($sosyalekle->rowCount()){
                                      echo '<div class="alert alert-success">Sosyal medya hesabı başarıyla eklendi.</div>';
                                      header('Refresh:2;url='.$yonetim."/sosyalmedya.php");
                                  }else {
                                      echo '<div class="alert alert-danger">Malesef bir hata ile karşılaştım. Tekrar dener misin ?</div>';
                                  }
                              }
                          }
                      }
                      ?>
                      <form class="form-horizontal" action="" method="POST">
                          <div class="tile-body">
                              <div class="form-group row">
                                  <label class="control-label col-md-3">Sosyal Medya İkon</label>
                                  <div class="col-md-8">
                                      <input class="form-control" name="ikon" placeholder="İkon Adı Giriniz.">
                                  </div>
                              </div>
                              <div class="form-group row">
                                  <label class="control-label col-md-3">Sosyal Medya Link</label>
                                  <div class="col-md-8">
                                      <input class="form-control" name="link" placeholder="Linki giriniz.">
                                      <small class="form-text" id="">https://www. kısmı ile beraber yazınız.</small>
                                  </div>
                              </div>
                              <p><a href="">İkon isimlerini öğrenmek için lütfen tıklayın.</a></p>
                          </div>
                          <div class="tile-footer">
                              <div class="row">
                                  <div class="col-md-8 col-md-offset-3">
                                      <button class="btn btn-primary" type="submit" name="sosyalmedyaekle"><i class="fa fa-fw fa-lg fa-check-circle"></i>Sosyal Medya Hesabı Ekle</button>&nbsp;&nbsp;&nbsp;
                                      <a class="btn btn-secondary" href="<?php echo $yonetim; ?>/sosyalmedya.php"><i class="fa fa-fw fa-lg fa-arrow-left"></i>Listeye Dön</a>
                                  </div>
                              </div>
                          </div>
                      </form>
                      <?php
                      break;
                  case 'yenikonu':

                      if (isset($_POST['yeniyaziekle'])){
                          require 'inc/class.upload.php';

                          $baslik      = post('baslik');
                          $sefbaslik   = sef_link($baslik);
                          $kategori    = post('kategori');
                          $icerik      = $_POST['icerik'];
                          $etiketler    = post('etiketler');

                          if (!$baslik || !$kategori || !$icerik || !$etiketler){
                              echo '<div class="alert alert-danger">Boş Alan Bırakmayınız.</div>';
                          }else{
                                ## Etiketleri Seflink Haline Getirdim ##
                              $sefyap = explode(',',$etiketler);
                              $dizi = array();
                              foreach ($sefyap as $par){
                                  $dizi[] = sef_link($par);
                              }
                              $deger = implode(',', $dizi);

                              $image = new Upload($_FILES['resim']);
                              if ($image->uploaded){

                                  $rname = md5(uniqid());
                                  $image->allowed = array("image/*");
                                  $image->image_convert = "webp";
                                  $image->file_new_name_body = $rname;
                                  $image->image_text = "Sedat Unal";
                                  $image->image_text_position = "BR";
                                  $image->process("../images");

                                  if ($image->processed){

                                      $konuekle = $db->prepare("INSERT INTO yazılar SET 
                                        yazi_kat_id = :k,
                                        yazi_baslik = :b,
                                        yazi_sef    = :s,
                                        yazi_resim  = :r,       
                                        yazi_icerik = :i,
                                        yazi_etiket = :e,
                                        yazi_sef_etiket = :se");

                                      $konuekle->execute([
                                         ':b' => $baslik,
                                         ':s' => $sefbaslik,
                                         ':k' => $kategori,
                                         ':r' => $rname.".webp",
                                          ':i' => $icerik,
                                          ':e' => $etiketler,
                                          ':se' => $deger ]);
                                      if ($konuekle->rowCount()){

                                          require 'inc/PHPMailer/src/Exception.php';
                                          require 'inc/PHPMailer/src/PHPMailer.php';
                                          require 'inc/PHPMailer/src/SMTP.php';

                                          $sonid    = $db->lastInsertId();

                                          $gonderen = "sedat@sedatunal.net";
                                          $parola   = "sed70Ffg";

                                          $mail             = new PHPMailer();
                                          $mail->Host       = "smtp.google.com";
                                          $mail->Port       = 587;
                                          $mail->SMTPSecure = "tls";
                                          $mail->SMTPAuth   = true;
                                          $mail->Username   = $gonderen;
                                          $mail->Password   = $parola;
                                          $mail->IsSMTP();

                                          $mail->From       = $gonderen;
                                          $mail->FromName   = "Sedat Ünal Blog | Yeni içerik eklendi.";
                                          $mail->CharSet    = "UTF-8";
                                          $mail->Subject    = "Yeni içerik eklendi";

                                          $aboneler = $db->prepare("SELECT * FROM aboneler");
                                          $aboneler->execute();
                                          if ($aboneler->rowCount()){
                                              foreach ($aboneler as $abone){
                                                  $mail->AddBCC($abone['abone_mail']);
                                              }
                                          }


                                          $konubul  = $db->prepare("SELECT * FROM yazılar WHERE yazi_id = :id");
                                          $konubul->execute([':id' => $sonid]);
                                          $konurow  = $konubul->fetch(PDO::FETCH_OBJ);
                                          $yazilink = $arow->site_url."/icerik.php?yazi_sef=".$konurow->yazi_sef."&id=".$konurow->yazi_id;

                                          $mailicerik = "Konu Başlığı : ".$konurow->yazi_baslik." | Konu Link : ".$yazilink;
                                          $mail->MsgHTML($mailicerik);
                                          if ($mail->Send()){

                                              echo '<div class="alert alert-success">Mail Başarıyla Gönderildi.</div>';
                                              header("Refresh:2;url=".$yonetim."/yazilar.php");

                                          }else {
                                              echo '<div class="alert alert-danger">Konu Başarıyla Eklendi ama Mail Gönderilmedi.</div>';
                                              header('Refresh:2;url='.$_SERVER['HTTP_REFERER']);
                                          }

                                      }else {
                                          echo '<div class="alert alert-danger">Konu Eklenirken Hata Oluştu.</div>';
                                      }

                                  }else {
                                      echo '<div class="alert alert-danger">Resim Yüklenemedi...</div>';
                                  }


                              }else {
                                  echo '<div class="alert alert-danger">Resim Seçmediniz...</div>';
                              }

                          }

                      }

                      ?>
                      <form class="form-horizontal" action="" method="POST" enctype="multipart/form-data">
                          <div class="tile-body">
                              <div class="form-group row">
                                  <label class="control-label col-md-3">Yazı Başlık</label>
                                  <div class="col-md-8">
                                      <input class="form-control" name="baslik" placeholder="Başlık Giriniz.">
                                  </div>
                              </div>
                              <div class="form-group row">
                                  <label class="control-label col-md-3">Yazı Kategori</label>
                                  <div class="col-md-8">
                                     <select name="kategori" class="form-control">
                                         <?php
                                            $kategoriler = $db->prepare("SELECT * FROM kategoriler");
                                            $kategoriler->execute();
                                            if ($kategoriler->rowCount()){
                                                foreach ($kategoriler as $row){
                                                    echo '<option value="'.$row['kat_id'].'">'.$row['kat_adi'].'</option>';
                                                }
                                            }
                                         ?>
                                     </select>
                                  </div>
                              </div>
                              <div class="form-group row">
                                  <label class="control-label col-md-3">Yazı Resim</label>
                                  <div class="col-md-8">
                                      <input class="form-control" type="file" name="resim">
                                  </div>
                              </div>
                              <div class="form-group row">
                                  <label class="control-label col-md-3">Yazı İçerik</label>
                                  <div class="col-md-8">
                                      <textarea name="icerik" class="ckeditor"></textarea>
                                  </div>
                              </div>
                              <div class="form-group row">
                                  <label class="control-label col-md-3">Yazı Etiketler</label>
                                  <div class="col-md-8">
                                      <input class="form-control" type="text" name="etiketler">
                                      <small class="form-text">Her etiketin yanına virgül koyunuz.</small>
                                  </div>
                              </div>
                          </div>
                          <div class="tile-footer">
                              <div class="row">
                                  <div class="col-md-8 col-md-offset-3">
                                      <button class="btn btn-primary" type="submit" name="yeniyaziekle"><i class="fa fa-fw fa-lg fa-check-circle"></i>Yeni Yazı Ekle</button>&nbsp;&nbsp;&nbsp;
                                      <a class="btn btn-secondary" href="<?php echo $yonetim; ?>/yazilar.php"><i class="fa fa-fw fa-lg fa-arrow-left"></i>Listeye Dön</a>
                                  </div>
                              </div>
                          </div>
                      </form>
                      <?php
                      break;
                  case 'bilgiekle':
                      if (isset($_POST['yeniegitimekle'])){

                          $tarih = post('tarih');
                          $baslik = post('baslik');
                          $icerik = $_POST['icerik'];

                          if (!$tarih || !$baslik || !$icerik){
                              echo '<div class="alert alert-danger">Lütfen Boş Alan Bırakmayınız</div>';
                          }else {
                              $ekle = $db->prepare("INSERT INTO egitim SET
                                    egitim_tarih = :tarih,
                                    egitim_baslik = :baslik,
                                    egitim_icerik = :icerik");
                              $ekle->execute([':tarih' => $tarih, ':baslik' => $baslik, ':icerik' => $icerik]);
                              if ($ekle->rowCount()){
                                  echo '<div class="alert alert-success">Eğitim Bilgisi Başarıyla Eklendi. Yönlendiriliyorsunuz..</div>';
                                  header("Refresh:2;url=".$_SERVER['HTTP_REFERER']);
                              }else {
                                  echo '<div class="alert alert-danger">Malesef bir hata ile karşılaştım. Tekrar dener misin ?</div>';
                              }
                          }

                      }
                      ?>
                      <form class="form-horizontal" action="" method="POST" enctype="multipart/form-data">
                          <div class="tile-body">
                              <div class="form-group row">
                                  <label class="control-label col-md-3">Eğitimin Tarihi</label>
                                  <div class="col-md-8">
                                      <input class="form-control" name="tarih" placeholder="Başlık Giriniz.">
                                  </div>
                              </div>
                              <div class="form-group row">
                                  <label class="control-label col-md-3">Kurum Adı</label>
                                  <div class="col-md-8">
                                      <input class="form-control" name="baslik" placeholder="Başlık Giriniz.">
                                  </div>
                              </div>
                            </div>
                              <div class="form-group row">
                                  <label class="control-label col-md-3">Eğitim İçeriği</label>
                                  <div class="col-md-8">
                                      <textarea name="icerik" class="ckeditor"></textarea>
                                  </div>
                              </div>
                          </div>
                            <div class="tile-footer">
                                <div class="row">
                                    <div class="col-md-8 col-md-offset-3">
                                        <button class="btn btn-primary" type="submit" name="yeniegitimekle"><i class="fa fa-fw fa-lg fa-check-circle"></i>Yeni Eğitim Ekle</button>&nbsp;&nbsp;&nbsp;
                                        <a class="btn btn-secondary" href="<?php echo $yonetim; ?>"><i class="fa fa-fw fa-lg fa-arrow-left"></i>Anasayfaya Dön</a>
                                    </div>
                                </div>
                            </div>
                            </form>
                        <?php




                      break;
                  case 'sertifikaekle':
                        if (isset($_POST['yenisertifikaekle'])){

                            $tarih = post('tarih');
                            $baslik = post('baslik');
                            $icerik = $_POST['icerik'];

                            if (!$tarih || !$baslik || !$icerik){
                                echo '<div class="alert alert-danger">Lütfen Boş Alan Bırakmayınız</div>';
                            }else {
                                $ekle = $db->prepare("INSERT INTO sertifika SET
                                    sertifika_tarih = :tarih,
                                    sertifika_baslik = :baslik,
                                    sertifika_icerik = :icerik");
                                $ekle->execute([':tarih' => $tarih, ':baslik' => $baslik, ':icerik' => $icerik]);
                                if ($ekle->rowCount()){
                                    echo '<div class="alert alert-success">Sertifika & Kurs Bilgisi Başarıyla Eklendi. Yönlendiriliyorsunuz..</div>';
                                    header("Refresh:2;url=".$_SERVER['HTTP_REFERER']);
                                }else {
                                    echo '<div class="alert alert-danger">Malesef bir hata ile karşılaştım. Tekrar dener misin ?</div>';
                                }
                            }

                        }
                        ?>
                        <form class="form-horizontal" action="" method="POST" enctype="multipart/form-data">
                            <div class="tile-body">
                                <div class="form-group row">
                                    <label class="control-label col-md-3">Sertifika & Kurs Tarihi</label>
                                    <div class="col-md-8">
                                        <input class="form-control" name="tarih" placeholder="Başlık Giriniz.">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label col-md-3">Sertifika & Kurs Adı</label>
                                    <div class="col-md-8">
                                        <input class="form-control" name="baslik" placeholder="Başlık Giriniz.">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-3">Sertifika & Kurs İçeriği</label>
                                <div class="col-md-8">
                                    <textarea name="icerik" class="ckeditor"></textarea>
                                </div>
                            </div>
                    </div>
                    <div class="tile-footer">
                        <div class="row">
                            <div class="col-md-8 col-md-offset-3">
                                <button class="btn btn-primary" type="submit" name="yenisertifikaekle"><i class="fa fa-fw fa-lg fa-check-circle"></i>Yeni Bilgi Ekle</button>&nbsp;&nbsp;&nbsp;
                                <a class="btn btn-secondary" href="<?php echo $yonetim; ?>"><i class="fa fa-fw fa-lg fa-arrow-left"></i>Anasayfaya Dön</a>
                            </div>
                        </div>
                    </div>
                    </form>
                    <?php




                    break;
                  case 'isekle':
                    if (isset($_POST['yeniisekle'])){

                        $tarih = post('tarih');
                        $baslik = post('baslik');
                        $icerik = $_POST['icerik'];

                        if (!$tarih || !$baslik || !$icerik){
                            echo '<div class="alert alert-danger">Lütfen Boş Alan Bırakmayınız</div>';
                        }else {
                            $ekle = $db->prepare("INSERT INTO deneyim SET
                                                deneyim_tarih = :tarih,
                                                deneyim_baslik = :baslik,
                                                deneyim_icerik = :icerik");
                            $ekle->execute([':tarih' => $tarih, ':baslik' => $baslik, ':icerik' => $icerik]);
                            if ($ekle->rowCount()){
                                echo '<div class="alert alert-success">İş Deneyim Bilgisi Başarıyla Eklendi. Yönlendiriliyorsunuz..</div>';
                                header("Refresh:2;url=".$_SERVER['HTTP_REFERER']);
                            }else {
                                echo '<div class="alert alert-danger">Malesef bir hata ile karşılaştım. Tekrar dener misin ?</div>';
                            }
                        }

                    }
                    ?>
                    <form class="form-horizontal" action="" method="POST" enctype="multipart/form-data">
                        <div class="tile-body">
                            <div class="form-group row">
                                <label class="control-label col-md-3">İş Deneyim Tarihi</label>
                                <div class="col-md-8">
                                    <input class="form-control" name="tarih" placeholder="Başlık Giriniz.">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-3">İş Yeri Adı</label>
                                <div class="col-md-8">
                                    <input class="form-control" name="baslik" placeholder="Başlık Giriniz.">
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-md-3">İş Deneyim İçeriği</label>
                            <div class="col-md-8">
                                <textarea name="icerik" class="ckeditor"></textarea>
                            </div>
                        </div>
                    </div>
                        <div class="tile-footer">
                            <div class="row">
                                <div class="col-md-8 col-md-offset-3">
                                    <button class="btn btn-primary" type="submit" name="yeniisekle"><i class="fa fa-fw fa-lg fa-check-circle"></i>Yeni İş Bilgisi Ekle</button>&nbsp;&nbsp;&nbsp;
                                    <a class="btn btn-secondary" href="<?php echo $yonetim; ?>"><i class="fa fa-fw fa-lg fa-arrow-left"></i>Anasayfaya Dön</a>
                                </div>
                            </div>
                        </div>
                        </form>
                        <?php




                        break;
                  case 'yenislider':
                    if (isset($_POST['yenisliderekle'])) {
                        require 'inc/class.upload.php';

                        $baslik = post('baslik');
                        $kategori = post('kategori');
                        $bag = post('bag');
                        $resim = post('resim');
                        $icerik = post('icerik');

                        if (!$baslik || !$kategori || !$bag || !$icerik) {
                            echo '<div class="alert alert-danger">Lütfen Boş Alan Bırakmayınız</div>';
                        } else {
                            $image = new Upload($_FILES['resim']);
                            if ($image->uploaded) {

                                $rname = md5(uniqid());
                                $image->allowed = array("image/*");
                                $image->image_convert = "webp";
                                $image->file_new_name_body = $rname;
                                $image->image_text = "Sedat Unal";
                                $image->image_text_position = "BR";
                                $image->process("../images");

                                if ($image->processed) {
                                    $sliderekle = $db->prepare("INSERT INTO slider SET
                                        slider_resim = :r,
                                        slider_baslik = :b,
                                        slider_kategori = :k,   
                                        slider_bag = :bag,
                                        slider_icerik = :i");
                                    $sliderekle->execute([
                                        ':r' => $rname . ".webp",
                                        ':b' => $baslik,
                                        ':k' => $kategori,
                                        ':bag' => $bag,
                                        ':i' => $icerik
                                    ]);
                                    if ($sliderekle->rowCount()) {
                                        echo '<div class="alert alert-success">Başarıyla Yüklendi. Yönlendiriliyorsunuz..</div>';
                                        header("Refresh:2;url=slider.php");
                                    } else {
                                        echo '<div class="alert alert-danger">Bir hata ile karşılaştım. Tekrar dener misin ?</div>';
                                    }
                                } else {
                                    echo '<div class="alert alert-danger">Resim eklenirken hata oldu tekrar dener misin ?</div>';
                                }
                            }
                        }
                    }
                      ?>

                      <form class="form-horizontal" action="" method="POST" enctype="multipart/form-data">
                          <div class="tile-body">
                              <div class="form-group row">
                                  <label class="control-label col-md-3">Slider Başlık</label>
                                  <div class="col-md-8">
                                      <input class="form-control" name="baslik" placeholder="Başlık Giriniz.">
                                      <small class="form-text text-muted">Slider Başlığı.</small>
                                  </div>
                              </div>
                              <div class="form-group row">
                                  <label class="control-label col-md-3">Slider Kategori</label>
                                  <div class="col-md-8">
                                     <select name="kategori" class="form-control">
                                         <?php
                                            $kategoriler = $db->prepare("SELECT * FROM kategoriler");
                                            $kategoriler->execute();
                                            if ($kategoriler->rowCount()){
                                                foreach ($kategoriler as $row){
                                                    echo '<option value="'.$row['kat_id'].'">'.$row['kat_adi'].'</option>';
                                                }
                                            }
                                         ?>
                                     </select>
                                      <small class="form-text text-muted">Sliderın linklenmesi için gereklidir.</small>
                                  </div>
                              </div>
                              <div class="form-group row">
                                  <label class="control-label col-md-3">Slider Yazı Seç</label>
                                  <div class="col-md-8">
                                      <select name="bag" class="form-control">
                                          <?php
                                          $yazilar = $db->prepare("SELECT * FROM yazılar");
                                          $yazilar->execute();
                                          if ($yazilar->rowCount()){
                                              foreach ($yazilar as $row){
                                                  echo '<option value="'.$row['yazi_id'].'">'.$row['yazi_baslik'].'</option>';
                                              }
                                          }
                                          ?>
                                      </select>
                                      <small class="form-text text-muted">Sliderın linklenmesi için gereklidir.</small>
                                  </div>
                              </div>
                              <div class="form-group row">
                                  <label class="control-label col-md-3">Slider Resim</label>
                                  <div class="col-md-8">
                                      <input class="form-control" type="file" name="resim">
                                      <small class="form-text text-muted">Sliderda dönecek resim.</small>
                                  </div>
                              </div>
                              <div class="form-group row">
                                  <label class="control-label col-md-3">Slider İçerik</label>
                                  <div class="col-md-8">
                                      <input class="form-control" name="icerik" placeholder="Kısa Bir Giriniz.">
                                      <small class="form-text text-muted">Slider hakkında kısa bir cümle.</small>
                                  </div>
                              </div>

                          </div>
                          <div class="tile-footer">
                              <div class="row">
                                  <div class="col-md-8 col-md-offset-3">
                                      <button class="btn btn-primary" type="submit" name="yenisliderekle"><i class="fa fa-fw fa-lg fa-check-circle"></i>Yeni Slider Ekle</button>&nbsp;&nbsp;&nbsp;
                                      <a class="btn btn-secondary" href="<?php echo $yonetim; ?>/slider.php"><i class="fa fa-fw fa-lg fa-arrow-left"></i>Listeye Dön</a>
                                  </div>
                              </div>
                          </div>
                      </form>
                      <?php



                      break;
                  ## EKLEME BİT ##

                  ## DUZENLEME VE OKUMA İŞLEMLERİ ##
                  case 'sliderduzenle':
                      $id = get('id');
                      if (!$id) {
                          header('Location:' . $yonetim . '/slider.php');
                      }

                          $sliderbul = $db->prepare("SELECT * FROM slider WHERE slider_id = :id");
                          $sliderbul->execute([':id' => $id]);
                          if ($sliderbul->rowCount()) {
                              $sliderrow = $sliderbul->fetch(PDO::FETCH_OBJ);
                          if (isset($_POST['sliderguncelle'])) {
                              require 'inc/class.upload.php';

                              $baslik = post('baslik');
                              $kategori = post('kategori');
                              $bag = post('bag');
                              $resim = post('resim');
                              $icerik = post('icerik');

                              if (!$baslik || !$kategori || !$bag || !$icerik) {
                                  echo '<div class="alert alert-danger">Lütfen Boş Alan Bırakmayınız</div>';
                              } else {
                                  $image = new Upload($_FILES['resim']);
                                  if ($image->uploaded) {

                                      $rname = md5(uniqid());
                                      $image->allowed = array("image/*");
                                      $image->image_convert = "webp";
                                      $image->file_new_name_body = $rname;
                                      $image->image_text = "Hilal Yildirim";
                                      $image->image_text_position = "BR";
                                      $image->process("../images");

                                      if ($image->processed) {
                                          $sliderguncelle = $db->prepare("UPDATE slider SET
                                                    slider_resim = :r,
                                                    slider_baslik = :b,
                                                    slider_kategori = :k,   
                                                    slider_bag = :bag,
                                                    slider_icerik = :i WHERE slider_id = :id");
                                          $sliderguncelle->execute([
                                              ':r' => $rname . ".webp",
                                              ':b' => $baslik,
                                              ':k' => $kategori,
                                              ':bag' => $bag,
                                              ':i' => $icerik,
                                              ':id' => $id
                                          ]);
                                          if ($sliderguncelle->rowCount()) {
                                              echo '<div class="alert alert-success">Başarıyla Yüklendi. Yönlendiriliyorsunuz..</div>';
                                              header("Refresh:2;url=slider.php");
                                          } else {
                                              echo '<div class="alert alert-danger">Bir hata ile karşılaştım. Tekrar dener misin ?</div>';
                                          }
                                      } else {
                                          echo '<div class="alert alert-danger">Resim eklenirken hata oldu tekrar dener misin ?</div>';
                                      }
                                  }else{
                                      $sliderguncelle2 = $db->prepare("UPDATE slider SET
                                            slider_baslik = :b,
                                            slider_kategori = :k,
                                            slider_bag = :bag,
                                            slider_icerik = :i WHERE slider_id = :id");
                                      $sliderguncelle2->execute([':b' => $baslik, ':k' => $kategori, ':bag' => $bag, ':i' => $icerik, ':id' => $id]);
                                      if ($sliderguncelle2->rowCount()){
                                          echo '<div class="alert alert-success">Slider Resim Değiştirilmeden Başarıyla Güncellendi. Yönlendiriliyorsunuz..</div>';
                                          header("Refresh:2;url=".$_SERVER['HTTP_REFERER']);
                                      }else{
                                          echo '<div class="alert alert-danger">Bir sorunla karşılaştım. Tekrar dener misin ?</div>';
                                      }
                                  }
                              }
                          }
                          ?>

                          <form class="form-horizontal" action="" method="POST" enctype="multipart/form-data">
                              <div class="tile-body">
                                  <div class="form-group row">
                                      <label class="control-label col-md-3">Slider Başlık</label>
                                      <div class="col-md-8">
                                          <input class="form-control" name="baslik" value="<?php echo $sliderrow->slider_baslik; ?>">
                                          <small class="form-text text-muted">Slider Başlığı.</small>
                                      </div>
                                  </div>
                                  <div class="form-group row">
                                      <label class="control-label col-md-3">Slider Kategori</label>
                                      <div class="col-md-8">
                                          <select name="kategori" class="form-control">

                                              <?php
                                              $kategoriler = $db->prepare("SELECT * FROM kategoriler");
                                              $kategoriler->execute();
                                              if ($kategoriler->rowCount()) {
                                                  foreach ($kategoriler as $row) {
                                                      echo '<option value="' . $row['kat_id'] . '"';
                                                      echo $sliderrow->slider_kategori == $row['kat_id'] ? 'selected' : null;
                                                      echo '>' . $row['kat_adi'] . '</option>';
                                                  }
                                              }
                                              ?>
                                          </select>
                                          <small class="form-text text-muted">Sliderın linklenmesi için gereklidir.</small>
                                      </div>
                                  </div>
                                  <div class="form-group row">
                                      <label class="control-label col-md-3">Slider Yazı Seç</label>
                                      <div class="col-md-8">
                                          <select name="bag" class="form-control">
                                              <?php
                                              $yazilar = $db->prepare("SELECT * FROM yazılar");
                                              $yazilar->execute();
                                              if ($yazilar->rowCount()) {
                                                  foreach ($yazilar as $row) {
                                                      echo '<option value="' . $row['yazi_id'] . '"';
                                                      echo $sliderrow->slider_bag == $row['yazi_id'] ? 'selected' : null;
                                                      echo '>' . $row['yazi_baslik'] . '</option>';
                                                  }
                                              }
                                              ?>
                                          </select>
                                          <small class="form-text text-muted">Sliderın linklenmesi için gereklidir.</small>
                                      </div>
                                  </div>
                                  <div class="form-group row">
                                      <label class="control-label col-md-3">Slider Resim</label>
                                      <div class="col-md-8">
                                          <img src="<?php echo $arow->site_url; ?>/images/<?php echo $sliderrow->slider_resim; ?>" style="width: 150px;height: 100px;">
                                         <hr />
                                          <input class="form-control" type="file" name="resim">
                                          <small class="form-text text-muted">Sliderda dönecek resim.</small>
                                      </div>
                                  </div>
                                  <div class="form-group row">
                                      <label class="control-label col-md-3">Slider İçerik</label>
                                      <div class="col-md-8">
                                          <input class="form-control" name="icerik" value="<?php echo $sliderrow->slider_icerik; ?>">
                                          <small class="form-text text-muted">Slider hakkında kısa bir cümle.</small>
                                      </div>
                                  </div>

                              </div>
                              <div class="tile-footer">
                                  <div class="row">
                                      <div class="col-md-8 col-md-offset-3">
                                          <button class="btn btn-primary" type="submit" name="sliderguncelle"><i
                                                      class="fa fa-fw fa-lg fa-check-circle"></i>Slider Güncelle
                                          </button>&nbsp;&nbsp;&nbsp;
                                          <a class="btn btn-secondary" href="<?php echo $yonetim; ?>/slider.php"><i
                                                      class="fa fa-fw fa-lg fa-arrow-left"></i>Listeye Dön</a>
                                      </div>
                                  </div>
                              </div>
                          </form>
                          <?php
                        }else {
                                header('Location:'.$yonetim.'/yazilar.php');
                            }

                                break;
                  case 'yaziduzenle':
                      $id = get('id');
                      if (!$id){
                          header('Location:'.$yonetim.'/yazilar.php');
                      }
                      $yazibul = $db->prepare("SELECT * FROM yazılar WHERE yazi_id = :id");
                      $yazibul->execute([':id' => $id]);
                      if ($yazibul->rowCount()){

                          $yazirow = $yazibul->fetch(PDO::FETCH_OBJ);

                          if (isset($_POST['yaziguncel'])){
                              require 'inc/class.upload.php';

                              $baslik       = post('baslik');
                              $sefbaslik    = sef_link($baslik);
                              $kategori     = post('kategori');
                              $icerik       = $_POST['icerik'];
                              $etiketler    = post('etiketler');
                              $durum        = post('durum');

                              if (!$baslik || !$kategori || !$icerik || !$etiketler || !$durum){
                                  echo '<div class="alert alert-danger">Boş Alan Bırakmayınız.</div>';
                              }else{
                                  ## Etiketleri Seflink Haline Getirdim ##
                                  $sefyap = explode(',',$etiketler);
                                  $dizi = array();
                                  foreach ($sefyap as $par){
                                      $dizi[] = sef_link($par);
                                  }
                                  $deger = implode(',', $dizi);

                                  $image = new Upload($_FILES['resim']);
                                  if ($image->uploaded){

                                      $rname = md5(uniqid());
                                      $image->allowed = array("image/*");
                                      $image->image_convert = ".webp";
                                      $image->file_new_name_body = $rname;
                                      $image->image_text = "Hilal Yıldırım";
                                      $image->image_text_position = "BR";
                                      $image->process("../images");

                                      if ($image->processed){

                                          $konuguncelle = $db->prepare("UPDATE yazılar SET 
                                        yazi_kat_id = :k,
                                        yazi_baslik = :b,
                                        yazi_sef    = :s,
                                        yazi_resim  = :r,       
                                        yazi_icerik = :i,
                                        yazi_etiket = :e,
                                        yazi_sef_etiket = :se,
                                        yazi_durum  = :du WHERE yazi_id = :id");

                                          $konuguncelle->execute([
                                              ':b' => $baslik,
                                              ':s' => $sefbaslik,
                                              ':k' => $kategori,
                                              ':r' => $rname.".webp",
                                              ':i' => $icerik,
                                              ':e' => $etiketler,
                                              ':se' => $deger,
                                              ':du' => $durum,
                                              ':id' => $id]);
                                          if ($konuguncelle->rowCount()){

                                              echo '<div class="alert alert-success">Konu Başarıyla Güncellendi.</div>';
                                              header("Refresh:2;url=".$_SERVER['HTTP_REFERER']);

                                             }else {
                                              echo '<div class="alert alert-danger">Konu Güncellenirken Hata Oluştu.</div>';
                                          }

                                      }else {
                                          echo '<div class="alert alert-danger">Resim Yüklenemedi...</div>';
                                      }


                                  }else {
                                      $konuguncelle2 = $db->prepare("UPDATE yazılar SET 
                                        yazi_kat_id = :k,
                                        yazi_baslik = :b,
                                        yazi_sef    = :s,
                                        yazi_icerik = :i,
                                        yazi_etiket = :e,
                                        yazi_sef_etiket = :se,
                                        yazi_durum  = :du WHERE yazi_id = :id");

                                      $konuguncelle2->execute([
                                          ':b' => $baslik,
                                          ':s' => $sefbaslik,
                                          ':k' => $kategori,
                                          ':i' => $icerik,
                                          ':e' => $etiketler,
                                          ':se' => $deger,
                                          ':du' => $durum,
                                          ':id' => $id]);
                                      if ($konuguncelle2->rowCount()){

                                          echo '<div class="alert alert-success">Konu Başarıyla Güncellendi. Resim değiştirilmedi.</div>';
                                          header("Refresh:2;url=".$_SERVER['HTTP_REFERER']);

                                      }else {
                                          echo '<div class="alert alert-danger">Konu Güncellenirken Hata Oluştu.</div>';
                                      }

                                  }

                              }

                          }




                          ?>
                          <form class="form-horizontal" action="" method="POST" enctype="multipart/form-data">
                              <div class="tile-body">
                                  <div class="form-group row">
                                      <label class="control-label col-md-3">Yazı Başlık</label>
                                      <div class="col-md-8">
                                          <input value="<?php echo $yazirow->yazi_baslik; ?>" class="form-control" name="baslik" placeholder="Başlık Giriniz.">
                                      </div>
                                  </div>
                                  <div class="form-group row">
                                      <label class="control-label col-md-3">Yazı Kategori</label>
                                      <div class="col-md-8">
                                          <select name="kategori" class="form-control">
                                              <?php
                                              $kategoriler = $db->prepare("SELECT * FROM kategoriler");
                                              $kategoriler->execute();
                                              if ($kategoriler->rowCount()){
                                                  foreach ($kategoriler as $row){
                                                      echo '<option value="'.$row['kat_id'].'"';
                                                      echo $yazirow->yazi_kat_id == $row['kat_id'] ? 'selected' : null;
                                                      echo '>'.$row['kat_adi'].'</option>';
                                                  }
                                              }
                                              ?>
                                          </select>
                                      </div>
                                  </div>
                                  <div class="form-group row">
                                      <label class="control-label col-md-3">Yazı Resim</label>
                                      <div class="col-md-8">
                                          <img src="<?php echo $arow->site_url; ?>/images/<?php echo $yazirow->yazi_resim; ?>" width="100" height="100" />
                                          <hr />
                                          <input class="form-control" type="file" name="resim">
                                      </div>
                                  </div>
                                  <div class="form-group row">
                                      <label class="control-label col-md-3">Yazı İçerik</label>
                                      <div class="col-md-8">
                                          <textarea name="icerik" class="ckeditor"><?php echo $yazirow->yazi_icerik; ?></textarea>
                                      </div>
                                  </div>
                                  <div class="form-group row">
                                      <label class="control-label col-md-3">Yazı Etiketler</label>
                                      <div class="col-md-8">
                                          <input value="<?php echo $yazirow->yazi_etiket; ?>" class="form-control" type="text" name="etiketler">
                                          <small class="form-text">Her etiketin yanına virgül koyunuz.</small>
                                      </div>
                                  </div>
                                  <div class="form-group row">
                                      <label class="control-label col-md-3">Yazı Durumu</label>
                                      <div class="col-md-8">
                                          <select name="durum" class="form-control">
                                              <option value="1" <?php echo $yazirow->yazi_durum == 1 ? 'selected' : null;  ?>>Evet, yayınlansın</option>
                                              <option value="2" <?php echo $yazirow->yazi_durum == 2 ? 'selected' : null;  ?>>Hayır, yayınlanmasın</option>
                                          </select>
                                      </div>
                                  </div>
                              </div>
                              <div class="tile-footer">
                                  <div class="row">
                                      <div class="col-md-8 col-md-offset-3">
                                          <button class="btn btn-primary" type="submit" name="yaziguncel"><i class="fa fa-fw fa-lg fa-check-circle"></i>Yazıyı Güncelle</button>&nbsp;&nbsp;&nbsp;
                                          <a class="btn btn-secondary" href="<?php echo $yonetim; ?>/yazilar.php"><i class="fa fa-fw fa-lg fa-arrow-left"></i>Listeye Dön</a>
                                      </div>
                                  </div>
                              </div>
                          </form>


                          <?php

                      }else {
                          header('Location:'.$yonetim.'/yazilar.php');
                      }
                      break;
                  case 'kategoriduzenle':
                      $id = get('id');
                      if (!$id){
                          header('Location:'.$yonetim."/kategoriler.php");
                      }
                      $kategoribul = $db->prepare("SELECT * FROM kategoriler WHERE kat_id = :id");
                      $kategoribul->execute([':id' => $id]);
                      if ($kategoribul->rowCount()){

                          $row = $kategoribul->fetch(PDO::FETCH_OBJ);
                          if (isset($_POST['kategoriduzenle'])) {

                              $katadi = post('katadi');
                              $katsef = sef_link($katadi);
                              $katkeyw = post('katkeyw');
                              $katdesc = post('katdesc');

                              if (!$katadi || !$katkeyw || !$katdesc) {
                                  echo '<div class="alert alert-danger">Lütfen Tüm Alanları Doldurun.</div>';
                              } else {

                                  $varmi = $db->prepare("SELECT * FROM kategoriler WHERE kat_sef = :s AND kat_id != :id");
                                  $varmi->execute([':s' => $katsef, ':id' => $id]);
                                  if ($varmi->rowCount()) {
                                      echo '<div class="alert alert-danger">Böyle bir kategori mevcut.</div>';
                                  } else {
                                      $katguncelle = $db->prepare("UPDATE kategoriler SET
                                    kat_adi = :adi,
                                    kat_sef = :sef,
                                    kat_keyw = :keyw,
                                    kat_desc = :descc  WHERE kat_id = :id                        
                                    ");
                                      $katguncelle->execute([':adi' => $katadi, ':sef' => $katsef, ':keyw' => $katkeyw, ':descc' => $katdesc, ':id' => $id]);
                                      if ($katguncelle) {
                                          echo '<div class="alert alert-success">Kategori başarıyla güncellendi.</div>';
                                          header('Refresh:2;url=' . $yonetim . "/kategoriler.php");
                                      } else {
                                          echo '<div class="alert alert-danger">Malesef bir hata ile karşılaştım. Tekrar dener misin ?</div>';
                                      }
                                  }
                              }
                          }
                          ?>
                          <form class="form-horizontal" action="" method="POST">
                              <div class="tile-body">
                                  <div class="form-group row">
                                      <label class="control-label col-md-3">Kategori Adı</label>
                                      <div class="col-md-8">
                                          <input class="form-control" name="katadi" value="<?php echo $row->kat_adi; ?>">
                                      </div>
                                  </div>
                                  <div class="form-group row">
                                      <label class="control-label col-md-3">Kategori Anahtar Kelimeler</label>
                                      <div class="col-md-8">
                                          <input class="form-control" name="katkeyw" value="<?php echo $row->kat_keyw; ?>">
                                          <small class="form-text" id="">Kategorinizin SEO ayarları için maksimum 5 kelime ve aralarına virgül koyunuz.</small>
                                      </div>
                                  </div>
                                  <div class="form-group row">
                                      <label class="control-label col-md-3">Kategori Açıklaması</label>
                                      <div class="col-md-8">
                                          <input class="form-control" name="katdesc" value="<?php echo $row->kat_desc; ?>">
                                          <small class="form-text" id="">Kategorinizin SEO ayarları için maksimum 200 harf giriniz.</small>
                                      </div>
                                  </div>
                              </div>
                              <div class="tile-footer">
                                  <div class="row">
                                      <div class="col-md-8 col-md-offset-3">
                                          <button class="btn btn-primary" type="submit" name="kategoriduzenle"><i class="fa fa-fw fa-lg fa-check-circle"></i>Kategoriyi Güncelle</button>&nbsp;&nbsp;&nbsp;
                                          <a class="btn btn-secondary" href="<?php echo $yonetim; ?>/kategoriler.php"><i class="fa fa-fw fa-lg fa-arrow-left"></i>Listeye Dön</a>
                                      </div>
                                  </div>
                              </div>
                          </form>
                        <?php
                      }else{
                          header('Location:'.$yonetim."/kategoriler.php");
                      }
                      break;
                  case 'mesajoku':
                      $id = get('id');
                      if (!$id){
                          header('Location:'.$yonetim."/bekleyenmesajlar.php");
                      }
                      $mesajbul = $db->prepare("SELECT * FROM mesajlar WHERE mesaj_id = :id");
                      $mesajbul->execute([':id' => $id]);
                      if ($mesajbul->rowCount()){
                            $row = $mesajbul->fetch(PDO::FETCH_OBJ);
                            $guncelle = $db->prepare("UPDATE mesajlar SET mesaj_durum = :d  WHERE mesaj_id = :id");
                            $guncelle->execute([':d' => 1, ':id' => $id]);
                            echo "<b>İsim : </b>".$row->mesaj_isim."<br />";
                            echo "<b>E-posta : </b>".$row->mesaj_eposta."<br />";
                            echo "<b>Konu : </b>".$row->mesaj_konu."<br />";
                            echo "<b>İçerik : </b>".$row->mesaj_mesaj."<br />";

                            echo "<hr />";
                            echo "<div class='alert alert-info'>Bu mesaj <b>".date('d.m.Y H:i', strtotime($row->mesaj_tarih))."</b> tarihinde <b>".$row->mesaj_ip."</b> IP adresinden gönderildi.</div>";
                            echo '<a class="btn btn-secondary" href="'.$yonetim.'/bekleyenmesajlar.php"><i class=\"fa fa-fw fa-lg fa-arrow-left\"></i>Listeye Dön</a>';

                      }else {
                          header('Location:'.$yonetim."/bekleyenmesajlar.php");
                      }

                      break;
                  case 'yorumoku':
                      $id = get('id');
                      if (!$id){
                            header('Location:'.$yonetim."/bekleyenyorumlar.php");
                      }
                      $yorumbul = $db->prepare("SELECT * FROM yorumlar INNER JOIN yazılar ON yazılar.yazi_id = yorumlar.yorum_yazi_id
                        WHERE yorum_id = :id");
                      $yorumbul->execute([':id' => $id]);
                      if ($yorumbul->rowCount()){
                          $row = $yorumbul->fetch(PDO::FETCH_OBJ);

                          echo "<b>İsim : </b>".$row->yorum_isim."<br />";
                          echo "<b>E-posta : </b>".$row->yorum_eposta."<br />";
                          echo "<b>Website : </b>".$row->yorum_website."<br />";
                          echo "<b>Hangi İçeriğe Yapıldı : </b><a href='".$arow->site_url."/icerik.php?yazi_sef=".$row->yazi_sef."&id=".$row->yazi_id."' target='_blank'>".$row->yazi_baslik."</a><br />";
                          echo "<b>İçerik : </b>".$row->yorum_icerik."<br />";

                          echo "<hr />";
                          echo "<div class='alert alert-info'>Bu yorum <b>".date('d.m.Y H:i', strtotime($row->yorum_tarih))."</b> tarihinde <b>".$row->yorum_ip."</b> IP adresinden yapıldı.</div>";

                          if ($row->yorum_durum == 1){ ?>

                              <a class="btn btn-danger" onclick="return confirm('Onaylıyor musunuz ?');" href="<?php echo $yonetim."/islemler.php?islem=yorumsil&id=".$row->yorum_id; ?>"><i class="fa fa-eraser"></i>Yorumu Sil</a>
                              <?php
                          }else{ ?>
                              <a class="btn btn-success" onclick="return confirm('Onaylıyor musunuz ?');" href="<?php echo $yonetim."/islemler.php?islem=yorumonayla&id=".$row->yorum_id; ?>"><i class="fa fa-check"></i>Yorumu Onayla</a>
                         <?php
                          }

                          echo '<a class="btn btn-secondary" href="'.$yonetim.'/bekleyenyorumlar.php"><i class=\"fa fa-fw fa-lg fa-arrow-left\"></i>Listeye Dön</a>';

                      }else {
                          header('Location:'.$yonetim."/bekleyenyorumlar.php");
                      }

                      break;
                  case 'yorumonayla':
                      $id = get('id');
                      if (!$id){
                          header('Location:'.$yonetim."/bekleyenyorumlar.php");
                      }
                      $onayla = $db->prepare("UPDATE yorumlar SET yorum_durum = :d WHERE yorum_id = :id");
                      $onayla->execute([':d' => 1, ':id' => $id]);
                      if ($onayla){
                          echo '<div class="alert alert-success">Yorum Onaylandı.</div>';
                          header('Refresh:2;url='.$_SERVER['HTTP_REFERER']);
                      }else{
                          echo '<div class="alert alert-danger">Hata Oluştu.</div>';
                      }
                   break;
                  case 'sosyalduzenle':
                      $id = get('id');
                      if (!$id){
                          header('Location:'.$yonetim."/sosyalmedya.php");
                      }
                      $sosyalbul = $db->prepare("SELECT * FROM sosyal_medya WHERE sosya_id = :id");
                      $sosyalbul->execute([':id' => $id]);
                      if ($sosyalbul->rowCount()){
                          $row = $sosyalbul->fetch(PDO::FETCH_OBJ);

                          if (isset($_POST['sosyalmedyaduzenle'])){

                              $ikon   = post('ikon');
                              $link   = post('link');
                              $durum  = post('durum');

                              if (!$ikon || !$link || !$durum){
                                  echo '<div class="alert alert-danger">Lütfen Tüm Alanları Doldurun.</div>';
                              }else{
                                  $sosyalguncelle = $db->prepare("UPDATE sosyal_medya SET
                                   sosyal_ikon = :ikon,
                                   sosyal_link = :link,
                                   sosyal_durum = :d WHERE sosya_id = :id
                                    ");
                                      $sosyalguncelle->execute([':ikon' => $ikon, ':link' => $link, ':d' => $durum, ':id' => $id ]);
                                      if ($sosyalguncelle){
                                          echo '<div class="alert alert-success">Sosyal medya hesabı başarıyla güncellendi.</div>';
                                          header('Refresh:2;url='.$yonetim."/sosyalmedya.php");
                                      }else {
                                          echo '<div class="alert alert-danger">Malesef bir hata ile karşılaştım. Tekrar dener misin ?</div>';
                                      }
                                  }
                              }
                          }

                          ?>
                          <form class="form-horizontal" action="" method="POST">
                              <div class="tile-body">
                                  <div class="form-group row">
                                      <label class="control-label col-md-3">Sosyal Medya İkon</label>
                                      <div class="col-md-8">
                                          <input class="form-control" name="ikon" value="<?php echo $row->sosyal_ikon; ?>">
                                      </div>
                                  </div>
                                  <div class="form-group row">
                                      <label class="control-label col-md-3">Sosyal Medya Link</label>
                                      <div class="col-md-8">
                                          <input class="form-control" name="link" value="<?php echo $row->sosyal_link; ?>">
                                          <small class="form-text" id="">https://www. kısmı ile beraber yazınız.</small>
                                      </div>
                                  </div>
                                  <div class="form-group row">
                                      <label class="control-label col-md-3">Sosyal Medya Durumu</label>
                                      <div class="col-md-8">
                                          <select name="durum" class="form-control">
                                              <option value="1" <?php echo $row->sosyal_durum == 1 ? 'selected' : null;  ?>>Evet, yayınlansın</option>
                                              <option value="2" <?php echo $row->sosyal_durum == 2 ? 'selected' : null;  ?>>Hayır, yayınlanmasın</option>
                                          </select>
                                      </div>
                                  </div>
                              </div>
                              <div class="tile-footer">
                                  <div class="row">
                                      <div class="col-md-8 col-md-offset-3">
                                          <button class="btn btn-primary" type="submit" name="sosyalmedyaduzenle"><i class="fa fa-fw fa-lg fa-check-circle"></i>Sosyal Medya Hesabı Düzenle</button>&nbsp;&nbsp;&nbsp;
                                          <a class="btn btn-secondary" href="<?php echo $yonetim; ?>/sosyalmedya.php"><i class="fa fa-fw fa-lg fa-arrow-left"></i>Listeye Dön</a>
                                      </div>
                                  </div>
                              </div>
                          </form>
                          <?php
                      break;
                  case 'egitimduzenle':
                      $id = get('id');
                      if (!$id){
                          header('Location:'.$yonetim."/egitim.php");
                      }
                      $bilgibul = $db->prepare("SELECT * FROM egitim WHERE egitim_id = :id");
                      $bilgibul->execute([':id' => $id]);
                      if ($bilgibul->rowCount()){
                          $row = $bilgibul->fetch(PDO::FETCH_OBJ);

                        if (isset($_POST['yeniegitimekle'])){

                        $tarih = post('tarih');
                        $baslik = post('baslik');
                        $icerik = $_POST['icerik'];

                            if (!$tarih || !$baslik || !$icerik){
                                echo '<div class="alert alert-danger">Lütfen Boş Alan Bırakmayınız</div>';
                            }else {
                                $ekle = $db->prepare("INSERT INTO egitim SET
                                                egitim_tarih = :tarih,
                                                egitim_baslik = :baslik,
                                                egitim_icerik = :icerik");
                                $ekle->execute([':tarih' => $tarih, ':baslik' => $baslik, ':icerik' => $icerik]);
                                if ($ekle->rowCount()){
                                    echo '<div class="alert alert-success">Eğitim Bilgisi Başarıyla Güncellendi. Yönlendiriliyorsunuz..</div>';
                                    header("Refresh:2;url=".$_SERVER['HTTP_REFERER']);
                                }else {
                                    echo '<div class="alert alert-danger">Malesef bir hata ile karşılaştım. Tekrar dener misin ?</div>';
                                }
                            }
                        }
                      }
                    ?>
                    <form class="form-horizontal" action="" method="POST" enctype="multipart/form-data">
                        <div class="tile-body">
                            <div class="form-group row">
                                <label class="control-label col-md-3">Eğitimin Tarihi</label>
                                <div class="col-md-8">
                                    <input value="<?php echo $row->egitim_tarih; ?>" class="form-control" name="tarih" placeholder="Başlık Giriniz.">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-3">Kurum Adı</label>
                                <div class="col-md-8">
                                    <input value="<?php echo $row->egitim_baslik; ?>" class="form-control" name="baslik" placeholder="Başlık Giriniz.">
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-md-3">Eğitim İçeriği</label>
                            <div class="col-md-8">
                                <textarea name="icerik" class="ckeditor"><?php echo $row->egitim_icerik; ?></textarea>
                            </div>
                        </div>
                        </div>
                        <div class="tile-footer">
                            <div class="row">
                                <div class="col-md-8 col-md-offset-3">
                                    <button class="btn btn-primary" type="submit" name="yeniegitimekle"><i class="fa fa-fw fa-lg fa-check-circle"></i>Eğitimi Düzenle</button>&nbsp;&nbsp;&nbsp;
                                    <a class="btn btn-secondary" href="<?php echo $yonetim; ?>"><i class="fa fa-fw fa-lg fa-arrow-left"></i>Anasayfaya Dön</a>
                                </div>
                            </div>
                        </div>
                    </form>
                    <?php
                    break;
                  case 'sertifikaduzenle':
                        $id = get('id');
                        if (!$id){
                            header('Location:'.$yonetim."/egitim.php");
                        }
                        $bilgibul = $db->prepare("SELECT * FROM sertifika WHERE sertifika_id = :id");
                        $bilgibul->execute([':id' => $id]);
                        if ($bilgibul->rowCount()){
                            $row = $bilgibul->fetch(PDO::FETCH_OBJ);

                            if (isset($_POST['kursguncelle'])){

                                $tarih = post('tarih');
                                $baslik = post('baslik');
                                $icerik = $_POST['icerik'];

                                if (!$tarih || !$baslik || !$icerik){
                                    echo '<div class="alert alert-danger">Lütfen Boş Alan Bırakmayınız</div>';
                                }else {
                                    $ekle = $db->prepare("INSERT INTO sertifika SET
                                                            sertifika_tarih = :tarih,
                                                            sertifika_baslik = :baslik,
                                                            sertifika_icerik = :icerik");
                                    $ekle->execute([':tarih' => $tarih, ':baslik' => $baslik, ':icerik' => $icerik]);
                                    if ($ekle->rowCount()){
                                        echo '<div class="alert alert-success">Sertifika Bilgisi Başarıyla Güncellendi. Yönlendiriliyorsunuz..</div>';
                                        header("Refresh:2;url=".$_SERVER['HTTP_REFERER']);
                                    }else {
                                        echo '<div class="alert alert-danger">Malesef bir hata ile karşılaştım. Tekrar dener misin ?</div>';
                                    }
                                }
                            }
                        }
                        ?>
                        <form class="form-horizontal" action="" method="POST" enctype="multipart/form-data">
                            <div class="tile-body">
                                <div class="form-group row">
                                    <label class="control-label col-md-3">Sertifika & Kurs Tarihi</label>
                                    <div class="col-md-8">
                                        <input value="<?php echo $row->sertifika_tarih; ?>" class="form-control" name="tarih" placeholder="Başlık Giriniz.">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label col-md-3">Sertifika & Kurs Adı</label>
                                    <div class="col-md-8">
                                        <input value="<?php echo $row->sertifika_baslik; ?>" class="form-control" name="baslik" placeholder="Başlık Giriniz.">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-3">Sertifika & Kurs İçeriği</label>
                                <div class="col-md-8">
                                    <textarea name="icerik" class="ckeditor"><?php echo $row->sertifika_icerik; ?></textarea>
                                </div>
                            </div>
                            </div>
                            <div class="tile-footer">
                                <div class="row">
                                    <div class="col-md-8 col-md-offset-3">
                                        <button class="btn btn-primary" type="submit" name="kursguncelle"><i class="fa fa-fw fa-lg fa-check-circle"></i>Güncelle</button>&nbsp;&nbsp;&nbsp;
                                        <a class="btn btn-secondary" href="<?php echo $yonetim; ?>"><i class="fa fa-fw fa-lg fa-arrow-left"></i>Anasayfaya Dön</a>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <?php
                        break;
                  case 'deneyimduzenle':
                        $id = get('id');
                        if (!$id){
                            header('Location:'.$yonetim."/egitim.php");
                        }
                        $bilgibul = $db->prepare("SELECT * FROM deneyim WHERE deneyim_id = :id");
                        $bilgibul->execute([':id' => $id]);
                        if ($bilgibul->rowCount()){
                            $row = $bilgibul->fetch(PDO::FETCH_OBJ);

                            if (isset($_POST['deneyimguncelle'])){

                                $tarih = post('tarih');
                                $baslik = post('baslik');
                                $icerik = $_POST['icerik'];

                                if (!$tarih || !$baslik || !$icerik){
                                    echo '<div class="alert alert-danger">Lütfen Boş Alan Bırakmayınız</div>';
                                }else {
                                    $ekle = $db->prepare("INSERT INTO deneyim SET
                                                                        deneyim_tarih = :tarih,
                                                                        deneyim_baslik = :baslik,
                                                                        deneyim_icerik = :icerik");
                                    $ekle->execute([':tarih' => $tarih, ':baslik' => $baslik, ':icerik' => $icerik]);
                                    if ($ekle->rowCount()){
                                        echo '<div class="alert alert-success">Deneyim Bilgisi Başarıyla Güncellendi. Yönlendiriliyorsunuz..</div>';
                                        header("Refresh:2;url=".$_SERVER['HTTP_REFERER']);
                                    }else {
                                        echo '<div class="alert alert-danger">Malesef bir hata ile karşılaştım. Tekrar dener misin ?</div>';
                                    }
                                }
                            }
                        }
                        ?>
                        <form class="form-horizontal" action="" method="POST" enctype="multipart/form-data">
                            <div class="tile-body">
                                <div class="form-group row">
                                    <label class="control-label col-md-3">Deneyim Tarihi</label>
                                    <div class="col-md-8">
                                        <input value="<?php echo $row->sertifika_tarih; ?>" class="form-control" name="tarih" placeholder="Başlık Giriniz.">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label col-md-3">Deneyim Adı</label>
                                    <div class="col-md-8">
                                        <input value="<?php echo $row->sertifika_baslik; ?>" class="form-control" name="baslik" placeholder="Başlık Giriniz.">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-3">Deneyim İçeriği</label>
                                <div class="col-md-8">
                                    <textarea name="icerik" class="ckeditor"><?php echo $row->sertifika_icerik; ?></textarea>
                                </div>
                            </div>
                            </div>
                            <div class="tile-footer">
                                <div class="row">
                                    <div class="col-md-8 col-md-offset-3">
                                        <button class="btn btn-primary" type="submit" name="deneyimguncelle"><i class="fa fa-fw fa-lg fa-check-circle"></i>Güncelle</button>&nbsp;&nbsp;&nbsp;
                                        <a class="btn btn-secondary" href="<?php echo $yonetim; ?>"><i class="fa fa-fw fa-lg fa-arrow-left"></i>Anasayfaya Dön</a>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <?php
                        break;
                  ## DUZENLEME VE OKUMA BİT ##

                  ## AYARLAR ##
                  case 'genel':
                      if (isset($_POST['genelguncel'])){
                          $url      = post('url');
                          $baslik   = post('baslik');
                          $keyw     = post('keyw');
                          $desc     = post('desc');
                          $durum    = post('durum');
                          $mail    = post('mail');

                          $guncelle = $db->prepare("UPDATE ayarlar SET 
                                    site_url    = :u,
                                    site_baslik = :b,
                                    site_keyw   = :k,
                                    site_desc   = :d,
                                    site_durum  = :du,
                                    site_mail = :m WHERE ayar_id = :id");
                              $guncelle->execute([':u' => $url, ':b' => $baslik, ':k' => $keyw, ':d' => $desc, ':du' => $durum, ':m' => $mail, ':id' => 1]);
                              if($guncelle){
                                  echo '<div class="alert alert-success">Ayarlar Başarıyla Güncellendi.</div>';
                                  header('refresh:2;url='.$_SERVER['HTTP_REFERER']);
                              }else {
                                  echo '<div class="alert alert-danger">Bir Hata İle Karşılaştım Tekrar Dener Misin ?</div>';
                              }
                          }
                      ?>

                            <form class="form-horizontal" action="" method="POST">
                                <div class="tile-body">
                                    <div class="form-group row">
                                        <label class="control-label col-md-3">Site URL</label>
                                        <div class="col-md-8">
                                            <input class="form-control" value="<?php echo $arow->site_url; ?>" name="url" placeholder="URL">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-md-3">Site Başlık</label>
                                        <div class="col-md-8">
                                            <input class="form-control" value="<?php echo $arow->site_baslik; ?>" name="baslik" placeholder="Başlık">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-md-3">Site Anahtar Kelimeler</label>
                                        <div class="col-md-8">
                                            <input class="form-control" value="<?php echo $arow->site_keyw; ?>" name="keyw" placeholder="Keyw">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-md-3">Site Açıklaması</label>
                                        <div class="col-md-8">
                                            <input class="form-control" value="<?php echo $arow->site_desc; ?>" name="desc" placeholder="DESC">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-md-3">Site Mail</label>
                                        <div class="col-md-8">
                                            <input class="form-control" value="<?php echo $arow->site_mail; ?>" name="mail" placeholder="MAİL">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-md-3">Sosyal Medya Durumu</label>
                                        <div class="col-md-8">
                                            <select name="durum" class="form-control">
                                                <option value="1" <?php echo $arow->site_durum == 1 ? 'selected' : null;  ?>>Aktif</option>
                                                <option value="2" <?php echo $arow->site_durum == 2 ? 'selected' : null;  ?>>Pasif</option>
                                            </select>
                                        </div>
                                    </div>

                                </div>
                                <div class="tile-footer">
                                    <div class="row">
                                        <div class="col-md-8 col-md-offset-3">
                                            <button class="btn btn-primary" type="submit" name="genelguncel"><i class="fa fa-fw fa-lg fa-check-circle"></i>Genel Ayarları Güncelle</button>&nbsp;&nbsp;&nbsp;
                                            <a class="btn btn-secondary" href="<?php echo $yonetim; ?>"><i class="fa fa-fw fa-lg fa-arrow-left"></i>Anasayfaya Dön</a>
                                        </div>
                                    </div>
                                </div>
                            </form>



                            <?php
                            break;
                  case 'logo':
                      if (isset($_POST['logoduzenle'])){
                          require_once 'inc/class.upload.php';
                          $image = new Upload($_FILES['logo']);
                          if ($image->uploaded){

                              $rname = md5(uniqid());
                              $image->allowed = array("image/*");
                              $image->image_convert = "webp";
                              $image->file_new_name_body = $rname;
                              $image->process("../images");
                              if ($image->processed){

                                  $guncelle = $db->prepare("UPDATE ayarlar SET site_icon = :l WHERE ayar_id = :id");
                                  $guncelle->execute([':l' => $rname.'.webp', ':id' => 1]);
                                  if ($guncelle){
                                        echo '<div class="alert alert-success">Logo Başarıyla Değiştirildi.</div>';
                                        header('refresh:2;url='.$_SERVER['HTTP_REFERER']);
                                  }else {
                                      echo '<div class="alert alert-danger">Hata Oluştu.</div>';
                                  }

                              }else {
                                  echo '<div class="alert alert-danger">Üzgünüm resimi yükleyemedim. Tekrar dener misin ?</div>';
                              }



                          }else {
                              echo '<div class="alert alert-danger">Resim Seçmediniz.</div>';
                          }

                      }
                      ?>
                      <form class="form-horizontal" action="" method="POST" enctype="multipart/form-data">
                          <div class="tile-body">
                              <div class="form-group row">
                                  <label class="control-label col-md-3">Logo</label>
                                  <div class="col-md-8">
                                      <img src="<?php echo $arow->site_url; ?>images/<?php echo $arow->site_icon; ?>" width="250" height="100" />
                                      <hr />
                                      <input class="form-control" type="file" name="logo">
                                  </div>
                              </div>
                          <div class="tile-footer">
                              <div class="row">
                                  <div class="col-md-8 col-md-offset-3">
                                      <button class="btn btn-primary" type="submit" name="logoduzenle"><i class="fa fa-fw fa-lg fa-check-circle"></i>Logoyu Güncelle</button>&nbsp;&nbsp;&nbsp;
                                      <a class="btn btn-secondary" href="<?php echo $yonetim; ?>"><i class="fa fa-fw fa-lg fa-arrow-left"></i>Anasayfaya Dön</a>
                                  </div>
                              </div>
                          </div>
                      </form>



                    <?php

                        break;
                  case 'favicon':
                      if (isset($_POST['faviconduzenle'])){
                          require_once 'inc/class.upload.php';
                          $image = new Upload($_FILES['logo']);
                          if ($image->uploaded){

                              $rname = md5(uniqid());
                              $image->allowed = array("image/*");
                              $image->image_convert = "webp";
                              $image->file_new_name_body = $rname;
                              $image->process("../images");
                              if ($image->processed){

                                  $guncelle = $db->prepare("UPDATE ayarlar SET site_favicon = :l WHERE ayar_id = :id");
                                  $guncelle->execute([':l' => $rname.'.webp', ':id' => 1]);
                                  if ($guncelle){
                                      echo '<div class="alert alert-success">Favicon Başarıyla Değiştirildi.</div>';
                                      header('refresh:2;url='.$_SERVER['HTTP_REFERER']);
                                  }else {
                                      echo '<div class="alert alert-danger">Hata Oluştu.</div>';
                                  }

                              }else {
                                  echo '<div class="alert alert-danger">Üzgünüm resimi yükleyemedim. Tekrar dener misin ?</div>';
                              }



                          }else {
                              echo '<div class="alert alert-danger">Resim Seçmediniz.</div>';
                          }

                      }
                      ?>
                      <form class="form-horizontal" action="" method="POST" enctype="multipart/form-data">
                          <div class="tile-body">
                              <div class="form-group row">
                                  <label class="control-label col-md-3">Favicon</label>
                                  <div class="col-md-8">
                                      <img src="<?php echo $arow->site_url; ?>images/<?php echo $arow->site_favicon; ?>" width="64" height="64" />
                                      <hr />
                                      <input class="form-control" type="file" name="logo">
                                  </div>
                              </div>
                              <div class="tile-footer">
                                  <div class="row">
                                      <div class="col-md-8 col-md-offset-3">
                                          <button class="btn btn-primary" type="submit" name="faviconduzenle"><i class="fa fa-fw fa-lg fa-check-circle"></i>Faviconu Güncelle</button>&nbsp;&nbsp;&nbsp;
                                          <a class="btn btn-secondary" href="<?php echo $yonetim; ?>"><i class="fa fa-fw fa-lg fa-arrow-left"></i>Anasayfaya Dön</a>
                                      </div>
                                  </div>
                              </div>
                      </form>



                      <?php

                      break;
                  case 'dogrulama':
                      if (isset($_POST['dogrulaguncelle'])) {
                          $google    = post('google');
                          $yandex    = post('yandex');
                          $bing      = post('bing');
                          $analiytcs = post('analiytcs');

                          $guncelle = $db->prepare("UPDATE ayarlar SET 
                                google_dogrulama_kodu   = :g,
                                yandex_dogrulama_kodu   = :y,
                                bing_dogrulama_kodu     = :b,
                                analiytcs_kodu          = :a WHERE ayar_id = :id");
                          $guncelle->execute([':g' => $google, ':y' => $yandex, ':b' => $bing, ':a' => $analiytcs, ':id' => 1]);
                          if ($guncelle){
                              echo '<div class="alert alert-success">Doğrulama ayarları başarıyla güncellendi.</div>';
                              header('refresh:2;url='.$_SERVER['HTTP_REFERER']);

                          }else {
                              echo '<div class="alert alert-danger">Malesef bir hata ile karşılaştım. Tekrar dener misiniz ?</div>';
                          }

                      }

                      ?>

                      <form class="form-horizontal" action="" method="POST">
                          <div class="tile-body">
                              <div class="form-group row">
                                  <label class="control-label col-md-3">Site Google Doğrulama Kodu</label>
                                  <div class="col-md-8">
                                      <input class="form-control" value="<?php echo $arow->google_dogrulama_kodu; ?>" name="google" placeholder="Google">
                                  </div>
                              </div>
                              <div class="form-group row">
                                  <label class="control-label col-md-3">Site Yandex Doğrulama Kodu</label>
                                  <div class="col-md-8">
                                      <input class="form-control" value="<?php echo $arow->yandex_dogrulama_kodu; ?>" name="yandex" placeholder="Yandex">
                                  </div>
                              </div>
                              <div class="form-group row">
                                  <label class="control-label col-md-3">Site Bing Doğrulama Kodu</label>
                                  <div class="col-md-8">
                                      <input class="form-control" value="<?php echo $arow->bing_dogrulama_kodu; ?>" name="bing" placeholder="Bing">
                                  </div>
                              </div>
                              <div class="form-group row">
                                  <label class="control-label col-md-3">Site Analiytcs Kodu</label>
                                  <div class="col-md-8">
                                      <input class="form-control" value="<?php echo $arow->analiytcs_kodu; ?>" name="analiytcs" placeholder="Analiytcs">
                                  </div>
                              </div>
                          </div>
                          <div class="tile-footer">
                              <div class="row">
                                  <div class="col-md-8 col-md-offset-3">
                                      <button class="btn btn-primary" type="submit" name="dogrulaguncelle"><i class="fa fa-fw fa-lg fa-check-circle"></i>Doğrulama Ayarlarını Güncelle</button>&nbsp;&nbsp;&nbsp;
                                      <a class="btn btn-secondary" href="<?php echo $yonetim; ?>"><i class="fa fa-fw fa-lg fa-arrow-left"></i>Anasayfaya Dön</a>
                                  </div>
                              </div>
                          </div>
                      </form>



                      <?php
                      break;
                  ## AYARLAR BİT ##
              }
              ?>
              
          </div>
        </div>
      </div>
    </main>
<?php require_once 'inc/alt.php'; ?>