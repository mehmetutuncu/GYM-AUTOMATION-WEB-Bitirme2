<?php
	include "config.php";
	header('Content-Type: text/html; charset=utf-8');
	session_start();
	// Uye doğrulama kısmı
	if(isset($_POST['tcno_dogrulama'])){
		$tcno = $_POST['tcno_dogrulama'];
		$sorgu = mysqli_query($baglanti,"select * from TBL_Uyeler where tcno = '$tcno'");
		$satir = mysqli_num_rows($sorgu);
		if($satir > 0){
			echo "1";
		}
		else{
			echo "2";
		}
	}
	// Tc İle Uyelik Alınmıs mı Kontrol
	if(isset($_POST['tcno_uyelik_kontrol'])){
		$tcno = $_POST['tcno_uyelik_kontrol'];
		$sorgu = mysqli_query($baglanti,"select * from TBL_Uyeler where tcno = '$tcno'");
		$sonuc = mysqli_fetch_assoc($sorgu);
		if($sonuc['kul_adi'] != null || $sonuc['sifre'] != null){
			echo "2";
		}
		else{
			echo "1";
		}
	}
	// Kullanıcı Kayıt için gerekli Kontrol
	if(isset($_POST['kulKayitAdi'])){
		$kulAdi = $_POST['kulKayitAdi'];
		$sifre = $_POST['sifre'];
		$tcno = $_POST['tcno'];
		$sorgu1 = mysqli_query($baglanti,"SELECT * FROM TBL_Uyeler where kul_adi = '$kulAdi'");
		$sorgu1_satir = mysqli_num_rows($sorgu1);
		if($sorgu1_satir > 0){
			echo "kullanici_mevcut";
		}
		else{
			$sorgu2 = mysqli_query($baglanti,"update TBL_Uyeler set kul_adi = '$kulAdi',sifre = '$sifre' where tcno = '$tcno'");

			if($sorgu2){
				echo "1";
			}
			else{
				echo "2";
			}
		}
	}
	// Kullanıcı girişi için gerekli kontrol
	if(isset($_POST["kulAdi"])){
		$kul_adi = $_POST["kulAdi"];
		$sifre = $_POST["sifre"];
		$sorgu = mysqli_query($baglanti,"select * from TBL_Uyeler where kul_adi = '$kul_adi' and sifre = '$sifre'");
		$satir = mysqli_num_rows($sorgu);
		if($satir > 0){
			echo "1";
		}
		else{
			echo "2";
		}
	}
	// Giriş yapan kişinin yetkisi hakkında tutulan session
	if(isset($_POST["Session"])){
		$durum = $_POST['Session'];
		if($durum == "uyeGirisiYapildi" || $durum == "adminGirisiYapildi"){
			$_SESSION["girisBilgisi"] = $_POST["Session"];
		}
		else{
			$_SESSION["kullanici"] = $_POST["Session"];
		}

	}
	// Admin girişi için gerekli kontrol
	if(isset($_POST["adminAdi"])){
		$admin_adi = $_POST["adminAdi"];
		$sifre = $_POST["sifre"];
		$sorgu = mysqli_query($baglanti,"select * from TBL_Adminler where admin_adi = '$admin_adi' and sifre = '$sifre'");
		$sonuc = mysqli_fetch_assoc($sorgu);
		if($sonuc > 0){
			echo "1";
		}
		else{
			echo "2";
		}
	}

	// Kart sorgulama
	if(isset($_POST['kartno'])){
		$kartno = $_POST['kartno'];
		$tarih = $_POST['tarih'];
		$sorgu = mysqli_query($baglanti,"select * from TBL_Kartlar where kart_no = '$kartno' ");
		$satir = mysqli_num_rows($sorgu);
		if($satir > 0){
			$sonuc = mysqli_fetch_assoc($sorgu);
			$durum = $sonuc['durum'];
			$kart_id = $sonuc['id'];
			if($durum == 1){
					$sorgu2 = mysqli_query($baglanti,"select bilgi from TBL_Salondakiler where kart_id = '$kart_id'");
					$satir2 = mysqli_num_rows($sorgu2);
					if($satir2 > 0){
						$sonuc2 = mysqli_fetch_assoc($sorgu2);
						$bilgi = $sonuc2['bilgi'];
						if($bilgi == "1"){
							$sorgu3 = mysqli_query($baglanti,"update TBL_Salondakiler set bilgi = '0' where kart_id = '$kart_id' ");
							echo "sifir"; // Hoşçakalın = 0
						}
						else{
							$sorgu4 = mysqli_query($baglanti,"update TBL_Salondakiler set bilgi = '1',tarih = '$tarih' where kart_id = '$kart_id' ");
							echo "bir"; // Hoşgeldiniz = 1
						}
					}
					else{
						$sorgu6 = mysqli_query($baglanti,"insert into TBL_Salondakiler(kart_id,bilgi,tarih) VALUES('$kart_id',1,'$tarih')");
						echo "bir"; // Hoşgeldiniz = 1
					}
			}
			else{
				echo "iki";// Tarifeniz sona ermiş = 2
			}
		}
		else{
			echo "uc"; // Böyle bir kayıt mevcut değil = 3
		}











	}
	if(isset($_POST['tarife_adi'])){
		$tarife_adi = $_POST['tarife_adi'];
		$bir = $_POST['bir_aylik_ucret'];
		$uc = $_POST['uc_aylik_ucret'];
		$alti = $_POST['alti_aylik_ucret'];
		$yillik = $_POST['yillik_ucret'];
		$sorgu = mysqli_query($baglanti,"insert into TBL_Tarifeler(tarife_adi,bir_aylik,uc_aylik,alti_aylik,yillik) VALUES('$tarife_adi','$bir','$uc','$alti','$yillik')");
		if($sorgu > 0){
			echo "1";
		}
		else{
			echo "2";
		}
	}
	if(isset($_POST["tarife_duzenle_id"])){
		$id = $_POST["tarife_duzenle_id"];
		$sorgu = mysqli_query($baglanti,"select * from TBL_Tarifeler where id = $id");
		$sonuc = mysqli_fetch_assoc($sorgu);
		echo json_encode($sonuc);
	}
	if(isset($_POST["tarife_update_id"])){
		$id = $_POST["tarife_update_id"];
		$tarife_adi = $_POST['tarife_adi_update'];
		$bir = $_POST['bir_aylik'];
		$uc = $_POST['uc_aylik'];
		$alti = $_POST['alti_aylik'];
		$yillik = $_POST['yillik'];
		$sorgu = mysqli_query($baglanti,"update TBL_Tarifeler set tarife_adi ='$tarife_adi',bir_aylik='$bir',uc_aylik = '$uc',alti_aylik ='$alti',yillik = '$yillik' where id = '$id'");
		if($sorgu >0){
			echo "1";
		}
		else{
			echo "2";
		}
	}
	if(isset($_POST["tarife_sil_id"])){
		$id = $_POST["tarife_sil_id"];
		$sorgu = mysqli_query($baglanti,"delete  from TBL_Tarifeler where id = '$id'");
		if($sorgu > 0){
			echo "1";
		}
		else {
			echo "2";
		}
	}
	if(isset($_POST["ad"])){
		$ad = $_POST["ad"];
		$soyad = $_POST["soyad"];
		$tcno = $_POST["tcno"];
		$cepno = $_POST["cepno"];
		$adres = $_POST["adres"];
		$eposta = $_POST["eposta"];
		$cinsiyet = $_POST["cinsiyet"];
		$kart = $_POST["kart"];


		$sorgu = mysqli_query($baglanti,"insert into TBL_Uyeler(ad,soyad,tcno,cepno,adres,eposta,cinsiyet) values('$ad','$soyad','$tcno','$cepno','$adres','$eposta','$cinsiyet')");
		if($sorgu > 0){
			$uye_getir = mysqli_query($baglanti,"select id from TBL_Uyeler where tcno = '$tcno'");
			$sonuc = mysqli_fetch_array($uye_getir);
			$kart_sorgu = mysqli_query($baglanti,"insert into TBL_Kartlar(kart_no,uye_id) values('$kart','$sonuc[id]')");
			echo "1";
		}
		else {
			echo "2";
		}
	}
	if(isset($_POST['fiyat_tarife_id'])){
		$tarife_id = $_POST['fiyat_tarife_id'];
		$sorgu = mysqli_query($baglanti,"select * from TBL_Tarifeler where id = '$tarife_id'");
		$sonuc = mysqli_fetch_assoc($sorgu);
		echo json_encode($sonuc);


	}
	if(isset($_POST['uyeler_tarife_id'])){
		$tarife_id = $_POST['uyeler_tarife_id'];
		$uye_id = $_POST['uye_id'];
		$ucret = $_POST['ucret'];
		$baslangic_tarihi = $_POST['baslangic_tarihi'];
		$bitis_tarihi = $_POST['bitis_tarihi'];
		$kalan_gun = $_POST['kalan_gun'];
		$sorgu = mysqli_query($baglanti,"insert into TBL_Uye_Tarifeler(tarife_id,uye_id,ucret,tahsil_durumu,baslangic_tarihi,bitis_tarihi,kalan_gun,uyelik_durumu) VALUES('$tarife_id','$uye_id','$ucret',0,'$baslangic_tarihi','$bitis_tarihi','$kalan_gun',1)");
		if($sorgu >0 ){
			$sorgu2 = mysqli_query($baglanti,"update TBL_Kartlar set durum = 1 where uye_id = '$uye_id'");
			echo "1";
		}
		else{
			echo "2";
		}

	}
	if(isset($_POST['tarife_getir_id'])){
		$uye_id = $_POST['tarife_getir_id'];
		$sorgu = mysqli_query($baglanti,"select tut.program,tut.uye_id,tut.donma, tut.id as id,tut.tarife_id,tt.tarife_adi as tarife_adi,tut.ucret as ucret ,tut.baslangic_tarihi as baslangic_tarihi, tut.bitis_tarihi as bitis_tarihi,tut.kalan_gun as kalan_gun,tut.uyelik_durumu as uyelik_durumu ,tut.tahsil_durumu as tahsil_durumu from TBL_Uye_Tarifeler as tut , TBL_Tarifeler as tt where uye_id = $uye_id and tut.tarife_id = tt.id");
		$dizi = array();
		while($sonuc = mysqli_fetch_array($sorgu)){
			$dizi[] = $sonuc;
		}
		echo json_encode($dizi);
	}
	if(isset($_POST['olmayan_tarife'])){
		$uye_id = $_POST['olmayan_tarife'];
		$sorgu = mysqli_query($baglanti,"select tt.id as id ,tt.tarife_adi as tarife_adi from TBL_Tarifeler as tt  where not exists (select * from TBL_Uye_Tarifeler as tut where tut.uye_id= '$uye_id' and tut.tarife_id = tt.id )");
		$dizi = array();
		while($sonuc = mysqli_fetch_array($sorgu)){
			$dizi[] = $sonuc;
		}
		echo json_encode($dizi);
	}
	if(isset($_POST['tarife_yenile'])){
		$tarife_id = $_POST['tarife_yenile'];
		$sorgu = mysqli_query($baglanti,"select * from TBL_Tarifeler where id = '$tarife_id'");
		$sonuc = mysqli_fetch_assoc($sorgu);
		echo json_encode($sonuc);
	}
	if(isset($_POST['uye_tarife_yenile_update'])){
		$uye_tarife_id = $_POST['uye_tarife_yenile_update'];
		$baslangic_tarihi = $_POST['baslangic_tarihi'];
		$bitis_tarihi = $_POST['bitis_tarihi'];
		$ucret = $_POST['ucret'];
		$kalan_gun = $_POST['kalan_gun'];
		$uyelik_durumu = $_POST['uyelik_durumu'];
		$sorgu = mysqli_query($baglanti,"update TBL_Uye_Tarifeler set  baslangic_tarihi = '$baslangic_tarihi',bitis_tarihi = '$bitis_tarihi',ucret = '$ucret' , kalan_gun = '$kalan_gun',uyelik_durumu = '$uyelik_durumu' where id = '$uye_tarife_id'");
		if($sorgu >0 )
			echo "1";
		else
			echo "2";
	}
	if(isset($_POST['uye_tarife_sil_id'])){
		$id = $_POST['uye_tarife_sil_id'];
		$sorgu = mysqli_query($baglanti,"delete from TBL_Uye_Tarifeler where id = '$id'");
		if($sorgu > 0){
			echo "1";
		}
		else{
			echo "2";
		}
	}
	if(isset($_POST['donma_id'])){
		$id = $_POST['donma_id'];
		$tmp = $_POST['tmp'];
		$kalan_gun = 0;
		$baslangic_tarihi = date('d-m-Y');
		$bitis_tarihi;
		if($tmp == 0){
			$sorgu = mysqli_query($baglanti,"select * from TBL_Uye_Tarifeler where id = '$id'");
			$sonuc = mysqli_fetch_assoc($sorgu);
			$kalan_gun = $sonuc['kalan_gun'];
			$bas_tarihi = explode("-",$baslangic_tarihi);
			$baslangic_tarihi = $bas_tarihi[0].".".$bas_tarihi[1].".".$bas_tarihi[2];
			$bitis_tarihi = date('d-m-Y', strtotime("+".$kalan_gun."days"));
			$bit_tarihi = explode("-",$bitis_tarihi);
			$bitis_tarihi = $bit_tarihi[0].".".$bit_tarihi[1].".".$bit_tarihi[2];
			$sorgu = mysqli_query($baglanti,"update TBL_Uye_Tarifeler set donma = '$tmp' , baslangic_tarihi = '$baslangic_tarihi',bitis_tarihi = '$bitis_tarihi' where id = '$id'");
			if($sorgu > 0){
				echo "1";
			}
			else{
				echo "2";
			}
		}
		else{
			$sorgu2 = mysqli_query($baglanti,"update TBL_Uye_Tarifeler set donma = '$tmp' where id = '$id'");
			if($sorgu2>0){
				echo "1";
			}
			else{
				echo "2";
			}
		}
	}
	if(isset($_POST['tahsilat_id'])){
		$id = $_POST['tahsilat_id'];
		$ucret = $_POST['ucret'];
		$sorgu = mysqli_query($baglanti,"update TBL_Uye_Tarifeler set tahsil_durumu = 1 where id = '$id'");
		if($sorgu > 0){
			$sorgu2 = mysqli_query($baglanti,"select kazanc from TBL_Kasa where id = 1");
			$sonuc = mysqli_fetch_assoc($sorgu2);
			$topKazanc = $sonuc['kazanc'];
			$topKazanc = $topKazanc + $ucret;
			$sorgu3 = mysqli_query($baglanti,"update TBL_Kasa set kazanc = '$topKazanc' where id = 1");
			echo "1";
		}

	}
	if(isset($_POST['profil_guncelle_kul_adi'])){
		$kul_adi = $_POST['profil_guncelle_kul_adi'];
		$cepno = $_POST['cepno'];
		$adres = $_POST['adres'];
		$sifre = $_POST['sifre'];
		$sorgu = mysqli_query($baglanti,"update TBL_Uyeler set cepno = '$cepno',adres='$adres',sifre = '$sifre' where kul_adi = '$kul_adi'");
		if($sorgu>0){
			echo "1";
		}
		else{
			echo "2";
		}
	}
	if(isset($_POST['kategori_adi'])){
		$kategori_adi = $_POST['kategori_adi'];
		$tarife_id = $_POST['tarife_id'];
		$sorgu = mysqli_query($baglanti,"INSERT INTO TBL_Kategoriler(tarife_id,kategori_adi) VALUES('$tarife_id','$kategori_adi')");
		if($sorgu > 0){
			echo "1";
		}
		else{
			echo "2";
		}
	}
	if(isset($_POST['tarifeden_kategori_getir'])){
		$tarife_id = $_POST['tarifeden_kategori_getir'];
		$sorgu = mysqli_query($baglanti,"select * from TBL_Kategoriler where tarife_id = '$tarife_id'");
		$dizi = array();
		while($sonuc = mysqli_fetch_assoc($sorgu)){
			$dizi[] = $sonuc;
		}
		echo json_encode($dizi);
	}
	if(isset($_POST['hareket_adi'])){
		$hareket_adi = $_POST['hareket_adi'];
		$kategori_id = $_POST['kategori_id'];
		$link = $_POST['link'];
		$sorgu = mysqli_query($baglanti,"insert into TBL_Kategori_Hareketler(kategori_id,hareket_adi,link) values('$kategori_id','$hareket_adi','$link')");
		if($sorgu > 0){
			echo "1";
		}
		else{
			echo "2";
		}
	}
	if(isset($_POST['tarife_id_kategori_getir'])){
		$tarife_id = $_POST['tarife_id_kategori_getir'];
		$sorgu = mysqli_query($baglanti,"SELECT * FROM TBL_Kategoriler  WHERE tarife_id = '$tarife_id'");
		$dizi = array();
		while($sonuc = mysqli_fetch_assoc($sorgu)){
			$dizi[] = $sonuc;
		}
		echo json_encode($dizi);
	}
	if(isset($_POST['kategori_id_hareket_getir'])){
		$kategori_id = $_POST['kategori_id_hareket_getir'];
		$sorgu = mysqli_query($baglanti,"select * from TBL_Kategori_Hareketler where kategori_id = '$kategori_id'");
		$dizi = array();
		while($sonuc = mysqli_fetch_assoc($sorgu)){
			$dizi[] = $sonuc;
		}
		echo json_encode($dizi);
	}
	if(isset($_POST['kategori_hareket_id'])){
		$kategori_hareket_id = $_POST['kategori_hareket_id'];
		$tarife_id = $_POST['tarife_id'];
		$h_set = $_POST['h_set'];
		$h_tekrar = $_POST['h_tekrar'];
		$uye_id = $_POST['uye_id'];
		$sorgu = mysqli_query($baglanti,"insert into TBL_Uye_Program_Listesi(uye_id,kategori_hareket_id,h_set,h_tekrar)VALUES('$uye_id','$kategori_hareket_id','$h_set','$h_tekrar')");
		
		if($sorgu > 0){
			$sorgu2 = mysqli_query($baglanti,"Update TBL_Uye_Tarifeler set program = 1 where uye_id = '$uye_id' and tarife_id = '$tarife_id'");
			
			echo "1";
		}
		else{
			echo "2";
		}
	}
?>
