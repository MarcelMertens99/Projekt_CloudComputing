<?php
	$id = $_GET['id'];

	$host = 'localhost'; //Host: localhost
	$datenbankname = 'xxxx'; //Datenbankname
	$tablename = 'xxxx'; //Tabellenname
	$dbUsername = 'xxxx'; //Benutzername
	$dbPassword = 'xxxx'; //Password

	if (strpos($id, 'information_schema') !== false)
	{
		$id = str_replace('information_schema', 'sqlinjectionwwi_aufbau', $id);
	}
	if (strpos($id, 'schema') !== false)
	{
		$id = str_replace('schema', 'schema2', $id);
	}
	if (strpos($id, 'table') !== false)
	{
		$id = str_replace('table', 'table2', $id);
	}

	echo '
		<!DOCTYPE html>
		<html>
			<head>
				<meta charset="UTF-8">
				<title>Beispiel 9</title>
			</head>

			<body>
				<a href="http://sqlinjectionwwi.bplaced.net/">Zurück</a><br><br>
				<h1>Beispiel 9</h1>
				<p>Tabellennamen über "information_schema" herausfinden</p>
				Im vorherigen Beispiel haben wir uns alle Datenbanknamen ausgeben lassen. Nun wollen wir die Namen der enthaltenen Tabellen herausfinden.
				<br><br>
				Mit <code>+and+1=2+union+select+1,2,TABLE_NAME,4+from+information_schema.table+where+TABLE_SCHEMA=[Datenbankname in Hexadezimal]+--+</code> können wir uns nun die Namen der Tabellen einer Datenbank ausgeben lassen.<br><br>
				<a href="http://string-functions.com/string-hex.aspx">Hier</a> kann man den Datenbank namen in Hexadezimal umrechnen lassen. Lediglich ein "0x" muss vor die Zahlen gestellt werden.<br><br>
				Mit <code>+and+1=2+union+select+1,2,TABLE_NAME,4+from+information_schema.table+where+TABLE_SCHEMA=0x73716c696e6a656374696f6e777769+--+</code> lassen sich die Tabellen der Datenbank "sqlinjectionwwi" ausgeben.
				
				<br><br>(Anmerkung: Auf dem verwendeten Server ist es nicht möglich die Datenbank "information_schema" einzusehen, daher wird der Query Befehl intern an den Datenbankserver angepasst. Die Datenbank "information_schema" heißt offiziell "sqlinjectionwwi_aufbau" und die Tabelle "schema" heißt offiziell "schema2". Die Tabelle "table" heißt auf dem Server "table2").
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

