<?php 
	$baglanti = mysqli_connect("","","","") or die ("Baglanti hatali!");
	mysqli_query($baglanti,"SET NAMES 'UTF8'");
	mysqli_query($baglanti,"SET character_set_connection = 'UTF8'");
	mysqli_query($baglanti,"SET character_set_client = 'UTF8'");
	mysqli_query($baglanti,"SET character_set_results = 'UTF8'");
    $sorgu = mysqli_query($baglanti,"select * from TBL_Ayarlar");
	$veri = mysqli_fetch_assoc($sorgu);
	
	


?>