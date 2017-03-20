<?php
	require_once 'config.php';
	$dbconn = mysqli_connect(DB_HOST, DB_USER, DB_PSWD, DB_NAME) or die(mysql_error());
	require_once 'header.php';
	require_once 'tabbalk.php';
	$moment = isset($_POST['moment']) ? $_POST['moment'] : date('Y-m-d');
?>
<h1>Werknemer</h1>

<form id=phpForm action="" method="post">
<table>
<colgroup><col width="50%"/><col width="50%"/></colgroup>
<tr><td class="label">Werknemersidentificatie:</td><td><input name="werknemerID" value="<?php echo isset($_POST['haalop']) ? $_POST['werknemerID'] : ''; ?>"/></td></tr>
<?php 
	if (isset($_POST['werknemerID'])) {
		$result = mysqli_query($dbconn, "SELECT id, content FROM werknemer WHERE name = '" . $_POST['werknemerID'] . "'");
		$row = mysqli_fetch_array($result);
		if ($row) {
			$uuid = $row[0];
			$json = json_decode($row[1], true);
		} else {
			$uuid = '';
			echo '<tr><td></td><td class="fout">Werknemer ' . $_POST['werknemerID'] . ' onbekend!</td></tr>' . "\n";
			unset($_POST['haalop']);
		}	// end if
		mysqli_free_result($result);
	}	// end if
		
	if (isset($_POST['haalop'])) {
		echo '<tr><td class="label">Burgerservicenummer:</td><td><input name="burgerservicenummer" value="' . $json['werknemer']['burgerservicenummer'] . '"/></td></tr>' . "\n";
		echo '<tr><td class="label">Voornamen:</td><td><input name="voornamen" value = "' . $json['werknemer']['voornamen'] . '"/></td></tr>' . "\n";
		echo '<tr><td class="label">Roepnaam:</td><td><input name="roepnaam" value="' . $json['werknemer']['roepnaam'] . '"/></td></tr>' . "\n";
		echo '<tr><td class="label">Achternaam:</td><td><input name="achternaam" value="' . $json['werknemer']['achternaam'] . '"/></td></tr>' . "\n";
		echo '<tr><td class="label">Geboortedatum:</td><td><input name="geboortedatum" value="' . $json['werknemer']['geboortedatum'] . '"/></td></tr>' . "\n";
		echo '<tr><td class="label">Geboorteplaats:</td><td><input name="geboorteplaats" value="' . $json['werknemer']['geboorteplaats'] . '"/></td></tr>' . "\n";
		echo '<tr><td class="label">Adres:</td><td><input name="adres" value="' . $json['werknemer']['adres'] . '"/></td></tr>' . "\n";
		echo '<tr><td class="label">Huisnummer:</td><td><input name="huisnummer" value="' . $json['werknemer']['huisnummer'] . '"/></td></tr>' . "\n";
		echo '<tr><td class="label">Postcode:</td><td><input name="postcode" value="' . $json['werknemer']['postcode'] . '"/></td></tr>' . "\n";
		echo '<tr><td class="label">Woonplaats:</td><td><input name="woonplaats" value="' . $json['werknemer']['woonplaats'] . '"/></td></tr>' . "\n";
		echo '<tr><td class="label">Paspoort nummer:</td><td><input name="paspoortnummer" value="' . $json['werknemer']['paspoortnummer'] . '"/></td></tr>' . "\n";
		echo '<tr><td class="label">Identiteitkaart nummer:</td><td><input name="idKaartNummer" value="' . $json['werknemer']['idKaartNummer'] . '"/></td></tr>' . "\n";
		echo '<tr><td class="label">Burgelijke staat:</td><td><input name="burgerlijkeStaat" value="' . $json['werknemer']['burgerlijkeStaat'] . '"/></td></tr>' . "\n";
		echo '<tr><td class="label">Nationaliteit:</td><td><input name="nationaliteit" value="' . $json['werknemer']['nationaliteit'] . '"/></td></tr>' . "\n";
		echo '<tr><td class="label">Nationaliteit sinds:</td><td><input name="nationaliteitSinds" value="' . $json['werknemer']['nationaliteitSinds'] . '"/></td></tr>' . "\n";
		echo '<tr><td class="label">Militair ambtenaar (ja/nee):</td><td><input name="militairAmbtenaar" value="' . $json['werknemer']['militairAmbtenaar'] . '"/></td></tr>' . "\n";
	}	// end if
	
	if (isset($_POST['beslis'])) {
		$json  = 'JSON:{"werknemer":{';
		$json .= '"burgerservicenummer":"' . $_POST['burgerservicenummer'] . '",';
		$json .= '"voornamen":"' . $_POST['voornamen'] . '",';
		$json .= '"roepnaam":"' . $_POST['roepnaam'] . '",';
		$json .= '"achternaam":"' . $_POST['achternaam'] . '",';
		$json .= '"geboortedatum":"' . $_POST['geboortedatum'] . '",';
		$json .= '"geboorteplaats":"' . $_POST['geboorteplaats'] . '",';
		$json .= '"adres":"' . $_POST['adres'] . '",';
		$json .= '"huisnummer":"' . $_POST['huisnummer'] . '",';
		$json .= '"postcode":"' . $_POST['postcode'] . '",';
		$json .= '"woonplaats":"' . $_POST['woonplaats'] . '",';
		$json .= '"paspoortnummer":"' . $_POST['paspoortnummer'] . '",';
		$json .= '"idKaartNummer":"' . $_POST['idKaartNummer'] . '",';
		$json .= '"burgerlijkeStaat":"' . $_POST['burgerlijkeStaat'] . '",';
		$json .= '"nationaliteit":"' . $_POST['nationaliteit'] . '",';
		$json .= '"nationaliteitSinds":"' . $_POST['nationaliteitSinds'] . '",';
		$json .= '"militairAmbtenaar":"' . $_POST['militairAmbtenaar'] . '",';
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