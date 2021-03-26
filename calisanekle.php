<?php 
include 'header.php';
if (yetkikontrol()!="yetkili") {
  header("location:index.php?durum=izinsiz");
  exit;
}
?>
<link rel="stylesheet" media="all" type="text/css" href="vendor/upload/css/fileinput.min.css">
<link rel="stylesheet" type="text/css" media="all" href="vendor/upload/themes/explorer-fas/theme.min.css">
<script src="vendor/upload/js/fileinput.js" type="text/javascript" charset="utf-8"></script>
<script src="vendor/upload/themes/fas/theme.min.js" type="text/javascript" charset="utf-8"></script>
<script src="vendor/upload/themes/explorer-fas/theme.minn.js" type="text/javascript" charset="utf-8"></script>

<div class="container">
  <form action="islemler/islem.php" method="POST" enctype="multipart/form-data"  data-parsley-validate>
    <div class="form-row">
      <div class="form-group col-md-6">
        <label>İsim Soyisim</label>
        <input type="text" class="form-control" required name="calisan_ismi" placeholder="Çalışan İsim Soyisim">
      </div>
      <div class="form-group col-md-6">
        <label>E-Posta</label>
        <input type="email" class="form-control" required name="calisan_mail" placeholder="Çalışan E-Mail">
      </div>
      
    </div>
    <div class="form-row">
      <div class="form-group col-md-6">
        <label>Telefon Numarası</label>
        <input type="number" class="form-control" required name="calisan_telefon" placeholder="Çalışan Telefon Numarası">
      </div>
      <div class="form-group col-md-6">
        <label>Birim Adı</label>
        <input type="text" class="form-control" required name="calisan_birim" placeholder="Birim Adı">
      </div>
    </div>
    <div class="form-row">
      <div class="form-group col-md-6">
        <label>Test Sonucu</label>
        <select required name="calisan_sonuc" class="form-control">
          <option>Pozitiv</option>
          <option>Negativ</option>
          <option>Belirsiz</option>
        </select>
      </div>
      <div class="form-group col-md-6">
        <label>Test Sonucu No(Pozitif = 1, Negatif = 2, Belirsiz = 3)</label>
        <select required name="calisan_test_id" class="form-control">
          <option>1</option>
          <option>2</option>
          <option>3</option>
        </select>
      </div>
    </div>
    <div class="form-row">
      <div class="form-group col-md-6">
        <label>Çalışan Durumu</label>
        <select required name="calisan_durum" class="form-control">
          <option>Aktif</option>
          <option>Pasif</option>
          <option>Online</option>
        </select>
      </div>
      <div class="form-group col-md-6">
        <label>Çalışan Durum No(Aktif = 1, Pasif = 2, Online = 3)</label>
        <select required name="calisan_durum_id" class="form-control">
          <option>1</option>
          <option>2</option>
          <option>3</option>
        </select>
      </div>
    </div>
    <div class="form-row">
      <div class="form-group col-md-12">
        <textarea class="ckeditor" name="calisan_detay" id="editor"></textarea>
      </div>
    </div>
    <button type="submit" name="calisanekle" class="btn btn-primary">Kaydet</button>
  </form>
</div>

<?php include 'footer.php' ?>
<script src="ckeditor/ckeditor.js"></script>
<script>
  CKEDITOR.replace( 'editor' );
</script>

<script type="text/javascript">
  $('#islemsonucu').modal('show');
  setTimeout(function() {
    $('#islemsonucu').modal('hide');
  }, 3000);
</script>

