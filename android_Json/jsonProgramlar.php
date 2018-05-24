<?php
include "../config.php";
if(isset($_POST['programGetir'])){
    $tarife_id = $_POST['programGetir'];
    $uye_id = $_POST['uye_id'];
    $dizi = array();
    $sorgu = mysqli_query($baglanti,"SELECT tk.kategori_adi , tkh.hareket_adi , upl.h_set,upl.h_tekrar,tkh.link FROM TBL_Uye_Program_Listesi as upl , TBL_Kategoriler as tk , TBL_Kategori_Hareketler as tkh  where upl.uye_id = '$uye_id' and tk.tarife_id = '$tarife_id' and tk.id = tkh.kategori_id and upl.kategori_hareket_id = tkh.id ");
    $satir = mysqli_num_rows($sorgu);
    if($satir > 0){
      while($sonuc = mysqli_fetch_array($sorgu)){
        $dizi[] = array("kategori_adi"=>$sonuc['kategori_adi'],"hareket_adi"=>$sonuc['hareket_adi'],"h_set"=>$sonuc['h_set'],"h_tekrar"=>$sonuc['h_tekrar'],"link"=>$sonuc['link']);
      }
      echo json_encode($dizi);
    }
}
if(isset($_POST['tarifeDondur'])){
  $tarife_id = $_POST['tarifeDondur'];
  $uye_id = $_POST['uye_id'];
  $donma = $_POST['donma'];
  $sorgu = mysqli_query($baglanti,"update TBL_Tarifeler set donma = '$donma' where uye_id = '$uye_id' and tarife_id = '$tarife_id'");
  if($sorgu > 0){
    if($donma == 0){
      $durum = 1;
    }
    else{
      $durum = 0;
    }
  }

  $json_sonuc = array("durum"=>$durum);
  echo json_encode($json_sonuc);
}
?>
