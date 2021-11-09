<?php
define('guvenlik', true);
require_once 'inc/ust.php';
require_once 'inc/sol.php';
?>
<main class="app-content">
    <div class="app-title">
        <div>
            <h1><i class="fa fa-th-list"></i> SLİDER SAYFASI</h1>
            <p>Slider Listesi</p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item">Slider</li>
            <li class="breadcrumb-item active"><a href="#">Slider Listesi</a></li>
        </ul>
    </div>
    <div class="row">
        <div class="clearfix"></div>
        <div class="col-md-12">
            <div class="tile">
                <h3 class="tile-title">Slider Listesi</h3>
                <div class="table-responsive table-hover">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>id</th>
                                <th>SLİDER RESMİ</th>
                                <th>SLİDER YAZISI</th>
                                <th>İŞLEMLER</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $resimcek = $db->prepare("SELECT * FROM slider");
                            $resimcek->execute();
                            if ($resimcek->rowCount()){

                                foreach ($resimcek as $row){
                                    ?>
                                    <tr>
                                        <td><?php echo $row['slider_id']; ?></td>
                                        <td>
                                            <div style="max-height: 150px;">
                                                <img src="../images/<?php echo $row['slider_resim']; ?>" style="height: 120px;width: 200px;">
                                            </div>
                                        </td>
                                        <td><?php echo mb_substr($row['slider_baslik'], 0,90, 'utf8'); ?></td>
                                        <td><a href="<?php echo $yonetim."/islemler.php?islem=sliderduzenle&id=".$row['slider_id']; ?>"><i class="fa fa-edit"></i></a> | Düzenle
                                            <br>
                                            <a onclick="return confirm('Slider silinirse artık gözükmeyecektir onaylıyor musunuz ?');" href="<?php echo $yonetim."/islemler.php?islem=slidersil&id=".$row['slider_id']; ?>"><i class="fa fa-eraser"></i></a> | Sil
                                        </td>
                                    </tr>




                                    <?php
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</main>
<?php require_once 'inc/alt.php'; ?>