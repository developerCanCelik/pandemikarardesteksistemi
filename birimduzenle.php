<?php 
include 'header.php' ;
if (isset($_POST['birimduzenle'])) {
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
					<h5 class="m-0 font-weight-bold text-primary">Birim Güncelleme İşlemi   
						<small>
							<?php 
							if (isset($_GET['islem'])) { 
								if ($_GET['islem']=="ok") {?> 
									<b style="color: green; font-size: 16px;">İşlem Başarılı</b>
								<?php } elseif ($_GET['islem']=="no") { ?> 
									<b style="color: red; font-size: 16px;">İşlem Başarısız</b>
								<?php } } ?>

							</small>
						</h5>
					</div>
					<div class="card-body">
						<form action="islemler/islem.php" method="POST" enctype="multipart/form-data"  data-parsley-validate>
							<div class="form-row">
								<div class="form-group col-md-6">
									<label>Birim Adi</label>
									<input required type="text" class="form-control" name="birim_ad" value="<?php echo $projecek['birim_ad'] ?>">
								</div>
							</div>
							<div class="form-row">
								<?php $aciliyet=$projecek['birim_durum']; ?>
								<div required class="form-group col-md-6">
									<label>Durum</label>
									<select id="inputState" name="birim_durum" class="form-control">
										<option <?php if($aciliyet == 'Aktif'){echo("selected");}?> value="Aktif">Aktif</option>
										<option <?php if($aciliyet == 'Kapalı'){echo("selected");}?> value="Kapalı">Kapalı</option>
										<option <?php if($aciliyet == 'Online'){echo("selected");}?> value="Online">Online</option>
									</select>
								</div>
							</div>
							<div class="form-row">
								<?php $birim_durum_no=$projecek['birim_durum_id']; ?>
								<div required class="form-group col-md-6">
									<label>	Durum No(Aktif = 1 , Kapalı = 2, Online =3)</label>
									<select id="inputState" name="birim_durum_id" class="form-control">
										<option <?php if($birim_durum_no == '1'){echo("selected");}?> value="1">1</option>
										<option <?php if($birim_durum_no == '2'){echo("selected");}?> value="2">2</option>
										<option <?php if($birim_durum_no == '3'){echo("selected");}?> value="3">3</option>
									</select>
								</div>
							</div>			
							<div class="form-row">
								<div class="form-group col-md-12">
									<textarea class="ckeditor" name="birim_detay" id="editor"><?php echo $projenindetaymetni; ?></textarea>
								</div>
							</div>
							<input type="hidden" class="form-control" name="birim_id" value="<?php echo $_POST['birim_id'] ?>">
							<button style="width: fit-content;" type="submit" name="birimguncelle" class="btn btn-success">Kaydet</button>
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
	CKEDITOR.replace( 'editor' );
</script>
