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
        <input type="text" name="baslik" placeholder="Foto İsmi">
        <button type="submit">Kaydet</button>
    </form>

    <?php

    if ($_POST) {
        // Dosya İsmini Yakalama
        $foto = $_FILES['foto']['name'];
        echo $foto;
        echo '<br><br><br><br>';

        // Geçici Dosta İsmini Yakalama
        // $foto_tmp = $_FILES['foto']['tmp_name'];
        // echo $foto_tmp;
        echo '<br><br><br><br>';

        // Dosya Boyutu Yakalama
        $foto_size = $_FILES['foto']['size'];
        echo $foto_size;

        if (18650 <= $foto_size) {
            echo 'Uygun';
        } else {
            echo 'Uygun Değil';
        }

        echo '<br><br><br><br>';

        //Dosya türünü yakalama
        $foto_tur = $_FILES['foto']['type'];
        echo $foto_tur;


        // Dosyayı Kök Dizine Gönderme
        $dizin = "../img/";
        $yuklenecekfoto =$dizin.$_FILES['foto']['name'];

        // $yuklenecekfoto = "../img/".$_FILES['foto']['name']; Bu şekilde de yazılabilir

        if(move_uploaded_file($_FILES['foto']['tmp_name'],$yuklenecekfoto)){
            echo '<img src="'.$yuklenecekfoto.'">';
        } else{
            echo 'Böyle Bir Foto Yok';
        }


    }

    ?>

</body>

</html>