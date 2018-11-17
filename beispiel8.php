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

	echo '
		<!DOCTYPE html>
		<html>
			<head>
				<meta charset="UTF-8">
				<title>Beispiel 8</title>
			</head>

			<body>
				<a href="http://sqlinjectionwwi.bplaced.net/">Zurück</a><br><br>
				<h1>Beispiel 8</h1>
				<p>Datenbanknamen herausfinden</p>
				Dank der Versionsnummer können wir nun schauen, ob wir die Datenbank "information_schema" auslesen können.<br>Dies ist bei MySQL-Versionen >=5.x möglich.
				<br><br>
				Mit <code>+and+1=2+union+select+1,2,SCHEMA_NAME,4+from+information_schema.schema+--+</code> können wir uns nun die Namen aller Datenbanke auf dem Server ausgeben lassen.<br><br>
				
				<br><br>(Anmerkung: Auf dem verwendeten Server ist es nicht möglich die Datenbank "information_schema" einzusehen, daher wird der Query Befehl intern an den Datenbankserver angepasst. Die Datenbank "information_schema" heißt offiziell "sqlinjectionwwi_aufbau" und die Tabelle "schema" heißt offiziell "schema2").
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

