<?php require_once "engine/baglan.php";
if ($arow->site_durum == 1){
    header("Location:".$arow->site_url);
}?>
<!--Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE html>
<html lang="en">
<head>
<title>404 | SEDAT ÜNAL</title>
<meta name="viewport" content="width=device-width, initial-scale=1" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="descriptipn" content="Bu sayfa Hilal Yıldırım Blog sitesinin 404 hata sayfasıdır. Blog sitesinin çalışmadığı ve bulamadığı sayfalarda bu sayfa açılacaktır." />
<meta name="keywords" content="Özgün,Blog,Kişisel,Psikolog,Tedavi" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- font files -->
<link href="//fonts.googleapis.com/css?family=Heebo:100,300,400,500,700,800,900" rel="stylesheet">
<link href="//fonts.googleapis.com/css?family=Rancho" rel="stylesheet">
<!-- /font files -->
<!-- css files -->
<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
<!-- /css files -->
<body>
<div class="agileits-main">
	<a href="#"><h1><span>404</span>Sedat Ünal | Blog Sitesi</h1></a>
	<div class="w3ls-container text-center">
		<div class="w3layouts-image text-center">
			<img src="images/board.png" alt="" />
			<h2 class="header-w3ls">404</h2>
		</div>
        <h3 class="img-txt">Yeniliyoruz !</h3>
        <h3 class="img-txt">Çevremize verdigimiz geçici rahatsızlıktan ötürü özür dileriz !</h3>
        <p>Görünüşe göre bazı güncellemeler yapıyorum.</p>
        <div class="agileits-link">
            <?php
            if ($arow->site_durum == 1){ ?>
                <a href="<?php echo $arow->site_url; ?>">Beni Eve Götür</a>
            <?php }else{ ?>
                <a href="https://www.google.com" target="_blank">Beni Eve Götür</a>
                <?php
            } ?>

		</div>	
	</div>
	<div class="w3ls-footer">
		<p> &copy; 2020. Her Hakkı Saklıdır | Design by <a href="http://sedatunal.net" target="=_blank">Sedat Ünal</a></p>
	</div>

</div>
</body>
</html>