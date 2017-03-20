<?php
	require_once 'config.php';
	$dbconn = mysqli_connect(DB_HOST, DB_USER, DB_PSWD, DB_NAME) or die(mysql_error());
	require_once 'header.php';
	require_once 'tabbalk.php';
	$moment = isset($_POST['moment']) ? $_POST['moment'] : date('Y-m-d');
?>
<h1>Spreiding</h1>

<form id=phpForm action="" method="post">
<table>
<colgroup><col width="25%"/><col width="25%"/><col width="25%"/><col width="25%"/></colgroup>
<tr><td></td><td class="label">Rooster:</td><td><input name="roosterID" value="<?php echo isset($_POST['haalop']) ? $_POST['roosterID'] : ''; ?>"/></td><td></td></tr>
<?php 
	if (isset($_POST['roosterID'])) {
		$result = mysqli_query($dbconn, "SELECT id, content FROM spreiding WHERE name = '" . $_POST['roosterID'] . "'");
		$row = mysqli_fetch_array($result);
		if ($row) {
			$uuid = $row[0];
			$json = json_decode($row[1], true);
		} else {
			$uuid = '';
			echo '<tr><td colspan="2"><td class="fout">Rooster ' . $_POST['roosterID'] . ' onbekend!</td><td></td></tr>' . "\n";
			unset($_POST['haalop']);
		}	// end if
		mysqli_free_result($result);
	}	// end if

	if (isset($_POST['haalop'])) {
		echo '<tr><td colspan="4"><hr></td></tr>';
		foreach ($json['spreiding']['werktijd'] as $item) {
			echo '<tr><td class="label">' . $item['dagdeel'] . ':</td>' .
					 '<td><input name="test" value="' . $item['dag'] . '"/></td>' .
					 '<td><input name="test" value="' . $item['aanvangstijd'] . '"/></td>' .
					 '<td><input name="test" value="' . $item['eindtijd'] . '"/></td>' .
				 '</tr>' . "\n";
		}	// end foreach
	}	// end if
	
	if (isset($_POST['beslis'])) {
		$json  = 'JSON:{"spreiding":{';
		$json .= '"rooster":"' . $_POST['rooster'] . '"';
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
<tr><td colspan="2"><td colspan="2"><input type="submit" name="haalop" value="Haal op"/>
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