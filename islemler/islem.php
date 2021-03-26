<?php
@ob_start();
@session_start();
include 'baglan.php';
include '../fonksiyonlar.php';


$ayarsor=$db->prepare("SELECT * FROM ayarlar");
$ayarsor->execute();
$ayarcek=$ayarsor->fetch(PDO::FETCH_ASSOC);




if (isset($_POST['oturumac'])) {
	$kul_mail=guvenlik($_POST['kul_mail']);
	$kul_sifre=md5($_POST['kul_sifre']);
	$kullanicisor=$db->prepare("SELECT * FROM kullanicilar WHERE kul_mail=:mail and kul_sifre=:sifre");
	$kullanicisor->execute(array(
		'mail'=> $kul_mail,
		'sifre'=> $kul_sifre
	));
	$sonuc=$kullanicisor->rowCount();
	if ($sonuc==1) {
		$kullanicicek=$kullanicisor->fetch(PDO::FETCH_ASSOC);
		$_SESSION['kul_mail']=sifreleme($kul_mail); 
		$_SESSION['kul_id']=$kullanicicek['kul_id'];

		$ipkaydet=$db->prepare("UPDATE kullanicilar SET
			ip_adresi=:ip_adresi, 
			session_mail=:session_mail WHERE 
			kul_mail=:kul_mail
			");

		$kaydet=$ipkaydet->execute(array(
			'ip_adresi' => $_SERVER['REMOTE_ADDR'], 
			'session_mail' => sifreleme($kul_mail),
			'kul_mail' => $kul_mail
		));
		header("location:../index.php");
		exit;
	} else {
		header("location:../login?durum=hata");
	}
	exit;
}



if (isset($_POST['genelayarkaydet'])) {
  if (yetkikontrol()!="yetkili") {
    header("location:../index.php");
    exit;
  }
 			$boyut = $_FILES['site_logo']['size'];
            if($boyut > 3145728)
            {
                echo 'Dosya 3MB den büyük olamaz.';
              } else {

               if ($boyut < 20) {
                $genelayarkaydet=$db->prepare("UPDATE ayarlar SET
                 site_baslik=:baslik,
                 site_aciklama=:aciklama,
                 site_sahibi=:sahip,
                 mail_onayi=:mail_onayi,
                 duyuru_onayi=:duyuru_onayi where id=1
                 ");

                $ekleme=$genelayarkaydet->execute(array(
                 'baslik' => guvenlik($_POST['site_baslik']),
                 'aciklama' => guvenlik($_POST['site_aciklama']),
                 'sahip' => guvenlik($_POST['site_sahibi']),
                 'mail_onayi' => guvenlik($_POST['mail_onayi']),
                 'duyuru_onayi' => guvenlik($_POST['duyuru_onayi'])
               ));
              } else {

                $yuklemeklasoru = '../img';
                @$gecici_isim = $_FILES['site_logo']["tmp_name"];
                @$dosya_ismi = $_FILES['site_logo']["name"];
            		$benzersizsayi1=rand(100,10000); 
            		$benzersizsayi2=rand(100,10000); 
            		$isim=$benzersizsayi1.$benzersizsayi2.$dosya_ismi;
            		$resim_yolu=substr($yuklemeklasoru, 3)."/".tum_bosluk_sil($isim);
            		@move_uploaded_file($gecici_isim, "$yuklemeklasoru/$isim");

            		$genelayarkaydet=$db->prepare("UPDATE ayarlar SET
            			site_baslik=:baslik,
            			site_aciklama=:aciklama,
            			site_sahibi=:sahip,
            			mail_onayi=:onay,
            			duyuru_onayi=:duyuru_onayi,
            			site_logo=:site_logo where id=1
            			");

            		$ekleme=$genelayarkaydet->execute(array(
            			'baslik' => guvenlik($_POST['site_baslik']),
            			'aciklama' => guvenlik($_POST['site_aciklama']),
            			'sahip' => guvenlik($_POST['site_sahibi']),
            			'onay' => guvenlik($_POST['mail_onayi']),
            			'duyuru_onayi' => guvenlik($_POST['duyuru_onayi']),
            			'site_logo' => $resim_yolu
            		));
            	}
            }

            if ($ekleme) {
            	header("location:../ayarlar?durum=ok");
            } else {
            	header("location:../ayarlar?durum=no");
            	exit;
            }            
          }

          

          if (isset($_POST['birimekle'])) {
            if (yetkikontrol()!="yetkili") {
              header("location:../index.php");
              exit;
            }
            $birimekle=$db->prepare("INSERT INTO birim SET
             birim_ad=:baslik,
             birim_detay=:detay,
             birim_durum=:aciliyet,
             birim_durum_id=:birim_durum_no
            ");

            $ekleme=$birimekle->execute(array(
             'baslik' => guvenlik($_POST['birim_ad']),
             'detay' => $_POST['birim_detay'],
             'aciliyet' => guvenlik($_POST['birim_durum']),
             'birim_durum_no' => guvenlik($_POST['birim_durum_id'])
           ));
            
            if ($ekleme) {
             header("location:../birimler?durum=ok");
             exit;
           } else {
             header("location:../birimler?durum=no");
             exit;
           }
           exit;
         }


         

         if (isset($_POST['birimguncelle'])) {
          if (yetkikontrol()!="yetkili") {
            header("location:../index.php");
            exit;
          }
          $birimguncelle=$db->prepare("UPDATE birim SET
           birim_ad=:baslik,
           birim_detay=:detay,
           birim_durum_id=:birim_durum_no,
           birim_durum=:aciliyet where birim_id={$_POST['birim_id']}");

          $guncelle=$birimguncelle->execute(array(
            'baslik' => guvenlik($_POST['birim_ad']),
            'detay' => $_POST['birim_detay'],
            'birim_durum_no' => guvenlik($_POST['birim_durum_id']),
            'aciliyet' => guvenlik($_POST['birim_durum'])
          ));

          if ($guncelle) {
            header("location:../birimler?durum=ok");
            exit;
          } else {
            header("location:../birimler?durum=no");
            exit;
          }
          exit;
        }

        

        if (isset($_POST['calisanekle'])) {
          if (yetkikontrol()!="yetkili") {
            header("location:../index.php");
            exit;
          }
          $calisanekle=$db->prepare("INSERT INTO calisanlar SET
            calisan_ismi=:isim,
            calisan_mail=:mail,
            calisan_telefon=:telefon,
            calisan_birim=:birim,
            calisan_sonuc=:test,
            calisan_test_id=:test_id,
            calisan_durum=:durum,
            calisan_durum_id=:durum_id,
            calisan_detay=:detay
            ");

          $ekleme=$calisanekle->execute(array(
            'isim' => guvenlik($_POST['calisan_ismi']),
            'mail' => guvenlik($_POST['calisan_mail']),
            'telefon' => guvenlik($_POST['calisan_telefon']),
            'birim' => guvenlik($_POST['calisan_birim']),
            'test' => guvenlik($_POST['calisan_sonuc']),
            'test_id' => guvenlik($_POST['calisan_test_id']),
            'durum' => guvenlik($_POST['calisan_durum']),
            'durum_id' => guvenlik($_POST['calisan_durum_id']),
            'detay' => $_POST['calisan_detay']
          ));
         if ($ekleme) {
          header("location:../calisanlar?durum=ok");
          exit;
        } else {
          header("location:../calisanlar?durum=no");
          exit;
        }
        exit;
      }




      if (isset($_POST['calisanguncelle'])) {
        if (yetkikontrol()!="yetkili") {
          header("location:../index.php");
          exit;
        }
        $calisanguncelle=$db->prepare("UPDATE calisanlar SET
          calisan_ismi=:isim,
          calisan_mail=:mail,
          calisan_telefon=:telefon,
          calisan_birim=:birim,
          calisan_sonuc=:test,
          calisan_test_id=:test_id,
          calisan_durum=:durum,
          calisan_durum_id=:durum_id,
          calisan_detay=:detay
          WHERE calisan_id={$_POST['calisan_id']}");

        $guncelle=$calisanguncelle->execute(array(
          'isim' => guvenlik($_POST['calisan_ismi']),
          'mail' => guvenlik($_POST['calisan_mail']),
          'telefon' => guvenlik($_POST['calisan_telefon']),
          'birim' => guvenlik($_POST['calisan_birim']),
          'test' => guvenlik($_POST['calisan_sonuc']),
          'test_id' => guvenlik($_POST['calisan_test_id']),
          'durum' => guvenlik($_POST['calisan_durum']),
          'durum_id' => $_POST['calisan_durum_id'],
          'detay' => $_POST['calisan_detay']
        ));

        if ($guncelle) {
          header("location:../calisanlar?durum=ok");
          exit;
        } else {
          echo "\nPDOStatement::errorInfo():\n";
          $arr = $guncelle->errorInfo();
          print_r($arr);
          exit;
        }
        exit;
      }





      if (isset($_POST['sifreguncelle'])) {
        if (yetkikontrol()!="yetkili") {
          header("location:../index.php");
          exit;
        }
        $eskisifre=guvenlik($_POST['eskisifre']);
        $yenisifre_bir=guvenlik($_POST['yenisifre_bir']); 
        $yenisifre_iki=guvenlik($_POST['yenisifre_iki']);

        $kul_sifre=md5($eskisifre);

        $kullanicisor=$db->prepare("SELECT * FROM kullanicilar WHERE kul_sifre=:sifre AND kul_id=:id");
        $kullanicisor->execute(array(
          'id' => guvenlik($_POST['kul_id']),
          'sifre' => $kul_sifre
        ));

        $say=$kullanicisor->rowCount();

        if ($say==0) {
          header("Location:../profil?durum=eskisifrehata");
        } else {

          if ($yenisifre_bir==$yenisifre_iki) {
           if (strlen($yenisifre_bir)>=6) {

            $sifre=md5($yenisifre_bir);
            $kullanici_yetki=0;
            $kullanicikaydet=$db->prepare("UPDATE kullanicilar SET
             kul_sifre=:kul_sifre
             WHERE kul_id=:kul_id");

            $insert=$kullanicikaydet->execute(array(
             'kul_sifre' => $sifre,
             'kul_id'=>guvenlik($_POST['kul_id'])
           ));

            if ($insert) {
             header("Location:../profil.php?durum=sifredegisti");

           } else {
             header("Location:../profil.php?durum=no");
           }


         } else {
          header("Location:../profil.php?durum=eksiksifre");
        }

      } else {
       header("Location:../profil?durum=sifreleruyusmuyor");
       exit;
     }
   }
   exit;
   if ($update) {
    header("Location:../profil?durum=ok");

  } else {
    header("Location:../profil?durum=no");
  }
}


if (isset($_POST['profilguncelle'])) {
  if (yetkikontrol()!="yetkili") {
    header("location:../index.php");
    exit;
  }
  if (isset($_SESSION['kul_mail'])) {

			$boyut = $_FILES['kul_logo']['size'];
            if($boyut > 3145728)
            {
           
                echo 'Dosya 3MB den büyük olamaz.';
              } else {
               $yuklemeklasoru = '../img';
               @$gecici_isim = $_FILES['kul_logo']["tmp_name"];
               @$dosya_ismi = $_FILES['kul_logo']["name"];
               $benzersizsayi1=rand(10000,99999);
               $benzersizsayi2=rand(10000,99999);
               $isim=$benzersizsayi1.$benzersizsayi2.$dosya_ismi;
               $resim_yolu=substr($yuklemeklasoru, 3)."/".tum_bosluk_sil($isim);
               @move_uploaded_file($gecici_isim, "$yuklemeklasoru/$isim");            	
             }
             $uzunluk=strlen($resim_yolu);
             if ($uzunluk<18) {
               $profilguncelle=$db->prepare("UPDATE kullanicilar SET
                kul_isim=:isim,
                kul_mail=:mail,
                kul_telefon=:telefon,
                kul_unvan=:unvan WHERE session_mail=:session_mail");
               $ekleme=$profilguncelle->execute(array(
                'isim' => guvenlik($_POST['kul_isim']),
                'mail' => guvenlik($_POST['kul_mail']),
                'telefon' => guvenlik($_POST['kul_telefon']),
                'unvan' => guvenlik($_POST['kul_unvan']),
                'session_mail' => $_SESSION['kul_mail']
              ));
               if ($ekleme) {
                header("Location:../profil?durum=ok");
              } else {

                header("Location:../profil?durum=no");
              }
              exit;
            } else {
            	$profilguncelle=$db->prepare("UPDATE kullanicilar SET
            		kul_isim=:isim,
            		kul_mail=:mail,
            		kul_telefon=:telefon,
            		kul_unvan=:unvan,
            		kul_logo=:logo WHERE session_mail=:session_mail");
            	$ekleme=$profilguncelle->execute(array(
            		'isim' => guvenlik($_POST['kul_isim']),
            		'mail' => guvenlik($_POST['kul_mail']),
            		'telefon' => guvenlik($_POST['kul_telefon']),
            		'unvan' => guvenlik($_POST['kul_unvan']),
            		'logo' => $resim_yolu,
            		'session_mail' => $_SESSION['kul_mail']
            	));

            	if ($ekleme) {
            		header("Location:../profil?durum=ok");
            	} else {
            		header("Location:../profil?durum=noff");
            	}
            	exit;
            }
          }
          header("Location:../profil");
          exit;
        }
     
        if (isset($_POST['calisansilme'])) {
          if (yetkikontrol()!="yetkili") {
            header("location:../index.php");
            exit;
          }
          $sil=$db->prepare("DELETE from calisanlar where calisan_id=:id");
          $kontrol=$sil->execute(array(
            'id' => guvenlik($_POST['calisan_id'])
          ));

          if ($kontrol) {
            header("location:../calisanlar?durum=ok");
            exit;
          } else {
            header("location:../calisanlar?durum=no");
            exit;

          }
        }
        if (isset($_POST['birimsil'])) {
          if (yetkikontrol()!="yetkili") {
            header("location:../index.php");
            exit;
          }
          $sil=$db->prepare("DELETE from birim where birim_id=:id");
          $kontrol=$sil->execute(array(
            'id' => guvenlik($_POST['birim_id'])
          ));

          if ($kontrol) {
            header("location:../birimler?durum=ok");
            exit;
          } else {
            header("location:../birimler?durum=no");
            exit;
          }
        }
        ?>
