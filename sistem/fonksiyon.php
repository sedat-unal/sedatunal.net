<?php

require_once 'baglan.php';

    function post($parametre, $kosul = false){
        if( $kosul == false ){
            $sonuc = strip_tags(trim($_POST[$parametre]));
        }elseif( $kosul == true ){
            $sonuc = strip_tags(trim(addslashes($_POST[$parametre])));
        }
        return $sonuc;
    }

    function IP(){

        if(getenv("HTTP_CLIENT_IP")){
            $ip = getenv("HTTP_CLIENT_IP");
        }elseif(getenv("HTTP_X_FORWARDED_FOR")){
            $ip = getenv("HTTP_X_FORWARDED_FOR");
            if (strstr($ip, ',')) {
                $tmp = explode (',', $ip);
                $ip = trim($tmp[0]);
            }
        }else{
            $ip = getenv("REMOTE_ADDR");
        }
        return $ip;
    }

    function pagination($s, $ptotal, $url){
        global $site;

        $forlimit = 3;
        if($ptotal < 2){
            null;
        }else{

            if($s > 4){
                $prev  = $s - 1;
                echo '<li class="page-item"><a class="page-link" href="'.$site.'/'.$url.'1" ><i class="fa fa-chevron-left"></i></a></li>';
                echo '<li class="page-item"><a class="page-link" href="'.$site.'/'.$url.($s-1).'" ><</a></li>';
            }

            for($i = $s - $forlimit; $i < $s + $forlimit + 1; $i++){
                if($i > 0 && $i <= $ptotal){
                    if($i == $s){
                        echo '<li class="page-item active"><a class="page-link"  href="#">'.$i.'</a></li>';
                    }else{
                        echo '<li class="page-item"><a class="page-link" href="'.$site.'/'.$url.$i.'" >'.$i.'</a></li>';
                    }
                }
            }

            if($s <= $ptotal - 4){
                $next  = $s + 1;
                echo '<li class="page-item"><a class="page-link" href="'.$site.'/'.$url.$next.'" > <i class="fa fa-chevron-right"></i></a></li>';
                echo '<li class="page-item"><a class="page-link" href="'.$site.'/'.$url.$ptotal.'" >»</a></li>';
            }
        }

    }

    function sef_link($str){
        $preg = array('Ç', 'Ş', 'Ğ', 'Ü', 'İ', 'Ö', 'ç', 'ş', 'ğ', 'ü', 'ö', 'ı', '+', '#', '.');
        $match = array('c', 's', 'g', 'u', 'i', 'o', 'c', 's', 'g', 'u', 'o', 'i', 'plus', 'sharp', '');
        $perma = strtolower(str_replace($preg, $match, $str));
        $perma = preg_replace("@[^A-Za-z0-9\-_\.\+]@i", ' ', $perma);
        $perma = trim(preg_replace('/\s+/', ' ', $perma));
        $perma = str_replace(' ', '-', $perma);
        return $perma;
    }

    function readingTime($content = "", $readingSpeed = 2)
    {
        $fiftySeconds = 50; //Saniye bazında en yüksek değer - Max value per second
        $oneMinute = 60; //Bir dakika 60 saniyiedir - One minute 60 seconds
        $totalSecondsInOneHour = 3600; //1 saatteki toplam saniye - Total seconds in 1 hour
        //Parametre olarak gelen içerikten html taglarını kaldırır.
        //Ardından boşlukları baz alarak, içerikte kaç kelime olduğunu hesaplar.
        //Removes html tags from content that comes as a parameter.
        //It then calculates how many words are in the content, based on gaps.
        $wordCount = round(count(explode(" ", strip_tags($content))));
        //Kelime sayısını, parametre olarak gelen hız değerine (varsayılan olarak 2) bölerek okuma hızını hesaplar.
        //Calculates the reading speed by dividing the word count by the incoming speed value (default is 2).
        $readingTime = ceil($wordCount / $readingSpeed);
        //Okuma süresi 1 dk'nın aşağısında ise çıktıyı saniye bazında verir.
        //If the reading time is below 1 min, the output is given in seconds.
        if ($readingTime < $fiftySeconds)
        {
            $second = intval($readingTime / 10);
            $second++;
            $second *= 10;
            echo "$second saniye";
            //echo "$second second";
        }
        //Okuma süresi 1 dk'nın üzerinde ise çıktıyı dakika bazında verir.
        //If the reading time is above 1 min, output is given in minutes.
        else if ($readingTime < $totalSecondsInOneHour)
        {
            $minute = ceil($readingTime / $oneMinute);
            echo "$minute dakika";
            //echo "$minute minute";
        }
        //Okuma süresi 1 saatin üzerinde ise çıktıyı saat bazında verir.
        //If the reading time is over 1 hour, the output is given in hours.
        else
        {
            $hour = floor($readingTime / $totalSecondsInOneHour);
            echo "$hour saat";
            //echo "$hour hour";
        }
    }

    function etiketler(){
        global $db;
        global $site;
        $sorgu = $db->prepare("SELECT yazi_id, yazi_etiket FROM yazılar WHERE yazi_durum = :d 
        ORDER BY yazi_id DESC LIMIT :lim");

        $sorgu->bindValue(':d', (int) 1, PDO::PARAM_INT);
        $sorgu->bindValue(':lim', (int) 2, PDO::PARAM_INT);
        $sorgu->execute();
        if($sorgu->rowCount()){
            $arr = array();
            foreach ($sorgu as $row){
                $etiketler = $row['yazi_etiket'];
                $exp       = explode(',', $etiketler);
                foreach ($exp as $e){
                    $arr[] = '<a href="'.$site.'etiketdetay.php?etiket='.sef_link($e).'"">'.$e.'</a>';
                }
            }
            $arr = array_unique($arr);
            foreach ($arr as $etiketbilgi){
                echo $etiketbilgi;
            }
        }
    }

    function tit(){
        global $db;
        global $sitebaslik;
        global $site;
        global $logo;
        global $sitekeyw;
        global $sitedesc;

        $yazisef = @$_GET['yazi_sef'];
        $katsef  = @$_GET['kat_sef'];
        $q       = @$_GET['q'];
        $etiket  = @$_GET['etiket'];

        if ($yazisef){
            $yazilar = $db->prepare("SELECT * FROM yazılar WHERE yazi_sef = :s AND yazi_durum = :d");
            $yazilar->execute([':s' => $yazisef, ':d' => 1]);
            $yazirow = $yazilar->fetch(PDO::FETCH_OBJ);

            $tit['baslik']    = $yazirow->yazi_baslik."-".$sitebaslik;
            $tit['resim']     = $site."/images/".$yazirow->yazi_resim;
            $tit['kelimeler'] = $yazirow->yazi_etiket;
            $tit['aciklama']  = mb_substr($yazirow->yazi_icerik,0,200,'utf8');
        }elseif ($katsef){
            $kategoriler = $db->prepare("SELECT * FROM kategoriler WHERE kat_sef = :s");
            $kategoriler->execute([':s' => $katsef]);
            $katrow = $kategoriler->fetch(PDO::FETCH_OBJ);

            $tit['baslik']    = $katrow->kat_adi."-".$sitebaslik;
            $tit['resim']     = $site.'/images/'.$logo;
            $tit['kelimeler'] = $katrow->kat_keyw;
            $tit['aciklama']  = $katrow->kat_desc;
        }elseif($q){
            $tit['baslik']    = $q."-".$sitebaslik;
            $tit['resim']     = $site.'/images/'.$logo;
            $tit['kelimeler'] = $sitekeyw;
            $tit['aciklama']  = $sitedesc;
        }elseif($etiket){
            $tit['baslik']    = $etiket."-".$sitebaslik;
            $tit['resim']     = $site.'/images/'.$logo;
            $tit['kelimeler'] = $sitekeyw;
            $tit['aciklama']  = $sitedesc;
        }else{
            $tit['baslik']  = $sitebaslik;
            $tit['resim']   = $site.'/images/'.$logo;
            $tit['kelimeler']  = $sitekeyw;
            $tit['aciklama']  = $sitedesc;
        }

        return $tit;
    }

$tit = tit();

?>