<?php 
session_start();
include"config.php";

$sayfa=isset($_GET["sayfa"]) ? $_GET["sayfa"] : "";  
if($sayfa == ""){
	$sayfa = "uyeler";
}
if(isset($_SESSION["girisBilgisi"]) ){
	
	if($_SESSION["girisBilgisi"] == "adminGirisiYapildi"){
		
		
		
	}
	else{
		echo '<script language="javascript">location.href="login.php";</script>';
	}
}
else{
	echo '<script language="javascript">location.href="login.php";</script>';
}



?>
<!DOCTYPE html>
<html lang="en">
<head>
<!--
Fitness Template
http://www.templatemo.com/tm-487-fitness
-->
<title><?php echo $veri['title'];?></title>
<meta name="description" content="">
<meta name="author" content="">
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=Edge">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">


  
<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="css/animate.css">
<link rel="stylesheet" href="css/font-awesome.min.css">
<link rel="stylesheet" href="css/owl.theme.css">
<link rel="stylesheet" href="css/owl.carousel.css">
<style>
body {
    font-family: "Lato", sans-serif;
    transition: background-color .5s;
}

.sidenav {
    height: 100%;
    width: 0;
    position: fixed;
    z-index: 1;
    top: 0;
    left: 0;
    background-color: #111;
    overflow-x: hidden;
    transition: 0.5s;
    padding-top:60px;
}

.sidenav a {
    padding: 8px 8px 8px 32px;
    text-decoration: none;
    font-size: 25px;
    color: red;;
    display: block;
    transition: 0.3s;
}

.sidenav a:hover {
    color: #f1f1f1;
}

.sidenav .closebtn {
    position: absolute;
    top: 0;
    right: 25px;
    font-size: 36px;
    margin-left: 50px;
}

#main {
    transition: margin-left .5s;
    padding: 16px;
}

@media screen and (max-height: 450px) {
  .sidenav {padding-top: 15px;}
  .sidenav a {font-size: 18px;}
}

</style>

<!-- Main css -->
<link rel="stylesheet" href="css/style.css">

<!-- Google Font -->
<link href='https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,300,600' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Lora:700italic' rel='stylesheet' type='text/css'>
 <!-- 
 Yeni eklenenler
 -->
 <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">

<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
 <!-- 
 Yeni eklenenler
 -->
 
 <script>

 	 
	function tarife_kaydet(){
		var tarife_adi = document.getElementById("tarife_adi").value;
		var bir_aylik_ucret = document.getElementById("bir_aylik_ucret").value;
		var uc_aylik_ucret = document.getElementById("uc_aylik_ucret").value;
		var alti_aylik_ucret = document.getElementById("alti_aylik_ucret").value;
		var yillik_ucret = document.getElementById("yillik_ucret").value;
		console.log(tarife_adi);
		console.log(bir_aylik_ucret);
		console.log(uc_aylik_ucret);
		console.log(alti_aylik_ucret);
		console.log(yillik_ucret);
		//error kısmı
		var tarife_adi_error = document.getElementById("tarife_adi_error");
		var bir_aylik_ucret_error = document.getElementById("bir_aylik_ucret_error");
		var uc_aylik_ucret_error = document.getElementById("uc_aylik_ucret_error");
		var alti_aylik_ucret_error = document.getElementById("alti_aylik_ucret_error");
		var yillik_ucret_error = document.getElementById("yillik_ucret_error");
		if(tarife_adi == ""){
			tarife_adi_error.innerHTML = "Tarife adı kısmı boş bırakılamaz!";
		}
		else if(bir_aylik_ucret == ""){
			bir_aylik_ucret_error.innerHTML = "Bir aylık ücret kısmı boş bırakılamaz!";
		}
		else if(uc_aylik_ucret == ""){
			uc_aylik_ucret_error.innerHTML = "Üç aylık ücret kısmı boş bırakılamaz!";
		}
		else if(alti_aylik_ucret == ""){
			alti_aylik_ucret_error.innerHTML = "Altı aylık ücret kısmı boş bırakılamaz!";
		}
		else if(yillik_ucret == ""){
			yillik_ucret_error.innerHTML = "Yıllık ücret kısmı boş bırakılamaz!";
		}
		else{
			$.post("postlar.php", {tarife_adi:tarife_adi,bir_aylik_ucret:bir_aylik_ucret,uc_aylik_ucret:uc_aylik_ucret,alti_aylik_ucret:alti_aylik_ucret,yillik_ucret:yillik_ucret}, 
				function(result){
					if(result == "1"){
						
						alert("Tarife başarı ile eklendi.");
						location.reload();
					}
					else{
						alert("Hata algılandı. Lütfen Tekrar Deneyiniz :(");
					}
					
				});
		}
	}
	function tarife_duzenle(id){
		var id = id;
		
		$.post("postlar.php", {tarife_duzenle_id:id}, 
				function(result){
					
					var tarife = JSON.parse(result);
					var tarife_adi = tarife.tarife_adi;
					var bir = tarife.bir_aylik;
					var uc = tarife.uc_aylik;
					var alti = tarife.alti_aylik;
					var yillik = tarife.yillik;
					document.getElementById("tarife_id").value = id;
					document.getElementById("modal_tarife_adi").value = tarife_adi;
					document.getElementById("modal_bir_aylik_ucret").value = bir;
					document.getElementById("modal_uc_aylik_ucret").value = uc;
					document.getElementById("modal_alti_aylik_ucret").value = alti;
					document.getElementById("modal_yillik_ucret").value = yillik;
					
				});
		
	}
	function tarife_update(){
		var id         = document.getElementById("tarife_id").value;
		var tarife_adi = document.getElementById("modal_tarife_adi").value;
		var bir_aylik  = document.getElementById("modal_bir_aylik_ucret").value;
		var uc_aylik   = document.getElementById("modal_uc_aylik_ucret").value;
		var alti_aylik   = document.getElementById("modal_alti_aylik_ucret").value;
		var yillik     = document.getElementById("modal_yillik_ucret").value;
		//error
		var tarife_adi_error = document.getElementById("modal_tarife_adi_error");
		var bir_aylik_error  = document.getElementById("modal_bir_aylik_ucret_error");
		var uc_aylik_error   = document.getElementById("modal_uc_aylik_ucret_error");
		var alti_aylik_error   = document.getElementById("modal_alti_aylik_ucret_error");
		var yillik_error     = document.getElementById("modal_yillik_ucret_error");
		if(tarife_adi == ""){
			tarife_adi_error.innerHTML = "Tarife adı kısmı boş bırakılamaz!";
		}
		else if(bir_aylik == ""){
			bir_aylik_error.innerHTML = "Bir aylık ücret kısmı boş bırakılamaz!";
		}
		else if(uc_aylik == ""){
			uc_aylik_error.innerHTML = "Üç aylık ücret kısmı boş bırakılamaz!";
		}
		else if(alti_aylik == ""){
			alti_aylik_error.innerHTML = "Altı aylık ücret kısmı boş bırakılamaz!";
		}
		else if(yillik == ""){
			yillik_error.innerHTML = "Yıllık ücret kısmı boş bırakılamaz!";
		}
		else{
			$.post("postlar.php", {tarife_update_id:id,tarife_adi_update:tarife_adi,bir_aylik:bir_aylik,uc_aylik:uc_aylik,alti_aylik:alti_aylik,yillik:yillik}, 
				function(result){
					if(result == "1"){
						
						alert("Tarife başarı ile güncellendi.");
						location.reload();
					}
					else{
						alert("Hata algılandı. Lütfen Tekrar Deneyiniz :(");
					}
					
				});
		}
	}
	function tarife_sil(id){
		$.post("postlar.php", {tarife_sil_id:id}, 
				function(result){
					if(result == "1"){
						
						alert("Tarife başarı ile silindi.");
						location.reload();
					}
					else{
						alert("Hata algılandı. Lütfen Tekrar Deneyiniz :(");
					}
					
				});
	}
	function uye_kaydet(){
		var ad = document.getElementById("ad").value;
		var ad_error = document.getElementById("ad_error");
		var soyad = document.getElementById("soyad").value;
		var soyad_error = document.getElementById("soyad_error");
		var tcno = document.getElementById("tcno").value;
		var tcno_error = document.getElementById("tcno_error");
		var cepno = document.getElementById("cepno").value;
		var cepno_error = document.getElementById("cepno_error");
		var adres = document.getElementById("adres").value;
		var adres_error = document.getElementById("adres_error");
		var eposta = document.getElementById("eposta").value;
		var eposta_error = document.getElementById("eposta_error");
		var cinsiyet = $('input[name=cinsiyet]:checked').val();
		var kart = document.getElementById("kart").value;
		var kart_error = document.getElementById("kart_error");
		if(ad == ""){
			ad_error.innerHTML = "* Ad kısmı boş bırakılamaz!";
		}
		else if(soyad == ""){
			soyad_error.innerHTML = "* Soyad kısmı boş bırakılamaz!";
		}
		else if(tcno.length < 11){
			tcno_error.innerHTML = "* TC Kimlik Numarası 11 rakamdan oluşmalıdır. Lütfen 11 rakam girdiğinizden emin olunuz!";
		}
		else if(cepno.length <11){
			cepno_error.innerHTML = "* Cep telefonu numaranız 11 rakamdan oluşmalıdır. Lütfen 11 rakam girdiğinizden emin olunuz!";
		}
		else if(adres == ""){
			adres_error.innerHTML = "* Adres kısmı boş bırakılamaz!";
		}
		else if(eposta == ""){
			eposta_error.innerHTML = "* E-Posta kısmı boş bırakılamaz!";
		}
		else if(kart <10){
			kart_error.innerHTML = "* 10 haneli kart numarasını girdiğinizden emin olun!";
		}
		else{
			$.post("postlar.php", {ad:ad,soyad:soyad,tcno:tcno,cepno:cepno,adres:adres,eposta:eposta,cinsiyet:cinsiyet,kart:kart}, 
				function(result){
					if(result == "1"){
						
						alert("Üye başarı ile kaydedildi.");
						location.reload();
					}
					else{
						alert("Hata algılandı. Lütfen Tekrar Deneyiniz :(");
					}
					
				});
		}
	
		
		
	}
	
	function uye_detay(obj,id){
		myText = obj.innerHTML;
		
		
		document.getElementById("uyeler_detay").innerHTML = myText;
		document.getElementById("secim").innerHTML = "<br><input id = 'bir'  type='radio' name='durum' value='kayitli_tarifeler'/>&nbsp;Üyenin Kayıtlı Tarifeleri<hr><input  type='radio' id = 'iki'name='durum' value='yeni_tarife'/>&nbsp;Üyeye Yeni Tarife Ekle<hr><input type='button' class='btn btn-theme btn-block' value='Geri Dön' onClick='javascript:history.go(0);' />";
		radiobtn = document.getElementById("bir");
		radiobtn.checked = true;
		uye_tarifeler(id);
		
		
		$('input:radio[name="durum"]').change(
		function(){
        if (this.checked && this.value == 'kayitli_tarifeler') {
			
            uye_tarifeler(id);
			
			
			
        }
		else if(this.checked && this.value == 'yeni_tarife')
		{
			uyeye_tarife_ekle(id);
			
			
		}
		});
		
		
		
	}
	
	function uye_tarifeler(id){
		var uye_id = id;
		
		var tbody = document.getElementById("tarifeler_tbody");
		$('#kayitli_tarifeler_modal').modal('show');
		$.post("postlar.php", {tarife_getir_id:uye_id}, 
				function(result){
					var myText = "";
					var yenileButton;
					var donmaButton;
					var programButton;
					var t = JSON.parse(result);
					var i = 0;
					var uyelik_d;
					var tahsil_d
					while(i  != t.length){
						if(t[i].uyelik_durumu == 1){
							uyelik_d = "Aktif";
						}
						else{
							uyelik_d = "Pasif";
						}
						if(t[i].tahsil_durumu == 1){
							tahsil_d = "Ödendi"
						}
						else {
							tahsil_d = "Ödenmedi";
						}
						if(t[i].program == 0){
							programButton = "<br><button onclick='program_modal_doldur("+t[i].uye_id+","+t[i].tarife_id+")'>Program Ekle</button></td>";
						}
						else{
							programButton = "<br><button onclick='program_goster("+t[i].uye_id+","+t[i].tarife_id+")'>Programı Gör</button></td>"
						}
						if(t[i].kalan_gun == 0){
							yenileButton = "<button onclick = 'tarife_yenile("+t[i].id+","+t[i].tarife_id+")'>Yenile</button>";
							
						}
						else {
							yenileButton = "";
							if(t[i].donma == 0){
							var tmp = 1;
							donmaButton = "<button onclick = 'tarife_durum("+t[i].id+","+tmp+")'>Dondur</button>";
							}
							else{
								var tmp = 0;
								donmaButton = "<button onclick = 'tarife_durum("+t[i].id+","+tmp+")'>Aktif Et</button>";
							}
						}
						
						myText =  myText + "<tr><td>"+t[i].tarife_adi+"</td><td>"+t[i].ucret+"</td><td>"+t[i].baslangic_tarihi+"</td><td>"+t[i].bitis_tarihi+"</td><td>"+tahsil_d+"</td><td>"+t[i].kalan_gun+"</td><td>"+uyelik_d+"</td><td>"+yenileButton+"&nbsp;<button onclick='uye_tarife_sil("+t[i].id+")'>Sil</button>&nbsp;"+donmaButton+"&nbsp;"+programButton+"</tr>";
						i++;
					}
					tbody.innerHTML = myText;
					
				});
				
	}
	function program_goster(uye_id){
		
	}
	function program_modal_doldur(uye_id,tarife_id){
		$('#kayitli_tarifeler_modal').modal('hide');
		
		$.post("postlar.php", {tarife_id_kategori_getir:tarife_id}, 
				function(result){
					var i = 0;
					var gelen_kategoriler = JSON.parse(result);
					var myText = "<option>Seçiniz</option>";
					var degisecek = document.getElementById("kategori_list");
					while(i != gelen_kategoriler.length){
						
						myText = myText +  "<option value ="+gelen_kategoriler[i].id+">"+gelen_kategoriler[i].kategori_adi+"</option>";;
						i++;
					}
					document.getElementById("hidden_uye_id").value = uye_id;
					document.getElementById("hidden_tarife_id").value = tarife_id;
					degisecek.innerHTML = myText;
					
					
				});
		
		
		$('#programOlusturModal').modal('show');
		
	}
	var global_i;
	function kategoriden_hareket_getir(s){
		var kategori_id = s.options[s.selectedIndex].value;
		
		var degisecek = document.getElementById("hareketler");
		$.post("postlar.php",{kategori_id_hareket_getir:kategori_id},function(result){
			var hareketler = JSON.parse(result);
			var i = 0;
			var myText = "";
			if(hareketler.length == 0){
				degisecek.innerHTML = "<marquee>Kayıtlı Hareket Yok</marquee>"
			}
			else{
				while(i != hareketler.length){
				myText = myText + "<label style = 'color:red;'>"+hareketler[i].hareket_adi+"</label><hr><input id = 'hidden"+i+"'type = 'hidden' value ='"+hareketler[i].id+"'><label for = 'set"+i+"' >Set Sayısı</label><input id='set"+i+"' class='form-control' type = 'number'><label for = 'tekrar"+i+"' >Tekrar Sayısı</label><input id='tekrar"+i+"' class='form-control' type = 'number'><hr>";
				i++;
			}
			global_i = i;
			degisecek.innerHTML = myText;
			}
			
		});
		
	}
	function program_kaydet(){
		var sayi = global_i;
		var uye_id = document.getElementById("hidden_uye_id").value;
		var tarife_id = document.getElementById("hidden_tarife_id").value;
		var i = 0;
		var durum = 1;
		var kategori_hareket_id = [];
		var h_set = [];
		var h_tekrar = [];
		for(i=0;i<sayi;i++){
			var kategori_hareket_id = document.getElementById("hidden"+i).value;
			var h_set = document.getElementById("set"+i).value;
			var h_tekrar = document.getElementById("tekrar"+i).value;
			if(kategori_hareket_id == 0 || h_set == 0 || h_tekrar == 0){
				alert("Lütfen boş alan bırakmayınız.");
			}
			else{
				$.post("postlar.php",{kategori_hareket_id:kategori_hareket_id,h_set:h_set,h_tekrar:h_tekrar,uye_id:uye_id,tarife_id:tarife_id},function(result){
					durum = result;
				});
			}
		}
		if(durum == "1"){
			alert("Program başarı ile eklendi.");
		}
		else{
			alert("Program eklenirken hata oluştu.");
		}
	}
	////////////////////////////////////////
	function tarife_yenile(id,tarife_id){
		
		var bir_aylik = document.getElementById('bir_aylik2');
		var uc_aylik = document.getElementById('uc_aylik2');
		var alti_aylik = document.getElementById('alti_aylik2');
		var yillik = document.getElementById('yillik2');
		var uye_tarife_id = document.getElementById('uye_tarife_id2');
		$.post("postlar.php", {tarife_yenile:tarife_id}, 
				function(result){
					var tarife = JSON.parse(result);
					var ucret_bir_aylik = tarife.bir_aylik;
					var ucret_uc_aylik = tarife.uc_aylik;
					var ucret_alti_aylik = tarife.alti_aylik;
					var ucret_yillik = tarife.yillik;
					bir_aylik.value = ucret_bir_aylik;
					document.getElementById("bir_aylik_value").innerHTML = ucret_bir_aylik;
					uc_aylik.value = ucret_uc_aylik;
					document.getElementById("uc_aylik_value").innerHTML = ucret_uc_aylik;
					alti_aylik.value = ucret_alti_aylik;
					document.getElementById("alti_aylik_value").innerHTML = ucret_alti_aylik;
					yillik.value = ucret_yillik;
					document.getElementById("yillik_value").innerHTML = ucret_yillik;
					uye_tarife_id.value = id; 
				});
		$('#tarife_yenile').modal('show');
	}
	function tarife_yenile_update(){
		var baslangic_tarihi;
		var bitis_tarihi;
		var ucret;
		var kalan_gun;
		var uyelik_durumu;
		var d = new Date();
		var bas_ay = d.getMonth()+1;
		var bas_yil = d.getFullYear();
		var bas_gun = d.getDate();
		var bit_ay = d.getMonth()+1;
		var bit_yil = d.getFullYear();
		var bit_gun = d.getDate();
		baslangic_tarihi = bas_gun+"."+bas_ay+"."+bas_yil;
		var uye_tarife_id = document.getElementById("uye_tarife_id2").value;
		if(document.getElementById("bir_aylik2").checked == true){
			ucret = document.getElementById("bir_aylik2").value;
			kalan_gun = 30;
			if(bit_ay == 12){
				bit_ay = 1;
				bit_yil = bit_yil+1;
			}
			else{
				bit_ay = bit_ay+1;
			}
			bitis_tarihi = bit_gun+"."+bit_ay+"."+bit_yil;
			uyelik_durumu = 1;
		}
		else if(document.getElementById("uc_aylik2").checked == true){
			ucret = document.getElementById("uc_aylik2").value;
			kalan_gun = 90;
			if(bit_ay > 9){
				bit_ay = (bit_ay+3)-12;
				bit_yil = bit_yil+1;
			}
			else{
				bit_ay = bit_ay+3;
			}
			bitis_tarihi = bit_gun+"."+bit_ay+"."+bit_yil;
			uyelik_durumu = 1;
		}
		else if(document.getElementById("alti_aylik2").checked == true){
			ucret = document.getElementById("alti_aylik2").value;
			kalan_gun = 180;
			if(bit_ay > 6){
				bit_ay = (bit_ay+6)-12;
				bit_yil = bit_yil+1;
			}
			else{
				bit_ay = bit_ay+6;
			}
			bitis_tarihi = bit_gun+"."+bit_ay+"."+bit_yil;
			uyelik_durumu = 1;
		}
		else{
			ucret = document.getElementById("yillik2").value;
			kalan_gun = 365;
			bit_yil = bit_yil +1;
			bitis_tarihi = bit_gun+"."+bit_ay+"."+bit_yil;
			uyelik_durumu = 1;
		}
		
		$.post("postlar.php", {uye_tarife_yenile_update:uye_tarife_id,baslangic_tarihi:baslangic_tarihi,bitis_tarihi:bitis_tarihi,ucret:ucret,kalan_gun:kalan_gun,uyelik_durumu:uyelik_durumu}, 
				function(result){
					if(result == "1"){
						
						alert("Tarife başarı ile yenilendi.");
						location.reload();
					}
					else{
						alert("Hata algılandı. Lütfen Tekrar Deneyiniz :(");
					}
				});
	}
	function uye_tarife_sil(id){
		$.post("postlar.php", {uye_tarife_sil_id:id}, 
				function(result){
					if(result == "1"){
						
						alert("Tarife başarı ile silindi.");
						location.reload();
					}
					else{
						alert("Hata algılandı. Lütfen Tekrar Deneyiniz :(");
					}
				});
	}
	function tarife_durum(id,tmp){
		
		$.post("postlar.php", {donma_id:id,tmp:tmp}, 
				function(result){
					
						
						if(result == "1"){
							alert("İşlem başarılı");
							location.reload();
						}
						else{
							alert("Hata tekrar deneyiniz.");
						}
						
					
				});
	}
	////////////////////////////////////////
	
	function uyeye_tarife_ekle(id){
		
		var uye_id = id;
		$('#uyeyeYeniTarifeEkle').modal('show');
		document.getElementById("uye_id").value = uye_id;
		var html = document.getElementById("degisecek_olan");
		if(uye_id != ""){
			$.post("postlar.php", {olmayan_tarife:uye_id}, 
				function(result){
					var tarife = JSON.parse(result);
					var i = 0;
					var myText = "<label for='tarife_id'>Tarifeler</label><select id='tarife_id' name='tarife_id' class='form-control' type='text' onchange='fiyat_getir(this)' data-validation='required'><option value = '0'>Tarife Seçiniz</option>";
					while(i  != tarife.length){
						myText = myText + "<option value = '"+tarife[i].id+"'>"+tarife[i].tarife_adi+"</option>";
						i++;
					}
					html.innerHTML = myText + "</select><hr>";
				});
		}
		
		
		
	}
	function uyeye_yeni_tarife_kaydet(){
		var uye_id = document.getElementById("uye_id").value;
		var tarife_id = document.getElementById("tarife_id2").value;
		var fiyat = 0;
		var now = new Date();
		var gun = now.getDate();
		var ay = now.getMonth()+1;
		var yil = now.getFullYear();
		var gun2 = now.getDate();
		var ay2 = now.getMonth()+1;
		var yil2 = now.getFullYear();
		var kalan_gun = 0;
		
	    if(document.getElementById("bir_aylik").checked == true){
			fiyat = document.getElementById("bir_aylik").value;
			kalan_gun = 30;
			if(ay2 == 12){
				ay2 = 1
				yil2 = yil2+1;
			}
			else{
				ay2 = ay2+1;
			}
			
		}
		else if(document.getElementById("uc_aylik").checked == true){
			fiyat = document.getElementById("uc_aylik").value;
			kalan_gun = 90;
			if(ay2 > 9){
				ay2 = (ay2+3)-12;
				yil2 = yil2+1;
			}
			else{
				ay2=ay2+3;
			}
		}
		else if(document.getElementById("alti_aylik").checked == true){
			fiyat = document.getElementById("alti_aylik").value;
			kalan_gun = 180;
			if(ay2>6){
				ay2 = (ay2+6)-12;
				yil2 = yil2+1;
			}
			else{
				ay2 = ay2+6;
			}
		}
		else if(document.getElementById("yillik").checked == true){
			kalan_gun = 365;
			fiyat = document.getElementById("yillik").value;
			yil2 = yil2+1;
		}
		else{
			alert("Lütfen üyelik ücretini seçiniz.");
		}
		
		var bitis_tarihi = gun2+"."+ay2+"."+yil2;
		var baslangic_tarihi = gun+"."+ay+"."+yil;
		var uye_id = document.getElementById("uye_id").value;
		var tarife_id = document.getElementById("tarife_id2").value;
		if(tarife_id == 0){
			alert("Lütfen tarife seçiniz");
		}
		else{
			$.post("postlar.php", {uyeler_tarife_id:tarife_id,uye_id:uye_id,ucret:fiyat,baslangic_tarihi:baslangic_tarihi,bitis_tarihi:bitis_tarihi,kalan_gun:kalan_gun}, 
				function(result){
					if(result == "1"){
						
						alert("Tarife üyeye başarı ile eklendi.");
						location.reload();
					}
					else{
						alert("Hata algılandı. Lütfen Tekrar Deneyiniz :(");
					}
					
				});
		}
		
	}
	function fiyat_getir(s){
		
		var tarife_id = s.options[s.selectedIndex].value;
		document.getElementById("label_bir_aylik").innerHTML ="";
		document.getElementById("label_uc_aylik").innerHTML ="";
		document.getElementById("label_alti_aylik").innerHTML ="";
		document.getElementById("label_yillik").innerHTML ="";
		if(tarife_id > 0){
				$.post("postlar.php", {fiyat_tarife_id:tarife_id}, 
				function(result){
					var fiyatlar = JSON.parse(result);
					var bir_aylik = fiyatlar.bir_aylik;
					var uc_aylik = fiyatlar.uc_aylik;
					var alti_aylik = fiyatlar.alti_aylik;
					var yillik = fiyatlar.yillik;
					document.getElementById("bir_aylik").value = bir_aylik;
					document.getElementById("label_bir_aylik").innerHTML =bir_aylik;
					document.getElementById("uc_aylik").value = uc_aylik;
					document.getElementById("label_uc_aylik").innerHTML =uc_aylik;
					document.getElementById("alti_aylik").value = alti_aylik;
					document.getElementById("label_alti_aylik").innerHTML =alti_aylik;
					document.getElementById("yillik").value = yillik;
					document.getElementById("label_yillik").innerHTML =yillik;
					document.getElementById("tarife_id2").value = tarife_id;
				});
		}
	
		
	}
	function tahsil_et(id,ucret){
		$.post("postlar.php",{tahsilat_id:id,ucret:ucret},
		function(result){
			if(result == "1"){
				alert("Tahsilat başarılı");
				location.reload();
			}
			else{
				alert("Hata!! Tekrar deneyiniz.");
			}
		});
	}
	var global_tarife_id;
	function tarife_id_al(s){
		var tarife_id = s.options[s.selectedIndex].value;
		global_tarife_id = tarife_id;
		
	}
	
	function kategori_kaydet(){
		if(global_tarife_id == null){
			alert("Tarife Seçiniz!");
		}
		else{
		var durum = 1;
		var kategori_sayisi = document.getElementById("kategori_sayisi").value;
		var i = 0;
		var dizi = [];
		for(i = 0;i<kategori_sayisi;i++){
			var dizi = document.getElementById("kategori"+i).value;
			$.post("postlar.php",{kategori_adi:dizi,tarife_id:global_tarife_id},function(result){
				durum = result;
			});
			
		}
		if(durum == "1"){
			alert("Kategoriler başarı ile eklendi.");
			location.reload();
		}
		else{
			alert("Ops. Bir hata ile karşılaşıldı.");
		}
		}
		
	}
	function tarifeden_kategori_getir(s){
		var tarife_id = s.options[s.selectedIndex].value;
		if(tarife_id == 0){
			alert("Tarife seçiniz.");
		}
		else{
			$.post("postlar.php",{tarifeden_kategori_getir:tarife_id},function(result){
			var kategori_select = document.getElementById("kategoriler");
			var kategoriler = JSON.parse(result);
			var i = 0;
			myText = "";
			while(i != kategoriler.length){
			myText = myText + "<option value ="+kategoriler[i].id+">"+kategoriler[i].kategori_adi+"</option>";
				i++;
			}
			kategori_select.innerHTML = myText;
		});
		}
		
	}
	var global_kategori_id;
	function kategori_id_al(s){
		global_kategori_id = s.options[s.selectedIndex].value;
	}
	function hareket_olustur(){
		var hareket_sayisi = document.getElementById("hareket_sayisi").value;
		if(hareket_sayisi == 0){
			alert("Geçerli bir sayı giriniz.");
		}
		else{
			myText = "";
			var parametreli_hareket = document.getElementById("parametreli_hareket");
			for(var i = 0 ;i<hareket_sayisi;i++){
				myText = myText + '<label for="hareket'+(i)+'">Hareket '+(i+1)+'</label><input class="form-control" type = "text" id = "hareket'+i+'"><br><label for="link'+(i)+'">Video Link '+(i+1)+'</label><input class="form-control" type = "text" id = "link'+i+'"><br>';
			}
			myText = myText + '<button onclick = "hareket_kaydet();" id="submit" type="submit" value="submit" class="btn btn-primary center" >Kaydet</button>';
			parametreli_hareket.innerHTML = myText;
		}
	}
	function hareket_kaydet(){
		if(global_kategori_id == null){
			alert("Tarife Seçiniz!");
		}
		else{
			var durum = 1;
			var hareket_sayisi = document.getElementById("hareket_sayisi").value;
			var i = 0;
			var hareket_adi = [];
			var link = []
			for(i = 0;i<hareket_sayisi;i++){
				var hareket_adi = document.getElementById("hareket"+i).value;
				var link = document.getElementById("link"+i).value;
				$.post("postlar.php",{hareket_adi:hareket_adi,link:link,kategori_id:global_kategori_id},function(result){
					durum = result;
				});
				
			}
		if(durum == "1"){
			alert("Hareketler başarı ile eklendi.");
			location.reload();
		}
		else{
			alert("Ops. Bir hata ile karşılaşıldı.");
		}
		}
	}
 </script>
</head>
<body data-spy="scroll" data-target=".navbar-collapse" data-offset="50" style="background-image:url(bg.jpg);">


<!-- =========================
     PRE LOADER       
============================== -->




 

<div id="mySidenav" class="sidenav">
  <a style = "color:red;" href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
  <ul class="sub">
  <a <?php if($sayfa =="uyeler") echo"style='color:white;'"?> href="admin_page.php?sayfa=uyeler">Üyeler</a>
  <a <?php if($sayfa =="yeni_uye") echo"style='color:white;'"?> href="admin_page.php?sayfa=yeni_uye">Yeni Üye</a>
  <a <?php if($sayfa =="tarifeler") echo"style='color:white;'"?> href="admin_page.php?sayfa=tarifeler">Tarifeler</a>
  <a <?php if($sayfa =="yeni_tarife") echo"style='color:white;'"?> href="admin_page.php?sayfa=yeni_tarife">Tarife Kayıt</a>
  <a <?php if($sayfa =="salondakiler") echo"style='color:white;'"?> href="admin_page.php?sayfa=salondakiler">Salondaki Üyeler</a>
  <a <?php if($sayfa =="tahsilat") echo"style='color:white;'"?> href="admin_page.php?sayfa=tahsilat">Tahsilat</a>
  <a <?php if($sayfa =="kasa") echo"style='color:white;'"?> href="admin_page.php?sayfa=kasa">Kasa</a>
  <a <?php if($sayfa =="kategori_ekle") echo"style='color:white;'"?> href="admin_page.php?sayfa=kategori_ekle">Kategori Ekle</a>
  <a <?php if($sayfa =="kategoriler") echo"style='color:white;'"?> href="admin_page.php?sayfa=kategoriler">Kategoriler</a>
  <a href="logout.php">Çıkış Yap</a>
  </ul>
</div>

<div id="main">
  <span style="font-size:30px;cursor:pointer;color:red;" onclick="openNav()">&#9776;</span>
    <div class="panel panel-default">
							
							<?php if($sayfa == "uyeler"){ ?>
							<div class="panel-body" style = "width:100%;height:100%;">
							<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"/>
							<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap.min.css"/>
							<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.1/css/responsive.bootstrap.min.css"/>
							<script type="text/javascript" src="https://code.jquery.com/jquery-1.12.4.js"/></script>
							<script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"/></script>
							<script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap.min.js"/></script>
							<script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.1/js/dataTables.responsive.min.js"/></script>
							<script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.1/js/responsive.bootstrap.min.js"/></script>
							<table id="uyelerTable" class="table table-striped table-bordered nowrap" style="width:100%">
								<thead>
									<tr>
										<th>Ad</th>
										<th>Soyad</th>
										<th>TC No</th>
										<th>Cep No</th>
										<th>Adres</th>
										<th>E-Posta</th>
										<th>Cinsiyet</th>
									</tr>
								</thead>
								<tbody id="uyeler_detay">
								<?php 
										$sorgu = mysqli_query($baglanti,"select * from TBL_Uyeler");
											$satir = mysqli_num_rows($sorgu);
											
											
												if($satir == 0){
													echo'<tr><td colspan = "7"><marquee>Kayıtlı Üye Yok</marquee></td></tr>
													<tr align="center"><td colspan = "7"><a href = "admin_page.php?sayfa=yeni_uye">Üye Eklemek İçin Tıkla</a></td></tr>';
												}
												else{
													while($sonuc = mysqli_fetch_array($sorgu)){
													echo"<tr style = 'cursor:pointer;' onclick= 'uye_detay(this,$sonuc[id])'>
															
															<td>$sonuc[ad]</a></td>
															<td>$sonuc[soyad]</td>
															<td>$sonuc[tcno]</td>
															<td>$sonuc[cepno]</td>
															<td>$sonuc[adres]</td>													
															<td>$sonuc[eposta]</td>		
															<td>$sonuc[cinsiyet]</td>	
															
															
														</tr>";
												}}
								?>
								</tbody>
								<tfoot>
									<tr>
										<th>Ad</th>
										<th>Soyad</th>
										<th>TC No</th>
										<th>Cep No</th>
										<th>Adres</th>
										<th>E-Posta</th>
										<th>Cinsiyet</th>
									</tr>
								</tfoot>
							</table>
							<script>
							$('#uyelerTable').DataTable( {
								responsive: true
								
							} );
							</script>
								<div id = "secim"  align = "center" class="table table-striped table-bordered nowrap" style="width:100%"></div>
								<div id = "kayitli_tarifeler_goster"  align = "center" class="table table-striped table-bordered nowrap" style="width:100%"></div>
								
							</div>
							<?php } else if($sayfa == "yeni_uye"){ ?>
							<div id = "kayit_turu" class="panel-body" style = "width:100%;height:100%;">
								<div class="form-group">
									<label for="ad">Ad</label>
									<input id="ad" name="ad" class="form-control" type="text" data-validation="required">
									<span id="ad_error" class="text-danger"></span>
								</div>
								<div class="form-group">
									<label for="soyad">Soyad</label>
									<input id="soyad" name="soyad" class="form-control" type="text" data-validation="required">
									<span id="soyad_error" class="text-danger"></span>
								</div>
								<div class="form-group">
									<label for="tcno">TC. Kimlik Numarası</label>
									<input id="tcno" name="tcno" class="form-control" type="number"  onkeyup="limit(11);" data-validation="required">
									<span id="tcno_error" class="text-danger"></span>
									<script type="text/javascript">
											function limit(max) {
												var textarea = document.getElementById('tcno');
												if (textarea.value.length > max) {
													textarea.value = textarea.value.substring(0, max);
												} 
											}
									</script>
								</div>
								<div class="form-group">
									<label for="cepno">Cep Telefonu</label>
									<input id="cepno" name="cepno"  class="form-control" type="number" onkeyup="limit2(11);" data-validation="required">
									<span id="cepno_error" class="text-danger"></span>
									<script type="text/javascript">
											function limit2(max) {
												var textarea = document.getElementById('cepno');
												if (textarea.value.length > max) {
													textarea.value = textarea.value.substring(0, max);
												} 
											}
									</script>
								</div>
								<div class="form-group">
									<label for="kart">Salon Kart Numarası</label>
									<input id="kart" name="kart"  class="form-control" type="number" onkeyup="limit3(10);" data-validation="required">
									<span id="kart_error" class="text-danger"></span>
									<script type="text/javascript">
											function limit3(max) {
												var textarea = document.getElementById('kart');
												if (textarea.value.length > max) {
													textarea.value = textarea.value.substring(0, max);
												} 
											}
									</script>
								</div>
								<div class="form-group">
									<label for="adres">Adres</label>
									<textarea style = "resize: none;" id="adres" name="adres"  class="form-control"  rows = "4" data-validation="required"></textarea>
									<span id="adres_error" class="text-danger"></span>
								</div>
								<div class="form-group">
									<label for="eposta">E-posta</label>
									<input id="eposta" name="eposta"  class="form-control" type="text" min="1" data-validation="required">
									<span id="eposta_error" class="text-danger"></span>
								</div>
								<div class="form-group">
									<label for="cinsiyet">Cinsiyet :</label>
									
									<input id = "erkek" checked = "true" type="radio" name="cinsiyet" value="Erkek"/>&nbsp;Erkek&nbsp;
									<input id = "kadin" type="radio" name="cinsiyet" value="Kadın"/>&nbsp;Kadın<br/>
									
								</div>
								<div align = "center" class="form-group">
									<button  onclick = "uye_kaydet();" id="submit" type="submit" value="submit" class="btn btn-primary center">Kaydet</button>
								</div>
							</div>
							<?php } else if($sayfa == "tarifeler"){ ?>
							<div class="panel-body" style = "width:100%;height:100%;">
							<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/r/bs-3.3.5/jq-2.1.4,dt-1.10.8/datatables.min.css"/>
							<script type="text/javascript" src="https://cdn.datatables.net/r/bs-3.3.5/jqc-1.11.3,dt-1.10.8/datatables.min.js"></script>
							<script type="text/javascript" charset="utf-8">$(document).ready(function() {$('#tarifeler').DataTable();} );
							
							</script>
							 

								<table id="tarifeler" class="display the-table" cellspacing="0" width="100%">
									<thead>
										<tr>
											<th>Tarife Adı</th>
											<th>Bir Aylık Ücret</th>
											<th>Üç Aylık Ücret</th>
											<th>Altı Aylık Ücret</th>
											<th>Yıllık Ücret</th>
											<th>İşlemler</th>
										</tr>
									</thead>
									<tbody>
										<?php 
											$sorgu = mysqli_query($baglanti,"select * from TBL_Tarifeler");
											$satir = mysqli_num_rows($sorgu);
											
											
												if($satir == 0){
													echo'<tr><td colspan = "6"><marquee>Kayıtlı Tarife Yok</marquee></td></tr>
													<tr align="center"><td colspan = "6"><a href = "admin_page.php?sayfa=yeni_tarife">Tarife Eklemek İçin Tıkla</a></td></tr>';
												}
												else{
													while($sonuc = mysqli_fetch_array($sorgu)){
													echo"<tr>
															<td>$sonuc[tarife_adi]</td>
															<td>$sonuc[bir_aylik]</td>
															<td>$sonuc[uc_aylik]</td>
															<td>$sonuc[alti_aylik]</td>
															<td>$sonuc[yillik]</td>													
															<td>
															<button data-toggle='modal' data-target='#tarifeDuzenleModal' onclick='tarife_duzenle($sonuc[id])' >Düzenle</button>&nbsp;
															<button onclick='tarife_sil($sonuc[id])' id='post-btn'   ><i class='fa fa-times-circle' aria-hidden='true'></i></button></td>
														</tr>";
												}}
											 ?>
									</tbody>
								</table>
								<script type="text/javascript">$('#tarifeler').removeClass( 'display' ).addClass('table table-striped table-bordered');</script>
							</div>
							<?php } else if($sayfa == "yeni_tarife"){ ?>
							<div class="panel-body" style = "width:auto%;height:auto%;">
							
								<div class="form-group">
									<label for="tarife_adi">Tarife Adı</label>
									<input id="tarife_adi" name="tarife_adi" class="form-control" type="text" data-validation="required">
									<span id="tarife_adi_error" class="text-danger"></span>
								</div>
								<div class="form-group">
									<label for="lastname">1 Aylık Ücret</label>
									<input id="bir_aylik_ucret" name="bir_aylik_ucret" class="form-control" type="number" data-validation="required">
									<span id="bir_aylik_ucret_error" class="text-danger"></span>
								</div>
								<div class="form-group">
									<label for="uc_aylik_ucret">3 Aylık Ücret</label>
									<input id="uc_aylik_ucret" name="uc_aylik_ucret"  class="form-control" type="number" min="1" data-validation="required">
									<span id="uc_aylik_ucret_error" class="text-danger"></span>
								</div>
								<div class="form-group">
									<label for="alti_aylik_ucret">6 Aylık Ücret</label>
									<input id="alti_aylik_ucret" name="alti_aylik_ucret"  class="form-control" type="number" min="1" data-validation="required">
									<span id="alti_aylik_ucret_error" class="text-danger"></span>
								</div>
								<div class="form-group">
									<label for="yillik_ucret">Yıllık Ücret</label>
									<input id="yillik_ucret" name="yillik_ucret"  class="form-control" type="number" min="1" data-validation="required">
									<span id="yillik_ucret_error" class="text-danger"></span>
								</div>
								<div align = "center" class="form-group">
									<button  onclick = "tarife_kaydet();" id="submit" type="submit" value="submit" class="btn btn-primary center">Kaydet</button>
								</div>
								
								
								
							
							</div>
							<?php } if($sayfa == "salondakiler"){?>
							<div class="panel-body" style = "width:auto%;height:auto%;">
								
							<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap.min.css"/>
							<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.1/css/responsive.bootstrap.min.css"/>
							<script type="text/javascript" src="https://code.jquery.com/jquery-1.12.4.js"/></script>
							<script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"/></script>
							<script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap.min.js"/></script>
							<script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.1/js/dataTables.responsive.min.js"/></script>
							
							<table id="salondakiler" class="table table-striped table-bordered nowrape" cellspacing="0" width="100%">
									<thead>
										<tr>
											<th>Ad</th>
											<th>Soyad</th>
											<th>Cinsiyet</th>
											
										</tr>
									</thead>
									<tbody>
										<?php 
											$sorgu = mysqli_query($baglanti,"SELECT tu.ad as ad,tu.soyad as soyad ,tu.cinsiyet as cinsiyet FROM TBL_Salondakiler as ts , TBL_Kartlar as tk , TBL_Uyeler as tu where ts.kart_id = tk.id and tk.uye_id = tu.id and ts.bilgi = 1");
											$satir = mysqli_num_rows($sorgu);
											
											
												if($satir == 0){
													echo'<tr><td colspan = "3"><marquee>Salonda Bulunan Üye Yok!</marquee></td></tr>';
												}
												else{
													while($sonuc = mysqli_fetch_array($sorgu)){
													echo"<tr>
															<td>$sonuc[ad]</td>
															<td>$sonuc[soyad]</td>
															<td>$sonuc[cinsiyet]</td>
																											
															
														</tr>";
												}}
											 ?>
											 
									</tbody>
									<tfoot>
											<tr><td colspan = "3">Salonda Bulunan Üye Sayısı : &nbsp;<?php $sorgu = mysqli_query($baglanti,"select count(*) as sayi from TBL_Salondakiler"); $sonuc = mysqli_fetch_assoc($sorgu); echo $sonuc['sayi'];?></td></tr>
									</tfoot>
								</table>
							<script>
							 $('#salondakiler').DataTable( {
								responsive: true,
								"bInfo": false
								
							} );
							</script>
							</div>
							<?php }else if($sayfa == "tahsilat"){ ?>
							<div class="panel-body" style = "width:100%;height:100%;">
								<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap.min.css"/>
							<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.1/css/responsive.bootstrap.min.css"/>
							<script type="text/javascript" src="https://code.jquery.com/jquery-1.12.4.js"/></script>
							<script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"/></script>
							<script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap.min.js"/></script>
							<script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.1/js/dataTables.responsive.min.js"/></script>
							
							<table id="tahsilat" class="table table-striped table-bordered nowrape" cellspacing="0" width="100%">
									<thead>
										<tr>
											<th>Ad</th>
											<th>Soyad</th>
											<th>Borç</th>
											<th>İşlemler</th>
											
										</tr>
									</thead>
									<tbody>
										<?php 
											$sorgu = mysqli_query($baglanti,"SELECT tut.id,tu.ad , tu.soyad , tut.ucret FROM TBL_Uye_tarifeler tut , TBL_Uyeler tu where tut.uye_id = tu.id and tahsil_durumu = 0");
											$satir = mysqli_num_rows($sorgu);
											
											
												if($satir == 0){
													echo'<tr><td colspan = "4"><marquee>Ücret tahsil edilecek üye yok.</marquee></td></tr>';
												}
												else{
													while($sonuc = mysqli_fetch_array($sorgu)){
													echo"<tr>
															<td>$sonuc[ad]</td>
															<td>$sonuc[soyad]</td>
															<td>$sonuc[ucret]</td>							
															<td><button onClick='tahsil_et($sonuc[id],$sonuc[ucret])'>Tahsil Et</button></td>
														</tr>";
												}}
											 ?>
											 
									</tbody>
								
								</table>
							<script>
							 $('#tahsilat').DataTable( {
								responsive: true,
								"bInfo": false
							} );
							</script>
							</div>
							<?php }else if($sayfa == "kasa"){?>
							<div class="panel-body" style = "width:100%;height:100%;">
								<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap.min.css"/>
							<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.1/css/responsive.bootstrap.min.css"/>
							<script type="text/javascript" src="https://code.jquery.com/jquery-1.12.4.js"/></script>
							<script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"/></script>
							<script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap.min.js"/></script>
							<script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.1/js/dataTables.responsive.min.js"/></script>
							
							<table id="kasa" class="table table-striped table-bordered nowrape" cellspacing="0" width="100%">
									<thead>
										<tr>
											<th><center style = "font-size:40px;">Kazanç</center></th>
											
											
										</tr>
									</thead>
									<tbody>
										<?php 
													$sorgu = mysqli_query($baglanti,"select * from TBL_Kasa where id = 1");
													$sonuc = mysqli_fetch_array($sorgu);
													echo"<tr align = 'center'  style = 'font-size:30px;'><td>₺$sonuc[kazanc]</td></tr>";
												
											 ?>
											 
									</tbody>
								
								</table>
							<script>
							 $('#kasa').DataTable( {
								responsive: true,
								"bLengthChange": false,
								"bPaginate": false,
								"bInfo": false,
								"searching": false
							} );
							</script>
							</div>
							<?php }else if($sayfa == "kategori_ekle"){?>
							<div class="panel-body" style = "width:100%;height:100%;">
								<div class="form-group">
								<label for="kategori_ekle">Tarifeler</label>
									<select id='kategori_ekle' name='tarife_id' class='form-control' type='text' onchange='tarife_id_al(this)' data-validation='required'>
									<option>Seçiniz</option>
									<?php 
										$sorgu = mysqli_query($baglanti,"select * from TBL_Tarifeler");
										while($sonuc = mysqli_fetch_assoc($sorgu)){
											echo '<option value = '.$sonuc['id'].'>'.$sonuc['tarife_adi'].'</option>';
										}
									?>
									</select>
								</div>
								<div class="form-group">
									<label for="kategori_sayisi">Kaç adet kategori eklenecek?</label>
									<input id="kategori_sayisi" name="kategori_sayisi" class="form-control" type="number" data-validation="required" value = "1">
								</div>
								<div class = "form-group">
									<button onclick = "kategori_olustur();" id="submit" type="submit" value="submit" class="btn btn-primary center" >Oluştur</button>
								</div>
								<div id = "parametreli_kategori" class = "form-group">
									
								</div>
								<script>
									function kategori_olustur(){
										var kategori_sayisi = document.getElementById("kategori_sayisi").value;
										var tmp = document.getElementById("parametreli_kategori");
										var i = 0;
										var myText = "";
										for(i=0;i<kategori_sayisi;i++){
											myText = myText + '<label for="kategori'+(i)+'">Kategori '+(i+1)+'</label><input class="form-control" type = "text" id = "kategori'+i+'"><br>';
										}
										myText = myText + '<button onclick = "kategori_kaydet();" id="submit" type="submit" value="submit" class="btn btn-primary center" >Kaydet</button>';
										tmp.innerHTML = myText;
										
									}
								</script>
							</div>
							<?php }if($sayfa == "kategoriler"){?>
							<div class="panel-body" style = "width:100%;height:100%;">
							<label for="tarife_getir">Tarife seçiniz.</label>
							<select id='tarife_getir' name='tarife_getir' class='form-control' type='text'  data-validation='required' onchange = "tarifeden_kategori_getir(this)">
							<option value = "0">Seçiniz</option>
							<?php 
								$sorgu = mysqli_query($baglanti,"select * from TBL_Tarifeler");
								while($sonuc = mysqli_fetch_assoc($sorgu)){
									echo'<option value = '.$sonuc["id"].'>'.$sonuc["tarife_adi"].'</option>';
								}
							?>
							</select><hr>
							<label for="kategoriler">Kategori seçiniz.</label>
							<select id = "kategoriler" class='form-control' type='text'  data-validation='required' onchange = "kategori_id_al(this)"></select><hr>
							<label for="hareket_sayisi">Kaç adet hareket eklenecek?</label>
									<input id="hareket_sayisi" name="hareket_sayisi" class="form-control" type="number" data-validation="required" value = "1">
									<br>
									<button onclick = "hareket_olustur();" id="submit" type="submit" value="submit" class="btn btn-primary center" >Oluştur</button>
									<hr>
									<div id = "parametreli_hareket"></div>
								</div>
							</div>
							<?php }?>
							
	</div> 
</div>
<div class="modal fade" id="tarifeDuzenleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 align = "center" class="modal-title" id="exampleModalLabel"><b style = "color:red;">Tarife Düzenle</b></h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div id = "tarife_duzenle_modal" class="modal-body">
								<div class="form-group">
									<input type = "hidden" id = "tarife_id">
									<label for="modal_tarife_adi">Tarife Adı</label>
									<input id="modal_tarife_adi" name="tarife_adi" class="form-control" type="text" data-validation="required">
									<span id="modal_tarife_adi_error" class="text-danger"></span>
								</div>
								<div class="form-group">
									<label for="modal_bir_aylik_ucret">1 Aylık Ücret</label>
									<input id="modal_bir_aylik_ucret" name="bir_aylik_ucret" class="form-control" type="number" data-validation="required">
									<span id="modal_bir_aylik_ucret_error" class="text-danger"></span>
								</div>
								<div class="form-group">
									<label for="modal_uc_aylik_ucret">3 Aylık Ücret</label>
									<input id="modal_uc_aylik_ucret" name="uc_aylik_ucret"  class="form-control" type="number" min="1" data-validation="required">
									<span id="modal_uc_aylik_ucret_error" class="text-danger"></span>
								</div>
								<div class="form-group">
									<label for="modal_alti_aylik_ucret">6 Aylık Ücret</label>
									<input id="modal_alti_aylik_ucret" name="alti_aylik_ucret"  class="form-control" type="number" min="1" data-validation="required">
									<span id="modal_alti_aylik_ucret_error" class="text-danger"></span>
								</div>
								<div class="form-group">
									<label for="modal_yillik_ucret">Yıllık Ücret</label>
									<input id="modal_yillik_ucret" name="yillik_ucret"  class="form-control" type="number" min="1" data-validation="required">
									<span id="modal_yillik_ucret_error" class="text-danger"></span>
								</div>
								
      </div>
      <div class="modal-footer">
	  <button type="button" onclick = "tarife_update();" class="btn btn-primary">Kaydet</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Kapat</button>
        
      </div>
    </div>
  </div>
</div>
<!--Modal Program Oluştur -->
<div class="modal fade" id="programOlusturModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 align = "center" class="modal-title" id="exampleModalLabel"><b style = "color:red;">Program Oluştur</b></h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div id = "programOlusturModal_div" class="modal-body">
								<div class="form-group">
								<label for = "kategori_list">Kategori Seçiniz</label>
									<select id='kategori_list' name='kategori_list' class='form-control' type='text'  data-validation='required' onchange = "kategoriden_hareket_getir(this)">
									<option>Seçiniz</option>
									</select>
									<input type = "hidden" id="hidden_uye_id">
									<input type = "hidden" id = "hidden_tarife_id">
								</div>
								<hr>
								<div id="hareketler" class="form-group">
								
								</div>
								
      </div>
      <div class="modal-footer">
	  <button type="button" onclick = "program_kaydet();" class="btn btn-primary">Kaydet</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Kapat</button>
        
      </div>
    </div>
  </div>
</div>
<!-- Modal Uyeye Yeni Tarife Ekle-->
<div class="modal fade" id="uyeyeYeniTarifeEkle" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 align = "center" class="modal-title" id="exampleModalLabel"><b style = "color:red;">Üyeye Yeni Tarife Ekle</b></h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div id = "tarife_duzenle_modal" class="modal-body">
								<div  id = "degisecek_olan"class="form-group">
									
									
									
									</div>
									
									
									
									<div class='form-group'>
									<label for='bir_aylik'>Bir Aylık Ücret</label><br>
									<input style = 'margin-left:10px;' id = 'bir_aylik' type = 'radio' name = 'fiyat' ><label id="label_bir_aylik"></label><br><br><hr>
									<label for='uc_aylik'>Üç Aylık Ücret</label><br>
									<input style = 'margin-left:10px;' id = 'uc_aylik' type = 'radio' name = 'fiyat' ><label id="label_uc_aylik"></label>
									<br><hr>
									<label for='alti_aylik'>Altı Aylık Ücret</label><br>
									<input style = 'margin-left:10px;' id = 'alti_aylik' type = 'radio' name = 'fiyat'>
									<label id="label_alti_aylik"></label>
									<br><hr>
									<label for='yillik'>Yıllık Ücret</label><br>
									<input style = 'margin-left:10px;' id = 'yillik' type = 'radio' name = 'fiyat' >
									<label id="label_yillik"></label>
									<br><hr>
									</div>
									<input type = 'hidden' id = 'uye_id'>
									<input type = 'hidden' id = 'tarife_id2'>
									
									
								
								
								
      </div>
      <div class="modal-footer">
	  <button type="button" onclick = "uyeye_yeni_tarife_kaydet();" class="btn btn-primary">Kaydet</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Kapat</button>
        
      </div>
    </div>
  </div>
</div>
<!-- Uyenin Kayıtlı tarifelerini listele-->
<div class="modal fade" id="kayitli_tarifeler_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 align = "center" class="modal-title" id="exampleModalLabel"><b style = "color:red;">Üyenin Tarifeleri</b></h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div id = "kayitli_tarifeler_modal2" class="modal-body">
							
									
									
					<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/r/bs-3.3.5/jq-2.1.4,dt-1.10.8/datatables.min.css"/>
							<script type="text/javascript" src="https://cdn.datatables.net/r/bs-3.3.5/jqc-1.11.3,dt-1.10.8/datatables.min.js"></script>
							
							 

								<table id="kayitli_tarifeler_table2" class="display the-table" cellspacing="0" width="100%">
									<thead>
										<tr>
											<th>Tarife Adı</th>
											<th>Ücret</th>
											<th>Başlangıç Tarihi</th>
											<th>Bitiş Tarihi</th>
											<th>Ücret Tahsili</th>
											<th>Kalan Gün</th>
											<th>Üyelik Durumu</th>
											<th>İşlemler</th>
										</tr>
									</thead>
									<tbody id = "tarifeler_tbody">
										
									</tbody>
								</table>
								<script type="text/javascript">$('#kayitli_tarifeler_table2').removeClass( 'display' ).addClass('table table-striped table-bordered');</script>				
								
								
								
      </div>
      <div class="modal-footer">
	  
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Kapat</button>
        
      </div>
    </div>
  </div>
</div>
<!-- Modal Tarife Yenile-->
<div class="modal fade" id="tarife_yenile" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 align = "center" class="modal-title" id="exampleModalLabel"><b style = "color:red;">Tarife Yenile</b></h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div id = "tarife_yenile_modal" class="modal-body">
								
									<div class='form-group'>
									<label for='bir_aylik2'>Bir Aylık Ücret</label><br>
									<input checked = "true" style = 'margin-left:10px;' id = 'bir_aylik2' type = 'radio' name = 'fiyat2' >&nbsp;<label id = "bir_aylik_value"></label><br><br><hr>
									<label for='uc_aylik2'>Üç Aylık Ücret</label><br>
									<input style = 'margin-left:10px;' id = 'uc_aylik2' type = 'radio' name = 'fiyat2'>&nbsp;<label id = "uc_aylik_value"></label>
									<br><hr>
									<label for='alti_aylik2'>Altı Aylık Ücret</label><br>
									<input style = 'margin-left:10px;' id = 'alti_aylik2' type = 'radio' name = 'fiyat2'>
									&nbsp;<label id = "alti_aylik_value"></label>
									<br><hr>
									<label id = "degistirbakem" for='yillik2'>Yıllık Ücret</label><br>
									<input style = 'margin-left:10px;' id = 'yillik2' type = 'radio' name = 'fiyat2' >
									<label id = "yillik_value"></label>
									<br><hr>
									</div>
									<input type = 'hidden' id = 'uye_tarife_id2'>
										
									
									
								
								
								
      </div>
      <div class="modal-footer">
	  <button type="button" onclick = "tarife_yenile_update()" class="btn btn-primary">Kaydet</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Kapat</button>
        
      </div>
    </div>
  </div>
</div>
<script>
function openNav() {
    document.getElementById("mySidenav").style.width = "250px";
    document.getElementById("main").style.marginLeft = "250px";
    document.body.style.backgroundColor = "rgba(0,0,0,0.4)";
}

function closeNav() {
    document.getElementById("mySidenav").style.width = "0";
    document.getElementById("main").style.marginLeft= "0";
    document.body.style.backgroundColor = "white";
}
</script>

	







<!-- =========================
    HOME SECTION   
============================== -->



<!-- =========================
    TESTIMONIAL SECTION   
============================== -->


<!-- =========================
     SCRIPTS   
============================== -->
<script src="js/jquery.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.parallax.js"></script>
<script src="js/jquery.nav.js"></script>
<script src="js/jquery.backstretch.min.js"></script>
<script src="js/owl.carousel.min.js"></script>
<script src="js/smoothscroll.js"></script>
<script src="js/wow.min.js"></script>
<script src="js/custom.js"></script>

</body>
</html>