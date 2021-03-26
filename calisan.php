<?php 
include 'header.php' ;

if (isset($_POST['calisan_id'])) {
	if (is_numeric($_POST['calisan_id'])) {
		$siparissor=$db->prepare("SELECT * FROM calisanlar where calisan_id=:id");
		$siparissor->execute(array(
			'id' => guvenlik($_POST['calisan_id'])
		));
		$sipariscek=$siparissor->fetch(PDO::FETCH_ASSOC);
	} else {
		header("location:calisanlar?durum=hata");
	}
} else {
	header("location:calisanlar.php");
} 
?>
<?php
$siparisdetaymetni=$sipariscek['calisan_detay'];

?>
<style type="text/css" media="screen">
	.file-details-cell {
		display: none
	}
</style>
<link rel="stylesheet" media="all" type="text/css" href="vendor/upload/css/fileinput.min.css">
<link rel="stylesheet" type="text/css" media="all" href="vendor/upload/themes/explorer-fas/theme.min.css">
<script src="vendor/upload/js/fileinput.js" type="text/javascript" charset="utf-8"></script>
<script src="vendor/upload/themes/fas/theme.min.js" type="text/javascript" charset="utf-8"></script>
<script src="vendor/upload/themes/explorer-fas/theme.minn.js" type="text/javascript" charset="utf-8"></script>
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="card shadow mb-4">
				<div class="card-header py-3">
					<h5 class="m-0 font-weight-bold text-primary"><?php echo $sipariscek['calisan_ismi'] ?></h5>
				</div>
				<div class="card-body">
					<form action="islemler/islem.php" method="POST">
						<div class="form-row">
							<div class="form-group col-md-6">
								<label>İsim Soyisim</label>
								<input disabled="" type="text" class="form-control" name="calisan_ismi" value="<?php echo $sipariscek['calisan_ismi'] ?>">
							</div>
							<div class="form-group col-md-6">
								<label>E-Posta</label>
								<input disabled="" type="email" class="form-control" name="calisan_mail" value="<?php echo $sipariscek['calisan_mail'] ?>">
							</div>	
						</div>
						<div class="form-row">
							<div class="form-group col-md-6">
								<label>Telefon Numarası</label>
								<input disabled="" type="number" class="form-control" name="calisan_telefon" value="<?php echo $sipariscek['calisan_telefon'] ?>">
							</div>
							<div class="form-group col-md-6">
								<label>Birim Adı</label>
								<input disabled="" type="text" class="form-control" name="calisan_birim" value="<?php echo $sipariscek['calisan_birim'] ?>">
							</div>
						</div>
						<div class="form-row">
							<div class="form-group col-md-6">
								<label>Test Sonucu</label>
								<input disabled="" type="text" class="form-control" name="calisan_sonuc" value="<?php echo $sipariscek['calisan_sonuc'] ?>">
							</div>
							<div class="form-group col-md-6">
								<label>Test Sonucu No</label>
								<input disabled="" type="text" class="form-control" name="calisan_test_id" value="<?php echo $sipariscek['calisan_test_id'] ?>">
							</div>
						</div>
						<div class="form-row">
							<div class="form-group col-md-6">
								<label>Çalışan Durumu</label>
								<input disabled="" type="text" class="form-control" name="calisan_durum" value="<?php echo $sipariscek['calisan_durum'] ?>">
							</div>
							<div class="form-group col-md-6">
								<label>Çalışan Durum No</label>
								<input disabled="" type="text" class="form-control" name="calisan_durum_id" value="<?php echo $sipariscek['calisan_durum_id'] ?>">
							</div>
						</div>				
						<div class="form-row mt-2">
							<div class="form-group col-md-12">
								<textarea class="ckeditor" name="calisan_detay" id="editor"><?php echo $sipariscek['calisan_detay']?></textarea>
							</div>
						</div>					
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
</div>
<?php include 'footer.php' ?>
<script src="ckeditor/ckeditor.js"></script>
<script>
	CKEDITOR.replace('editor');
</script>
