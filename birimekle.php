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
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h5 class="m-0 font-weight-bold text-primary">Birim Ekle</h5>
    </div>
    <div class="card-body">
      <form action="islemler/islem.php" method="POST" enctype="multipart/form-data"  data-parsley-validate>
        <div class="form-row">
          <div class="form-group col-md-6">
            <label>Birim Adı</label>
            <input type="text" class="form-control" name="birim_ad" placeholder="Eklenecek Olan Birimin Adı">
          </div>
          <div class="form-group col-md-6">
            <label for="inputState">Durum</label>
            <select required name="birim_durum" class="form-control">
              <option>Aktif</option>
              <option>Kapalı</option>
              <option>Online</option>
            </select>
          </div>
          <div class="form-group col-md-6">
            <label for="inputState">Durum No(Aktif = 1 , Kapalı = 2, Online =3)</label>
            <select required name="birim_durum_id" class="form-control">
              <option>1</option>
              <option>2</option>
              <option>3</option>
            </select>
          </div>
        </div>

        
      </div>
      <div class="form-row mt-2">
        <div class="form-group col-md-12">
          <textarea class="ckeditor" name="birim_detay" id="editor"></textarea>
        </div>
      </div>
      <button type="submit" name="birimekle" class="btn btn-primary">Kaydet</button>
    </form>
  </div>
</div>
</div>

<script src="ckeditor/ckeditor.js"></script>

