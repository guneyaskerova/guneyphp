<?php require_once('header.php'); ?>

<!-- Yazı Ekle Section Start -->
<section id="yaziEkle" class="py-3">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h3>Yazı Ekle</h3>
            </div>
        </div>
        <form method="post" class="form-row" enctype="multipart/form-data">
            <div class="col-md-8">
                <div class="form-group">
                    <input type="text" name="baslik" class="form-control" placeholder="Yazı Başlığını Giriniz">
                </div>
                <div class="form-group">
                    <textarea name="icerik" rows="7" class="form-control" placeholder="Yazı İçeriğini Girin"></textarea>
                </div>
                <div class="form-group">
                    <input type="text" name="meta" class="form-control" placeholder="Meta Açıklaması Girin (Max. 160 Karakter)">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <input type="file" name="foto">
                </div>
                <div class="form-group">
                    <input type="text" name="fotoalt" class="form-control" placeholder="Foto Alt Metni Girin">
                </div>
                <div class="form-group">
                    <label><small>Kategori</small></label>
                    <select name="kategori" class="form-control">
                        <option value="">Seçiniz</option>
                        <?php
                        $sorgu_katlist = $db->prepare('select * from kategoriler order by kategori asc');
                        $sorgu_katlist->execute();

                        if ($sorgu_katlist->rowCount()) {
                            foreach ($sorgu_katlist as $satir_katlist) {
                        ?>
                                <option value="<?php echo $satir_katlist['kategori']; ?>"><?php echo $satir_katlist['kategori']; ?></option>
                        <?php
                            }
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label><small>Yayınlanma Tarihi</small></label>
                    <input type="date" name="tarih" class="form-control">
                </div>
                <div class="form-group">
                    <label><small>Yayın Durumu</small></label>
                    <select name="durum" class="form-control">
                        <option value="">Seçiniz</option>
                        <option value="Taslak">Taslak</option>
                        <option value="Yayınlandı">Yayınlandı</option>
                    </select>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-success w-100">Kaydet</button>
                </div>
<?php

if($_POST){
    $baslik = $_POST['baslik'];
    $icerik = $_POST['icerik'];
    $meta = $_POST['meta'];
    $dizin = '../img/';
    $yuklenecekfoto = $dizin.$_FILES['foto']['name'];
    $fotoalt = $_POST['fotoalt'];
    $kategori = $_POST['kategori'];
    $tarih = $_POST['tarih'];
    $durum = $_POST['durum'];

    if(move_uploaded_file($_FILES['foto']['tmp_name'],$yuklenecekfoto)){
        $sorgu_kaydet = $db -> prepare('insert into yazilar(baslik,icerik,meta,foto,fotoalt,kategori,tarih,durum) values(?,?,?,?,?,?,?,?)');
        $sorgu_kaydet -> execute(array($baslik,$icerik,$meta,$yuklenecekfoto,$fotoalt,$kategori,$tarih,$durum));

        if($sorgu_kaydet -> rowCount()){
            echo '<div class="alert alert-success">Kayıt İşlemi Başarılı</div> <meta http-equiv="refresh" content="2; url=yazilar.php">';
            
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
<!-- Yazı Ekle Section End -->

<?php require_once('footer.php'); ?>



