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
				<title>Beispiel 6</title>
			</head>

			<body>
				<a href="http://sqlinjectionwwi.bplaced.net/">Zurück</a><br><br>
				<h1>Beispiel 6</h1>
				<p>Spaltenanzahl herausfinden mit UNION</p>
				<br>Zuerst die vorherige Query mit <code>+and+1=2</code> unwahr machen und dann <code>+union+select+1+--+</code> anhängen<br><br>
				Wenn man hinter die Zahl weiter Zahlen durch Komma getrennt einfügt, kann man die Spaltenanzahl mitzählen. Wenn kein Fehler mehr auftritt, hat man die Spaltenanzahl gefunden.<br><br>
				<code>+and+1=2+union+select+1+--+</code> => Fehler => 1 Spalte ?<br>
				<code>+and+1=2+union+select+1,2+--+</code> => Fehler => 2 Spalten ?<br>
				<code>+and+1=2+union+select+1,2,3+--+</code> => Fehler => 3 Spalten ?<br>
				<code>+and+1=2+union+select+1,2,3,4+--+</code> => Kein Fehler => 4 Spalten!<br>
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

