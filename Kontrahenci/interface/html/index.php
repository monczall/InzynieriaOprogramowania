<!DOCTYPE HTML>
<html lang="pl">
<head>

	<meta charset="utf-8" />

 	<title>Kontrahenci</title>
    <!--------------------------SCRIPTS------------------>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
    <!----------------------WLASNY_CSS--------------------->
    <link rel="stylesheet" href="../css/style.css">

	<script>
	function reloadHead(){
		location.href = "http://localhost/Kontrahenci/interface/html/";
	}
	</script>

</head>



<body>
    <main>
		<div id="header" onclick="reloadHead();">
			Moduł zarządzania kontrahentami
		</div>
        <div id="left">
		<iframe name="dummyframe" id="dummyframe" style="display: none;"></iframe>
            <div>
              <form action="" method="POST">
              <input placeholder="Wpisz" name="search-input" id="search-input">
              <select id="select-input" name="searchby">
                <option value="nip">NIP</option>
                <option value="nazwafirmy">Nazwa Firmy</option>
                <option value="nazwisko">Nazwisko</option>
              </select>
              <input type="submit" id="search-btn" value="Szukaj">
            	</form>
            </div>

            <table id="table" style="margin-top: 0px;">

				<h2 style="margin: 0px; margin-top: 40px; color: #ced4da;">Kontrahenci</h2>
				<br>
				
                <thead>
                    <th hidden>ID</th>
                    <th>Imie</th>
                    <th>Nazwisko</th>
                    <th>Nazwa firmy</th>
                    <th>Data rejestracji</th>
                    <th>NIP</th>
                    <th colspan="4">Więcej</th>
                </thead>
                <tbody>
				
                 <?php
if (isset($_POST['search-input']) && isset($_POST['searchby']) && !empty($_POST['search-input'])) $json = @file_get_contents("http://localhost/kontrahenci/api/contractor/readcontractor.php?" . $_POST['searchby'] . "=" . $string = str_replace('-','', str_replace(' ', '%20', $_POST['search-input'])));

else $json = @file_get_contents("http://localhost/kontrahenci/api/contractor/readcontractor.php");

if ($json)
{
    $arr = json_decode($json);
    foreach ($arr->Kontrahenci as $key => $value)
    {
?>
        
		<form method='get'>
			<tr>	
				<input type="hidden" value="<?php echo $value->id_kontrahenta; ?>" name="id">
				<input type="hidden" value="<?php echo $value->nazwa_firmy; ?>" name="val_nazwa_firmy">
				<input type="hidden" value="<?php echo $value->nip; ?>" name="val_nip_do_obliczen">
                <td><?php echo $value->imie; ?></td>
                <td><?php echo $value->nazwisko; ?></td>
                <td><?php echo $value->nazwa_firmy; ?></td>
                <td><?php echo $value->data_rejestracji; ?></td>
                <td><?php echo $value->nip; ?></td>
				<td><input type="submit" name="action" value="wyswietl"></td>
                <td><input type="submit" name="action" value="edytuj"></td>
                <td><input type="submit" name="action" value="ukryj"></td>
				<td><input type="submit" name="action" value="wyswietl saldo"></td>
			</tr>
		</form>
			
<?php
    }
}
else
{
    echo "Nie znaleziono rekordów.";
} ?>
						</tbody>
            </table>

            <section hidden id="update-row">
                <label>Name:</label>
                <input type="text" id="update-name-input">
                <button id="update-row-btn">Update</button>
            </section>

<form method="get">
						<input type="submit" name="dodaj" value="Dodaj kontrahenta">
						<input type="submit" name="dodaj" value="Dodaj oddzial">
						<input type="submit" name="dodaj" value="Dodaj osobe">
</form>
        </div>

        <div id="right">

					<?php
// DODAJ-------------------------------------------------------------------------------------------------------------------------------
// KONTRAHENTA-------------------------------------------------------------------------------------------------------------------------
if (isset($_GET['dodaj']) && $_GET['dodaj'] == 'Dodaj kontrahenta')
{
?>
	
 	<form  method="get" action="http://localhost/Kontrahenci/api/contractor/readcontractor.php?create=" target="dummyframe" onsubmit="setTimeout(function(){window.location.reload();},10);">
 	<table>
	 	<h2 style ="color: #ced4da;">Dodaj Kontrahenta</h2>
	  	<tr><td><span class="rows">Imie: </span><input name="imie" required></td></td>
		<tr><td><span class="rows">Nazwisko: </span><input name="nazwisko" required></td></td>
	  	<tr><td><span class="rows">Nazwa firmy: </span><input name="nazwa_firmy" required></td></td>
		<input type="hidden" value = "<?php $mydate=getdate(date("U")); $month = date('m'); echo "$mydate[year]-$month-$mydate[mday]";?>" name="data_rejestracji" required>
		<tr><td><span class="rows">Nip: </span><input name="nip" maxlength="13" required></td></td>
		<input type="hidden" name="ukryj_kontrahenta" value="0" required>
		<tr><td><input type="submit" name="create" value="Dodaj"></td></td>

	</table>
 </form>
<?php
}

// ODDZIAL-------------------------------------------------------------------------------------------------------------------------
if (isset($_GET['dodaj']) && $_GET['dodaj'] == 'Dodaj oddzial')
{
	$json = @file_get_contents("http://localhost/kontrahenci/api/contractor/readcontractor.php?getId=1");


?>

 	<form  method="get" action="http://localhost/Kontrahenci/api/contractor/readadres.php?create=" target="dummyframe" onsubmit="setTimeout(function(){window.location.reload();},10);">
 	<table>
	 	<h2 style ="color: #ced4da;">Dodaj oddział</h2>
	  	<tr><td><span class="rows">Ulica: </span><input name="ulica" required></td></td>
		<tr><td><span class="rows">Numer budynku: </span><input name="numer_budynku" required></td></td>
	  	<tr><td><span class="rows">Miasto: </span><input name="miasto" required></td></td>
		<tr><td><span class="rows">Kod pocztowy: </span><input name="kod_pocztowy" required></td></td>
			<tr><td><span class="rows">Kraj: </span><input name="kraj" required></td></td>
		<tr><td><span class="rows">Nazwa oddziału: </span><input name="nazwa_oddzialu" required></td></td>
			<tr><td><span class="rows">Email: </span><input name="email" required></td></td>
		<tr><td><span class="rows">Numer telefonu: </span><input name="numer_telefonu" required></td></td>
			<tr><td><span class="rows">Oddział głowny: </span><input type="checkbox" name="oddzial_glowny" value=1></td></td>
		<tr><td><span class="rows">NIP: </span><select name="id_kontrahenta" required>
			<?php foreach ($arr->Kontrahenci as $key => $value)
			{?>
			<option value="<?php echo $value->id_kontrahenta; ?>"><?php echo $value->nip; ?> </option>
			<?php } ?>
			</td></td>
		<tr><td><input type="submit" name="create" value="Dodaj"></td></td>

	</table>
 </form>
<?php
}

// OSOBE-------------------------------------------------------------------------------------------------------------------------
if (isset($_GET['dodaj']) && $_GET['dodaj'] == 'Dodaj osobe')
{
	$adresy_json = @file_get_contents("http://localhost/kontrahenci/api/contractor/readadres.php?getId2=1");

		$adresy_arr = @json_decode($adresy_json);




?>

 	<form  method="get" action="http://localhost/Kontrahenci/api/contractor/readosoba.php?create=" target="dummyframe" onsubmit="setTimeout(function(){window.location.reload();},10);">
 	<table>
	 	<h2 style ="color: #ced4da;">Dodaj osobę kontaktową</h2>
	  	<tr><td><span class="rows">Imię: </span><input name="imie_osoba" required></td></td>
		<tr><td><span class="rows">Nazwisko: </span><input name="nazwisko_osoba" required></td></td>
	  	<tr><td><span class="rows">Numer telefonu: </span><input name="numer_telefonu_osoba" required></td></td>
		<tr><td><span class="rows">Email: </span><input name="email_osoba" required></td></td>
		<tr><td><span class="rows">Oddział: </span><select name="id_oddzialu" required>
			<?php foreach ($adresy_arr->Adresy as $key => $value)
			{?>
			<option value="<?php echo $value->id_oddzialu; ?>"><?php echo $value->nazwa_oddzialu; ?> </option>
			<?php } ?>
			</td></td>
		<tr><td><input type="submit" name="create" value="Dodaj"></td></td>

	</table>
 </form>
<?php
}

// WYSWIETL-------------------------------------------------------------------------------------------------------------------------------
if (isset($_GET['action']) && $_GET['action'] == 'wyswietl')
{
?>

<p id="demo"></p>
	<script>

	function Get(yourUrl){
	    var Httpreq = new XMLHttpRequest();
	    Httpreq.open("GET",yourUrl,false);
	    Httpreq.send(null);
	    return Httpreq.responseText;
	}


	var data = JSON.parse(Get('http://localhost/Kontrahenci/api/contractor/readall.php/?id="<?php echo $_GET['id']?>"'));
	var  i, j, z = "";
  	var m = 0;
	var n = 0;
  	var x = " ";


	for(i in data.Kontrahent){
		x +=  "<table class="+"right_table"+">";
		x += "<tr><td><h2>Kontrahent</h2></td></tr>" ;
		x +=  "<tr><td><span class="+"rows"+">Imię:  </span> " + data.Kontrahent[i].imie + "</td></tr>";
		x +=  "<tr><td><span class="+"rows"+">Nazwisko:  </span> " + data.Kontrahent[i].nazwisko + "</td></tr>";
		x +=  "<tr><td><span class="+"rows"+">Nazwa firmy:  </span> " + data.Kontrahent[i].nazwa_firmy + "</td></tr>";
		x +=  "<tr><td><span class="+"rows"+">Data rejestracji:  </span> " + data.Kontrahent[i].data_rejestracji + "</td></tr>";
		x +=  "<tr><td><span class="+"rows"+">Nip:  </span> " + data.Kontrahent[i].nip + "</td></tr>";
		x +=  "</table>";
		
		
		
		for (j in data.Kontrahent[i].adresy_oddzialow.Oddzialy) {
			m=parseInt(j)+1;
			x +=  "<table class="+"right_table"+">";
			x += "<tr><td><h2>Oddział "+ m +"</h2></td></tr>";
	    	x += "<tr><td><span class="+"rows"+">Ulica:  </span> " + data.Kontrahent[i].adresy_oddzialow.Oddzialy[j].ulica + "</td></tr>";
			x += "<tr><td><span class="+"rows"+">Numer budynku:  </span> " + data.Kontrahent[i].adresy_oddzialow.Oddzialy[j].numer_budynku + "</td></tr>";
		 	x += "<tr><td><span class="+"rows"+">Miasto:  </span> " + data.Kontrahent[i].adresy_oddzialow.Oddzialy[j].miasto + "</td></tr>";
			x += "<tr><td><span class="+"rows"+">Kod pocztowy:  </span> " + data.Kontrahent[i].adresy_oddzialow.Oddzialy[j].kod_pocztowy + "</td></tr>";
			x += "<tr><td><span class="+"rows"+">Kraj:  </span> " + data.Kontrahent[i].adresy_oddzialow.Oddzialy[j].kraj + "</td></tr>";
			x += "<tr><td><span class="+"rows"+">Nazwa oddziału:  </span> " + data.Kontrahent[i].adresy_oddzialow.Oddzialy[j].nazwa_oddzialu + "</td></tr>";
			x += "<tr><td><span class="+"rows"+">Email:  </span> " + data.Kontrahent[i].adresy_oddzialow.Oddzialy[j].email + "</td></tr>";
			x += "<tr><td><span class="+"rows"+">Numer telefonu:  </span> " + data.Kontrahent[i].adresy_oddzialow.Oddzialy[j].numer_telefonu + "</td></tr>";

			 for (z in data.Kontrahent[i].adresy_oddzialow.Oddzialy[j].osoby_kontaktowe.OsobyKontaktowe) {
				 n=parseInt(z)+1;
				x += "<tr><td><h2>Osoba kontaktowa "+ n +"</h2></td></tr>";
				x += "<tr><td><span class="+"rows"+">Imię:  </span> " + data.Kontrahent[i].adresy_oddzialow.Oddzialy[j].osoby_kontaktowe.OsobyKontaktowe[z].imie_osoba + "</td></tr>";
				x += "<tr><td><span class="+"rows"+">Nazwisko:  </span> " + data.Kontrahent[i].adresy_oddzialow.Oddzialy[j].osoby_kontaktowe.OsobyKontaktowe[z].nazwisko_osoba + "</td></tr>";
				x += "<tr><td><span class="+"rows"+">Numer telefonu:  </span> " + data.Kontrahent[i].adresy_oddzialow.Oddzialy[j].osoby_kontaktowe.OsobyKontaktowe[z].numer_telefonu_osoba + "</td></tr>";
				x += "<tr><td><span class="+"rows"+">Email:  </span> "+  data.Kontrahent[i].adresy_oddzialow.Oddzialy[j].osoby_kontaktowe.OsobyKontaktowe[z].email_osoba + "</td></tr>";

	  }
 				x +=  "</table>";
	  }

	}


	document.getElementById("demo").innerHTML = x;
	</script>

<?php

}
// WYSWIETL SALDO------------------------------------------------------------------------------------------------------------------------

if (isset($_GET['action']) && $_GET['action'] == 'wyswietl saldo')
{

	$val_nazwa_firmy = $_GET['val_nazwa_firmy'];
	$val_nip_do_obliczen = $_GET['val_nip_do_obliczen'];
	?>
			<!------------------>
			<!--POCZĄTEK-SALD--->
			<!------------------>
			<h2 style ="color: #ced4da;"> Wybierz okres rozliczeniowy dla firmy <?php echo $val_nazwa_firmy;?></h2>
			<h2 style ="color: #ced4da;"> NIP: <?php echo $val_nip_do_obliczen;?></h2>
			<form method='get'>	
				<input type="hidden" name="val2_nazwa_firmy" value="<?php echo $val_nazwa_firmy?>">
				<input type="hidden" name="val2_nip_do_obliczen" value="<?php echo $val_nip_do_obliczen?>">
				<input type="date" name="val2_data_od" value="<?php $mydate=getdate(date("U")); $month = date('m'); echo "$mydate[year]-$month-01";?>" name="data_rejestracji" required>
				<input type="date" name="val2_data_do" value="<?php $mydate=getdate(date("U")); $month = date('m'); echo "$mydate[year]-$month-$mydate[mday]";?>" name="data_rejestracji" required>
				<input type="submit" name="daty" value="Wyświetl salda">
			</form>

			<?php
			
}
if (isset($_GET['daty']) && isset($_GET['daty'])== 'Wyświetl salda')
			{
				//echo " " . $_GET['val2_nazwa_firmy'];
				//echo " " . $_GET['val2_nip_do_obliczen'];
				//echo " " . $_GET['val2_data_od'];
				//echo " " . $_GET['val2_data_do'];
			?>
			<h2 style ="color: #ced4da;"> Salda dla firmy: <?php echo $_GET['val2_nazwa_firmy'];?> </h2>
			<h2 style ="color: #ced4da;"> NIP: <?php echo $_GET['val2_nip_do_obliczen'];?> </h2>
			<h2 style ="color: #ced4da;"> W okresie rozliczeniowym od: <?php echo $_GET['val2_data_od'];?> do: <?php echo $_GET['val2_data_do'];?></h2>
			<table id="tabelkaSald" style="margin-top: 0px;">
				<thead>
					<th>ID</th>
					<th>Numer Faktury</th>
                    <th>NIP</th>
                    <th>Status faktury</th>
                    <th>Wartość faktury brutto</th>
                    <th>Data płatności</th>
                </thead>
				<tbody>
					<?php
						$ch = curl_init();

						$url = "http://modul-fakturowania.cba.pl/Project/api/invoice/endPoint.php?NIP=" . $_GET['val2_nip_do_obliczen'] . "&Data_od=" . $_GET['val2_data_od'] . "&Data_do=" . $_GET['val2_data_do'] . "";
						
						curl_setopt($ch, CURLOPT_RETURNTRANSFER, True);
    					curl_setopt($ch, CURLOPT_URL, $url);
    					curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Macintosh; Intel Mac OS X 10.7; rv:7.0.1) Gecko/20100101 Firefox/7.0.1');
						
						
						$faktury_json = curl_exec($ch);
						$faktury1_arr = json_decode($faktury_json,true);
						curl_close($ch);
						//$faktury_arr["Błąd"] != "Nie znaleziono faktur.";
						error_reporting(0);
						if($faktury_json && $faktury1_arr["Błąd"] != "Nie znaleziono faktur."){
							error_reporting(E_ALL);
							 
							$faktury_arr = json_decode($faktury_json);
							$saldo_ostateczne = 0;
							$faktury_ilosc_wszystkich = 0;
							$faktury_ilosc_zaplaconych = 0;
							$kwota_zaplaconych = 0;
							$faktury_ilosc_nie_zaplaconych = 0;
							$kwota_nie_zaplaconych = 0;
							$stan_err = 0;
							foreach ($faktury_arr->Faktury as $key => $faktury_value){

							?>
								<tr>
								<td><?php echo $faktury_value->id_faktura; ?></td>
                				<td><?php echo $faktury_value->numer_faktury; ?></td>
                				<td><?php echo $faktury_value->NIP; ?></td>
                				<td><?php echo $faktury_value->status_faktury; ?></td>
								<td><?php echo $faktury_value->Wartosc_faktury_brutto; ?></td>
								<td><?php echo $faktury_value->data_wystawienia; ?></td>
								<?php
									if($faktury_value->status_faktury == 'Nie opłacona'){
										
										$faktury_ilosc_wszystkich++;
										$faktury_ilosc_nie_zaplaconych++;
										$kwota_zaplaconych = $kwota_zaplaconych +(float)$faktury_value->Wartosc_faktury_brutto;
										$saldo_ostateczne = $saldo_ostateczne - (float)$faktury_value->Wartosc_faktury_brutto;
									}else if($faktury_value->status_faktury == 'Opłacona'){
										
										$faktury_ilosc_wszystkich++;
										$faktury_ilosc_zaplaconych++;
										$kwota_nie_zaplaconych = $kwota_nie_zaplaconych +(float)$faktury_value->Wartosc_faktury_brutto;
										//$saldo_ostateczne = $saldo_ostateczne + (float)$faktury_value->wartosc_faktury_brutto;
									}else{
										$stan_err++;
									}
								?>

							</tr>
							
							
							<?php
							}
							?>
							
							<tr>
								<td></td>
								<td></td>
								<td><b>Zapłacone</b><br><?php echo $faktury_ilosc_zaplaconych?></td>
								<td><b>Nie zapłacone</b><br><?php echo $faktury_ilosc_nie_zaplaconych?></td>
								<td></td>
								<td></td>
							</tr>
							<tr>	
								<td></td>
								<td><b>Kwota:</b></td>
								<td><span style="font-size:24px; color:green"><?php echo $kwota_zaplaconych?></span></td>
								<td><span style="font-size:24px; color:red"><?php echo $kwota_nie_zaplaconych?></span></td>
								<td><b>Saldo:</b></td>
								<td><b>
									<?php 
										if($stan_err == 0){
											if($saldo_ostateczne < 0){
												?>
													<span style="font-size:24px; color:red">
												<?php
													echo $saldo_ostateczne; 
												?>
													</span>
												<?php
											}else{
												?>
													<span style="font-size:24px; color:green">
												<?php
													echo "Opłacone"; 
												?>
													</span>
												<?php
											}
										}else{
											if($saldo_ostateczne < 0){
												?>
													<span style="font-size:24px; color:red">
												<?php
													echo $saldo_ostateczne ?><br><?php echo "!! Istnieją faktury z nieprawidłowym statusem !!"; 
												?>
													</span>
												<?php
											}else{
												?>
													<span style="font-size:24px; color:green">
												<?php
													echo "Opłacone" ?><br><?php echo "!! Istnieją faktury z nieprawidłowym statusem !!"; 
												?>
													</span>
												<?php
											}
										}
										
									?>
								</b></td>
								<tr>
							
							<?php
						}else{
							error_reporting(E_ALL);
							?>
							<td colspan= "6" ><?php echo "Brak danych w wybranym okresie rozliczeniowym"; ?></td>
							<?php
							
						}
						
					?>
					
				</tbody>
			</table>
			<!------------------>
			<!---KONIEC-SALD---->
			<!------------------>

			<?php
			}

// EDYCJA------------------------------------------------------------------------------------------------------------------------
if (isset($_GET['action']) && $_GET['action'] == 'edytuj')
{




?>

	<form method="get" action="http://localhost/Kontrahenci/interface/html/?id=<?php echo $_GET['id'] ?>&action=edytuj" target="dummyframe" onsubmit="setTimeout(function(){window.location.reload();},10);">
	<p id="demo">
	</p></form>


	<script>

	



	function Get(yourUrl){
	    var Httpreq = new XMLHttpRequest();
	    Httpreq.open("GET",yourUrl,false);
	    Httpreq.send(null);
	    return Httpreq.responseText;
	}


	var data = JSON.parse(Get('http://localhost/Kontrahenci/api/contractor/readall.php/?id="<?php echo $_GET['id']?>"'));
	var  i, j, z = "";
  	var m = 0;
	var n = 0;
  	var x = " ";
  	var k = 0;
	var h = 0;

	for(i in data.Kontrahent){
		x +=  "<table class="+"right_table"+">";

		x +=  "<tr><td><h2>Kontrahent</h2></td></tr>" ;
		x +=  "<input type="+"hidden"+" name="+"updateId"+ " value=" + data.Kontrahent[i].id_kontrahenta +">";
	  	x +=  "<tr><td><span class="+"rows"+">Imię:  </span> " +"<input value=" + data.Kontrahent[i].imie + " name="+"imie"+" required></td></tr>";
		x +=  "<tr><td><span class="+"rows"+">Nazwisko:  </span> " +"<input value=" + data.Kontrahent[i].nazwisko + " name="+"nazwisko"+" required></td></tr>";
		x +=  "<tr><td><span class="+"rows"+">Nazwa firmy:  </span> " +"<input value=" + data.Kontrahent[i].nazwa_firmy + " name="+"nazwa_firmy"+" required></td></tr>";
		x +=  "<tr><td><span class="+"rows"+">Data rejestracji:  </span> " +"<input type="+"date"+" value=" + data.Kontrahent[i].data_rejestracji + " name="+"data_rejestracji"+" required></td></tr>";
		x +=  "<tr><td><span class="+"rows"+">Nip:  </span> "+"<input value=" + data.Kontrahent[i].nip + " name="+"nip"+" maxlength="+"13"+" required></td></tr>";
		x +=  "<input type="+"submit"+" name="+"update"+" value="+"Potwierdz"+" >";

		x +=  "</table>";
		for (j in data.Kontrahent[i].adresy_oddzialow.Oddzialy) {
			m=parseInt(j)+1;
			k=parseInt(j);
			x += "<table class="+"right_table"+">";

			x += "<tr><td><h2>Oddział "+ m +"</h2></td></tr>";
			x += "<input type="+"hidden"+" name="+"inkrmentacja"+"  value=" + k +">";
			x += "<input type="+"hidden"+" name="+"updateIdA"+k+""+ " value=" + data.Kontrahent[i].adresy_oddzialow.Oddzialy[j].id_oddzialu +">";
	    	x += "<tr><td><span class="+"rows"+">Ulica:  </span> " +"<input value=" + data.Kontrahent[i].adresy_oddzialow.Oddzialy[j].ulica + " name="+"ulica"+k+" required></td></tr>";
			x += "<tr><td><span class="+"rows"+">Numer budynku:  </span> " + "<input value=" + data.Kontrahent[i].adresy_oddzialow.Oddzialy[j].numer_budynku + " name="+"numer_budynku"+k+" required></td></tr>";
		  	x += "<tr><td><span class="+"rows"+">Miasto:  </span> " + "<input value=" + data.Kontrahent[i].adresy_oddzialow.Oddzialy[j].miasto + " name="+"miasto"+k+" required></td></tr>";
			x += "<tr><td><span class="+"rows"+">Miasto:  </span> " + "<input value=" + data.Kontrahent[i].adresy_oddzialow.Oddzialy[j].kod_pocztowy + " name="+"kod_pocztowy"+k+" required></td></tr>";
			x += "<tr><td><span class="+"rows"+">Kraj:  </span> " + "<input value=" + data.Kontrahent[i].adresy_oddzialow.Oddzialy[j].kraj + " name="+"kraj"+k+" required></td></tr>";
			x += "<tr><td><span class="+"rows"+">Nazwa oddziału:  </span> " + "<input value=" + data.Kontrahent[i].adresy_oddzialow.Oddzialy[j].nazwa_oddzialu + " name="+"nazwa_oddzialu"+k+" required></td></tr>";
			x += "<tr><td><span class="+"rows"+">Email:  </span> " + "<input value=" + data.Kontrahent[i].adresy_oddzialow.Oddzialy[j].email + " name="+"email"+k+" required></td></tr>";
			x += "<tr><td><span class="+"rows"+">Numer telefonu:  </span> " + "<input value=" + data.Kontrahent[i].adresy_oddzialow.Oddzialy[j].numer_telefonu + " name="+"numer_telefonu"+k+" required></td></tr>";

			 for (z in data.Kontrahent[i].adresy_oddzialow.Oddzialy[j].osoby_kontaktowe.OsobyKontaktowe) {
				 n=parseInt(z)+1;
				 h=parseInt(z);

				x += "<tr><td><h2>Osoba kontaktowa "+ n +"</h2></td></tr>";
				x += "<input type="+"hidden"+" name="+"inkrmentacja2"+"  value=" + k+h+">";
				x += "<input type="+"hidden"+" name="+"updateIdO"+k+h+""+ " value=" + data.Kontrahent[i].adresy_oddzialow.Oddzialy[j].osoby_kontaktowe.OsobyKontaktowe[z].id_osoby_kontaktowej+ " name="+"id_osoby_kontaktowej"+k+h+">";
				x += "<tr><td><span class="+"rows"+">Imię:  </span> " + "<input value=" + data.Kontrahent[i].adresy_oddzialow.Oddzialy[j].osoby_kontaktowe.OsobyKontaktowe[z].imie_osoba +  " name="+"imie_osoba"+k+h+" required></td></tr>";
				x += "<tr><td><span class="+"rows"+">Nazwisko:  </span> " + "<input value=" + data.Kontrahent[i].adresy_oddzialow.Oddzialy[j].osoby_kontaktowe.OsobyKontaktowe[z].nazwisko_osoba + " name="+"nazwisko_osoba"+k+h+" required></td></tr>";
				x += "<tr><td><span class="+"rows"+">Numer telefonu:  </span> " + "<input value=" + data.Kontrahent[i].adresy_oddzialow.Oddzialy[j].osoby_kontaktowe.OsobyKontaktowe[z].numer_telefonu_osoba +  " name="+"numer_telefonu_osoba"+k+h+" required></td></tr>";
				x += "<tr><td><span class="+"rows"+">Email:  </span> "+"<input value=" +  data.Kontrahent[i].adresy_oddzialow.Oddzialy[j].osoby_kontaktowe.OsobyKontaktowe[z].email_osoba +  " name="+"email_osoba"+k+h+" required></td></tr>";

	  }
				x +=  "</table>";

	  }

	}

	document.getElementById("demo").innerHTML = x;
	</script>




		 <?php
}


if (isset($_GET['update']))
{

$x = 9;
$d = 9;

    $json = @file_get_contents("http://localhost/Kontrahenci/api/contractor/readcontractor.php?update=" . "&id_kontrahenta=" . $_GET['updateId'] . "&imie=" . $_GET['imie'] . "&nazwisko=" . $_GET['nazwisko'] . "&nazwa_firmy=" . $_GET['nazwa_firmy'] . "&data_rejestracji=" . $_GET['data_rejestracji'] . "&nip=" . $_GET['nip']);

		for ($i=0;$i <= $x; $i++) {
    $json = @file_get_contents("http://localhost/Kontrahenci/api/contractor/readadres.php?update=" . "&id_oddzialu=" . $_GET['updateIdA'.$i.''] . "&ulica=" . $_GET['ulica'.$i.''] . "&numer_budynku=" . $_GET['numer_budynku'.$i.''] . "&miasto=" . $_GET['miasto'.$i.''] . "&kod_pocztowy=" . $_GET['kod_pocztowy'.$i.''] . "&kraj=" . $_GET['kraj'.$i.''] . "&nazwa_oddzialu=" . $_GET['nazwa_oddzialu'.$i.''] . "&email=" . $_GET['email'.$i.''] . "&numer_telefonu=" . $_GET['numer_telefonu'.$i.'']);


	}
		for ($i=0;$i <= $x; $i++) {
			for ($k=0;$k <= $d; $k++) {
		$json = @file_get_contents("http://localhost/Kontrahenci/api/contractor/readosoba.php?update=" . "&id_osoby_kontaktowej=" . $_GET['updateIdO'.$i.$k.''] . "&imie_osoba=" . $_GET['imie_osoba'.$i.$k.''] . "&nazwisko_osoba=" . $_GET['nazwisko_osoba'.$i.$k.''] . "&numer_telefonu_osoba=" . $_GET['numer_telefonu_osoba'.$i.$k.''] . "&email_osoba=" . $_GET['email_osoba'.$i.$k.'']);
}}
}

if (isset($_GET['action']) && $_GET['action'] == 'ukryj')
{
	$json = @file_get_contents("http://localhost/kontrahenci/api/contractor/readcontractor.php?input=" . $_GET['id'] . "&action=" . $_GET['action']);
	echo("<meta http-equiv='refresh' content='0; url=http://localhost/Kontrahenci/interface/html/' >");
    //echo "Ukryto kontrahenta o id: " . ($_GET['id']);
}

if (isset($_POST['search4']))
{
    $json = @file_get_contents("http://localhost/kontrahenci/api/contractor/readcontractor.php");

    if ($json)
    {
        $arr = json_decode($json);
        foreach ($arr->Kontrahenci as $key => $value)
        {

            echo $value->imie;
            echo $value->nazwisko;
            echo $value->nazwa_firmy;
            echo $value->data_rejestracji;
            echo $value->nip;
        }
    }
} ?>

					        </div>
    </main>





</body>
</html>