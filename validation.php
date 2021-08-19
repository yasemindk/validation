<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link href="main.css" rel="stylesheet" type="text/css"/>
    <title></title>
  </head>
  <body>
    <section class="validation-form">
          <h2>Kullanıcılar İçin Validation</h2>
          <div class="validation-form-form">
      
              <a href="close.php" class="back-icon">
              <img src="back.png"/>
              </a>

          <form action="#" method="post">
            <input type="text" name="ad" placeholder="Adınız:">
            <input type="text" name="soyad" placeholder="Soyadınız:">
            <input type="text" name="tcno" placeholder="TC Kimlik Numarası:">
            <input type="text" name="dogumyili" placeholder="Doğum yılınız:">
            <hr>
            <button type="submit" name="submit">Gönder</button>

          </form>
          </div>
        </section>

      <?php
        if (isset($_POST["submit"])) {
          $tcno = $_POST["tcno"];
          $ad = $_POST["ad"];
          $soyad = $_POST["soyad"];
          $dogumyili = $_POST["dogumyili"];


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
              echo "Tebrikler hayattasınız.";
            }else {
              echo "Bilgileriniz doğrulanamadı. Lütfen kontrol ediniz.";
            }
          } catch (\Exception $e) {
            echo $e ->getMessage();
          }

      }
   ?>


  </body>
</html>
