<?php
	require_once 'config.php';
	$dbconn = mysqli_connect(DB_HOST, DB_USER, DB_PSWD, DB_NAME) or die(mysql_error());
	require_once 'header.php';
	require_once 'tabbalk.php';
?>
<h1>Werkgever</h1>
<table>
<colgroup><col width="50%"/><col width="50%"/></colgroup>
<tr><td class="label">Werkgeversidentificatie:</td><td class="invoer"><input></input></td></tr>
<tr><td class="label">Naam:</td><td class="invoer"><input></input></td></tr>
<tr><td class="label">Adres:</td><td class="invoer"><input></input></td></tr>
<tr><td class="label">Huisnummer:</td><td class="invoer"><input></input></td></tr>
<tr><td class="label">Postcode:</td><td class="invoer"><input></input></td></tr>
<tr><td class="label">Aantal werknemers:</td><td class="invoer"><input></input></td></tr>
<tr><td class="label">Peildatum:</td><td class="invoer"><input></input></td></tr>
<tr><td class="label">Militairen in dienst (ja/nee):</td><td class="invoer"><input></input></td></tr>
</table>
</div>
<?php
	require_once 'footer.php';
	mysqli_close($dbconn) or die(mysql_error());
?>