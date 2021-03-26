<?php 
include 'header.php';

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
<script type="text/javascript">
	var genislik = $(window).width()   
	if (genislik < 768) {
		function yenile(){
			$('#sidebarToggleTop').trigger('click');
		}
		setTimeout("yenile()",1);
	}
</script>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);
	  <?php 
	  //Çalışan Test Sonucu Oranları
		$host="localhost"; //Host adınızı girin varsayılan olarak Localhosttur eğer bilginiz yoksa bu şekilde bırakın
		$veritabani_ismi="kds"; //Veritabanı İsminiz
		$kullanici_adi="root"; //Veritabanı kullanıcı adınız
		$sifre=""; //Kullanıcı şifreniz şifre yoksa 123456789 yazan yeri silip boş bırakın
		try {
			$db=new PDO("mysql:host=$host;dbname=$veritabani_ismi;charset=utf8",$kullanici_adi,$sifre);
			//echo "veritabanı bağlantısı başarılı";
		}
		catch (PDOExpception $e) {
			echo $e->getMessage();
		}
		?>
	  	function drawChart() {
			var data = new google.visualization.DataTable();
			data.addColumn('string', 'Topping');
			data.addColumn('number', 'Slices');
			data.addRows([
				<?php 
				$query = $db->query("SELECT COUNT(calisanlar.calisan_test_id) as calisan_sayisi FROM calisanlar WHERE calisanlar.calisan_test_id = '2'");
				foreach($query as $row) {	
					echo "['Negatif',".$row["calisan_sayisi"]."],";	
				}	
				?>
				<?php 
				$query = $db->query("SELECT COUNT(calisanlar.calisan_test_id) as calisan_sayisi FROM calisanlar WHERE calisanlar.calisan_test_id = '1'");
				foreach($query as $row) {	
					echo "['Pozitif',".$row["calisan_sayisi"]."],";	
				}	
				?>
				<?php 
				$query = $db->query("SELECT COUNT(calisanlar.calisan_test_id) as calisan_sayisi FROM calisanlar WHERE calisanlar.calisan_test_id = '3'");
				foreach($query as $row) {	
					echo "['Belirsiz',".$row["calisan_sayisi"]."],";	
				}	
				?>
			]);
			var options = {'title':''};

        	var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        	chart.draw(data, options);
      	}
    </script>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);
	  <?php 
	 
		$host="localhost"; 
		$veritabani_ismi="kds";
		$kullanici_adi="root"; 
		$sifre=""; 
		try {
			$db=new PDO("mysql:host=$host;dbname=$veritabani_ismi;charset=utf8",$kullanici_adi,$sifre);

		}
		catch (PDOExpception $e) {
			echo $e->getMessage();
		}
		?>
	  	function drawChart() {
			var data = new google.visualization.DataTable();
			data.addColumn('string', 'Topping');
			data.addColumn('number', 'Slices');
			data.addRows([
				<?php 
				$query = $db->query("SELECT COUNT(birim.birim_durum_id) as birim_sayisi FROM birim WHERE birim.birim_durum_id = '1'");
				foreach($query as $row) {	
					echo "['Aktif',".$row["birim_sayisi"]."],";	
				}	
				?>
				<?php 
				$query = $db->query("SELECT COUNT(birim.birim_durum_id) as birim_sayisi FROM birim WHERE birim.birim_durum_id = '2'");
				foreach($query as $row) {	
					echo "['Kapalı',".$row["birim_sayisi"]."],";	
				}	
				?>
				<?php 
				$query = $db->query("SELECT COUNT(birim.birim_durum_id) as birim_sayisi FROM birim WHERE birim.birim_durum_id = '3'");
				foreach($query as $row) {	
					echo "['Online',".$row["birim_sayisi"]."],";	
				}	
				?>
			]);
			var options = {'title':''};

        	var chart = new google.visualization.PieChart(document.getElementById('asd'));

        	chart.draw(data, options);
      	}
    </script>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);
	  <?php 
		$host="localhost";
		$veritabani_ismi="kds"; 
		$kullanici_adi="root"; 
		$sifre=""; 
		try {
			$db=new PDO("mysql:host=$host;dbname=$veritabani_ismi;charset=utf8",$kullanici_adi,$sifre);
			
		}
		catch (PDOExpception $e) {
			echo $e->getMessage();
		}
		?>
	  	function drawChart() {
			var data = new google.visualization.DataTable();
			data.addColumn('string', 'Topping');
			data.addColumn('number', 'Slices');
			data.addRows([
				<?php 
				$query = $db->query("SELECT COUNT(calisanlar.calisan_durum_id) as calisan_sayisi FROM calisanlar WHERE calisanlar.calisan_durum_id = '1'");
				foreach($query as $row) {	
					echo "['Aktif',".$row["calisan_sayisi"]."],";	
				}	
				?>
				<?php 
				$query = $db->query("SELECT COUNT(calisanlar.calisan_durum_id) as calisan_sayisi FROM calisanlar WHERE calisanlar.calisan_durum_id = '2'");
				foreach($query as $row) {	
					echo "['Pasif',".$row["calisan_sayisi"]."],";	
				}	
				?>
				<?php 
				$query = $db->query("SELECT COUNT(calisanlar.calisan_durum_id) as calisan_sayisi FROM calisanlar WHERE calisanlar.calisan_durum_id = '3'");
				foreach($query as $row) {	
					echo "['Online',".$row["calisan_sayisi"]."],";	
				}	
				?>
			]);
			var options = {'title':''};

        	var chart = new google.visualization.PieChart(document.getElementById('calisanDurumOrani'));

        	chart.draw(data, options);
      	}
    </script>
 <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {packages: ['corechart']});
		google.charts.setOnLoadCallback(drawBarColors);

		function drawBarColors() {
			var data = new google.visualization.DataTable();
			data.addColumn('string', 'Topping');
			data.addColumn('number', 'Pozitif');
			data.addRows([
				<?php 
				$query = $db->query("SELECT COUNT(calisanlar.calisan_id) as calisan_sayisi FROM calisanlar WHERE calisanlar.calisan_test_id = '1' and calisanlar.calisan_birim = 'G&uuml;mr&uuml;k'");
				foreach($query as $row) {	
					echo "['Gümrük',".$row["calisan_sayisi"]."],";	
				}	
				?>
				<?php 
				$query = $db->query("SELECT COUNT(calisanlar.calisan_id) as calisan_sayisi FROM calisanlar WHERE calisanlar.calisan_test_id = '1'  and calisanlar.calisan_birim = 'Dağıtım, sevkiyat'");
				foreach($query as $row) {	
					echo "['Dağıtım, sevkiyat',".$row["calisan_sayisi"]."],";	
				}	
				?>
				<?php 
				$query = $db->query("SELECT COUNT(calisanlar.calisan_id) as calisan_sayisi FROM calisanlar WHERE calisanlar.calisan_test_id = '1'  and calisanlar.calisan_birim = 'IT'");
				foreach($query as $row) {	
					echo "['IT',".$row["calisan_sayisi"]."],";	
				}	
				?>
				<?php 
				$query = $db->query("SELECT COUNT(calisanlar.calisan_id) as calisan_sayisi FROM calisanlar WHERE calisanlar.calisan_test_id = '1' and calisanlar.calisan_birim = 'Satış Birimi'");
				foreach($query as $row) {	
					echo "['Satış Birimi',".$row["calisan_sayisi"]."],";	
				}	
				?>
				<?php 
				$query = $db->query("SELECT COUNT(calisanlar.calisan_id) as calisan_sayisi FROM calisanlar WHERE calisanlar.calisan_test_id = '1'  and calisanlar.calisan_birim = 'Y&ouml;netim'");
				foreach($query as $row) {	
					echo "['Yönetim',".$row["calisan_sayisi"]."],";	
				}	
				?>
				<?php 
				$query = $db->query("SELECT COUNT(calisanlar.calisan_id) as calisan_sayisi FROM calisanlar WHERE calisanlar.calisan_test_id = '1' and calisanlar.calisan_birim = 'Halkla İlişkiler'");
				foreach($query as $row) {	
					echo "['Halkla İlişkiler',".$row["calisan_sayisi"]."],";	
				}	
				?>
				<?php 
				$query = $db->query("SELECT COUNT(calisanlar.calisan_id) as calisan_sayisi FROM calisanlar WHERE calisanlar.calisan_test_id = '1' and calisanlar.calisan_birim = '&Uuml;retim ve AR-GE'");
				foreach($query as $row) {	
					echo "['Üretim ve AR-GE',".$row["calisan_sayisi"]."],";	
				}	
				?>
				<?php 
				$query = $db->query("SELECT COUNT(calisanlar.calisan_id) as calisan_sayisi FROM calisanlar WHERE calisanlar.calisan_test_id = '1' and calisanlar.calisan_birim = 'Pazarlama Hizmetleri'");
				foreach($query as $row) {	
					echo "['Pazarlama Hizmetleri',".$row["calisan_sayisi"]."],";	
				}	
				?>
				<?php 
				$query = $db->query("SELECT COUNT(calisanlar.calisan_id) as calisan_sayisi FROM calisanlar WHERE calisanlar.calisan_test_id = '1' and calisanlar.calisan_birim = 'Operasyon Y&ouml;netimi'");
				foreach($query as $row) {	
					echo "['Operasyon Yönetimi',".$row["calisan_sayisi"]."],";	
				}	
				?>
				<?php 
				$query = $db->query("SELECT COUNT(calisanlar.calisan_id) as calisan_sayisi FROM calisanlar WHERE calisanlar.calisan_test_id = '1' and calisanlar.calisan_birim = 'Hukuk'");
				foreach($query as $row) {	
					echo "['Hukuk',".$row["calisan_sayisi"]."],";	
				}	
				?>
			]);

			var options = {
				title: 'Birimlerdeki pozitf olan çalışan sayısı',
				chartArea: {width: '50%'},
				colors: ['#b0120a', '#ffab91'],
				hAxis: {
				title: 'Pozitiv Çalışan Sayısı',
				minValue: 0
				},
				vAxis: {title: 'Birimler'}
			};
			var chart = new google.visualization.BarChart(document.getElementById('calisanDurumOran'));
			chart.draw(data, options);
    
      }
    </script>
 <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Year', 'Aktif Birimler', 'Kapanan birimler'],
          ['1.Ay',  10,      1],
          ['4.Ay',  5,      5],
          ['8.Ay',  4,       6],
          ['12.Ay',  5,      4]
        ]);

        var options = {
          title: 'Aylara Göre Aktif ve Kapanan Birim',
          curveType: 'function',
          legend: { position: 'bottom' }
        };
        var chart = new google.visualization.LineChart(document.getElementById('calisanDurumOra'));
        chart.draw(data, options);
      }
    </script>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
       google.charts.load('current', {packages: ['corechart']});
		google.charts.setOnLoadCallback(drawBarColors);

		function drawBarColors() {
			var data = new google.visualization.DataTable();
			data.addColumn('string', 'Topping');
			data.addColumn('number', 'Aktif, Pasif, Online');
			data.addRows([
				<?php 
				$query = $db->query("SELECT COUNT(calisanlar.calisan_id) as calisan_sayisi FROM calisanlar WHERE calisanlar.calisan_durum_id = '1' and calisanlar.calisan_durum = 'Aktif '");
				foreach($query as $row) {	
					echo "['Aktif',".$row["calisan_sayisi"]."],";	
				}	
				?>
				<?php 
				$query = $db->query("SELECT COUNT(calisanlar.calisan_id) as calisan_sayisi FROM calisanlar WHERE calisanlar.calisan_durum_id = '2'  and calisanlar.calisan_durum = 'Pasif'");
				foreach($query as $row) {	
					echo "['Pasif',".$row["calisan_sayisi"]."],";	
				}	
				?>
				<?php 
				$query = $db->query("SELECT COUNT(calisanlar.calisan_id) as calisan_sayisi FROM calisanlar WHERE calisanlar.calisan_durum_id = '3'  and calisanlar.calisan_durum = 'Online'");
				foreach($query as $row) {	
					echo "['Online',".$row["calisan_sayisi"]."],";	
				}	
				?>
				
			]);

			var options = {
				title: 'Aktif - Pasif - Online Çalışanlar',
				chartArea: {width: '50%'},
				colors: ['#b0120a', '#57aeff'],
				hAxis: {
				title: 'Aktif - Pasif - Online',
				minValue: 0
				},
			};
			var chart = new google.visualization.BarChart(document.getElementById('calisanDurumOr'));
			chart.draw(data, options);
    
      }
    </script>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Year', 'Aktif + Online Çalışanlar', 'Pasif Çalışanlar'],
          ['1.Ay',  80,      20],
          ['4.Ay',  40,      60],
          ['8.Ay',  47,       53],
          ['12.Ay',  59,      41]
        ]);

        var options = {
          title: 'Aylara Göre Aktif ve Pasif Çalışanlar',
          curveType: 'function',
          legend: { position: 'bottom' }
        };
        var chart = new google.visualization.LineChart(document.getElementById('calisanDurumO'));
        chart.draw(data, options);
      }
    </script>
<div class="container-fluid p-2">
	<div class="row" style="margin-bottom: -20px;">

		<?php 
		$birim_sayi_sor=$db->prepare("SELECT birim_id FROM birim");
		$birim_sayi_sor->execute();
		$birim_sayi_cek = $birim_sayi_sor->rowCount();
		?>
		<div class="col-xl-3 col-md-6 mb-4">
			<div class="card border-left-primary shadow h-100 py-2">
				<div class="card-body">
					<div class="row no-gutters align-items-center">
						<div class="col mr-2">
							<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Toplam <b>Birim</b> Sayısı</div>
							<div class="h4 mb-0 font-weight-bold text-gray-800"><?php echo $birim_sayi_cek; ?></div>
						</div>
						<div class="col-auto">
							<i class="fas fa-list fa-2x text-gray-300"></i>
						</div>
					</div>
				</div>
			</div>
		</div>


		<?php 
		$aktif_birim_sor=$db->prepare("SELECT birim_id FROM birim WHERE birim_durum='Aktif'");
		$aktif_birim_sor->execute();
		$aktif_birim_cek = $aktif_birim_sor->rowCount();
		?>
		<div class="col-xl-3 col-md-6 mb-4">
			<div class="card border-left-success shadow h-100 py-2">
				<div class="card-body">
					<div class="row no-gutters align-items-center">
						<div class="col mr-2">
							<div class="text-xs font-weight-bold text-success text-uppercase mb-1">Aktif <b>Birim</b> Sayısı</div>
							<div class="h4 mb-0 font-weight-bold text-gray-800"><?php echo $aktif_birim_cek; ?></div>
						</div>
						<div class="col-auto">
							<i class="fas fa-calendar-check fa-2x text-gray-300"></i>
						</div>
					</div>
				</div>
			</div>
		</div>

		<?php 
		$kapalı_birim_sor=$db->prepare("SELECT birim_id FROM birim WHERE birim_durum='Kapalı'");
		$kapalı_birim_sor->execute();
		$kapalı_birim_cek = $kapalı_birim_sor->rowCount();
		?>
		<div class="col-xl-3 col-md-6 mb-4">
			<div class="card border-left-danger shadow h-100 py-2">
				<div class="card-body">
					<div class="row no-gutters align-items-center">
						<div class="col mr-2">
							<div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Kapalı <b>Birim</b> Sayısı</div>
							<div class="h4 mb-0 font-weight-bold text-gray-800"><?php echo $kapalı_birim_cek; ?></div>
						</div>
						<div class="col-auto">
							<i class="fas fa-calendar-plus fa-2x text-gray-300"></i>
						</div>
					</div>
				</div>
			</div>
		</div>


		<?php 
		$online_birim_sor=$db->prepare("SELECT birim_id FROM birim WHERE birim_durum='Online'");
		$online_birim_sor->execute();
		$online_birim_cek = $online_birim_sor->rowCount();
		?>
		<div class="col-xl-3 col-md-6 mb-4">
			<div class="card border-left-warning shadow h-100 py-2">
				<div class="card-body">
					<div class="row no-gutters align-items-center">
						<div class="col mr-2">
							<div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Online <b>Birim</b> Sayısı</div>
							<div class="h4 mb-0 font-weight-bold text-gray-800"><?php echo $online_birim_cek; ?></div>
						</div>
						<div class="col-auto">
							<i class="fas fa-calendar-alt fa-2x text-gray-300"></i>
						</div>
					</div>
				</div>
			</div>
		</div>	
	</div>

	<hr style="margin-bottom: 15px !important;">

	<div class="row">

		<?php 
		$toplam_sayi_sor=$db->prepare("SELECT calisan_id FROM calisanlar");
		$toplam_sayi_sor->execute();
		$toplam_sayi_cek = $toplam_sayi_sor->rowCount();
		?>
		<div class="col-xl-3 col-md-6 mb-4">
			<div class="card border-left-primary shadow h-100 py-2">
				<div class="card-body">
					<div class="row no-gutters align-items-center">
						<div class="col mr-2">
							<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Toplam <b>Çalışan</b> Sayısı</div>
							<div class="h4 mb-0 font-weight-bold text-gray-800"><?php echo $toplam_sayi_cek; ?></div>
						</div>
						<div class="col-auto">
							<i class="fas fa-list fa-2x text-gray-300"></i>
						</div>
					</div>
				</div>
			</div>
		</div>	

		<?php 
		$negatif_biten_sayi_sor=$db->prepare("SELECT calisan_id FROM calisanlar WHERE calisan_sonuc='Negativ'");
		$negatif_biten_sayi_sor->execute();
		$negatif_biten_sayi_cek = $negatif_biten_sayi_sor->rowCount();
		?>
		<div class="col-xl-3 col-md-6 mb-4">
			<div class="card border-left-success shadow h-100 py-2">
				<div class="card-body">
					<div class="row no-gutters align-items-center">
						<div class="col mr-2">
							<div class="text-xs font-weight-bold text-success text-uppercase mb-1">Negatif <b>Çalışan</b> Sayısı</div>
							<div class="h4 mb-0 font-weight-bold text-gray-800"><?php echo $negatif_biten_sayi_cek; ?></div>
						</div>
						<div class="col-auto">
							<i class="fas fa-calendar-check fa-2x text-gray-300"></i>
						</div>
					</div>
				</div>
			</div>
		</div>	

		<?php 
		$pozitif_calisan_sayisi_sor=$db->prepare("SELECT calisan_id FROM calisanlar WHERE calisan_sonuc='Pozitiv'");
		$pozitif_calisan_sayisi_sor->execute();
		$pozitif_calisan_sayisi_cek = $pozitif_calisan_sayisi_sor->rowCount();
		?>
		<div class="col-xl-3 col-md-6 mb-4">
			<div class="card border-left-danger shadow h-100 py-2">
				<div class="card-body">
					<div class="row no-gutters align-items-center">
						<div class="col mr-2">
							<div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Pozitif <b>Çalışan</b> Sayısı</div>
							<div class="h4 mb-0 font-weight-bold text-gray-800"><?php echo $pozitif_calisan_sayisi_cek; ?></div>
						</div>
						<div class="col-auto">
							<i class="fas fa-calendar-plus fa-2x text-gray-300"></i>
						</div>
					</div>
				</div>
			</div>
		</div>

	
		<?php 
		$belirsiz_calisan_sayisi_sor=$db->prepare("SELECT calisan_id FROM calisanlar  WHERE calisan_sonuc='Belirsiz'");
		$belirsiz_calisan_sayisi_sor->execute();
		$belirsiz_calisan_sayisi_cek = $belirsiz_calisan_sayisi_sor->rowCount();
		?>
		<div class="col-xl-3 col-md-6 mb-4">
			<div class="card border-left-warning shadow h-100 py-2">
				<div class="card-body">
					<div class="row no-gutters align-items-center">
						<div class="col mr-2">
							<div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Belirsiz <b>Çalışan</b> Sayısı</div>
							<div class="h4 mb-0 font-weight-bold text-gray-800"><?php echo $belirsiz_calisan_sayisi_cek; ?></div>
						</div>
						<div class="col-auto">
							<i class="fas fa-calendar-alt fa-2x text-gray-300"></i>
						</div>
					</div>
				</div>
			</div>
		</div>	
	</div>


	<div class="row">
		<div class="col-md-6">
			<div class="card shadow mb-4">
				<div class="card-header py-3">
					<h5 class="m-0 font-weight-bold text-primary text-center">Çalışan Test Sonucu Oranları</h5>
				</div>
				<div class="card-body">
					<div class="table-responsive">
						<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" >
						
							<center>
								<div class="form-row justify-content-center" id="piechart" style="width: 575px; height: 425px;"></div>
							</center>
							
						</table>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-6">
			<div class="card shadow mb-4">
				<div class="card-header py-3 text-center">
					<h5 class="m-0 font-weight-bold text-primary">Test Sonucu Pozitif Çalışanlar</h5>
				</div>
				<div class="card-body" style="width: 100%">
					<div class="table-responsive">
						<table class="table table-bordered" id="siparistablosu" width="100%" cellspacing="0">
							<thead>
								<tr> 
									<th>İsim</th>
									<th>Birim</th>
									<th>Test Sonucu</th>
								</tr>
							</thead>
							<tbody>
								<?php 
								$calisansor=$db->prepare("SELECT * FROM calisanlar WHERE calisan_sonuc = 'Pozitiv' ");
								$calisansor->execute();
								while ($calisancek=$calisansor->fetch(PDO::FETCH_ASSOC)) { $say++?>
									<tr>
										<td><?php echo $calisancek['calisan_ismi']; ?></td>										
										<td><?php echo $calisancek['calisan_birim']; ?></td>
										<td><?php 
										if ($calisancek['calisan_sonuc']=="Pozitiv") {
											echo '<span class="badge badge-danger" style="font-size:1rem">Pozitiv</span>';
										} else {
											echo $calisancek['calisan_sonuc'];
										}
										?></td>
									</tr>
								<?php }
								?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-6">
			<div class="card shadow mb-4">
				<div class="card-header py-3">
					<h5 class="m-0 font-weight-bold text-primary text-center">Kapanan Birim Oranı</h5>
				</div>
				<div class="card-body">
					<div class="table-responsive">
						<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" >
							
							<center>
								<div class="form-row justify-content-center" id="asd" style="width: 575px; height: 425px;"></div>
							</center>
							
						</table>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-6">
			<div class="card shadow mb-4">
				<div class="card-header py-3">
					<h5 class="m-0 font-weight-bold text-primary text-center">Çalışan Durum Oranı</h5>
				</div>
				<div class="card-body">
					<div class="table-responsive">
						<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" >
						
							<center>
								<div class="form-row justify-content-center" id="calisanDurumOrani" style="width: 575px; height: 425px;"></div>
							</center>
							
						</table>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-6">
			<div class="card shadow mb-4">
				<div class="card-header py-3">
					<h5 class="m-0 font-weight-bold text-primary text-center">Birim Pozitif Çalışan Sayıları</h5>
				</div>
				<div class="card-body">
					<div class="table-responsive">
						<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" >
						
							<center>
								<div class="form-row justify-content-center" id="calisanDurumOran" style="width: 575px; height: 425px;"></div>
							</center>
							
						</table>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-6">
			<div class="card shadow mb-4">
				<div class="card-header py-3">
					<h5 class="m-0 font-weight-bold text-primary text-center">Aktif - Kapalı Birim</h5>
				</div>
				<div class="card-body">
					<div class="table-responsive">
						<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" >
					
							<center>
								<div class="form-row justify-content-center" id="calisanDurumOra" style="width: 575px; height: 425px;"></div>
							</center>
							
						</table>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-6">
			<div class="card shadow mb-4">
				<div class="card-header py-3">
					<h5 class="m-0 font-weight-bold text-primary text-center">Aktif - Pasif - Online</h5>
				</div>
				<div class="card-body">
					<div class="table-responsive">
						<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" >
					
							<center>
								<div class="form-row justify-content-center" id="calisanDurumOr" style="width: 575px; height: 425px;"></div>
							</center>
							
						</table>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-6">
			<div class="card shadow mb-4">
				<div class="card-header py-3">
					<h5 class="m-0 font-weight-bold text-primary text-center">Çalışan && Çalışmayan Oranı</h5>
				</div>
				<div class="card-body">
					<div class="table-responsive">
						<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" >
						
							<center>
								<div class="form-row justify-content-center" id="calisanDurumO" style="width: 575px; height: 425px;"></div>
							</center>
							
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>



</div>


</div>


<?php 
include 'footer.php';
?>

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
    "ordering": true,  
    "searching": true, 
    "lengthChange": true,
    "info": true,
    "lengthMenu": [ 5, 10, 25, 50, 75, 100 ],
    dom: "<'row '<'col-md-6'l><'col-md-6'f><'col-md-4 d-none d-print-block'B>>rtip",
});
</script>

<script>
	var dataTables = $('#siparistablosu').DataTable({
    "ordering": true,  
    "searching": true,  
    "lengthChange": true, 
    "info": true,
    "lengthMenu": [ 5, 10, 25, 50, 75, 100 ],
    dom: "<'row '<'col-md-6'l><'col-md-6'f><'col-md-4 d-none d-print-block'B>>rtip",
});
</script>

<?php 
if (isset($_GET['durum'])) {?>
	<?php if ($_GET['durum']=="izinsiz")  {?>	
		<script>
			Swal.fire({
				type: 'error',
				title: 'İzniniz Yok',
				text: 'Girme İzniniz olmayan bir alana girmeye çalıştınız',
				showConfirmButton: false,
				timer: 2000
			})
		</script>
	<?php } ?>
	<?php if ($_GET['durum']=="ok")  {?>	
		<script>
			Swal.fire({
				type: 'success',
				title: 'İşlem Başarılı',
				text: 'İşleminiz Başarıyla Gerçekleştirildi',
				showConfirmButton: false,
				timer: 2000
			})
		</script>
	<?php } } ?>
