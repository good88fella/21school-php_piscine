<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<style>
		.buttonsmall {
			padding:1px 1px;
			background:#ccc;
			font-size: 0;
			border:0 none;
			cursor:pointer;
		}
		.td {
			height: 1px;
			width: 1px;
		}
		th, td {
			border: 1px solid black;
			margin: 0;
			padding: 0;
			border-collapse: collapse;
			border-spacing: 0;
		}
		table {
			border-collapse: collapse;
			border-spacing: 0;
		}
		.cellp1 {
			width: 10px;
			height: 10px;
			background-color: black;
		}
		.cellp2 {
			width: 10px;
			height: 10px;
			background-color: red;
		}
		.cell {
			width: 10px;
			height: 10px;
		}
	</style>
	<link href='//fonts.googleapis.com/css?family=Lato:300' rel='stylesheet' type='text/css'>
	<title>Warhammer</title>
</head>
<body>

		<table border="1">
			<?php
				for ($i = 0; $i < 100; $i++)
				{
				  	echo ('<tr id=' . $i .'>');
				  	for ($j = 0; $j < 150; $j++) {
						echo('<td id="' . $j . '">' .
							'<form id="' . $i . ' ' . $j . '" method="get" action="play.php">
<input type="hidden" name="pos" value="' . $i . ' ' . $j . '">
<div class="');
						if ($i == 50 && $j > 10 && $j <= 13)
							echo "cellp1";
						else if ($i == 5 && $j > 10 && $j <= 13)
							echo "cellp2";
						else
							echo "cell";
						echo('" onclick="document.getElementById(\'' . $i . ' ' . $j . '\').submit();"></div></form>' .
							'</td>' . '</td>');
					}
				  	echo('</tr>');
				}
			?>
		</table>
		<form method="get" action="getpos.php"><button name="start" value="start"></button></form>
</body>
</html>
