<?php
	require_once 'config.php';
	$dbconn = mysqli_connect(DB_HOST, DB_USER, DB_PSWD, DB_NAME) or die(mysql_error());
	require_once 'header.php';
	require_once 'tabbalk.php';
	$moment = isset($_POST['moment']) ? $_POST['moment'] : date('Y-m-d');
?>
<h1>Arbeidsovereenkomst</h1>

<form id=phpForm action="" method="post">
<table>
<colgroup><col width="50%"/><col width="50%"/></colgroup>
<tr><td class="label">Werknemers-, Werkgeversidentificatie:</td><td><input name="identificaties" value="<?php echo isset($_POST['haalop']) ? $_POST['identificaties'] : ''; ?>"/></td></tr>
<?php 
	if (isset($_POST['identificaties'])) {
		$result = mysqli_query($dbconn, "SELECT id, content FROM arbeidsovereenkomst WHERE name = '" . str_replace(' ', '', $_POST['identificaties']) . "'");
		$row = mysqli_fetch_array($result);
		if ($row) {
			$uuid = $row[0];
			$json = json_decode($row[1], true);
		} else {
			$uuid = '';
			echo '<tr><td></td><td class="fout">Werknemer,werkgever combi ' . $_POST['identificaties'] . ' onbekend!</td></tr>' . "\n";
			unset($_POST['haalop']);
		}	// end if
		mysqli_free_result($result);
	}	// end if

	if (isset($_POST['haalop'])) {
		echo '<tr><td class="label">Werknemersidentificatie:</td><td><input name="werknemerID" value="' . $json['arbeidsovereenkomst']['werknemerID'] . '"/></td></tr>' . "\n";
		echo '<tr><td class="label">Werkgeversidentificatie:</td><td><input name="werkgeverID" value="' . $json['arbeidsovereenkomst']['werkgeverID'] . '"/></td></tr>' . "\n";
		echo '<tr><td class="label">Datum indiensttreding:</td><td><input name="datumIndiensttreding" value="' . $json['arbeidsovereenkomst']['datumIndiensttreding'] . '"/></td></tr>' . "\n";
		echo '<tr><td class="label">Arbeidsovereenkomst getekend op:</td><td><input name="overeenkomstGetekendOp" value="' . $json['arbeidsovereenkomst']['overeenkomstGetekendOp'] . '"/></td></tr>' . "\n";
		echo '<tr><td class="label">Arbeidsduurperiode in arbeidsovereenkomst:</td><td><input name="arbeidsduurperiode" value="' . $json['arbeidsovereenkomst']['arbeidsduurperiode'] . '"/></td></tr>' . "\n";
	}	// end if
?>
<tr><td>&nbsp;</td><td>&nbsp;</td></tr>
<tr><td></td><td><input type="submit" name="haalop" value="Haal op"/>
<?php
	if (isset($_POST['haalop'])) {
		echo ' &nbsp; <input type="submit" name="bewaar" value="Bewaar"/></td>';
	}	// end if
?>
</tr>
</table>
<input type="hidden" name="uuid"    value="<?php echo $uuid; ?>"/>
<input type="hidden" name="moment"  value="<?php echo $moment; ?>"/>
</form>

<h2>Vandaag is <?php echo $moment; ?></h2>
<?php
	require_once 'footer.php';
	mysqli_close($dbconn) or die(mysql_error());
?>