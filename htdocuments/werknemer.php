<?php
	require_once 'config.php';
	$dbconn = mysqli_connect(DB_HOST, DB_USER, DB_PSWD, DB_NAME) or die(mysql_error());
	require_once 'header.php';
	require_once 'tabbalk.php';
?>
<h1>Werknemer</h1>
<table>
<colgroup><col width="50%"/><col width="50%"/></colgroup>
<tr><td class="label">Werknemersidentificatie:</td>
	<td class="invoer"><input value="<?php echo isset($_POST['Werknemersidentificatie'])?$_POST['Werknemersidentificatie']:'' ?>"></input></td></tr>
<tr><td class="label">Burgerservicenummer:</td>
	<td class="invoer"><input value ="<?php echo isset($_POST['Burgerservicenummer'])?$_POST['Burgerservicenummer']:'' ?>"></input></td></tr>
<tr><td class="label">Voornamen:</td><td class="invoer"><input></input></td></tr>
<tr><td class="label">Roepnaam:</td><td class="invoer"><input></input></td></tr>
<tr><td class="label">Achternaam:</td><td class="invoer"><input></input></td></tr>
<tr><td class="label">Geboortedatum:</td><td class="invoer"><input></input></td></tr>
<tr><td class="label">Geboorteplaats:</td><td class="invoer"><input></input></td></tr>
<tr><td class="label">Adres:</td><td class="invoer"><input></input></td></tr>
<tr><td class="label">Huisnummer:</td><td class="invoer"><input></input></td></tr>
<tr><td class="label">Postcode:</td><td class="invoer"><input></input></td></tr>
<tr><td class="label">Woonplaats:</td><td class="invoer"><input></input></td></tr>
<tr><td class="label">Paspoort nummer:</td><td class="invoer"><input></input></td></tr>
<tr><td class="label">Identiteitkaart nummer:</td><td class="invoer"><input></input></td></tr>
<tr><td class="label">Burgelijke staat:</td><td class="invoer"><input></input></td></tr>
<tr><td class="label">Nationaliteit:</td><td class="invoer"><input></input></td></tr>
<tr><td class="label">Nationaliteit sinds:</td><td class="invoer"><input></input></td></tr>
<tr><td class="label">Militair ambtenaar (ja/nee):</td><td class="invoer"><input></input></td></tr>
</table>
<?php
	require_once 'footer.php';
	mysqli_close($dbconn) or die(mysql_error());
?>