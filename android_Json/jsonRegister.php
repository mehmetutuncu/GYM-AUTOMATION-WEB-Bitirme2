<?php
include "../config.php";
if(isset($_POST['tcNoDogrulama'])){
  $tcno = $_POST['tcNoDogrulama'];

  $id;
  $kul_adi = "null";

  $sorgu = mysqli_query($baglanti,"select id ,kul_adi from TBL_Uyeler where tcno = '$tcno' ");
  $satir = mysqli_num_rows($sorgu);

  if($satir>0){
    $sonuc = mysqli_fetch_array($sorgu);
    $id = $sonuc['id'];
    $kul_adi = $sonuc['kul_adi'];

  }
  else{
    $id = 0;
  }
  $json_sonuc = array("id"=>$id,"kul_adi"=>$kul_adi);
  echo json_encode($json_sonuc);
}
if(isset($_POST['kayitId'])){
  $id = $_POST['kayitId'];
  $kul_adi = $_POST['kayitKulAdi'];
  $sifre = $_POST['kayitSifre'];
  $kontrol_sorgu = mysqli_query($baglanti,"select * from TBL_Uyeler where kul_adi = '$kul_adi'");
  $satir = mysqli_num_rows($kontrol_sorgu);
  if($satir > 0){
    $sonuc = "2";
  }
  else{
    $sorgu = mysqli_query($baglanti,"update TBL_Uyeler set kul_adi = '$kul_adi',sifre='$sifre' where id = '$id'");
      if($sorgu > 0){
        $sonuc = 1;
      }else{
        $sonuc = 0;
      }
  }

  $json_sonuc = array("durum"=>$sonuc);
  echo json_encode($json_sonuc);
}
?>
