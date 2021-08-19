<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
  <link href="main.css" rel="stylesheet" type="text/css"/>
    <title>ADMİN GİRİŞİ</title>
  </head>
  <body>
    <section class="admin-form">
          <h2>ADMİN GİRİŞİ</h2>
          <a href="close.php" class="back-icon">
          <img src="back.png"/>
          </a>
          <form action="#" method="post">
                <input type="text" name="ad" placeholder="Adınız:">
                <input type="password" name="sifre" placeholder="Admin Şifresi:">

<hr>
                  <button type="submit" name="submit">Gönder</button>

          </form>
        </section>

        <?php
        if (isset($_POST["submit"])) {
          $ad = $_POST["ad"];
          $sifre = $_POST["sifre"];
         $conn = mysqli_connect("localhost", "root", "","edevlet");
         if (!$conn) {
             echo "database connected" . mysqli_connect_error();
         }
           $sql = mysqli_query($conn, "SELECT * FROM admin WHERE ad = '{$ad}' AND sifre = '{$sifre}'");
        if (!empty($ad) && !empty($sifre)) {

          if (mysqli_num_rows($sql) <= 0) {
            echo "Adınız veya parolanız yanlış!";
          }
        }else {
          echo "Bütün boşlukları doldurun..";
        }
        if (mysqli_num_rows($sql) > 0) {
          header("location: ../edevlet/login.php");
        }
      }
        ?>



  </body>
</html>
