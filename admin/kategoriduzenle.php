<?php require_once('header.php'); ?>

<?php
$id = $_GET['id'];
$sorgu_duzenle = $db->prepare('select * from kategoriler where id=?');
$sorgu_duzenle->execute(array($id));
$satir_duzenle = $sorgu_duzenle->fetch();
?>

<!-- Kategoriler Section Start -->
<section id="adminKategori" class="py-3">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <h3>Kategori Ekle</h3>
                <form method="post">
                    <div class="form-group">
                        <input type="text" name="kategori" class="form-control" value="<?php echo $satir_duzenle['kategori']; ?>">
                    </div>
                    <div class="form-group">
                        <label>Kategori Türü</label>
                        <select name="katturu" class="form-control">
                            <option value="<?php echo $satir_duzenle['katturu']; ?>"><?php echo $satir_duzenle['katturu']; ?></option>
                            <option value="Ana Kategori">Ana Kategori</option>
                            <option value="Alt Kategori">Alt Kategori</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Üst Kategorisi</label>
                        <select name="ustkat" class="form-control">
                            <option value="<?php echo $satir_duzenle['ustkat']; ?>"><?php echo $satir_duzenle['ustkat']; ?></option>
                            <option value="-">-</option>
                            <?php
                            $sorgu_kategori = $db->prepare('select * from kategoriler where katturu = "Ana Kategori"');
                            $sorgu_kategori->execute();

                            if ($sorgu_kategori->rowCount()) {
                                foreach ($sorgu_kategori as $satir_kategori) {
                            ?>
                                    <option value="<?php echo $satir_kategori['kategori']; ?>"><?php echo $satir_kategori['kategori']; ?></option>
                            <?php
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <textarea name="meta" rows="3" class="form-control"><?php echo $satir_duzenle['meta']; ?></textarea>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-success w-100">Kaydet</button>
                    </div>
                </form>

                <?php
                if ($_POST) {
                    $kategori = $_POST['kategori'];
                    $katturu = $_POST['katturu'];
                    $ustkat = $_POST['ustkat'];
                    $meta = $_POST['meta'];

                    $sorgu_guncel = $db->prepare('update kategoriler set kategori=?,katturu=?,ustkat=?,meta=? where id=?');
                    $sorgu_guncel->execute(array($kategori, $katturu, $ustkat, $meta, $id));

                    if ($sorgu_guncel->rowCount()) {
                        echo '<div class="alert alert-success">Kayıt Güncellendi</div>';
                    } else {
                        echo '<div class="alert alert-danger">Hata Oluştu</div>';
                    }
                }
                ?>

            </div>
            <div class="col-md-9">
                <h3>Kategori Listesi</h3>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Kategori</th>
                            <th>Türü</th>
                            <th>Üst Kategorisi</th>
                            <th>Düzenle</th>
                            <th>Sil</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                        $sorgu_katlist = $db->prepare('select * from kategoriler order by kategori desc');
                        $sorgu_katlist->execute();

                        if ($sorgu_katlist->rowCount()) {
                            foreach ($sorgu_katlist as $satir_katlist) {
                        ?>
                                <tr>
                                    <td><?php echo $satir_katlist['id']; ?></td>
                                    <td><?php echo $satir_katlist['kategori']; ?></td>
                                    <td><?php echo $satir_katlist['katturu']; ?></td>
                                    <td><?php echo $satir_katlist['ustkat']; ?></td>
                                    <td><a href="kategoriduzenle.php?id=<?php echo $satir_katlist['id']; ?>"><button class="btn btn-warning">Düzenle</button></a></td>
                                    <td><a href="kategorisil.php?id=<?php echo $satir_katlist['id']; ?>"><button class="btn btn-danger">Sil</button></a></td>
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
<!-- Kategoriler Section End -->



<?php require_once('footer.php'); ?>