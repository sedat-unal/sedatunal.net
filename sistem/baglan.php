<?php
    ob_start();
    $host = "";
    $dbname = "";
    $user = "";
    $pass = "";
    // "5.2.87.161"
    try{
        $db = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8;", "$user", "$pass");
        $db->query("SET CHARSET SET UTF8");
        $db->query("SET NAMES UTF8");
    }catch (PDOException $hata){
        echo $hata->getMessage();
    }

    ## Ayarlar tablosu bağlantısı ##
    $ayarlar = $db->prepare("SELECT * FROM ayarlar");
    $ayarlar ->execute();
    $arow       = $ayarlar->fetch(PDO::FETCH_OBJ);
    $site       = $arow->site_url;
    $logo       = $arow->site_icon;
    $sitekeyw   = $arow->site_keyw;
    $sitedesc   = $arow->site_desc;
    $sitebaslik = $arow->site_baslik;
    ##

    if($arow->site_durum != 1){
        header("Location:/hata/index.php");
    }


    ## Hakkımda tablosu bağlantısı ##
    $hakkimda = $db->prepare("SELECT * FROM hakkimda");
    $hakkimda ->execute();
    $hrow     = $hakkimda->fetch(PDO::FETCH_OBJ);
    $resim = $hrow->hakkimda_resim;
    ##

    ## Yazılar Tablosu Bağlantısı ##
    $yazial = $db->prepare("SELECT * FROM yazılar");
    $yazial->execute();
    $yrow = $yazial->fetch(PDO::FETCH_OBJ);
