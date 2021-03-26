<?php 
include 'header.php' ;
if (yetkikontrol()!="yetkili") {
	header("location:index.php?durum=izinsiz");
	exit;
}
if (isset($_POST['calisan_id'])) {
	$kayitsor=$db->prepare("SELECT * FROM calisanlar where calisan_id=:id");
	$kayitsor->execute(array(
		'id' => guvenlik($_POST['calisan_id'])
	));
	$kayitcek=$kayitsor->fetch(PDO::FETCH_ASSOC);
} else {
	header("location:calisanlar");
} 

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
					<h5 class="m-0 font-weight-bold text-primary">Çalışan Güncelleme İşlemi   
						<small>
							<?php 
							if (isset($_GET['islem'])) { 
								if (guvenlik($_GET['islem'])=="ok") {?> 
									<b style="color: green; font-size: 16px;">İşlem Başarılı</b>
								<?php } elseif (guvenlik($_GET['islem'])=="no") { ?> 
									<b style="color: red; font-size: 16px;">İşlem Başarısız</b>
								<?php } } ?>

							</small>
						</h5>
					</div>
					<div class="card-body">
						<form action="islemler/islem.php" method="POST"  enctype="multipart/form-data"  data-parsley-validate>
							<div class="form-row">
								<div class="form-group col-md-6">
									<label>İsim Soyisim</label>
									<input type="text" class="form-control" required name="calisan_ismi" value="<?php echo $kayitcek['calisan_ismi'] ?>">
								</div>
								<div class="form-group col-md-6">
									<label>E-Posta</label>
									<input type="email" class="form-control"  name="calisan_mail" value="<?php echo $kayitcek['calisan_mail'] ?>">
								</div>	
							</div>
							<div class="form-row">
								<div class="form-group col-md-6">
									<label>Telefon Numarası</label>
									<input type="number" class="form-control" name="calisan_telefon" value="<?php echo $kayitcek['calisan_telefon'] ?>">
								</div>
								<div class="form-group col-md-6">
									<label>Birim Adı</label>
									<input type="text" class="form-control" required name="calisan_birim" value="<?php echo $kayitcek['calisan_birim'] ?>">
								</div>
							</div>
							<div class="form-row">
								<?php $aciliyet=$kayitcek['calisan_sonuc']; ?>
								<div class="form-group col-md-6">
									<label>Çalışan Test Sonucu</label>
									<select id="inputState" name="calisan_sonuc" class="form-control">
										<option <?php if($aciliyet == 'Pozitiv'){echo("selected");}?> value="Pozitiv">Pozitiv</option>
										<option <?php if($aciliyet == 'Negativ'){echo("selected");}?> value="Negativ">Negativ</option>
										<option <?php if($aciliyet == 'Belirsiz'){echo("selected");}?> value="Belirsiz">Belirsiz</option>
									</select>
								</div>
								<?php $aciliyet=$kayitcek['calisan_test_id']; ?>
								<div class="form-group col-md-6">
									<label>Test Sonucu No(Pozitif = 1, Negatif = 2, Belirsiz = 3)</label>
									<select id="inputState" name="calisan_test_id" class="form-control">
										<option <?php if($aciliyet == '1'){echo("selected");}?> value="1">1</option>
										<option <?php if($aciliyet == '2'){echo("selected");}?> value="2">2</option>
										<option <?php if($aciliyet == '3'){echo("selected");}?> value="3">3</option>
									</select>
								</div>
							</div>	
							<div class="form-row">
								<?php $durum=$kayitcek['calisan_durum']; ?>
								<div class="form-group col-md-6">
									<label>Çalışan Durumu</label>
									<select id="inputState" name="calisan_durum" class="form-control">
										<option <?php if($durum == 'Aktif'){echo("selected");}?> value="Aktif">Aktif</option>
										<option <?php if($durum == 'Pasif'){echo("selected");}?> value="Pasif">Pasif</option>
										<option <?php if($durum == 'Online'){echo("selected");}?> value="Online">Online</option>
									</select>
								</div>
								<?php $aciliyet=$kayitcek['calisan_durum_id']; ?>
								<div class="form-group col-md-6">
									<label>Çalışan Durum No(Aktif = 1, Pasif = 2, Online = 3)</label>
									<select id="inputState" name="calisan_durum_id" class="form-control">
										<option <?php if($aciliyet == '1'){echo("selected");}?> value="1">1</option>
										<option <?php if($aciliyet == '2'){echo("selected");}?> value="2">2</option>
										<option <?php if($aciliyet == '3'){echo("selected");}?> value="3">3</option>
									</select>
								</div>
							</div>	
							<div class="form-row mt-2">
								<div class="form-group col-md-12">
									<textarea class="ckeditor" name="calisan_detay" id="editor"><?php echo $kayitcek['calisan_detay']?></textarea>
								</div>
							</div>
							<input type="hidden" class="form-control" name="calisan_id" value="<?php echo $kayitcek['calisan_id'] ?>">
							<button type="submit" name="calisanguncelle" class="btn btn-success">Kaydet</button>
						</form>
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

