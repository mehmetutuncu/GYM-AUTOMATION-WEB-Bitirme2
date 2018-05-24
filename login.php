<?php 
	session_start();
	include("config.php"); 
	if(isset($_SESSION["girisBilgisi"])){
		
		if($_SESSION["girisBilgisi"] == "uyeGirisiYapildi"){
			echo '<script language="javascript">location.href="uye_page.php";</script>';
		}
		else if($_SESSION["girisBilgisi"] == "adminGirisiYapildi"){
			echo '<script language="javascript">location.href="admin_page.php";</script>';
		}
	}
	

?>
<!DOCTYPE html>
<html lang="en">
<head>
<!--
Fitness Template
http://www.templatemo.com/tm-487-fitness
-->
<title><?php echo $veri['title']; ?></title>
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
<!-- Main css -->
<link rel="stylesheet" href="css/style.css">
<!-- Google Font -->
<link href='https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,300,600' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Lora:700italic' rel='stylesheet' type='text/css'>
<script>
	function tc_dogrulama_secimi(){
		 var kullanici = document.getElementById("girisSecimi");
		 kullanici.innerHTML='<h2 class="form-login-heading"style = "color:white">Üye Doğrulama</h2><div class="login-wrap"><input id="tcno_dogrulama" type="number" class="form-control" placeholder="TC Kimlik Numaranızı Giriniz!" onkeyup="limit(11);" autofocus name="tcno"><br><span style = "font-size:30px;color:red;" id="tcno_error" class="text-danger"></span><button onClick= "uye_dogrulama()" class="btn btn-theme btn-block"  name="dogrulama" type="submit"><i class="fa fa-check-circle" aria-hidden="true"></i>Kontrol Et</button><input type="button" class="btn btn-theme btn-block" value="Geri Dön" onClick="javascript:history.go(0);" /></div>';
	}
	function limit(max) {
		var textarea = document.getElementById('tcno_dogrulama');
		if (textarea.value.length > max) {
			textarea.value = textarea.value.substring(0, max);
		} 
	}
	function uye_dogrulama(){
		var tcno = document.getElementById("tcno_dogrulama").value;
		if(tcno == ""){
			document.getElementById("tcno_error").innerHTML = "Lütfen TC Kimlik Numaranızı Giriniz.";
		}
		else{
				$.post("postlar.php",{tcno_dogrulama:tcno},
				function(result){
				if(result == "1"){
					uyelik_kontrol(tcno);
					//kayit_secimi(tcno);
				}
				else{
					document.getElementById("tcno_error").innerHTML = "Bu TC Kimlik Numarası Mevcut Değildir. Yönetici ile iletişime geçiniz.";
				}
		});
		}
	}
	function uyelik_kontrol(tcno){
		$.post("postlar.php",{tcno_uyelik_kontrol:tcno},
				function(result){
				if(result == "1"){
					kayit_secimi(tcno);
				}
				else{
					document.getElementById("tcno_error").innerHTML = "Bu TC Kimlik Numarası ile açılmış bir üyelik mevcut.";
				}
		});
	}
	function kayit_secimi(tcno){
		 var kullanici = document.getElementById("girisSecimi");
		 kullanici.innerHTML='<h2 class="form-login-heading"style = "color:red">KAYIT OL</h2><div class="login-wrap"><label syle="float:left" for="kulAdi">Kullanıcı Adı</label><input id="kulAdi" type="text" class="form-control" placeholder="Kullanıcı adını giriniz" autofocus name="kullanici"><br><label syle="float:left" for="sifre">Şifre</label><input id = "sifre" type="password" class="form-control" placeholder="Şifrenizi giriniz." name="parola"><span style = "font-size:30px;color:red;" id="kayit_error" class="text-danger"></span><button onClick= "kayitOl()" class="btn btn-theme btn-block"  name="giris" type="submit"><i class="fa fa-user-plus" aria-hidden="true"></i>Kayıt Ol</button><input type="button" class="btn btn-theme btn-block" value="Geri Dön" onClick="javascript:history.go(0);" /><input id = "hidden_tcno" type = "hidden" value ='+tcno+'></div>';
	}
	function kayitOl(){
		 var kulKayitAdi = document.getElementById("kulAdi").value;
		 var sifre = document.getElementById("sifre").value;
		 var tcno = document.getElementById("hidden_tcno").value;
		 console.log(tcno);
		 if(kulAdi == "" || sifre == ""){
			document.getElementById("kayit_error").innerHTML = "Kullanıcı Adı ve Parola Boş Bırakılamaz.";
		 }
		 else{
			 $.post("postlar.php", {kulKayitAdi:kulKayitAdi,sifre:sifre,tcno:tcno}, 
				 function(result){
					
					 if(result == "kullanici_mevcut"){
						document.getElementById("kayit_error").innerHTML = "Kullanıcı Adı Mevcut Lütfen Yeni Bir Kullanıcı Adı Seçiniz.";
					 }
					 else if(result == "1"){
						 alert("Kayıt Başarılı");
						 location.href = "login.php";
					 }
					 else{
						 document.getElementById("kulAdi").value = "";
						 document.getElementById("sifre").value = "";
						 document.getElementById("kayit_error").innerHTML = "Hata ile karşılaşıldı. Lütfen Tekrar Deneyiniz.";
					 }
				 });
		 }
	 }
	function yoneticiSecimi(){
		var kullanici = document.getElementById("girisSecimi");
		kullanici.innerHTML='<h2 class="form-login-heading"style = "color:white;font-family:sans-serif;">YÖNETİCİ GİRİŞİ</h2><div class="login-wrap"><input id="adminAdi" type="text" class="form-control" placeholder="Admin Kullanıcı Adı" autofocus name="kullanici"><br><input id = "sifre" type="password" class="form-control" placeholder="Şifre" name="parola"><button onClick= "yoneticiKontrol()" class="btn btn-theme btn-block"  name="giris" type="submit"><i class="fa fa-lock"></i> Giriş Yap</button><input type="button" class="btn btn-theme btn-block" value="Geri Dön" onClick="javascript:history.go(0);" /></div>';
	}
	function yoneticiKontrol(){
		var adminAdi = document.getElementById("adminAdi").value;
		var sifre = document.getElementById("sifre").value;
		if(sifre == "" || adminAdi == ""){
			alert("Kullanıcı adı ve Şifre kısımları boş bırakılamaz.");
		}
		else{
			$.post("postlar.php", {adminAdi:adminAdi,sifre:sifre}, 
				function(result){
					if(result == "1"){
						alert("Kullanıcı adı ve Şifre doğru.Yönlendiriliyorsunuz..");
						var Session = "adminGirisiYapildi";
						sessionOlustur(Session);
						var Session2 = adminAdi;
						sessionOlustur(Session2);
						location.href = "admin_page.php";
					}
					else{
						alert("Böyle bir kullanıcı adı ve şifre mevcut değil. Lütfen tekrar deneyiniz.");
					    document.getElementById("adminAdi").value = "";
						document.getElementById("sifre").value = "";
					}
				});
		}
	}
	function kullaniciSecimi(){
		var kullanici = document.getElementById("girisSecimi");
		kullanici.innerHTML='<h2 class="form-login-heading"style = "color:white;font-family:sans-serif;">ÜYE GİRİŞİ</h2><div class="login-wrap"><input id="kulAdi" type="text" class="form-control" placeholder="Kullanıcı Adı" autofocus name="kullanici"><br><input id = "sifre" type="password" class="form-control" placeholder="Şifre" name="parola"><button onClick= "kullaniciKontrol()" class="btn btn-theme btn-block"  name="giris" type="submit"><i class="fa fa-lock"></i> Giriş Yap</button><input type="button" class="btn btn-theme btn-block" value="Geri Dön" onClick="javascript:history.go(0);" /></div>';
	}
	function kullaniciKontrol(){
		var kulAdi = document.getElementById("kulAdi").value;
		var sifre = document.getElementById("sifre").value;
		if(sifre == "" || kulAdi == ""){
			alert("Kullanıcı adı ve Şifre kısımları boş bırakılamaz.");
		}
		else{
			$.post("postlar.php", {kulAdi:kulAdi,sifre:sifre}, 
				function(result){
					if(result == "1"){
						alert("Kullanıcı adı ve Şifre doğru.Yönlendiriliyorsunuz..");
						var Session = "uyeGirisiYapildi";
						var Session2 = kulAdi;
						sessionOlustur(Session);
						sessionOlustur(Session2);
						location.href = "uye_page.php";
					}
					else{
						alert("Böyle bir kullanıcı adı ve şifre mevcut değil. Lütfen tekrar deneyiniz.");
					    document.getElementById("kulAdi").value = "";
						document.getElementById("sifre").value = "";
					}
				});
		}
	}
	function sessionOlustur(Session){
		$.post("postlar.php",{Session:Session},function(result){
			
		});
	}
</script>
</head>
<body data-spy="scroll" data-target=".navbar-collapse" data-offset="50">


<!-- =========================
     PRE LOADER       
============================== -->
<div  class="preloader">

	<div class="sk-spinner sk-spinner-pulse"></div>

</div>


<!-- =========================
    NAVIGATION SECTION   
============================== -->
<div class="navbar navbar-default navbar-fixed-top sticky-navigation" role="navigation">
	<div class="container">

		<div class="navbar-header">
			<button class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
				<span class="icon icon-bar"></span>
				<span class="icon icon-bar"></span>
				<span class="icon icon-bar"></span>
			</button>
			<a href="#" class="navbar-brand">Fitness</a>
		</div>
		<div class="collapse navbar-collapse">
			<!--<ul class="nav navbar-nav navbar-right main-navigation">
				<li><a href="#home" class="smoothScroll">Home</a></li>
				<li><a href="#overview" class="smoothScroll">About</a></li>
				<li><a href="#trainer" class="smoothScroll">Trainers</a></li>
				<li><a href="#blog" class="smoothScroll">Blog</a></li>
				<li><a href="#price" class="smoothScroll">Prices</a></li>
				<li><a href="#testimonial" class="smoothScroll">Testimonials</a></li>
			</ul>-->
		</div>

	</div>
</div>


<!-- =========================
    HOME SECTION   
============================== -->
<section id="home" class="parallax-section">
	<div class="container">
		<div class="row">

			
						
						  <div id = "girisSecimi" class="container">
						  <div>
							<h2 style = "color:white;"><?php echo $veri['title']; ?></h2>
						  </div>
							<div>
								<button style = "background-color:white;color:black;width:300px;" class="btn btn-primary btn-lg" onClick = "kullaniciSecimi();">Kullanıcı Girişi</button>
							</div>
							<div>
								<button style = "background-color:white;color:black;width:300px;" class="btn btn-primary btn-lg" onClick = "yoneticiSecimi();">Yönetici Girişi</button>
							</div>
							<div>
								 <button  style = "background-color:white;color:black;width:300px;" class="btn btn-primary btn-lg" onClick = "tc_dogrulama_secimi();">Durma Bize Katıl</button>
							</div>
						  </div>
						
			

		</div>
		
	</div>
</section>


<!-- =========================
    OVERVIEW SECTION   
============================== -->



<!-- =========================
    TRAINER SECTION   
============================== -->



<!-- =========================
    NEWSLETTER SECTION   
============================== -->



<!-- =========================
    PRICE SECTION   
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