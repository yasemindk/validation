<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
  <link href="main.css" rel="stylesheet" type="text/css"/>
    <title>Kullanıcı ekle/sil</title>
  </head>
  <body>
    <section class="validation-form">
          <div class="validation-form-form">
            <a href="logout.php" class="back-icon">
            <img src="back.png" />
            </a>
          <form action="#" method="post">
            <input type="text" name="ad" placeholder="Ad:">
            <input type="text" name="soyad" placeholder="Soyad:">
            <input type="text" name="tcno" placeholder="TC Kimlik Numarası:">
            <input type="text" name="dogumyili" placeholder="Doğum yılı:">
            <hr>
  <p>Kullanıcı ekle/sil:</p>
<div class="radio">
<input type="radio" name="eklesil" <?php if (isset($eklesil) && $eklesil=="ekle") echo "checked";?> value="ekle">Ekle
</div>
<div class="radio">
<input type="radio" name="eklesil" <?php if (isset($eklesil) && $eklesil=="sil") echo "checked";?> value="sil">Sil
</div>
<hr>
            <button type="submit" name="submit">Gönder</button>
          </form>
          </div>
        </section>

<?php
if (isset($_POST["submit"])) {
  $ad = $_POST["ad"];
  $soyad = $_POST["soyad"];
  $tcno = $_POST["tcno"];
  $dogumyili = $_POST["dogumyili"];
  $eklesil = $_POST["eklesil"];
 $conn = mysqli_connect("localhost", "root", "","edevlet");
 if (!$conn) {
     echo "database connected" . mysqli_connect_error();
 }
 if ($eklesil == "ekle") {
   $client=new SoapClient("https://tckimlik.nvi.gov.tr/Service/KPSPublic.asmx?WSDL");
   $postdata = array(
     "TCKimlikNo" => $tcno,
     "Ad" =>$ad,
     "Soyad" => $soyad,
     "DogumYili"=>$dogumyili
   );
   $sonuc = $client->TCKimlikNoDogrula($postdata);
   try {
     if ($sonuc -> TCKimlikNoDogrulaResult) {
       echo "Kullanıcı ekleniyor...";
       $ekle = "INSERT INTO validation (ad,soyad,tcno,dogumyili) VALUES ('$ad','$soyad','$tcno','$dogumyili')";
       if ($conn ->query($ekle)){
         echo "Kayıt başarılı bir şekilde yapıldı.";
       }else {
         echo "Kayıt yapılamadı.Bağlantınızı kontrol edin.";
       }
     }else {
       echo "Bilgileriniz doğrulanamadı. Lütfen kontrol ediniz.";
     }
   } catch (\Exception $e) {
     echo $e ->getMessage();
   }
 }elseif ($eklesil == "sil") {
   $bul = "SELECT * FROM validation WHERE ad = '$ad' AND soyad = '$soyad' AND tcno = '$tcno' AND dogumyili = '$dogumyili'";
   $kullanıcı = $conn ->query($bul);
   if ($kullanıcı->num_rows>0) {
     echo "Kullanıcı bulundu..";
     $sil= "DELETE FROM validation where tcno = '$tcno'";
     if (mysqli_query($conn,$sil)) {
       echo "Kullanıcı silindi..";
     }else {
       echo "Silme başarısız. Bağlantınızı kontrol ediniz.";
     }
   }else {
     echo "Kullanıcı bulunamadı. Lütfen bilgilerin doğruluğundan emin olun.";
   }
 }
}
?>
  </body>
</html>
