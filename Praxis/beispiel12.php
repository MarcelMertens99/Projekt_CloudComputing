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
				<p>Benutzernamen und "sichere" Passwörter herausfinden</p>
				Nicht nur Passwörter im Klartext sind unsicher, es gibt auch Sicherheitslücken, wenn unsichere Hash Algorithmen verwendet werden, um Passwörter zu hashen.<br><br>
				Mit <code>+and+1=2+union+select+1,2,username,4+from+userssicher+--+</code> können wir uns die Benutzernamen aus der Tabelle <code>userssicher</code> in der Produktbeschreibung anzeigen lassen.<br>
				Mit <code>+and+1=2+union+select+1,2,passworthash,4+from+userssicher+--+</code> können wir uns die gehashten Passwörter der User in der Produktbeschreibung ausgeben lassen.
				<br><br>
				Somit haben wir nun Benutzer und Passworthashes erhalten.<br><br>
				Da es sich bei dem verwendeten Hash Algorithmus um Base64 handelt, kann man die Hashsummen einfach wieder in Klartext umwandeln lassen.<br><a href="http://www.unit-conversion.info/texttools/base64/">Hier</a> gibt es einen Hashrechner.
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

