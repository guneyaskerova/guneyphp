<?php 
require_once('header.php'); 

$id = $_GET['id'];
$sorgu_sayfasil = $db -> prepare('delete from sayfalar where id=?');
$sorgu_sayfasil -> execute(array($id)); 

// Üstteki 3 satır yerine bu yapı da kullanılabilir
// $sorgu_sayfasil = $db -> prepare('delete from sayfalar where id=?');
// $sorgu_sayfasil -> execute(array($_GET['id']));

if($sorgu_sayfasil -> rowCount()){
    echo '<div class = "alert alert-success">Sayfa Silindi</div><meta http-equiv="refresh" content="2; url=sayfalar.php">';
}else{
    echo '<div class = "alert alert-success">Hata Oluştu</div>';
}



?>





<?php require_once('footer.php'); ?>