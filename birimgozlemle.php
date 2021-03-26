<?php 
include 'header.php' ;
if (isset($_POST['birim_bak'])) {
	if (is_numeric($_POST['birim_id'])) {

		$projesor=$db->prepare("SELECT * FROM birim where birim_id=:id");
		$projesor->execute(array(
			'id' => guvenlik($_POST['birim_id'])
		));
		$projecek=$projesor->fetch(PDO::FETCH_ASSOC);
	} else {
		header("location:birimler?durum=hata");
	}

} else {
	header("location:birimler.php");
} 
?>

<?php
$projenindetaymetni=$projecek['birim_detay'];
?>
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
					<h5 class="m-0 font-weight-bold text-primary"><?php echo $projecek['birim_ad'] ?></h5>
				</div>
				<div class="card-body">
					<form action="islemler/islem.php" method="POST">
						<div class="form-row">
							<div class="form-group col-md-6">
								<label>Proje Başlık</label>
								<input disabled type="text" class="form-control" name="birim_ad" value="<?php echo $projecek['birim_ad'] ?>">
							</div>
						</div>
						<div class="form-row">
							<?php $aciliyet=$projecek['birim_durum']; ?>
							<div disabled class="form-group col-md-6">
								<label>Birim Durum</label>
								<input disabled type="text" class="form-control" value="<?php echo $aciliyet ?>">
							</div>
						</div>
						<div class="form-row">
							<?php $birim_durum_no=$projecek['birim_durum_id']; ?>
							<div disabled class="form-group col-md-6">
								<label>Birim Durum No</label>
								<input disabled type="text" class="form-control" value="<?php echo $birim_durum_no ?>">
							</div>
						</div>								
						<div class="form-row">
							<div class="form-group col-md-12">
								<textarea disabled class="ckeditor" id="editor"><?php echo $projenindetaymetni; ?></textarea>
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
	CKEDITOR.replace('editor',{
	});
</script>


