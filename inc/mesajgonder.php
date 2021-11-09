<?php
    require_once "../sistem/fonksiyon.php";

    if($_POST){
        $isim = $_POST["isim"];
        $eposta = $_POST["eposta"];
        $konu = $_POST["konu"];
        $mesaj = $_POST["mesaj"];

        if (!$isim || !$eposta || !$konu || !$mesaj){
            echo 'bos';
        }else {
            if(!filter_var($eposta, FILTER_VALIDATE_EMAIL)){
                echo 'format';
            }else{
                $kaydet = $db->prepare("INSERT INTO mesajlar SET 
                    mesaj_isim = :i,
                    mesaj_eposta = :e,
                    mesaj_konu = :k,
                    mesaj_mesaj = :m,
                    mesaj_ip = :ip");
                $kaydet->execute([
                    ':i' => $isim, ':e' => $eposta, ':k' => $konu, ':m' => $mesaj, ':ip' => IP() ]);
                if ($kaydet){
                    echo "basarili";
                }else{
                    echo "hata";
                }
            }
        }
    }