<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
<form method="post" enctype="multipart/form-data">

<input type="file" name="foto">
<input type="text" name="baslik" placeholder="Foto Başlık">
<button type="submit">Kaydet</button>

</form>

<?php
 
 //Dosya İsmini Yakalama

if($_POST){
    $foto = $_FILES['foto']['name'];
echo $foto;

echo '<br><br><br><br>';

//GEÇİCİ DOSYA İSMİNİ YAKALAMA

$foto_tmp = $_FILES['foto']['tmp_name'];
echo $foto_tmp;
echo '<br><br><br><br>';

//DOSYA BOYUTU YAKALAMA

$foto_size = $_FILES['foto']['size'];
echo $foto_size;

if(103991 <= $foto_size){
    echo 'Uygun';
}else{
    echo 'Uygun Değil';
}

echo '<br><br><br><br>';

//DOSYA TÜRÜNÜ YAKALAMA

$foto_tur = $_FILES['foto']['type'];
echo $foto_tur;


// DOSYAYI KÖK DİZİNE GÖNDERME

$dizin = '../img/';
$yuklenecekfoto = $dizin.$_FILES['foto']['name'];

/* $yuklenecekfoto = '../img/'.$_FILES['foto']['name']; 

Bu şekilde de yazılabilir kısa yazım şeklidir */

if(move_uploaded_file($_FILES['foto']['tmp_name'],$yuklenecekfoto)){
    echo '<img src = "'.$yuklenecekfoto.'">';
}else{
    echo 'Böyle bir foto yok';
}





}


?>



</body>
</html>






