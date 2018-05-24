<?php
include "../config.php";
if(isset($_POST['kulAdi'])){
  $kulAdi = $_POST['kulAdi'];
  $sifre = $_POST['sifre'];
  $id;
  $sorgu = mysqli_query($baglanti,"select id from TBL_Uyeler where kul_adi = '$kulAdi' and sifre ='$sifre'");
  $satir = mysqli_num_rows($sorgu);

  if($satir>0){
    $sonuc = mysqli_fetch_array($sorgu);
    $id = $sonuc['id'];

  }
  else{
    $id = 0;
  }
  $json_sonuc = array("id"=>$id);
  echo json_encode($json_sonuc);
}
?>
