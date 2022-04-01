<?php require_once('header.php'); ?>

<!-- Sayfalar list Section Start-->
<section id="saylarList">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <span style="font-size:32px; font-weight:500;">Sayfalar</span>
                <a href="sayfaekle.php"><button class="btn btn-info">Sayfa Ekle</button></a>
            </div>
            <div class="col-12">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Görsel</th>
                            <th>Başlık</th>
                            <th>Sayfa Başlığı</th>
                            <th>Durum</th>
                            <th>Sayfa Türü</th>
                            <th>Düzenle</th>
                            <th>Sil</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sorgu_sayfalar = $db->prepare('select * from sayfalar order by id desc');
                        $sorgu_sayfalar->execute();

                        if ($sorgu_sayfalar->rowCount()) {
                            foreach ($sorgu_sayfalar as $satir_sayfalar) {
                        ?>
                                <tr>
                                    <td class="w-25"><img src="<?php echo $satir_sayfalar['foto']; ?>"  class="img-fluid"></td>
                                    <td style="vertical-align: middle;" class="w-25"><?php echo $satir_sayfalar['baslik']; ?></td>
                                    <td style="vertical-align: middle;" class="w-25"><?php echo $satir_sayfalar['seotitle']; ?></td>
                                    <td style="vertical-align: middle;" class="w-25"><?php echo $satir_sayfalar['durum']; ?></td>
                                    <td style="vertical-align: middle;" class="w-25"><?php echo $satir_sayfalar['sayfaturu']; ?></td>
                                    <td style="vertical-align: middle;"><a href="sayfaduzenle.php?$id=<?php echo $satir_sayfalar['id'];?>"><button class="btn btn-warning">Düzenle</button></a></td>
                                    <td style="vertical-align: middle;"><a href="sayfasil.php?id=<?php echo $satir_sayfalar['id']; ?>"><button class="btn btn-danger">Sil</button></a></td>
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
</section>
<!-- Sayfalar list Section End-->

<?php require_once('footer.php'); ?>