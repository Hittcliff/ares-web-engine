<?php session_start();
include '../data/db.php';

if($_SESSION["permisions"] == 2 or $_SESSION["permisions"] == 1){


if(isset($_GET['id'])){
  $link = mysqli_connect($db_addr, $db_user, $db_pass, $db_name);
  $folder_path = 'template/screenshot/' . $_GET['id'];
  if (is_dir($folder_path)) {
      $files = glob($folder_path . '/*');
      foreach ($files as $file) {
          unlink($file);
      }
      rmdir($folder_path);
  }
  mysqli_query($link, 'DELETE FROM releases WHERE id = "'.$_GET['id'].'" LIMIT 1');

  header("Location: ".$_SERVER['HTTP_REFERER']);
}
}?>
