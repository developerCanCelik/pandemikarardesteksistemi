<?php 


ob_start();
session_start(); 
include 'islemler/baglan.php';
include 'fonksiyonlar.php';

oturumkontrol();

$ayarsor=$db->prepare("SELECT * FROM ayarlar");
$ayarsor->execute();
$ayarcek=$ayarsor->fetch(PDO::FETCH_ASSOC);

$kullanici=$db->prepare("SELECT * FROM kullanicilar where session_mail=:mail");
$kullanici->execute(array(
	'mail' => $_SESSION['kul_mail']
));

$say=$kullanici->rowcount();
$kullanicicek=$kullanici->fetch(PDO::FETCH_ASSOC);
if ($say==0) {
	header("location:login?durum=izinsiz");
	exit;
};



if ($kullanicicek['ip_adresi']!=$_SERVER['REMOTE_ADDR']) {
	header("location:login?durum=suphe");
	session_destroy();
	exit;
}



?>
<!DOCTYPE html>
<html lang="tr">
<head>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge"/>
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="<?php echo $ayarcek['site_aciklama'] ?>">
	<meta name="author" content="<?php echo $ayarcek['site_sahibi'] ?>">
	<link rel="shortcut icon" type="image/png" href="<?php echo $ayarcek['site_logo'] ?>">

	<title><?php echo $ayarcek['site_baslik'] ?></title>


	<link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
	<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
	
	<script src="vendor/jquery/jquery.min.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

	<link href="css/sb-admin-2.min.css" rel="stylesheet">
	<style type="text/css" media="screen">
		.file-details-cell {
			display: none
		}
	</style>
	
</head>
<body id="page-top">

	<div id="wrapper">

		<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

			<li class="nav-item mt-1 mb-1">
				<center>
					<a class="nav-link" style="text-align: center;" href="index.php" title="Ana Sayfa">
						<img style="width: 50%; height: auto;" src="<?php echo $ayarcek['site_logo'] ?>" alt="<?php echo $ayarcek['site_baslik'] ?>">
					</a>
				</center>
			</li>

		
			<hr class="sidebar-divider my-0">

			<li class="nav-item">
				<a class="nav-link" href="index.php">
					<i class="fas fa-home"></i>
					<span>Ana Sayfa</span></a>
				</li>

				
				<hr class="sidebar-divider">

			
				<div class="sidebar-heading">
					Seçenekler
				</div>

				

				<li class="nav-item">
					<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseone" aria-expanded="true" aria-controls="collapseone">
						<i class="fas fa-tasks"></i>
						<span>Birimler</span>
					</a>
					<div id="collapseone" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
						<div class="bg-white py-2 collapse-inner rounded">
							<h6 class="collapse-header">Birim İşlemleri</h6>
							<a class="collapse-item" href="birimler">Tüm Birimler</a>
							<?php 
							if (yetkikontrol()=="yetkili") {?>
								<a class="collapse-item" href="birimekle">Birim Ekle</a>
							<?php } ?>
							
						</div>
					</div>
				</li>
				<li class="nav-item">
					<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsefour" aria-expanded="true" aria-controls="collapsefour">
						<i class="fas fa-laptop-code"></i>
						<span>Çalışanlar</span>
					</a>
					<div id="collapsefour" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
						<div class="bg-white py-2 collapse-inner rounded">
							<h6 class="collapse-header">Çalışan İşlemleri</h6>
							<a class="collapse-item" href="calisanlar">Tüm Çalışanlar</a>
							<?php 
							if (yetkikontrol()=="yetkili") {?>
								<a class="collapse-item" href="calisanekle">Çalışan Ekle</a>
							<?php } ?>
							
						</div>
					</div>
				</li>
				

				<li class="nav-item">
					<a class="nav-link" href="profil">
						<i class="fas fa-user-circle"></i>
						<span>Profil</span>
					</a>
				</li>
			

				<li class="nav-item">
					<a class="nav-link" href="#" data-toggle="modal" data-target="#logoutModal">
						<i class="fas fa-sign-out-alt fa-sm fa-fw mr-2"></i>
						<span>Oturumu Kapat</span>
					</a>
				</li>




				<hr class="sidebar-divider">

			</ul>
		
			<div id="content-wrapper" class="d-flex flex-column">

				<div id="content">

				
					<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

					
						<button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
							<i class="fa fa-bars"></i>
						</button>

					
						<form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100">				
							<div class="input-group">
								<label><?php echo $ayarcek['site_baslik'] ?></label>
							</div>							
						</form>

					
						<ul class="navbar-nav ml-auto"> 
						
							<li class="nav-item dropdown no-arrow">
								<a class="nav-link dropdown-toggle" id="userDropdown" data-toggle="dropdown" >
									<span class="mr-2 d-none d-lg-inline text-gray-600 small">
										<?php echo $kullanicicek['kul_isim']; ?>
									</span>
								</a>
							
								<div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
									<a class="dropdown-item" href="profil">
										<i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
										Profil
									</a>

									<div class="dropdown-divider"></div>
									<a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
										<i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
										Oturumu Kapat
									</a>
								</div>
							</li>
						</ul>
					</nav>
				
					<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
						<div class="modal-dialog" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title" id="exampleModalLabel">Oturum Kapatma</h5>
									<button class="close" type="button" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">×</span>
									</button>
								</div>
								<div class="modal-body">Oturumu kapatmak istediğinize emin misiniz?</div>
								<div class="modal-footer">
									<button class="btn btn-secondary" type="button" data-dismiss="modal">İptal</button>
									<a class="btn btn-primary" href="islemler/cikis">Çıkış Yap</a>
								</div>
							</div>
						</div>
					</div>
		
					<script type="text/javascript">
						var genislik = $(window).width()   
						if (genislik < 768) {
							function gizle(){
								$('#sidebarToggleTop').trigger('click');
							}
							setTimeout("gizle()",1);
						}
					</script>
