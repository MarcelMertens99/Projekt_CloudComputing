<?php
	$id = $_GET['id'];

	$host = 'localhost'; //Host: localhost
	$datenbankname = 'xxxx'; //Datenbankname
	$tablename = 'xxxx'; //Tabellenname
	$dbUsername = 'xxxx'; //Benutzername
	$dbPassword = 'xxxx'; //Password

	echo '
		<!DOCTYPE html>
		<html>
			<head>
				<meta charset="UTF-8">
				<title>Beispiel 4</title>
			</head>

			<body>
				<a href="http://sqlinjectionwwi.bplaced.net/">Zurück</a><br><br>
				<h1>Beispiel 4</h1>
				<p>Fehler erzeugen mit AND</p>
				<br><code>+and+1=1+</code> an die ID anhängen => Ausgabe bleibt unverändert<br><br>
				<code>+and+1=2</code> an die ID anhängen => Ausgabe leer => Fehler auf der Seite gefunden!
				<br><br>Ausgabe:<br>';

	//Neue Verbindung öffnen
	$handler = new PDO("mysql:host=$host;dbname=$datenbankname", $dbUsername, $dbPassword);

	$lQuery = "SELECT id, preis, beschreibung, anzahl FROM $tablename WHERE id = $id";

	foreach ($handler->query($lQuery) as $lRow)
	{
		$lPreis = $lRow['preis'];
		
		echo "Produktpreis: $lPreis Euro";
	}

	echo '
		</body></html> 
	';
?>

