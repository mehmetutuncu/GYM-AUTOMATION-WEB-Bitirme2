<?php
include "../config.php";
  if(isset($_POST['tarife_id'])){
    $tarife_id = $_POST['tarife_id'];
    $uye_id = $_POST['uye_id'];
    $sorgu = mysqli_query($baglanti,"SELECT  tk.kategori_adi as kategori_adi,tkh.hareket_adi as hareket_adi ,upl.h_set as h_set ,upl.h_tekrar as h_tekrar,tkh.link as link FROM tbl_uye_program_listesi as upl , tbl_kategoriler as tk , tbl_kategori_hareketler as tkh  where upl.uye_id = '$uye_id' and tk.tarife_id = '$tarife_id' and tk.id = tkh.kategori_id and upl.kategori_hareket_id = tkh.id ");
		$dizi = array();
		while($sonuc = mysqli_fetch_array($sorgu)){
			$dizi[] = $sonuc;
		}
		echo json_encode($dizi);
  }
?>
