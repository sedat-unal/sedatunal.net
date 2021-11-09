<?php
echo !defined('guvenlik') ? die() : null;
require_once "sistem/fonksiyon.php";
?>
<!DOCTYPE html>
<html lang="en-US">

<head>
    <title><?php echo $tit['baslik']; ?></title>
    <!-- META TAGS -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta name="description" content="<?php echo $tit['aciklama']; ?>">
    <meta name="keywords" content="<?php echo $tit['kelimeler']; ?>">
    <!-- CSS FILES -->
    <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="css/fontawesome.css" rel="stylesheet" type="text/css">
    <link href="css/slick.css" rel="stylesheet" type="text/css">
    <link href="css/style.css" rel="stylesheet" type="text/css">
    <link href="css/featherlight.css" rel="stylesheet" type="text/css">
    <link href="css/rrssb.css" rel="stylesheet" type="text/css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.css" rel="stylesheet" type="text/css">
    <link rel="icon" type="image/png" href="<?php echo $arow->site_url; ?>/images/<?php echo $arow->site_favicon; ?>" <meta name="google-site-verification" content="<?php echo $arow->google_dogrulama_kodu; ?>" />
    <meta name="msvalidate.01" content="<?php echo $arow->bing_dogrulama_kodu; ?>" />
    <meta name="yandex-verification" content="<?php echo $arow->yandex_dogrulama_kodu; ?>" />
    <meta name="robots" content="index, follow">


    <script language="javascript">
        document.onmousedown = disableclick;
        status = "Right Click Disabled";
        Function disableclick(event) {
            if (event.button == 2) {
                alert(status);
                return false;
            }
        }
    </script>


</head>

<body oncontextmenu="return true">
    <!-- READING POSITION INDICATOR -->
    <progress value="0" id="eskimo-progress-bar">
        <span class="eskimo-progress-container">
            <span class="eskimo-progress-bar"></span>
        </span>
    </progress>