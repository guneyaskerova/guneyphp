<?php require_once('header.php'); ?>

<!-- Sayfa Ekle Section Start -->
<section id="sayfalar" class="py-3">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2>Sayfa Ekle</h2>
            </div>
        </div>
        <form class="form-row" method="post" enctype="multipart/form-data">
            <div class="col-md-8">
                <div class="form-group">
                    <input type="text" name="baslik" class="form-control" placeholder="Sayfa Başlığını Girin">
                </div>
                <div class="form-group">
                    <textarea name="icerik" rows="7" class="form-control" placeholder="Sayfa İçeriğini Girin"></textarea>
                    <script>
                        CKEDITOR.replace('icerik');
                    </script>
                </div>
                <div class="form-group">
                    <input type="text" name="meta" placeholder="Meta Açıklamasını Girin (Max.160 Karakter)" class="form-control">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label><small>Öne Çıkan Görsel</small></label>
                    <input type="file" name="foto">
                </div>
                <div class="form-group">
                    <input type="text" name="fotoalt" class="form-control" placeholder="Görsel Alt Metni Ekleyin">
                </div>
                <div class="form-group">
                    <input type="text" name="seotitle" placeholder="Sayfa Başlığı Girin" class="form-control">
                </div>
                <div class="form-group">
                    <label><small>Durum</small></label>
                    <select name="durum" class="form-control">
                        <option value="">Seçiniz</option>
                        <option value="Taslak">Taslak</option>
                        <option value="Yayınlandı">Yayınlandı</option>
                    </select>
                </div>
                <div class="form-group">
                    <label><small>Sayfa Türü</small></label>
                    <select name="sayfaturu" class="form-control">
                        <option value="">Seçiniz</option>
                        <option value="Alt Sayfa">Alt Sayfa</option>
                        <option value="Üst Sayfa">Üst Sayfa</option>
                    </select>
                </div>
                <div class="form-group">
                    <label><small>Yayınlanma Tarihi</small></label>
                    <input type="date" name="tarih" class="form-control">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-success w-100">Kaydet</button>
                </div>

                <?php
                if ($_POST) {

                    $baslik = $_POST['baslik'];
                    $icerik = $_POST['icerik'];
                    $meta = $_POST['meta'];
                    $dizin = "../img/";
                    $yuklenecekfoto = $dizin . $_FILES['foto']['name'];
                    $fotoalt = $_POST['fotoalt'];
                    $seotitle = $_POST['seotitle'];
                    $durum = $_POST['durum'];
                    $sayfaturu = $_POST['sayfaturu'];
                    $tarih = $_POST['tarih'];

                    if (move_uploaded_file($_FILES['foto']['tmp_name'], $yuklenecekfoto)) {
                        $sorgu_sayfa = $db->prepare('insert into sayfalar(baslik,icerik,meta,foto,fotoalt,seotitle,durum,sayfaturu,tarih) values(?,?,?,?,?,?,?,?,?)');
                        $sorgu_sayfa->execute(array($baslik, $icerik, $meta, $yuklenecekfoto, $fotoalt, $seotitle, $durum, $sayfaturu, $tarih));

                        if ($sorgu_sayfa->rowCount()) {
                            echo '<div class="alert alert-success">Sayfa Eklendi</div><meta http-equiv="refresh" content="2; url=sayfalar.php">';
                        } else {
                            echo '<div class="alert alert-danger">Hata Oluştu</div>';
                        }
                    }
                }
                ?>

            </div>
        </form>
    </div>
</section>
<!-- Sayfa Ekle Section End -->



<?php require_once('footer.php'); ?>