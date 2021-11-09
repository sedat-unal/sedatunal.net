-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Anamakine: localhost:3306
-- Üretim Zamanı: 09 Kas 2021, 13:53:34
-- Sunucu sürümü: 8.0.27
-- PHP Sürümü: 7.3.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `rfyalmhi_blog`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `aboneler`
--

CREATE TABLE `aboneler` (
  `abone_id` int NOT NULL,
  `abone_mail` varchar(200) NOT NULL,
  `abone_tarih` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `abone_ip` varchar(200) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

--
-- Tablo döküm verisi `aboneler`
--

INSERT INTO `aboneler` (`abone_id`, `abone_mail`, `abone_tarih`, `abone_ip`) VALUES
(4, 'sedat@sedatunal.net', '2020-01-09 08:16:24', '::1'),
(3, 'sedatunal42@gmail.com', '2020-01-07 14:19:48', ''),
(5, '42@42.com', '2020-12-13 21:31:56', '159.146.41.50');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `ayarlar`
--

CREATE TABLE `ayarlar` (
  `ayar_id` int NOT NULL,
  `site_url` varchar(200) NOT NULL,
  `site_baslik` varchar(500) NOT NULL,
  `site_keyw` varchar(260) NOT NULL,
  `site_desc` varchar(260) NOT NULL,
  `site_mail` varchar(200) NOT NULL,
  `site_icon` varchar(200) NOT NULL,
  `site_favicon` varchar(200) NOT NULL,
  `google_dogrulama_kodu` varchar(300) NOT NULL,
  `yandex_dogrulama_kodu` varchar(300) NOT NULL,
  `bing_dogrulama_kodu` varchar(300) NOT NULL,
  `analiytcs_kodu` mediumtext NOT NULL,
  `site_durum` tinyint(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

--
-- Tablo döküm verisi `ayarlar`
--

INSERT INTO `ayarlar` (`ayar_id`, `site_url`, `site_baslik`, `site_keyw`, `site_desc`, `site_mail`, `site_icon`, `site_favicon`, `google_dogrulama_kodu`, `yandex_dogrulama_kodu`, `bing_dogrulama_kodu`, `analiytcs_kodu`, `site_durum`) VALUES
(1, 'https://sedatunal.net/', 'Sedat Ünal', 'blog, sitesi, özgün,kişisel', 'Sedat Ünal Kişisel Blog Sitesi', 'sedat@sedatunal.net', '', '', '', '', '', '', 1);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `deneyim`
--

CREATE TABLE `deneyim` (
  `deneyim_id` int NOT NULL,
  `deneyim_tarih` varchar(200) NOT NULL,
  `deneyim_baslik` varchar(200) NOT NULL,
  `deneyim_icerik` varchar(500) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

--
-- Tablo döküm verisi `deneyim`
--

INSERT INTO `deneyim` (`deneyim_id`, `deneyim_tarih`, `deneyim_baslik`, `deneyim_icerik`) VALUES
(3, '2019', 'Reset Bilişim Teknolojileri LTD. ŞTİ.', '<p>İş Başlığı : PHP Developer</p>\r\n\r\n<p>Ekstra İşler : Windows sunucu kurulumları, web site kurulumları, var olan web sitelerin d&uuml;zeltilmesi vb..&nbsp;</p>\r\n');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `egitim`
--

CREATE TABLE `egitim` (
  `egitim_id` int NOT NULL,
  `egitim_tarih` varchar(200) NOT NULL,
  `egitim_baslik` varchar(200) NOT NULL,
  `egitim_icerik` varchar(500) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

--
-- Tablo döküm verisi `egitim`
--

INSERT INTO `egitim` (`egitim_id`, `egitim_tarih`, `egitim_baslik`, `egitim_icerik`) VALUES
(12, '2019 - 2022', 'Nişantaşı Üniversitesi', '<p>Bilgisayar M&uuml;hendisliği</p>\r\n'),
(11, '09/06/2017', 'ÖZEL ÜMRANİYE BİRİKİM TEMEL LİSESİ', '<p>Yabancı Dil : İngilizce<br />\r\nDiploma Puanı :&nbsp;68,74</p>\r\n');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `hakkimda`
--

CREATE TABLE `hakkimda` (
  `hakkimda_id` int NOT NULL,
  `hakkimda_isim` varchar(100) NOT NULL,
  `hakkimda_meslek` varchar(100) NOT NULL,
  `hakkimda_resim` varchar(200) NOT NULL,
  `hakkimda_icerik` text NOT NULL,
  `hakkimda_iletisim` varchar(300) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

--
-- Tablo döküm verisi `hakkimda`
--

INSERT INTO `hakkimda` (`hakkimda_id`, `hakkimda_isim`, `hakkimda_meslek`, `hakkimda_resim`, `hakkimda_icerik`, `hakkimda_iletisim`) VALUES
(1, 'BEN KİMİM ?', 'Bir bilgisayar mühendisi öğrencisi', '9e88eb2b6f50ba0db4201d886b24f48e.webp', 'Lisedeyken&nbsp;sadece html ve css ile web siteleri yaptıktan sonra php ve js &ouml;ğrenmeye başladım. Hala da tamamen biliyorum diyemem. Her g&uuml;n ve tanıdığım her insandan bir şeyler &ouml;ğrenmeye &ccedil;alışırım. Hayatın ustası değil &ouml;ğrencisiyimdir.&nbsp; Şimdi ise Nişantaşı &Uuml;niversitesinde Bilgisayar M&uuml;hendisliği &ouml;ğrencisiyim aynı zamanda da bir yazılım şirketinde full stack web developer olarak &ccedil;alışıyorum. Hobilerim arasında d&uuml;nya klasiklerini okumak, kamp yapmak, motosiklet s&uuml;rmek bulunuyor. Her şeyin başladığı yıl olan 2013&#39;e buradan sevgilerle..', 'Size ulaşabilmem i&ccedil;in l&uuml;tfen bilgileri eksiksiz giriniz..');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `kategoriler`
--

CREATE TABLE `kategoriler` (
  `kat_id` int NOT NULL,
  `kat_adi` varchar(200) NOT NULL,
  `kat_sef` varchar(200) NOT NULL,
  `kat_keyw` varchar(200) NOT NULL,
  `kat_desc` varchar(300) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

--
-- Tablo döküm verisi `kategoriler`
--

INSERT INTO `kategoriler` (`kat_id`, `kat_adi`, `kat_sef`, `kat_keyw`, `kat_desc`) VALUES
(7, 'Genel', 'genel', 'Genel, özgün, kaliteli, blog, yazısı', 'Genel ve özgün blogların bulunduğu kategori.'),
(8, 'Blog', 'blog', 'Blog,Kategori,Canlı,Özgün', 'Özgün blog yazılarının bulunduğu Blog isimli kategori.'),
(9, 'PHP', 'php', 'PHP, PDO, MYSQL, webiste', 'PHP ile alakalı yazıların bulunduğu kategori'),
(10, 'Linux', 'linux', 'Ubuntu, linux, nasıl, yapılır,', 'Linux dağıtımları için karşılaştığım sorunların çözümlerinin yer aldığı kategori'),
(11, 'JavaScript', 'javascript', 'JavaScript, TypeScript, React, Flutter, JS', 'JavaScript yazılım diline dair özgün blog yazılarının bulunduğu kategori.');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `mesajlar`
--

CREATE TABLE `mesajlar` (
  `mesaj_id` int NOT NULL,
  `mesaj_isim` varchar(200) NOT NULL,
  `mesaj_konu` varchar(250) NOT NULL,
  `mesaj_eposta` varchar(200) NOT NULL,
  `mesaj_mesaj` text NOT NULL,
  `mesaj_tarih` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `mesaj_durum` tinyint(1) NOT NULL DEFAULT '2',
  `mesaj_ip` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `sertifika`
--

CREATE TABLE `sertifika` (
  `sertifika_id` int NOT NULL,
  `sertifika_tarih` varchar(200) NOT NULL,
  `sertifika_baslik` varchar(200) NOT NULL,
  `sertifika_icerik` varchar(500) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

--
-- Tablo döküm verisi `sertifika`
--

INSERT INTO `sertifika` (`sertifika_id`, `sertifika_tarih`, `sertifika_baslik`, `sertifika_icerik`) VALUES
(4, '2013', 'Web Tasarım Kursu', '<p>Html, css eğitimi&nbsp;</p>\r\n');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `slider`
--

CREATE TABLE `slider` (
  `slider_id` int NOT NULL,
  `slider_resim` varchar(300) NOT NULL,
  `slider_baslik` varchar(200) NOT NULL,
  `slider_kategori` varchar(200) NOT NULL,
  `slider_bag` varchar(300) NOT NULL,
  `slider_icerik` varchar(200) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

--
-- Tablo döküm verisi `slider`
--

INSERT INTO `slider` (`slider_id`, `slider_resim`, `slider_baslik`, `slider_kategori`, `slider_bag`, `slider_icerik`) VALUES
(15, '7f316af90f9a2cb6e482ea85a4b69fdc.webp', 'PDO İLE VERİTABANI BAĞLANTISI NASIL YAPILIR ?', '9', '32', 'Pdo veritabanı bağlantısını yapıyoruz.'),
(16, '094ae08537a5cae7d7cf4b626e0a667f.webp', 'PDO İLE MYSQL\'DE Kİ DATAYI EKRANA YAZDIRMA', '9', '33', 'Mysql\'de ki datamızı ekrana bastırıyoruz.'),
(17, 'e357afc787bf6b0b5fb06adc1067c2b3.webp', 'İNPUT:NUMBER NEDEN “e” DEĞERİ ALIR ?', '7', '34', 'e nedir ve neden input:number kabul eder ?'),
(18, '61989e4e8157c06653db3d999e62595d.webp', 'UBUNTU PHPMYADMİN 404 HATASI', '10', '36', 'Linux dağıtımlarında phpmyadmin neden 404 alır ?'),
(19, 'd54863714c23aa7182ef125ee78161e4.webp', 'JavaScript Zar Oyunu', '11', '40', 'JavaScript öğrenirken oyun yazıyoruz');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `sosyalmedya`
--

CREATE TABLE `sosyalmedya` (
  `id` int NOT NULL,
  `ikon` varchar(200) NOT NULL,
  `link` varchar(200) NOT NULL,
  `durum` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `sosyal_medya`
--

CREATE TABLE `sosyal_medya` (
  `sosya_id` int NOT NULL,
  `sosyal_ikon` varchar(200) NOT NULL,
  `sosyal_link` varchar(200) NOT NULL,
  `sosyal_durum` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

--
-- Tablo döküm verisi `sosyal_medya`
--

INSERT INTO `sosyal_medya` (`sosya_id`, `sosyal_ikon`, `sosyal_link`, `sosyal_durum`) VALUES
(7, 'github', 'https://www.github.com/sedat-unal', 1),
(3, 'instagram', 'https://instagram.com/sedatunaall', 1),
(5, 'linkedin', 'https://tr.linkedin.com/in/sedat-unal', 1);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `yazılar`
--

CREATE TABLE `yazılar` (
  `yazi_id` int NOT NULL,
  `yazi_kat_id` int NOT NULL,
  `yazi_baslik` varchar(250) NOT NULL,
  `yazi_sef` varchar(250) NOT NULL,
  `yazi_resim` varchar(200) NOT NULL,
  `yazi_icerik` text NOT NULL,
  `yazi_etiket` varchar(250) NOT NULL,
  `yazi_sef_etiket` varchar(250) NOT NULL,
  `yazi_tarih` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `yazi_goruntulenme` int NOT NULL DEFAULT '0',
  `yazilar_slider_id` int DEFAULT NULL,
  `yazi_durum` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

--
-- Tablo döküm verisi `yazılar`
--

INSERT INTO `yazılar` (`yazi_id`, `yazi_kat_id`, `yazi_baslik`, `yazi_sef`, `yazi_resim`, `yazi_icerik`, `yazi_etiket`, `yazi_sef_etiket`, `yazi_tarih`, `yazi_goruntulenme`, `yazilar_slider_id`, `yazi_durum`) VALUES
(33, 9, 'PDO İLE MYSQL\'DE Kİ DATAYI EKRANA YAZDIRMA', 'pdo-ile-mysql-de-ki-datayi-ekrana-yazdirma', 'c4e9844988c40463bd52ebb143cb3b66.webp', '<p>Pdo ile mysql\'de ki verimizi ekrana bastırabilmek için,</p>\r\n    <p>Önce Mysql tablomuzu yapılandıralım,</p>\r\n    <pre>\r\n        CREATE TABLE `users`(   `user_id` int(11) NOT NULL,   `user_name` varchar(50) NOT NULL ) ENGINE=InnoDB DEFAULT CHARSET=latin1; INSERT INTO `users` (`user_id`, `user_name`) VALUES\r\n        (1, \'Deneme 1\'), (2, \'Deneme 2\');\r\n    </pre>\r\n    <p>Sonra veritabanı bağlantımızı yaptığımız sayfayı (örn. baglan.php) indeximize include ettikten sonra (bkz. index.php içinde ) veritabanımızdaki veriden hem id yi hemde ismi ekrana bastırmak için,</p>\r\n    <pre>\r\n        include(\"baglan.php\"); $query = $db->query(\"Select * from users\", PDO::FETCH_ASSOC); if ( $query->rowCount() ){ foreach( $query as $row ){ print $row[\'user_name\'].\" \"; } }\r\n    </pre>', 'php, pdo, mysql, insert', 'php,pdo,mysql,insert', '2020-11-01 10:43:59', 402, NULL, 1),
(32, 9, 'PDO İLE VERİTABANI BAĞLANTISI NASIL YAPILIR ?', 'pdo-ile-veritabani-baglantisi-nasil-yapilir', 'd80abb19e4e81aba72fb75db2f342fa4.webp', '<p><strong>Php</strong>&#39;nin g&uuml;venlik bakımından etkili&nbsp;<strong>pdo</strong>&nbsp;ile veritabanı bağlantısını aşağıdaki gibi yapabilirsiniz.</p>\r\n\r\n<pre>\r\n<p>$host&nbsp;=&nbsp;&quot;host ismi&quot;;<br />\r\n$dbname&nbsp;=&nbsp;&quot;database adı&quot;;<br />\r\n$user&nbsp;=&nbsp;&quot;hangi kullanıcı ile phpmyadmine giriş yapılacağı&quot;;<br />\r\n$pass&nbsp;=&nbsp;&quot;kullanıcının şifresi&quot;;<br />\r\ntry&nbsp;{ &nbsp;&nbsp;&nbsp;&nbsp;<br />\r\n$db&nbsp;=&nbsp;new&nbsp;PDO(&quot;mysql:host=$host;dbname=$dbname;charset=utf8;&quot;,&nbsp;&quot;$user&quot;,&nbsp;&quot;$pass&quot;);<br />\r\n&nbsp;&nbsp;&nbsp;&nbsp;$db-&gt;query(&quot;SET&nbsp;CHARSET&nbsp;SET&nbsp;UTF8&quot;);<br />\r\n&nbsp;&nbsp;&nbsp;&nbsp;$db-&gt;query(&quot;SET&nbsp;NAMES&nbsp;UTF8&quot;);<br />\r\n&nbsp;}&nbsp;catch&nbsp;(PDOException&nbsp;$hata)&nbsp;{<br />\r\n&nbsp;&nbsp;&nbsp;&nbsp;echo&nbsp;$hata-&gt;getMessage();<br />\r\n}</p>\r\n</pre>', 'php,pdo,veritabanı,mysql', 'php,pdo,veritabani,mysql', '2020-10-16 14:18:28', 353, NULL, 1),
(34, 7, 'İNPUT:NUMBER NEDEN “e” DEĞERİ ALIR ?', 'input-number-neden-e-degeri-alir', '151cc0e8c7f6fa3c5cf59b32c32c72ab.webp', '<p>Merhaba arkadaşlar bu yazımda sizlere html input elementinin tip olarak number belirtilmesi halinde neden &quot;e&quot; değeri alabildiğini anlatıcam.&nbsp;<br />\r\n&nbsp;</p>\r\n\r\n<p>Aksi belirtilmediği s&uuml;rece input:number elementi e değerini alır &ccedil;&uuml;nk&uuml; e aslında bir değer belirtir. &Ouml;rneğin 2e5 dediğimiz zaman aslında 200000 sayısını ifade etmiş oluyoruz.&nbsp;<br />\r\n&nbsp;</p>\r\n\r\n<p>Peki bunu nasıl &ouml;nleriz ? Tabi ki input:number elementine min ve max değerlerini ekleyerek. Detaylar i&ccedil;in kodu inceleyebilirsiniz.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><code>&lt;input type=&quot;number&quot;&gt;</code></p>\r\n\r\n<p>Şu anda &quot;e&quot; değerini alabilir.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><code>&lt;input type=&quot;number&quot; min=&quot;1&quot; max=&quot;5&quot;&gt;</code></p>\r\n\r\n<p>Şu anda &quot;e&quot; değerini alamaz.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n', 'html,input,number,e', 'html,input,number,e', '2020-12-14 21:25:32', 335, NULL, 1),
(36, 10, 'Ubuntuda phpMyAdmin 404 Not Found Hatası Nasıl Çözülür', 'ubuntuda-phpmyadmin-404-not-found-hatasi-nasil-cozulur', '2acf11521855c299b0488a3f3c3868bd.webp', '<p>Linux dağıtımlarının herhangi birinde kendi makinenizde php yazmak i&ccedil;in serverınızı kurdunuz. Kurulum aşamalarını tamamen doğru yapmanıza rağmen <strong>phpMyAdmin 404 d&ouml;nd&uuml;r&uuml;yorsa endişelenmeyin.</strong> Sorun sizden kaynaklanmıyor.&nbsp;</p>\r\n\r\n<p>Bende aynı sorunla karşılaştım ve internette uzun araştırmalarım sonucunda nasıl d&uuml;zeltebileceğimi &ouml;ğrendim ve bunu paylaşarak &ouml;ğrenilmesi daha kolay hale getirmek istedim.&nbsp;</p>\r\n\r\n<p>Gelelim hatanın nedenine; Aslında hata sembolik olarak &#39;/etc/apache2/conf-avalilable/&#39; dizini altındaki phpMyAdmin i&ccedil;in bağlantının oluşturulmamış olmasından kaynaklanıyor.&nbsp;</p>\r\n\r\n<p>Bunu d&uuml;zeltmek i&ccedil;inse; &#39;etc/apache2/conf-available/&#39; dizini altında phpMyAdmin i&ccedil;in sembolik bir bağlantı oluşturmak gerekyior.</p>\r\n\r\n<p>Gelelim bunun nasıl yapıldığına,</p>\r\n\r\n<div style=\"background:#eeeeee;border:1px solid #cccccc;padding:5px 10px;\">&Ouml;ncelikle terminali a&ccedil;ıyoruz. Y&ouml;netici olduğunuzdan emin olun.</div>\r\n\r\n<div style=\"background:#eeeeee;border:1px solid #cccccc;padding:5px 10px;\">\r\n<pre>\r\nsudo ln -s /etc/phpmyadmin/apache.conf /etc/apache2/conf-available/phpmyadmin.conf\r\n\r\nsudo a2enconf phpmyadmin</pre>\r\n\r\n<pre>\r\nsudo service apache2 reload</pre>\r\n</div>\r\n\r\n<p>Verdiğim kodları satır satır &ccedil;alıştırdıktan sonra <a href=\"http://ip_adresiniz/phpmyadmin\">http://ip_adresiniz/phpmyadmin</a> linkinden tekrar erişmeyi deneyin. D&uuml;zeldiğini g&ouml;receksiniz. :)</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n', 'Linux, ubuntu, phpmyadmin, 404,', 'linux,ubuntu,phpmyadmin,404,', '2021-09-15 10:16:30', 61, NULL, 1),
(40, 11, 'JavaScript İle Zar Atma Oyunu Yapıyoruz', 'javascript-ile-zar-atma-oyunu-yapiyoruz', 'd389cc11445f134411c1e8771a126e0b..webp', '<p>JavaSciprt oyun yazma serimizin ilk b&ouml;l&uuml;m&uuml;ne hoşgeldin :)</p>\r\n\r\n<p><strong>JavaScript &ouml;ğrenmeye &ccedil;alıştığım şu g&uuml;nlerde &ouml;ğrendiğim bilgileri seninle de paylaşmak istedim.</strong> &Ouml;ncelikle belirtmeliyim ki benim i&ccedil;in &ouml;nemli olan oyunların &ccedil;alışma mantığını anlayarak koda d&ouml;kebilmek o y&uuml;zden UI kısmına &ccedil;ok dikkat etmedim.</p>\r\n\r\n<p>Gelelim kodlarımızın a&ccedil;ıklamalarına;</p>\r\n\r\n<pre>\r\n<code>\r\nfunction zarAt() {\r\n    var div = document.getElementById(&#39;player1Choosen&#39;);\r\n    var myNumber = (Math.floor(Math.random() * 6) + 1);\r\n    computerDice();\r\n}\r\n</code></pre>\r\n\r\n<p>Yukarıda&nbsp;index html sayfamızda oyuncunun yani bizim zar at tuşuna bastığımız anda 1 ile 6 arasında rastgele sayı se&ccedil;erek se&ccedil;tiği sayıya g&ouml;re images klas&ouml;r&uuml;nden o zarın resmini &ccedil;ağırıyor ve bilgisayarın zar atması i&ccedil;in computerDice() fonksiyonunu &ccedil;ağırıyoruz.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<pre>\r\n<code>\r\nfunction computerDice() {\r\n    var div = document.getElementById(&#39;computerChoice&#39;);\r\n    var myNumber = (Math.floor(Math.random() * 6) + 1);\r\n    getResult();\r\n}\r\n</code>\r\n</pre>\r\n\r\n<p>Yukarıda kullanıcı yani bizim i&ccedil;in 1 ile 6 arasında rastgele bir zar attıktan sonra aynı işlemleri bilgisayar i&ccedil;inde yapıp sonu&ccedil; fonksiyonunu &ccedil;ağıyor.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<pre>\r\n<code>\r\nfunction getResult() {\r\n    var player1 = document.getElementById(&#39;player1&#39;);\r\n    var computer = document.getElementById(&#39;computer&#39;);\r\n\r\n    var computerSrc = computer.getAttribute(&#39;src&#39;);\r\n    var playerSrc = player1.getAttribute(&#39;src&#39;);\r\n\r\n\r\n    //substring folder name\r\n    var playerSubstring = playerSrc.substring(15, 16);\r\n    var computerSubstring = computerSrc.substring(15, 16);\r\n\r\n    let playerWin = 0;\r\n    let computerWin = 0;\r\n\r\n    var homeScore = document.getElementById(&quot;homeScore&quot;);\r\n    var computerScore = document.getElementById(&quot;computerScore&quot;);\r\n\r\n    if (playerSubstring &gt; computerSubstring) {\r\n        if (homeScore.innerHTML &gt; 0) {\r\n            if (computerScore.innerHTML &gt; 0) {\r\n                playerWin = homeScore.innerHTML;\r\n                computerWin = computerScore.innerHTML;\r\n            }\r\n            playerWin = homeScore.innerHTML;\r\n        }\r\n        console.log(&quot;humanity win&quot;);\r\n        ++playerWin;\r\n        homeScore.innerHTML = playerWin;\r\n    } else if (playerSubstring &lt; computerSubstring) {\r\n        if (computerScore.innerHTML &gt; 0) {\r\n            if (homeScore.innerHTML &gt; 0) {\r\n                computerWin = computerScore.innerHTML;\r\n                playerWin = homeScore.innerHTML;\r\n            }\r\n            computerWin = computerScore.innerHTML;\r\n        }\r\n        console.log(&quot;computer win&quot;);\r\n        ++computerWin;\r\n        computerScore.innerHTML = computerWin;\r\n    } else {\r\n        draw = 1;\r\n    }\r\n\r\n}\r\n</code>\r\n</pre>\r\n\r\n<p>Yukarıdaki kod bloğu biraz uzun olabilir fakat telaşlanma her şeyi a&ccedil;ıklayacağım.</p>\r\n\r\n<p>1. Adım =&gt; Player 1 yani kullanıcının ve bilgisayarın zarını attıktan sonra zar resimlerinin g&ouml;sterildiği divi se&ccedil;iyoruz.</p>\r\n\r\n<p>2. Adım =&gt; Image tagının src değerini alıyoruz.</p>\r\n\r\n<p>3. Adım =&gt; Src değerlerini aldıktan sonra substring fonksiyonu ile imagelerin folder namellerini traşlıyoruz.</p>\r\n\r\n<p>4. Adım =&gt; Oyuncu ve bilgisayar skorlarını tanımlıyoruz ve bunu let data typeı ile yapıyoruz. Burası &ouml;nemli &ccedil;&uuml;nk&uuml; <strong>program &ccedil;alışırken bu değer değişeceği i&ccedil;in let olarak tanımlamalıyız</strong>. <strong>Const olarak tanımlarsak skorlar hep tanımlandığı gibi kalır.</strong></p>\r\n\r\n<p>5. Adım =&gt; Skorların bulunduğu divleri &ccedil;ekiyoruz.</p>\r\n\r\n<p>6. Adım =&gt; 3. Adımda traşladığımız isimleri kendi aralarında kıyaslıyoruz. &Ouml;rneğin kullanıcının zarı 4, bilgisayarın zarı 2 geldiyse if in i&ccedil;ine girecek. Tam tersi ise else if e girecek ve eğer eşitlik s&ouml;z konusu ise skorlar artmayacaktır.</p>\r\n\r\n<p>7 . Adım =&gt; Kullanıcının zarı bilgisayardan y&uuml;ksekse,&nbsp;kullanıcının ve bilgisayarın skor durumlarına g&ouml;re kullanıcının skorunu 1 arttırıyoruz.</p>\r\n\r\n<p>8. Adım =&gt; Bilgisayarın zarı kullanıcıdan y&uuml;ksekse,&nbsp; bilgisayarın ve kullanıcının skor durumuna g&ouml;re bilgisayarın skorunu 1 arttırıyoruz.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Umarım faydalı bir yazı olmuştur.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><code>Github Reposity Adresi :&nbsp;https://github.com/sedat-unal/Dice-Game-With-JavaScript</code></p>\r\n', 'JavaScript, Zar Oyunu', 'javascript,zar-oyunu', '2021-10-27 20:20:43', 10, NULL, 1);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `yoneticiler`
--

CREATE TABLE `yoneticiler` (
  `yonetici_id` int NOT NULL,
  `yonetici_kadi` varchar(200) NOT NULL,
  `yonetici_eposta` varchar(200) NOT NULL,
  `yonetici_sifre` varchar(200) NOT NULL,
  `son_ip` varchar(255) NOT NULL,
  `son_tarih` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

--
-- Tablo döküm verisi `yoneticiler`
--

INSERT INTO `yoneticiler` (`yonetici_id`, `yonetici_kadi`, `yonetici_eposta`, `yonetici_sifre`, `son_ip`, `son_tarih`) VALUES
(1, 'Sedat', '', '', '', '');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `yorumlar`
--

CREATE TABLE `yorumlar` (
  `yorum_id` int NOT NULL,
  `yorum_yazi_id` int NOT NULL,
  `yorum_isim` varchar(200) NOT NULL,
  `yorum_eposta` varchar(200) NOT NULL,
  `yorum_icerik` text NOT NULL,
  `yorum_website` varchar(250) DEFAULT NULL,
  `yorum_tarih` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `yorum_durum` tinyint(1) NOT NULL DEFAULT '2',
  `yorum_ip` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `aboneler`
--
ALTER TABLE `aboneler`
  ADD PRIMARY KEY (`abone_id`);

--
-- Tablo için indeksler `ayarlar`
--
ALTER TABLE `ayarlar`
  ADD PRIMARY KEY (`ayar_id`);

--
-- Tablo için indeksler `deneyim`
--
ALTER TABLE `deneyim`
  ADD PRIMARY KEY (`deneyim_id`);

--
-- Tablo için indeksler `egitim`
--
ALTER TABLE `egitim`
  ADD PRIMARY KEY (`egitim_id`);

--
-- Tablo için indeksler `hakkimda`
--
ALTER TABLE `hakkimda`
  ADD PRIMARY KEY (`hakkimda_id`);

--
-- Tablo için indeksler `kategoriler`
--
ALTER TABLE `kategoriler`
  ADD PRIMARY KEY (`kat_id`);

--
-- Tablo için indeksler `mesajlar`
--
ALTER TABLE `mesajlar`
  ADD PRIMARY KEY (`mesaj_id`);

--
-- Tablo için indeksler `sertifika`
--
ALTER TABLE `sertifika`
  ADD PRIMARY KEY (`sertifika_id`);

--
-- Tablo için indeksler `slider`
--
ALTER TABLE `slider`
  ADD PRIMARY KEY (`slider_id`);

--
-- Tablo için indeksler `sosyalmedya`
--
ALTER TABLE `sosyalmedya`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `sosyal_medya`
--
ALTER TABLE `sosyal_medya`
  ADD PRIMARY KEY (`sosya_id`);

--
-- Tablo için indeksler `yazılar`
--
ALTER TABLE `yazılar`
  ADD PRIMARY KEY (`yazi_id`);

--
-- Tablo için indeksler `yoneticiler`
--
ALTER TABLE `yoneticiler`
  ADD PRIMARY KEY (`yonetici_id`);

--
-- Tablo için indeksler `yorumlar`
--
ALTER TABLE `yorumlar`
  ADD PRIMARY KEY (`yorum_id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `aboneler`
--
ALTER TABLE `aboneler`
  MODIFY `abone_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Tablo için AUTO_INCREMENT değeri `ayarlar`
--
ALTER TABLE `ayarlar`
  MODIFY `ayar_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Tablo için AUTO_INCREMENT değeri `deneyim`
--
ALTER TABLE `deneyim`
  MODIFY `deneyim_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Tablo için AUTO_INCREMENT değeri `egitim`
--
ALTER TABLE `egitim`
  MODIFY `egitim_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Tablo için AUTO_INCREMENT değeri `hakkimda`
--
ALTER TABLE `hakkimda`
  MODIFY `hakkimda_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Tablo için AUTO_INCREMENT değeri `kategoriler`
--
ALTER TABLE `kategoriler`
  MODIFY `kat_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Tablo için AUTO_INCREMENT değeri `mesajlar`
--
ALTER TABLE `mesajlar`
  MODIFY `mesaj_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Tablo için AUTO_INCREMENT değeri `sertifika`
--
ALTER TABLE `sertifika`
  MODIFY `sertifika_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Tablo için AUTO_INCREMENT değeri `slider`
--
ALTER TABLE `slider`
  MODIFY `slider_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Tablo için AUTO_INCREMENT değeri `sosyalmedya`
--
ALTER TABLE `sosyalmedya`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `sosyal_medya`
--
ALTER TABLE `sosyal_medya`
  MODIFY `sosya_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Tablo için AUTO_INCREMENT değeri `yazılar`
--
ALTER TABLE `yazılar`
  MODIFY `yazi_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- Tablo için AUTO_INCREMENT değeri `yoneticiler`
--
ALTER TABLE `yoneticiler`
  MODIFY `yonetici_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Tablo için AUTO_INCREMENT değeri `yorumlar`
--
ALTER TABLE `yorumlar`
  MODIFY `yorum_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
