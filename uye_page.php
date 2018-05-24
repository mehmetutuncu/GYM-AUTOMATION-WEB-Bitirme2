<?php
session_start();
include"config.php";

$sayfa=isset($_GET["sayfa"]) ? $_GET["sayfa"] : "";
if($sayfa == ""){
	$sayfa = "profil";
}
if(isset($_SESSION["girisBilgisi"]) ){

	if($_SESSION["girisBilgisi"] == "uyeGirisiYapildi"){
			$kullanici = $_SESSION['kullanici'];
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
	function profil_guncelle(){
		var cepno = document.getElementById("cepno").value;
		var adres = document.getElementById("adres").value;
		var sifre = document.getElementById("sifre").value;
		var kul_adi = document.getElementById("hidden_kul_adi").value;
		if(cepno == ""){
			document.getElementById("cepno_error").innerHTML = "Cep Telefonu boş bırakılamaz. Lütfen doldurunuz!";
		}
		else if(cepno.length <11){
			document.getElementById("cepno_error").innerHTML = "Cep Telefonu numaranızın başına '0' ekleyip 11 karakter olacak şekilde giriniz!";
		}
		else if(adres == ""){
			document.getElementById("adres_error").innerHTML = "Adres bilgilerinizi doldurunuz.";
		}
		else if(sifre == ""){
			document.getElementById("sifre.error").innerHTML = "Şifre boş bırakılamaz";
		}
		else if(sifre.length < 8){
			document.getElementById("sifre_error").innerHTML = "Şifre en az 8 karakterden oluşmak zorundadır.";
		}
		else{
			$.post("postlar.php",{profil_guncelle_kul_adi:kul_adi,cepno:cepno,adres:adres,sifre:sifre},
			function(result){
				if(result == "1"){
					alert("Profil başarı ile güncellendi.");
					location.reload();
				}
				else{
					alert("İşlem sırasında hata algılandı. Tekrar deneyiniz.");
				}
			});
		}
	}
	function tarife_id_al(value){
		var tarife_id = value;
		var uye_id = document.getElementById("hidden_uye_id").value;

			program_getir(tarife_id,uye_id);
	}
	function program_getir(tarife_id,uye_id){
		var tarife_id = tarife_id;
		var uye_id = uye_id;
		var tbody = document.getElementById("programlar_tbody");
		$.post("./JsonUyeler/programGetir.php",{tarife_id:tarife_id,uye_id:uye_id},
		function(result){
				var program = JSON.parse(result);

				var myText = "";
				var i = 0;
				if(program.length == 0){
					myText= "<tr><td colspan = '5'><marquee>Tarife Seçiniz!</marquee></td></tr>";
				}
				else{
					while(i != program.length){
						myText =  myText + "<tr><td>"+program[i].kategori_adi+"</td><td>"+program[i].hareket_adi+"</td><td>"+program[i].h_set+"</td><td>"+program[i].h_tekrar+"</td><td><a target = '_blank' href = 'https://www.youtube.com/embed/"+program[i].link+"'>Hareketin Videosunu İzle</a></td></tr>";
						i++;
					}
				}

				tbody.innerHTML = myText;

		});
	}
	function videoLinkGonder(videoLink,i){
		var modal_id = document.getElementById("myModal").id;
		modal_id.id = "myModal"+i;
		var videoLink = videoLink;
		var link ="https://www.youtube.com/embed/"+videoLink;
		var degisecek = document.getElementById("iframe");
		degisecek.src = link;

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
  <a <?php if($sayfa =="profil") echo"style='color:white;'"?> href="uye_page.php?sayfa=profil">Profil</a>
  <a <?php if($sayfa == "tarifeler") echo "style='color:white;'"?> href="uye_page.php?sayfa=tarifeler">Tarifeler</a>
		<a <?php if($sayfa == "programlar") echo "style='color:white;'"?> href="uye_page.php?sayfa=programlar">Program Sayfası</a>

  <a href="logout.php">Çıkış Yap</a>
  </ul>
</div>

<div id="main">
  <span style="font-size:30px;cursor:pointer;color:red;" onclick="openNav()">&#9776;</span>
    <div class="panel panel-default">

							<?php if($sayfa == "profil"){
								$sorgu = mysqli_query($baglanti,"SELECT tu.ad , tu.soyad , tu.tcno , tu.cepno,tu.adres,tu.kul_adi,tu.sifre,tk.kart_no FROM TBL_Uyeler tu , tbl_kartlar as tk where kul_adi = '".$kullanici."' and tu.id = tk.uye_id;");
								$sonuc = mysqli_fetch_assoc($sorgu);
							?>
							<div class="panel-body" style = "width:auto;height:auto;">
							<span style = "font-size:20px;"class="text-danger"><center>Hoşgeldin <?php echo $kullanici?> , Kendi Profilini Görüntülemektesin.</center></span>

								<div class="form-group">
									<label for="ad">Ad</label>
									<input id="ad" name="ad" class="form-control" type="text" value = "<?php echo $sonuc['ad'];?>" disabled>
									<span id="ad_error" class="text-danger"></span>
								</div>
								<div class="form-group">
									<label for="soyad">Soyad</label>
									<input id="soyad" name="soyad" class="form-control" type="text"   value = "<?php echo $sonuc['soyad'];?>" disabled>
									<span id="soyad_error" class="text-danger"></span>
								</div>
								<div class="form-group">
									<label for="tcno">TC Numarası</label>
									<input id="tcno" name="tcno" class="form-control" type="number"   value = "<?php echo $sonuc['tcno'];?>" disabled>
									<span id="tcno_error" class="text-danger"></span>
								</div>
								<div class="form-group">
									<label for="cepno">*Cep Telefonu</label>
									<input id="cepno" name="cepno" class="form-control" type="number"  onkeyup= "limit(11);" value = "<?php echo $sonuc['cepno'];?>" >
									<br>
									<span style = "font-size:20px;" id="cepno_error" class="text-danger"></span>
									<input id = "hidden_kul_adi" type = "hidden" value = "<?php echo $kullanici;?>">
								</div>
								<script>
									function limit(max) {
										var textarea = document.getElementById('cepno');
										if (textarea.value.length > max) {
											textarea.value = textarea.value.substring(0, max);
										}
									}
								</script>
								<div class="form-group">
									<label for="adres">*Adres</label>
									<input id="adres" name="adres" class="form-control" type="text"   value = "<?php echo $sonuc['adres'];?>" >
									<span style = "font-size:20px;"id="adres_error" class="text-danger"></span>
								</div>
								<div class="form-group">
									<label for="kartno">Kart Numarası</label>
									<input id="kartno" name="kart_no" class="form-control" type="text" value = "<?php echo $sonuc['kart_no'];?>" disabled>
									<span id="kartno_error" class="text-danger"></span>
								</div>
								<div class="form-group">
									<label for="kul_adi">Kullanıcı Adı</label>
									<input id="kul_adi" name="kul_adi" class="form-control" type="text" value = "<?php echo $sonuc['kul_adi'];?>" disabled>
									<span id="kul_adi_error" class="text-danger"></span>
								</div>
								<div class="form-group">
									<label for="sifre">*Şifre</label>
									<input id="sifre" name="sifre" class="form-control" type="password" value = "<?php echo $sonuc['sifre'];?>" >
									<span style = "font-size:20px;" id="sifre_error" class="text-danger"></span>
								</div>
								<div class="form-group">
								<span style = "font-size:20px;"class="text-danger"><center>* İle Gösterilen kısımlar boş bırakılamaz.</center></span>
								</div>
								<div class="form-group" align = "center" >
									<button onclick = "profil_guncelle();" id="submit" type="submit" value="submit" class="btn btn-primary center"><i class="fa fa-save">&nbsp;Güncelle</i></button>
								</div>

							</div>
						<?php } else if($sayfa == "tarifeler"){ ?>
										  <div class="panel panel-default">
												<div class="panel-body" style = "width:100%;height:100%;">
												<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"/>
												<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap.min.css"/>
												<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.1/css/responsive.bootstrap.min.css"/>
												<script type="text/javascript" src="https://code.jquery.com/jquery-1.12.4.js"/></script>
												<script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"/></script>
												<script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap.min.js"/></script>
												<script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.1/js/dataTables.responsive.min.js"/></script>
												<script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.1/js/responsive.bootstrap.min.js"/></script>
												<table id="tarifeler_Table" class="table table-striped table-bordered nowrap" style="width:100%">
													<thead>
														<tr>
															<th>Tarife Adı</th>
															<th>Ücret</th>
															<th>Başlangıç Tarihi</th>
															<th>Bitiş Tarihi</th>
															<th>Kalan Gün</th>
															<th>Donma Durumu</th>
															<th>Program Durumu</th>
														</tr>
													</thead>
													<tbody id="tarifeler">
													<?php
															$id_getir = mysqli_query($baglanti,"select id from TBL_Uyeler where kul_adi = '$kullanici'");
															$id_sonuc = mysqli_fetch_array($id_getir);
															$uye_id = $id_sonuc['id'];
															$tarife_getir = mysqli_query($baglanti,"select tut.id,tt.tarife_adi,tut.ucret,tut.baslangic_tarihi,tut.bitis_tarihi,tut.kalan_gun,tut.donma,tut.program from TBL_Uye_Tarifeler as tut , TBL_Tarifeler as tt where uye_id = '$uye_id' and tut.tarife_id = tt.id");
															$satir = mysqli_num_rows($tarife_getir);


																	if($satir == 0){
																		echo'<tr><td colspan = "7"><marquee>Kayıtlı Tarife Yok</marquee></td></tr>';
																	}
																	else{
																		while($sonuc = mysqli_fetch_array($tarife_getir)){
																			if($sonuc['donma'] == '0'){
																				$uyelik_donma = "Üyelik Aktif";
																			}
																			else{
																				$uyelik_donma = "Üyelik Pasif";
																			}
																			if($sonuc['program'] == 0)
																			{
																				$program_durumu = "Program Mevcut Değil";
																			}
																			else{
																				$program_durumu = "Program Mevcut";
																			}

																		echo"<tr style = 'cursor:pointer;' onclick= 'uye_detay(this,$sonuc[id])'>

																				<td>$sonuc[tarife_adi]</a></td>
																				<td>$sonuc[ucret]</td>
																				<td>$sonuc[baslangic_tarihi]</td>
																				<td>$sonuc[bitis_tarihi]</td>
																				<td>$sonuc[kalan_gun]</td>
																				<td>$uyelik_donma</td>
																				<td>$program_durumu</td>


																			</tr>";
																	}}
													?>
													</tbody>
													<tfoot>
														<tr>
															<th>Tarife Adı</th>
															<th>Ücret</th>
															<th>Başlangıç Tarihi</th>
															<th>Bitiş Tarihi</th>
															<th>Kalan Gün</th>
															<th>Donma Durumu</th>
															<th>Program Durumu</th>
														</tr>
													</tfoot>
												</table>
												<script>
												$('#tarifeler_Table').DataTable( {
													responsive: true

												} );
												</script>
											</div>
						<?php }else if($sayfa == "programlar"){ ?>
									<div class="panel panel-default" >
										<div class="form-group" style = "margin:10px 10px 10px 10px;">
										<label for="program_tarifeler">Tarifeler</label>

											<select class="form-control" id = "program_tarifeler" onchange='tarife_id_al(this.value)' data-validation='required'>
												<option>Seçiniz</option>
												<?php
															$id_getir = mysqli_query($baglanti,"select id from TBL_Uyeler where kul_adi = '$kullanici'");
															$id_sonuc = mysqli_fetch_array($id_getir);
															$uye_id = $id_sonuc['id'];
															$sorgu = mysqli_query($baglanti,"select tut.tarife_id , tt.tarife_adi from TBL_Uye_Tarifeler as tut , TBL_Tarifeler as tt where program = '1' and uye_id = '$uye_id' and tut.tarife_id = tt.id");
															$satir = mysqli_num_rows($sorgu);

															if($satir == 0){
																echo '<option>Tarife Yok</option>';
															}
															else{
																while($sonuc = mysqli_fetch_array($sorgu)){

																	echo '<option value = '.$sonuc['tarife_id'].'>'.$sonuc['tarife_adi'].'</option>';
																}
																echo '<input type="hidden" id="hidden_uye_id" value='.$uye_id.'>';
															}
												?>

											</select>
									</div>
									<div class="panel-body" style = "width:100%;height:100%;">
									<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"/>
									<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap.min.css"/>
									<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.1/css/responsive.bootstrap.min.css"/>
									<script type="text/javascript" src="https://code.jquery.com/jquery-1.12.4.js"/></script>
									<script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"/></script>
									<script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap.min.js"/></script>
									<script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.1/js/dataTables.responsive.min.js"/></script>
									<script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.1/js/responsive.bootstrap.min.js"/></script>
									<table id="tarifeler_Table" class="table table-striped table-bordered nowrap" style="width:100%">
										<thead>
											<tr>
												<th>Bölge Adı</th>
												<th>Hareket Adı</th>
												<th>Set</th>
												<th>Tekrar</th>
												<th>Link</th>
											</tr>
										</thead>
										<tbody id="programlar_tbody">
											<tr>
												<td colspan ="5"><marquee>Tarife Seçiniz!</marquee></td>

											</tr>
										</tbody>
										<tfoot>
											<tr>
												<th>Bölge Adı</th>
												<th>Hareket Adı</th>
												<th>Set</th>
												<th>Tekrar</th>
												<th>Link</th>
											</tr>
										</tfoot>
									</table>
									<script>
									$('#tarifeler_Table').DataTable( {
										responsive: true,
										bPaginate: false



									} );
									</script>
								</div>
								</div>
						<?php } ?>

	</div>
</div>
<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Modal Header</h4>
      </div>
      <div class="modal-body">
				<div class="embed-responsive embed-responsive-16by9">
				  <iframe id = "iframe" class="embed-responsive-item" src="" allowfullscreen></iframe>
				</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
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
