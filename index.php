<?php
$string = file_get_contents("dist/list.json");
$json_a = json_decode($string, true);
?>
<!DOCTYPE html>
<html>
<head>
	<!-- Tocas UI：CSS 與元件 -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tocas-ui/2.3.3/tocas.css">
	<!-- Tocas JS：模塊與 JavaScript 函式 -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/tocas-ui/2.3.3/tocas.js"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>NKUST lib !</title>
</head>
<body>
<div class="ts slate">
    <span class="header">打工戰士</span>
    <span class="description">讓我偷懶的地方</span>
</div>
<table class="ts celled table">
    <thead>
        <tr>
            <th>編號</th>
            <th>標題</th>
        </tr>
    </thead>
    <tbody>
        <?php
			foreach ($json_a as $person_name => $person_a) 
			{
				echo '<tr>';
				echo '<td>' . $person_a['id'] . '</td>';
				echo '<td>' . '<a href="'. $person_a['link'] .'">' . $person_a['title'] . '</a>' . '</td>';
				echo '</tr>';
			}
		?>
    </tbody>
</table>
</body>
</html>