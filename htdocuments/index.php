<?php
	require_once 'header.php';
	require_once 'tabbalk.php';
?>
<h1>Openingsscherm dienstverlening WAA</h1>
<h2>Vandaag is <?php echo date("d-m-Y"); ?></h2>
<?php 
// 	$socket = socket_create(AF_INET, SOCK_STREAM, 0) or die("Could not create socket\n");
// 	socket_connect($socket, "localhost", 8888) or die("Could not connect to socket\n");

// 	//	Write Request:
// 	$output = "Hello PHP and Java worlds...\nthis is a message from XAMPP\n" . "\n";
// 	socket_write($socket, $output) or die("Could not write output\n");
	
// 	//	Read Response:
// 	do {
// 		$line = socket_read($socket, 512, PHP_NORMAL_READ) or die("Could not read input\n");
// 		echo $line;
// 	} while ($line != "\n");
	
// 	socket_close($socket);
	require_once 'footer.php';
?>