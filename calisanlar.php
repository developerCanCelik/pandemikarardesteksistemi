<?php 
include'header.php' 
?>

<link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
<style type="text/css" media="screen">
  @media only screen and (max-width: 700px) {
    .mobilgizle {
      display: none;
    }
    .mobilgizleexport {
      display: none;
    }
    .mobilgoster {
      display: block;
    }
  }
  @media only screen and (min-width: 700px) {
    .mobilgizleexport {
      display: flex;
    }
    .mobilgizle {
      display: block;
    }
    .mobilgoster {
      display: none;
    }
  }
</style>

<div class="container-fluid">

  <h1 class="h3 mb-2 text-gray-800">Çalışanlar</h1>
  <p class="mb-4">Burada çalışanlara ait verileri görebilirsiniz.</p>
  

  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Çalışan Bilgileri</h6>
    </div>
    <div class="card-body" style="width: 100%">
     
      <button type="button"class="btn btn-sm btn-info btn-icon-split mobilgoster">
        <span class="icon text-white-65">
          <i class="fas fa-edit"></i>
        </span>
        <span class="text">Seçenekler</span>
      </button>
      <div class="mobilgizle gizlemeyiac" style="margin-bottom: 10px;">
    
        <button type="button" id="hepsi" style="margin-bottom: 5px;" class="btn btn-sm btn-info btn-icon-split">
          <span class="icon text-white-65">
            <i class="fas fa-edit"></i>
          </span>
          <span class="text">Hepsi</span>
        </button>
        <button type="button" id="pozitiv" style="margin-bottom: 5px;" class="btn btn-sm btn-danger btn-icon-split">
          <span class="icon text-white-65">
            <i class="fas fa-exclamation-triangle"></i>
          </span>
          <span class="text">Pozitiv Olanlar</span>           
        </button>
        <button type="button" id="negativ" style="margin-bottom: 5px;" class="btn btn-sm btn-primary btn-icon-split">
          <span class="icon text-white-65">
            <i class="fas fa-clock"></i>
          </span>
          <span class="text">Negativ Olanlar</span>
        </button>
        <button type="button" id="belirsiz" style="margin-bottom: 5px;" class="btn btn-sm btn-warning btn-icon-split">
          <span class="icon text-white-65">
            <i class="fas fa-circle-notch"></i>
          </span>
          <span class="text">Belirsiz</span>
        </button>
        <button type="button" id="aktif" style="margin-bottom: 5px;" class="btn btn-sm btn-success btn-icon-split">
          <span class="icon text-white-65">
            <i class="fas fa-check"></i>
          </span>
          <span class="text">Aktif </span>
        </button>
        <button type="button" id="online" style="margin-bottom: 5px;" class="btn btn-sm btn-info btn-icon-split">
          <span class="icon text-white-65">
            <i class="fas fa-sync-alt"></i>
          </span>
          <span class="text">Online</span>
        </button>
        <button type="button" id="pasif" style="margin-bottom: 5px;" class="btn btn-sm btn-dark btn-icon-split">
          <span class="icon text-white-65">
            <i class="fas fa-hourglass-start"></i>
          </span>
          <span class="text">Pasif</span>
        </button>

        </div>
        <div class="table-responsive">
          <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
              <tr> 
                <th>No</th>
                <th>İsim Soyisim</th>
                <th>E-Mail</th>
                <th>Birim İsmi</th>
                <th>Test Sonucu</th>
                <th>Durum</th>
                <th>İşlem</th>

              </tr>
            </thead>
       
            <tbody>
             <?php 
             $say=0;
             $siparissor=$db->prepare("SELECT * FROM calisanlar ORDER BY calisan_id DESC");
             $siparissor->execute();
             while ($sipariscek=$siparissor->fetch(PDO::FETCH_ASSOC)) { $say++?>

               <tr>
                <td><?php echo $say; ?></td>
                <td><?php echo $sipariscek['calisan_ismi']; ?></td>
                <td><?php echo $sipariscek['calisan_mail']; ?></td>
                <td><?php echo $sipariscek['calisan_birim']; ?></td>
                
                <td><?php 
                if ($sipariscek['calisan_sonuc']=="Pozitiv") {
                  echo '<span class="badge badge-danger" style="font-size:1rem">Pozitiv</span>';
                } else {
                  echo $sipariscek['calisan_sonuc'];
                }
                ?></td>
                <td><?php 
                if ($sipariscek['calisan_durum']=="Aktif") {
                  echo '<span class="badge badge-success" style="font-size:1rem">Aktif</span>';
                } else {
                  echo $sipariscek['calisan_durum'];
                }
                ?></td>
                <td> 
                  <?php 
                  if (yetkikontrol()=="yetkili") {?>
                    <div class="d-flex justify-content-center">
                     <form action="calisandüzenle.php" method="POST">
                      <input type="hidden" name="calisan_id" value="<?php echo $sipariscek['calisan_id'] ?>">
                      <button type="submit" name="calisanguncelle" class="btn btn-success btn-sm btn-icon-split">
                        <span class="icon text-white-60">
                          <i class="fas fa-edit"></i>
                        </span>
                      </button>
                    </form>
                    <form class="mx-1" action="islemler/islem.php" method="POST">
                      <input type="hidden" name="calisan_id" value="<?php echo $sipariscek['calisan_id'] ?>">
                      <button type="submit" name="calisansilme" class="btn btn-danger btn-sm btn-icon-split">
                        <span class="icon text-white-60">
                          <i class="fas fa-trash"></i>
                        </span>
                      </button>
                    </form>  
                  <?php } ?>
                  <form action="calisan.php" method="POST">
                    <input type="hidden" name="calisan_id" value="<?php echo $sipariscek['calisan_id'] ?>">
                    <button type="submit" name="calisanbak" class="btn btn-primary btn-sm btn-icon-split">
                      <span class="icon text-white-60">
                        <i class="fas fa-eye"></i>
                      </span>
                    </button>
                  </form>  
                </div>
              </td>              
            </tr>
          <?php } ?>
        </tbody>
        <tfoot>
          <tr> 
             <th>No</th>
             <th>İsim Soyisim</th>
             <th>E-Mail</th>
             <th>Birim İsmi</th>
             <th>Test Sonucu</th>
             <th>Durum</th>
             <th>İşlem</th>
          </tr>
        </tfoot>
    
      </table>
    </div>
  </div>
</div>

</div>


<?php include'footer.php' ?>

<script src="vendor/datatables/jquery.dataTables.min.js"></script>
<script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>
<script src="js/demo/datatables-demo.js"></script> 
<script src="vendor/datatables/dataTables.buttons.min.js"></script>
<script src="vendor/datatables/buttons.flash.min.js"></script>
<script src="vendor/datatables/jszip.min.js"></script>
<script src="vendor/datatables/pdfmake.min.js"></script>
<script src="vendor/datatables/vfs_fonts.js"></script>
<script src="vendor/datatables/buttons.html5.min.js"></script>
<script src="vendor/datatables/buttons.print.min.js"></script>
<script type="text/javascript">
  $("#aktarmagizleme").click(function(){
    $(".dt-buttons").toggle();
  });
</script>
<script type="text/javascript">
  $(".mobilgoster").click(function(){
    $(".gizlemeyiac").toggle();
  });
</script>
<script>
  var dataTables = $('#dataTable').DataTable({
   initComplete: function () {
    this.api().columns([1,2,4,5]).every( function () {
      var column = this;
      var select = $('<select class="filtre"><option value=""></option></select>')
      .appendTo( $(column.footer()).empty() )
      .on( 'change', function () {
        var val = $.fn.dataTable.util.escapeRegex(
          $(this).val()
          );

        column
        .search( val ? '^'+val+'$' : '', true, false )
        .draw();
      });

      column.data().unique().sort().each( function ( d, j ) {
        var val = $('<div/>').html(d).text();
          
          if (val.length>29) {
            filtremetin =  val.substr(0,30)+"...";
          } else {
            filtremetin=val;
          }
          select.append( '<option value="' + val + '">' + filtremetin + '</option>' )
      });
    });
  },
    "ordering": true, 
    "searching": true, 
    "lengthChange": true,
    "info": true,
    dom: "<'row mobilgizleexport gizlemeyiac'<'col-md-6'l><'col-md-6'f><'col-md-4 d-none d-print-block'B>>rtip",
});

  $('#hepsi').on('click', function () {
    dataTables
    .columns()
    .search( '' )
    .columns( '.sold_out' )
    .search( 'YES' )
    .draw();
    dataTables.column(5).search("").draw();
  }); 
  $('#pozitiv').on('click', function () {
    dataTables
    .columns()
    .search( '' )
    .columns( '.sold_out' )
    .search( 'YES' )
    .draw();
    dataTables.column(4).search("Pozitiv").draw();
  }); 
  $('#negativ').on('click', function () {
    dataTables
    .columns()
    .search( '' )
    .columns( '.sold_out' )
    .search( 'YES' )
    .draw();
    dataTables.column(4).search("Negativ").draw();
  }); 
  $('#belirsiz').on('click', function () {
    dataTables
    .columns()
    .search( '' )
    .columns( '.sold_out' )
    .search( 'YES' )
    .draw();
    dataTables.column(4).search("Belirsiz").draw();
  }); 
  $('#aktif').on('click', function () {
    dataTables
    .columns()
    .search( '' )
    .columns( '.sold_out' )
    .search( 'YES' )
    .draw();
    dataTables.column(5).search("Aktif").draw();
  }); 
  $('#online').on('click', function () {
    dataTables
    .columns()
    .search( '' )
    .columns( '.sold_out' )
    .search( 'YES' )
    .draw();
    dataTables.column(5).search("Online").draw();
  }); 
  $('#pasif').on('click', function () {
    dataTables
    .columns()
    .search( '' )
    .columns( '.sold_out' )
    .search( 'YES' )
    .draw();
    dataTables.column(5).search("Pasif").draw();
  });
</script>

<?php if (@$_GET['durum']=="no")  {?>  
  <script>
    Swal.fire({
      type: 'error',
      title: 'İşlem Başarısız',
      text: 'Lütfen Tekrar Deneyin',
      showConfirmButton: true,
      confirmButtonText: 'Kapat'
    })
  </script>
<?php } ?>

<?php if (@$_GET['durum']=="ok")  {?>  
  <script>
    Swal.fire({
      type: 'success',
      title: 'İşlem Başarılı',
      text: 'İşleminiz Başarıyla Gerçekleştirildi',
      showConfirmButton: false,
      timer: 2000
    })
  </script>
  <?php } ?>