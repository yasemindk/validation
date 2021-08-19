<?php
  session_start();
  session_unset();
  session_destroy();

  header("location: ../edevlet/admin.php");
  exit();
