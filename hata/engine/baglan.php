<?php
    $host = "";
    $dbname = "";
    $user = "";
    $pass = "";
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



    ## Hakkımda tablosu bağlantısı ##
    $hakkimda = $db->prepare("SELECT * FROM hakkimda");
    $hakkimda ->execute();
    $hrow     = $hakkimda->fetch(PDO::FETCH_OBJ);
    ##
