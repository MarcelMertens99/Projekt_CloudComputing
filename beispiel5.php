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
				<title>Beispiel 5</title>
			</head>

			<body>
				<a href="http://sqlinjectionwwi.bplaced.net/">Zurück</a><br><br>
				<h1>Beispiel 5</h1>
				<p>Spaltenanzahl herausfinden mit ORDER BY</p>
				<br><code>+order+by+1+--+</code> an die ID anhängen.<br><br>
				Wenn man die Zahl weiter hochzählt, kann man die Spaltenanzahl mitzählen. Wenn ein Fehler auftritt, gibt es keine weiteren Spalten mehr.<br><br>
				<code>+order+by+1+--+</code> => Kein Fehler => 1 Spalte<br>
				<code>+order+by+2+--+</code> => Kein Fehler => 2 Spalten<br>
				<code>+order+by+3+--+</code> => Kein Fehler => 3 Spalten<br>
				<code>+order+by+4+--+</code> => Kein Fehler => 4 Spalten<br>
				<code>+order+by+5+--+</code> => Fehler ==> Insgesamt 4 Spalten
				<br><br>
				Die Zahl in der Ausgabe gibt an, in welcher Spalte der Wert gespeichert wird (in unsrem Fall wird der Preis in der 2. Spalte gespeichert).
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

