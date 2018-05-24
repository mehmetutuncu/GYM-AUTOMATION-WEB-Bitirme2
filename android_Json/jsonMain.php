<?php
include "../config.php";
if(isset($_POST['tarifeGetir'])){
  $dizi = array();
  $uye_id = $_POST['tarifeGetir'];
  $tarife_getir_sorgu = mysqli_query($baglanti,"select tut.id as id,tut.tarife_id as tarife_id ,tt.tarife_adi as tarife_adi from TBL_Uye_Tarifeler as tut ,TBL_Tarifeler as tt  where uye_id = '$uye_id' and tut.tarife_id = tt.id");
  $satir = mysqli_num_rows($tarife_getir_sorgu);
  if($satir > 0){
    while($sonuc = mysqli_fetch_array($tarife_getir_sorgu)){
      $dizi[] = array("id"=>$sonuc['id'],"tarife_id"=>$sonuc['tarife_id'],"tarife_adi"=>$sonuc['tarife_adi']);
    }
    echo json_encode($dizi);
  }
}
if(isset($_POST['salondaki_aktif_uye'])){
  $sorgu = mysqli_query($baglanti,"select count(id) as salondaki_aktif_uye FROM TBL_Salondakiler where bilgi = 1");
  $satir = mysqli_num_rows($sorgu);
  $aktif_uye;
  if($satir >0){
    $sonuc = mysqli_fetch_array($sorgu);
    $aktif_uye = $sonuc['salondaki_aktif_uye'];

  }

  $json_sonuc = array("salondaki_aktif_uye"=>$aktif_uye);
  echo json_encode($json_sonuc);
}
?>
