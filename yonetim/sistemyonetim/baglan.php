<?php
session_start();
ob_start();
$host = "";
$dbname = "";
$user = "";
$pass = "";
try {
    $db = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8;", "$user", "$pass");
    $db->query("SET CHARSET SET UTF8");
    $db->query("SET NAMES UTF8");
} catch (PDOException $hata) {
    echo $hata->getMessage();
}
if (@$_SESSION['oturum'] == sha1(md5(@$_SESSION['id'] . IP()))) {
    $yoneticibul = $db->prepare("SELECT * FROM yoneticiler WHERE yonetici_id = :id");
    $yoneticibul->execute([':id' => @$_SESSION['id']]);
    if ($yoneticibul->rowCount()) {
        $yrow    = $yoneticibul->fetch(PDO::FETCH_OBJ);
        $yid    = $yrow->yonetici_id;
        $ykadi  = $yrow->yonetici_kadi;
        $yposta = $yrow->yonetici_eposta;
    }
}

## Ayarlar tablosu bağlantısı ##
$ayarlar = $db->prepare("SELECT * FROM ayarlar");
$ayarlar->execute();
$arow       = $ayarlar->fetch(PDO::FETCH_OBJ);
$yonetim       = $arow->site_url . "yonetim";
