<?php echo !defined('guvenlik') ? die() :null; ?>
<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
<aside class="app-sidebar">
    <div class="app-sidebar__user"><img style="height: 40px; width: 40px;" class="app-sidebar__user-avatar" src="../images/<?php echo $arow->site_icon; ?>" alt="User Image">
        <div>
            <p class="app-sidebar__user-name"><?php echo $ykadi; ?></p>
            <p class="app-sidebar__user-designation">Yönetici</p>
        </div>
    </div>
    <ul class="app-menu">
        <li><a class="app-menu__item <?php if(loc() == $yonetim."/index.php"){ echo "active"; } ?>" href="index.php"><i class="app-menu__icon fa fa-dashboard"></i><span class="app-menu__label">Ana Sayfa</span></a></li>

        <li class="treeview <?php if(loc() == $yonetim."/kategoriler.php" || loc() == $yonetim."/islemler.php?islem=yenikategori" || loc() == $yonetim."/islemler.php?islem=kategoriduzenle&id=".get('id')) {echo "is-expanded";} ?>"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-list"></i><span class="app-menu__label">Kategoriler</span><i class="treeview-indicator fa fa-angle-right"></i></a>
            <ul class="treeview-menu">
                <li><a class="treeview-item" href="<?php echo $yonetim; ?>/kategoriler.php"><i class="icon fa fa-circle-o"></i> Kategori Listesi (<?php echo say('kategoriler'); ?>)</a></li>
                <li><a class="treeview-item" href="<?php echo $yonetim; ?>/islemler.php?islem=yenikategori"><i class="icon fa fa-circle-o"></i> Yeni Kategori Ekle</a></li>

            </ul>
        </li>

        <li class="treeview <?php if (loc() == $yonetim."/yazilar.php" || loc() == $yonetim."/islemler.php?islem=yenikonu" || loc() == $yonetim."/islemler.php?islem=yaziduzenle&id=".get('id')) {echo "is-expanded";} ?>"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-laptop"></i><span class="app-menu__label">Yazılar</span><i class="treeview-indicator fa fa-angle-right"></i></a>
            <ul class="treeview-menu">
                <li><a class="treeview-item" href="<?php echo $yonetim;?>/yazilar.php"><i class="icon fa fa-circle-o"></i> Yazı Listesi (<?php echo say('yazılar'); ?>)</a></li>
                <li><a class="treeview-item" href="<?php echo $yonetim; ?>/islemler.php?islem=yenikonu"><i class="icon fa fa-circle-o"></i> Yeni Yazı Ekle</a></li>

            </ul>
        </li>

        <li class="treeview <?php if (loc() == $yonetim."/slider.php" || loc() == $yonetim."/islemler.php?islem=yenislider" || loc() == $yonetim."/islemler.php?islem=sliderduzenle&id=".get('id')) {echo "is-expanded";} ?>"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-forward"></i><span class="app-menu__label">Slider</span><i class="treeview-indicator fa fa-angle-right"></i></a>
            <ul class="treeview-menu">
                <li><a class="treeview-item" href="<?php echo $yonetim; ?>/slider.php"><i class="icon fa fa-circle-o"></i> Slider Listesi (<?php echo say('slider'); ?>)</a></li>
                <li><a class="treeview-item" href="<?php echo $yonetim; ?>/islemler.php?islem=yenislider"><i class="icon fa fa-circle-o"></i> Yeni Slider Ekle</a></li>

            </ul>
        </li>

        <li class="treeview <?php if (loc() == $yonetim."/onayliyorumlar.php" || loc() == $yonetim."/bekleyenyorumlar.php" || loc() == $yonetim."/islemler.php?islem= &id=".get('id')) {echo "is-expanded";} ?>"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-comment"></i><span class="app-menu__label">Yorumlar</span><i class="treeview-indicator fa fa-angle-right"></i></a>
            <ul class="treeview-menu">
                <li><a class="treeview-item" href="<?php echo $yonetim; ?>/onayliyorumlar.php"><i class="icon fa fa-circle-o"></i> Onaylı Yorumlar (<?php echo say('yorumlar', 'yorum_durum', '1'); ?>)</a></li>
                <li><a class="treeview-item" href="<?php echo $yonetim; ?>/bekleyenyorumlar.php"><i class="icon fa fa-circle-o"></i> Onay Bekleyen Yorumlar (<?php echo say('yorumlar', 'yorum_durum', '2'); ?>)</a></li>

            </ul>
        </li>

        <li class="treeview <?php if (loc() == $yonetim."/okunmusmesajlar.php" || loc() == $yonetim."/bekleyenmesajlar.php" || loc() == $yonetim."/islemler.php?islem= &id=".get('id')) {echo "is-expanded";} ?>"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-envelope"></i><span class="app-menu__label">Mesajlar</span><i class="treeview-indicator fa fa-angle-right"></i></a>
            <ul class="treeview-menu">
                <li><a class="treeview-item" href="<?php echo $yonetim; ?>/okunmusmesajlar.php"><i class="icon fa fa-circle-o"></i> Okunmuş Mesajlar (<?php echo say('mesajlar', 'mesaj_durum', '1'); ?>)</a></li>
                <li><a class="treeview-item" href="<?php echo $yonetim; ?>/bekleyenmesajlar.php"><i class="icon fa fa-circle-o"></i> Yeni Mesajlar (<?php echo say('mesajlar', 'mesaj_durum', '2'); ?>)</a></li>

            </ul>
        </li>

        <li class="treeview <?php if (loc() == $yonetim."/sosyalmedya.php" || loc() == $yonetim."/islemler.php?islem=yenisosyalmedya" || loc() == $yonetim."/islemler.php?islem= &id=".get('id')) {echo "is-expanded";} ?>"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-facebook-square"></i><span class="app-menu__label">Sosyal Medya</span><i class="treeview-indicator fa fa-angle-right"></i></a>
            <ul class="treeview-menu">
                <li><a class="treeview-item" href="<?php echo $yonetim; ?>/sosyalmedya.php"><i class="icon fa fa-circle-o"></i> Sosyal Medya Listesi (<?php echo say('sosyal_medya'); ?>)</a></li>
                <li><a class="treeview-item" href="<?php echo $yonetim; ?>/islemler.php?islem=yenisosyalmedya"><i class="icon fa fa-circle-o"></i> Yeni Sosyal Medya Ekle</a></li>

            </ul>
        </li>

        <li class="treeview <?php if (loc() == $yonetim."/aboneler.php" || loc() == $yonetim."/islemler.php?islem=aboneduzenle" || loc() == $yonetim."/islemler.php?islem= &id=".get('id')) {echo "is-expanded";} ?>"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-users"></i><span class="app-menu__label">Aboneler</span><i class="treeview-indicator fa fa-angle-right"></i></a>
            <ul class="treeview-menu">
                <li><a class="treeview-item" href="<?php echo $yonetim; ?>/aboneler.php"><i class="icon fa fa-circle-o"></i> Abone Listesi (<?php echo say('aboneler'); ?>)</a></li>

            </ul>
        </li>

        <li class="treeview <?php if(loc() == $yonetim."/about.php") {echo "is-expanded";} ?>"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-list"></i><span class="app-menu__label">Hakkımda</span><i class="treeview-indicator fa fa-angle-right"></i></a>
            <ul class="treeview-menu">
                <li><a class="treeview-item" href="<?php echo $yonetim; ?>/about.php"><i class="icon fa fa-circle-o"></i> Hakkımda Sayfası</a></li>
                <li><a class="treeview-item" href="<?php echo $yonetim; ?>/egitim.php"><i class="icon fa fa-circle-o"></i> Bilgiler Listesi</a></li>
                <li><a class="treeview-item" href="<?php echo $yonetim; ?>/islemler.php?islem=bilgiekle"><i class="icon fa fa-circle-o"></i> Yeni Eğitim Ekle</a></li>
                <li><a class="treeview-item" href="<?php echo $yonetim; ?>/islemler.php?islem=sertifikaekle"><i class="icon fa fa-circle-o"></i> Yeni Sertifika Ekle</a></li>
                <li><a class="treeview-item" href="<?php echo $yonetim; ?>/islemler.php?islem=isekle"><i class="icon fa fa-circle-o"></i> Yeni İş Deneyimi Ekle</a></li>

            </ul>
        </li>

        <li class="treeview <?php if (loc() == $yonetim."/islemler.php" || loc() == $yonetim."/islemler.php?islem=genel" || loc() == $yonetim."/islemler.php?islem=logo" || loc() == $yonetim."/islemler.php?islem=favicon" || loc() == $yonetim."/islemler.php?islem=dogrulama" || loc() == $yonetim."/islemler.php?islem= &id=".get('id')) {echo "is-expanded";} ?>"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-cog"></i><span class="app-menu__label">Ayarlar</span><i class="treeview-indicator fa fa-angle-right"></i></a>
            <ul class="treeview-menu">
                <li><a class="treeview-item" href="<?php echo $yonetim; ?>/islemler.php?islem=genel"><i class="icon fa fa-circle-o"></i> Genel Ayarlar</a></li>
                <li><a class="treeview-item" href="<?php echo $yonetim; ?>/islemler.php?islem=logo"><i class="icon fa fa-circle-o"></i> Logo Ayarları</a></li>
                <li><a class="treeview-item" href="<?php echo $yonetim; ?>/islemler.php?islem=favicon"><i class="icon fa fa-circle-o"></i> Favicon Ayarları</a></li>
                <li><a class="treeview-item" href="<?php echo $yonetim; ?>/islemler.php?islem=dogrulama"><i class="icon fa fa-circle-o"></i> Doğrulama Ayarları</a></li>

            </ul>
        </li>


    </ul>
</aside>