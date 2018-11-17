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
				<title>Beispiel 3</title>
			</head>

			<body>
				<a href="http://sqlinjectionwwi.bplaced.net/">Zurück</a><br><br>
				<h1>Beispiel 3</h1>
				<p>Fehler erzeugen mit Hochkomma (\')</p>
				<br><br>

				<table>
					<thead>
						<tr>
							<th>ID</th>
							<th>Produktbeschreibung</th>
							<th>Preis</th>
							<th>Verfügbar</th>
						</tr>
					</thead>
					<tbody>';

	//Neue Verbindung öffnen
	$handler = new PDO("mysql:host=$host;dbname=$datenbankname", $dbUsername, $dbPassword);

	$lQuery = "SELECT id, preis, beschreibung, anzahl FROM $tablename WHERE id = $id";

	foreach ($handler->query($lQuery) as $lRow)
	{
		$lId = $lRow['id'];
		$lPreis = $lRow['preis'];
		$lBeschreibung = utf8_encode($lRow['beschreibung']);
		$lAnzahl = $lRow['anzahl'];
		
		echo "
			<tr>
				<td>$lId</td>
				<td>$lBeschreibung</td>
				<td>$lPreis €</td>
				<td>$lAnzahl Stk.</td>
			</tr>
		";
	}

	echo '
		</tbody></table>
		</body></html> 
	';
?>

