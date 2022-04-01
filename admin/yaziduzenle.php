<?php
require_once('header.php');

$id = $_GET['id'];
$sorgu_duzenle = $db->prepare('select * from yazilar where id=?');
$sorgu_duzenle->execute(array($id));
$satir_duzenle = $sorgu_duzenle->fetch();
?>

<!-- Yazı Ekle Section Start -->
<section id="yaziEkle" class="py-3">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h3>Yazı Düzenle</h3>
            </div>
        </div>
        <form method="post" class="form-row" enctype="multipart/form-data">
            <div class="col-md-8">
                <div class="form-group">
                    <input type="text" name="baslik" class="form-control" value="<?php echo $satir_duzenle['baslik']; ?>">
                </div>
                <div class="form-group">
                    <textarea name="icerik" rows="7" class="form-control"><?php echo $satir_duzenle['icerik']; ?></textarea>
                    <script>
                        CKEDITOR.replace('icerik');
                    </script>
                </div>
                <div class="form-group">
                    <input type="text" name="meta" class="form-control" value="<?php echo $satir_duzenle['meta']; ?>">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <img src="<?php echo $satir_duzenle['foto']; ?>" class="img-fluid">
                    <input type="file" name="foto" class="mt-2">
                </div>
                <div class="form-group">
                    <input type="text" name="fotoalt" class="form-control" value="<?php echo $satir_duzenle['fotoalt']; ?>">
                </div>
                <div class="form-group">
                    <label><small>Kategori - <?php echo $satir_duzenle['kategori']; ?></small></label>
                    <select name="kategori" class="form-control">
                        <option value="<?php echo $satir_duzenle['kategori']; ?>"><?php echo $satir_duzenle['kategori']; ?></option>
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
                    <input type="date" name="tarih" class="form-control" value="<?php echo $satir_duzenle['tarih']; ?>">
                </div>
                <div class="form-group">
                    <label><small>Yayın Durumu - <?php echo $satir_duzenle['durum']; ?></small></label>
                    <select name="durum" class="form-control">
                        <option value="<?php echo $satir_duzenle['durum']; ?>"><?php echo $satir_duzenle['durum']; ?></option>
                        <option value="Taslak">Taslak</option>
                        <option value="Yayınlandı">Yayınlandı</option>
                    </select>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-success w-100">Kaydet</button>
                </div>

                <?php

                if ($_POST) {
                    $baslik = $_POST['baslik'];
                    $icerik = $_POST['icerik'];
                    $meta = $_POST['meta'];
                    $dizin= "../img/";
                    $yuklenecekfoto = $dizin.$_FILES['foto']['name'];
                    $fotoalt = $_POST['fotoalt'];
                    $kategori = $_POST['kategori'];
                    $tarih = $_POST['tarih'];
                    $durum = $_POST['durum'];

                    if(move_uploaded_file($_FILES['foto']['tmp_name'],$yuklenecekfoto)){
                        $sorgu_guncelle = $db -> prepare('update yazilar set baslik=?, icerik=?, meta=?, foto=?, fotoalt=?, kategori=?, tarih=?, durum=? where id=?');
                        $sorgu_guncelle -> execute(array($baslik,$icerik,$meta,$yuklenecekfoto,$fotoalt,$kategori,$tarih,$durum,$id));

                        if($sorgu_guncelle -> rowCount()){
                            echo '<div class="alert alert-success">Kayıt Güncellendi</div><meta http-equiv="refresh" content="2; url=yazilar.php">';
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

