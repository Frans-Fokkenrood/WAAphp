<?php
	require_once 'header.php';
	require_once 'tabbalk.php';
	
	if (isset($_POST['moment'])) {
		$moment = isset($_POST['vandaag']) ? $_POST['vandaag'] : '';
	} else {
		$moment = date('Y-m-d');
	}	// end if
?>
<h1>Openingsscherm dienstverlening WAA</h1>
<form id=vandaag action="" method="post">
<?php
	if ($moment == '') {
		echo '<h1><input type="text" name="vandaag"/>' . "\n";
		echo '<input type="submit" value="Zet datum"/></h1>' . "\n";
	}	// end if
?>
<input type="hidden" name="moment" value="<?php echo $moment; ?>"/>
</form>
<?php
	if ($moment != '') {
		echo '<h2 onclick="vandaag.submit();">Vandaag is ' . $moment . '</h2>' . "\n";
	}	// end if
	
 	$socket = socket_create(AF_INET, SOCK_STREAM, 0) or die("Could not create socket\n");
 	socket_connect($socket, "localhost", 8888) or die("Could not connect to socket\n");

 	//	Write Request:
 	$output = "Hello PHP and Java worlds, this is a message from XAMPP\n" . "\n";
 	socket_write($socket, $output) or die("Could not write output\n");
	
 	//	Read Response:
 	do {
 		$line = socket_read($socket, 512, PHP_NORMAL_READ) or die("Could not read input\n");
 		echo $line;
 	} while ($line != "\n");
	
 	socket_close($socket);

	require_once 'footer.php';
?>