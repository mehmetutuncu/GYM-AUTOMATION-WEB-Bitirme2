<?php
	include "../config.php";
	$sorgu = mysqli_query($baglanti,"select id,baslangic_tarihi ,bitis_tarihi,kalan_gun from TBL_Uye_Tarifeler");
	$i = 0;
	$bas_ay = "";
	$bas_gun = "";
	$bas_yil = "";
	$bit_ay = "";
	$bit_gun = "";
	$bit_yil = "";
	$top_gun = 0;
	$top_ay = 0;
	$top_yil = 0;
	$kalan_uyelik = 0;
	$id;
	$durum;
	$now =  date('d-m-Y');
	
	while($sonuc = mysqli_fetch_assoc($sorgu)){
		$baslangic = explode ("-",$now);
		$bitis = explode (".",$sonuc['bitis_tarihi']);
		$id = $sonuc['id'];
		$bas_gun = $baslangic[0];
		$bit_gun = $bitis[0];
		$bas_ay = $baslangic[1];
		$bit_ay = $bitis[1];
		$bas_yil = $baslangic[2];
		$bit_yil = $bitis[2];
		$kalan_uyelik = $sonuc['kalan_gun'];
		echo "bas gun = ".$bas_gun;
		echo "<br>";
		echo "bit gun = ".$bit_gun;
		echo "<br>";
		echo "bas ay = ".$bas_ay;
		echo "<br>";
		echo "bit ay = ".$bit_ay;
		echo "<br>";
		echo "bas yil = ".$bas_yil;
		echo "<br>";
		echo "bit yil = ".$bit_yil;
		echo "<br>";
		if($kalan_uyelik == 0){
			$durum = 0;
			$sorgu2 = mysqli_query($baglanti,"UPDATE TBL_Uye_Tarifeler set kalan_gun = '$kalan_uyelik' , uyelik_durumu = '$durum' where id = '$id' and donma = 0");
		}
		else{
			
			if($bas_gun == $bit_gun){
				$top_gun = 0;
				//günlerin eşit olma ihtimali için ay hesabı yapıldı.
				if($bas_ay == $bit_ay){
					$top_ay = 0;
				}
				else if($bas_ay > $bit_ay){
					$top_ay = (12-$bas_ay)+$bit_ay;
					$bit_yil=$bit_yil-1;
					
				}
				else if($bas_ay < $bit_ay){
					$top_ay = $bit_ay - $bas_ay;
				}
				if($bas_yil == $bit_yil){
					$top_yil = 0;
				}
				else if($bas_yil>$bit_yil){
					$top_yil = 0;
					$top_ay = 0;
					$top_gun = 0;
				}
				else if($bas_yil<$bit_yil){
					$top_yil = $bit_yil-$bas_yil;
					
				}
					$kalan_uyelik = ($top_gun) + ($top_ay*30)+($top_yil*365);
					if($kalan_uyelik < 0){
						$kalan_uyelik = 0;
					}
					else{
						$sorgu2 = mysqli_query($baglanti, "UPDATE TBL_Uye_Tarifeler set kalan_gun = '$kalan_uyelik' where id = '$id'and donma = 0");
					}
			}
			else if($bas_gun>$bit_gun){
				$top_gun = (30-$bas_gun)+$bit_gun;
				if($bas_ay == $bit_ay){
					$top_ay = 0;
				}
				else if($bas_ay > $bit_ay){
					$top_ay = (12-$bas_ay)+$bit_ay;
					$bit_yil=$bit_yil-1;
					
				}
				else if($bas_ay < $bit_ay){
					$top_ay = $bit_ay - $bas_ay;
				}
				if($bas_yil == $bit_yil){
					$top_yil = 0;
				}
				else if($bas_yil>$bit_yil){
					$top_yil = 0;
					$top_ay = 0;
					$top_gun = 0;
				}
				else if($bas_yil<$bit_yil){
					$top_yil = $bit_yil-$bas_yil;
					
				}
					$kalan_uyelik = ($top_gun) + ($top_ay*30)+($top_yil*365);
					if($kalan_uyelik < 0){
						$kalan_uyelik = 0;
						
					}
					else{
						$sorgu2 = mysqli_query($baglanti, "UPDATE TBL_Uye_Tarifeler set kalan_gun = '$kalan_uyelik' where id = '$id'and donma = 0");
					}
			}
			else if($bas_gun<$bit_gun){
				$top_gun = $bit_gun-$bas_gun;
				if($bas_ay == $bit_ay){
					$top_ay = 0;
				}
				else if($bas_ay > $bit_ay){
					$top_ay = (12-$bas_ay)+$bit_ay;
					$bit_yil=$bit_yil-1;
					
				}
				else if($bas_ay < $bit_ay){
					$top_ay = $bit_ay - $bas_ay;
				}
				if($bas_yil == $bit_yil){
					$top_yil = 0;
				}
				else if($bas_yil>$bit_yil){
					$top_yil = 0;
					$top_ay = 0;
					$top_gun = 0;
				}
				else if($bas_yil<$bit_yil){
					$top_yil = $bit_yil-$bas_yil;
					
				}
					$kalan_uyelik = ($top_gun) + ($top_ay*30)+($top_yil*365);
					if($kalan_uyelik < 0){
						$kalan_uyelik = 0;
					}
					else{
						$sorgu2 = mysqli_query($baglanti, "UPDATE TBL_Uye_Tarifeler set kalan_gun = '$kalan_uyelik' where id = '$id'and donma = 0");
					}
			}
			
			
			
		}
		
		
		}
		
		
	
	
 ?>