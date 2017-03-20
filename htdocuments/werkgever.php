<?php
	require_once 'config.php';
	$dbconn = mysqli_connect(DB_HOST, DB_USER, DB_PSWD, DB_NAME) or die(mysql_error());
	require_once 'header.php';
	require_once 'tabbalk.php';
	$moment = isset($_POST['moment']) ? $_POST['moment'] : date('Y-m-d');
?>
<h1>Werkgever</h1>

<form id=phpForm action="" method="post">
<table>
<colgroup><col width="50%"/><col width="50%"/></colgroup>
<tr><td class="label">Werkgeversidentificatie:</td><td><input name="werkgeverID" value="<?php echo isset($_POST['haalop']) ? $_POST['werkgeverID'] : ''; ?>"/></td></tr>
<?php 
	if (isset($_POST['werkgeverID'])) {
		$result = mysqli_query($dbconn, "SELECT id, content FROM werkgever WHERE name = '" . $_POST['werkgeverID'] . "'");
		$row = mysqli_fetch_array($result);
		if ($row) {
			$uuid = $row[0];
			$json = json_decode($row[1], true);
		} else {
			$uuid = '';
			echo '<tr><td></td><td class="fout">Werkgever ' . $_POST['werkgeverID'] . ' onbekend!</td></tr>' . "\n";
			unset($_POST['haalop']);
		}	// end if
		mysqli_free_result($result);
	}	// end if

	if (isset($_POST['haalop'])) {
		echo '<tr><td class="label">Naam:</td><td><input name="naam" value="' . $json['werkgever']['naam'] . '"/></td></tr>' . "\n";
		echo '<tr><td class="label">Adres:</td><td><input name="adres" value="' . $json['werkgever']['adres'] . '"/></td></tr>' . "\n";
		echo '<tr><td class="label">Huisnummer:</td><td><input name="huisnummer" value="' . $json['werkgever']['huisnummer'] . '"/></td></tr>' . "\n";
		echo '<tr><td class="label">Postcode:</td><td><input name="postcode" value="' . $json['werkgever']['postcode'] . '"/></td></tr>' . "\n";
		echo '<tr><td class="label">Aantal werknemers:</td><td><input name="aantalWerknemers" value="' . $json['werkgever']['aantalWerknemers'] . '"/></td></tr>' . "\n";
		echo '<tr><td class="label">Peildatum:</td><td><input name="peildatum" value="' . $json['werkgever']['peildatum'] . '"/></td></tr>' . "\n";
		echo '<tr><td class="label">Militairen in dienst (ja/nee):</td><td><input name="militairenInDienst" value="' . $json['werkgever']['militairenInDienst'] . '"/></td></tr>' . "\n";
	}	// end if
	
	if (isset($_POST['beslis'])) {
		$json  = 'JSON:{"werkgever":{';
		$json .= '"naam":"' . $_POST['naam'] . '",';
		$json .= '"adres":"' . $_POST['adres'] . '",';
		$json .= '"huisnummer":"' . $_POST['huisnummer'] . '",';
		$json .= '"postcode":"' . $_POST['postcode'] . '",';
		$json .= '"aantalWerknemers":"' . $_POST['aantalWerknemers'] . '",';
		$json .= '"peildatum":"' . $_POST['peildatum'] . '",';
		$json .= '"militairenInDienst":"' . $_POST['militairenInDienst'] . '",';
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