<?php
	require_once 'config.php';
	$dbconn = mysqli_connect(DB_HOST, DB_USER, DB_PSWD, DB_NAME) or die(mysql_error());
	require_once 'header.php';
	require_once 'tabbalk.php';
	$moment = isset($_POST['moment']) ? $_POST['moment'] : date('Y-m-d');
?>
<h1>Arbeidsduur</h1>

<form id=phpForm action="" method="post">
<table>
<colgroup><col width="50%"/><col width="50%"/></colgroup>
<tr><td class="label">Arbeidsovereenkomst, Datum indienen verzoek:</td><td><input name="overeenkomst" value="<?php echo isset($_POST['haalop']) ? $_POST['overeenkomst'] : ''; ?>"/></td></tr>
<?php 
	if (isset($_POST['overeenkomst'])) {
		$result = mysqli_query($dbconn, "SELECT id, content FROM arbeidsduur WHERE name = '" . str_replace(' ', '', $_POST['overeenkomst']) . "'");
		$row = mysqli_fetch_array($result);
		if ($row) {
			$uuid = $row[0];
			$json = json_decode($row[1], true);
		} else {
			$uuid = '';
			echo '<tr><td></td><td class="fout">Arbeidsovereenkomst,datumIndienenVerzoek combi ' . $_POST['overeenkomst'] . ' onbekend!</td></tr>' . "\n";
			unset($_POST['haalop']);
		}	// end if
		mysqli_free_result($result);
	}	// end if

	if (isset($_POST['haalop'])) {
		echo '<tr><td class="label">Arbeidsovereenkomst:</td><td><input name="arbeidsovereenkomst" value="' . $json['arbeidsduur']['arbeidsovereenkomst'] . '"/></td></tr>' . "\n";
		echo '<tr><td class="label">Datum indienen verzoek:</td><td><input name="datumIndienenVerzoek" value="' . $json['arbeidsduur']['datumIndienenVerzoek'] . '"/></td></tr>' . "\n";
		echo '<tr><td class="label">Datum vorig versie van het verzoek:</td><td><input name="datumVorigVerzoek" value="' . $json['arbeidsduur']['datumVorigVerzoek'] . '"/></td></tr>' . "\n";
		echo '<tr><td class="label">Datum overleg plegen:</td><td><input name="datumOverlegPlegen" value="' . $json['arbeidsduur']['datumOverlegPlegen'] . '"/></td></tr>' . "\n";
		echo '<tr><td class="label">Datum inwilligen verzoek:</td><td><input name="datumInwilligenVerzoek" value="' . $json['arbeidsduur']['datumInwilligenVerzoek'] . '"/></td></tr>' . "\n";
		echo '<tr><td class="label">Datum afwijzen verzoek:</td><td><input name="datumAfwijzenVerzoek" value="' . $json['arbeidsduur']['datumAfwijzenVerzoek'] . '"/></td></tr>' . "\n";
		echo '<tr><td class="label">Datum vaststellen spreiding:</td><td><input name="datumVaststellenSpreiding" value="' . $json['arbeidsduur']['datumVaststellenSpreiding'] . '"/></td></tr>' . "\n";
		echo '<tr><td class="label">Datum wijzigen van de spreiding:</td><td><input name="datumWijzigenSpreiding" value="' . $json['arbeidsduur']['datumWijzigenSpreiding'] . '"/></td></tr>' . "\n";
		echo '<tr><td class="label">Datum mededelen beslissing:</td><td><input name="datumMededelenBeslissing" value="' . $json['arbeidsduur']['datumMededelenBeslissing'] . '"/></td></tr>' . "\n";
		echo '<tr><td class="label">Datum mededelen redenen:</td><td><input name="datumMededelenRedenen" value="' . $json['arbeidsduur']['datumMededelenRedenen'] . '"/></td></tr>' . "\n";
		echo '<tr><td class="label">Werkgever heeft een belang:</td><td><input name="werkgeverHeeftBelang" value="' . $json['arbeidsduur']['werkgeverHeeftBelang'] . '"/></td></tr>' . "\n";
		echo '<tr><td class="label">Beoogde ingangsdatum van de aanpassing:</td><td><input name="ingangsdatumAanpassing" value="' . $json['arbeidsduur']['ingangsdatumAanpassing'] . '"/></td></tr>' . "\n";
		echo '<tr><td class="label">Omvang van de aanpassing:</td><td><input name="omvangVanDeAanpassing" value="' . $json['arbeidsduur']['omvangVanDeAanpassing'] . '"/></td></tr>' . "\n";
		echo '<tr><td class="label">Gewenste spreiding:</td><td><input name="gewensteSpreiding" value="' . $json['arbeidsduur']['gewensteSpreiding'] . '"/></td></tr>' . "\n";
		echo '<tr><td class="label">Schriftelijk ingediend:</td><td><input name="isSchriftelijkIngediend" value="' . $json['arbeidsduur']['isSchriftelijkIngediend'] . '"/></td></tr>' . "\n";
		echo '<tr><td class="label">Samentelling volgens:</td><td><input name="samentellingVolgensWerknemer" value="' . $json['arbeidsduur']['samentellingVolgensWerknemer'] . '"/></td></tr>' . "\n";
		echo '<tr><td class="label">Samentelling volgens:</td><td><input name="samentellingVolgensWerkgever" value="' . $json['arbeidsduur']['samentellingVolgensWerkgever'] . '"/></td></tr>' . "\n";
		echo '<tr><td class="label">Redenen voor afwijzing:</td><td><input name="redenenVoorAfwijzing" value="' . $json['arbeidsduur']['redenenVoorAfwijzing'] . '"/></td></tr>' . "\n";
		echo '<tr><td class="label">Zwaarwegende belangen tegen het inwilligen:</td><td><input name="zwaarwegendeBelangen" value="' . $json['arbeidsduur']['zwaarwegendeBelangen'] . '"/></td></tr>' . "\n";
		echo '<tr><td class="label">Feiten bij vermindering:</td><td><input name="feitenBijVermindering" value="' . $json['arbeidsduur']['feitenBijVermindering'] . '"/></td></tr>' . "\n";
		echo '<tr><td class="label">Feiten bij vermeerdering:</td><td><input name="feitenBijVermeerdering" value="' . $json['arbeidsduur']['feitenBijVermeerdering'] . '"/></td></tr>' . "\n";
	}	// end if
	
	if (isset($_POST['beslis'])) {
		$json  = 'JSON:{"arbeidsduur":{';
		$json .= '"arbeidsovereenkomst":"' . $_POST['arbeidsovereenkomst'] . '",';
		$json .= '"datumIndienenVerzoek":"' . $_POST['datumIndienenVerzoek'] . '",';
		$json .= '"datumVorigVerzoek":"' . $_POST['datumVorigVerzoek'] . '",';
		$json .= '"datumOverlegPlegen":"' . $_POST['datumOverlegPlegen'] . '",';
		$json .= '"datumInwilligenVerzoek":"' . $_POST['datumInwilligenVerzoek'] . '",';
		$json .= '"datumAfwijzenVerzoek":"' . $_POST['datumAfwijzenVerzoek'] . '",';
		$json .= '"datumVaststellenSpreiding":"' . $_POST['datumVaststellenSpreiding'] . '",';
		$json .= '"datumWijzigenSpreiding":"' . $_POST['datumWijzigenSpreiding'] . '",';
		$json .= '"datumMededelenBeslissing":"' . $_POST['datumMededelenBeslissing'] . '",';
		$json .= '"datumMededelenRedenen":"' . $_POST['datumMededelenRedenen'] . '",';
		$json .= '"werkgeverHeeftBelang":"' . $_POST['werkgeverHeeftBelang'] . '",';
		$json .= '"ingangsdatumAanpassing":"' . $_POST['ingangsdatumAanpassing'] . '",';
		$json .= '"omvangVanDeAanpassing":"' . $_POST['omvangVanDeAanpassing'] . '",';
		$json .= '"gewensteSpreiding":"' . $_POST['gewensteSpreiding'] . '",';
		$json .= '"isSchriftelijkIngediend":"' . $_POST['isSchriftelijkIngediend'] . '",';
		$json .= '"samentellingVolgensWerknemer":"' . $_POST['samentellingVolgensWerknemer'] . '",';
		$json .= '"samentellingVolgensWerkgever":"' . $_POST['samentellingVolgensWerkgever'] . '",';
		$json .= '"redenenVoorAfwijzing":"' . $_POST['redenenVoorAfwijzing'] . '",';
		$json .= '"zwaarwegendeBelangen":"' . $_POST['zwaarwegendeBelangen'] . '",';
		$json .= '"feitenBijVermindering":"' . $_POST['feitenBijVermindering'] . '",';
		$json .= '"feitenBijVermeerdering":"' . $_POST['feitenBijVermeerdering'] . '"';
		$json .= '}}' . "\n\n";
		
		$socket = socket_create(AF_INET, SOCK_STREAM, 0) or die("Could not create socket\n");
		socket_connect($socket, "localhost", 8888) or die("Could not connect to socket\n");
		//	Write Request:
		socket_write($socket, $json) or die("Could not write output\n");
		//	Read Response:
		do {
			$line = socket_read($socket, 512, PHP_NORMAL_READ) or die("Could not read input\n");
			echo $line;
		} while ($line != "\n");
		socket_close($socket);
	}	// end if
?>
<tr><td>&nbsp;</td><td>&nbsp;</td></tr>
<tr><td></td><td><input type="submit" name="haalop" value="Haal op"/>
<?php
	if (isset($_POST['haalop'])) {
		echo ' &nbsp; <input type="submit" name="beslis" value="Beslis"/>';
	}	// end if
?>
</td></tr>
</table>
<input type="hidden" name="uuid"    value="<?php echo $uuid; ?>"/>
<input type="hidden" name="moment"  value="<?php echo $moment; ?>"/>
</form>

<h2>Vandaag is <?php echo $moment; ?></h2>
<?php
	require_once 'footer.php';
	mysqli_close($dbconn) or die(mysql_error());
?>