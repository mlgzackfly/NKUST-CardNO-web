<?php
session_reset();
	if (isset($_POST['uid']))
	{
		$postdata = http_build_query(
	    array(
		        'uid' => $_POST['uid'],
		    )
		);
		$opts = array('http' =>
		    array(
		        'method' => 'POST',
		        'header' => 'Referer: https://space.lib.nkust.edu.tw/space/module.php',
		        'content' => $postdata
		    )
		);
		$context = stream_context_create($opts);
		$result = file_get_contents('https://space.lib.nkust.edu.tw/space/getnkmuUserInfo.php', false, $context);

		$json = json_decode($result, true);

		$status = $json["status"]; // 狀態 ok / error
		$userid = $json["userid"]; // 學號
		$name = $json["NAME"]; // 姓名
		$CardNo = $json["CardNo"]; // 卡號

	}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>來看看你的卡號！</title>
    <!-- Tocas UI：CSS 與元件 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tocas-ui/2.3.3/tocas.css">
    <!-- Tocas JS：模塊與 JavaScript 函式 -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tocas-ui/2.3.3/tocas.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
</head>

<body>
    <div class="ts heading slate">
        <span class="header">查卡號！</span>
        <span class="description">我有寫Pythonㄉ，這是個<a href="https://github.com/mlgzackfly/nkust_CardNo_Inquire">開源的專案</a>！</span>
    </div>
    <!--艾斯死了 各位-->
    <form class="ts form" method="POST">
        <div class="ts four column centered grid">
            <div class="column">
                <div class="field">
                    <input type="text" name="uid" placeholder="學號">
                </div>
            </div>
            <div class="column">
                <button onclick="fetch()" class="ts button">查詢</button>
            </div>
        </div>
    </form>
    <?php
if (isset($_POST['uid'])) {
	if ($status == "ok") {
		echo '<div class="ts inverted positive card">	
				<div class="content">
				<div class="header">成功 
				</div>
				</div>
				</div>';
	}
	elseif ($status == "error"){	
		echo '<div class="ts inverted negative card">學號錯誤！</div>' ;
	}
}

?>
    <div class="ts primary card">
        <div class="content">
            <div class="header"></div>
            <div class="description">
                <?php
       		 	if (isset($_POST['uid'])) {
       		 			$CardNo = strtoupper(dechex($CardNo));
						echo '<p>' . mb_substr($name,0,1, 'UTF-8') . '同學</p>' ;
						$arrayc = str_split(dechex($CardNo));
						$arrayNo = str_split($CardNo,"2"); // 把卡號切成陣列
						$result = "";
						for ($i = count($arrayNo); $i >= 0; $i --)
						{
							$result .= $arrayNo[$i];
						}
						echo '<p>你的卡號是：' . $result . '</p>';
						// echo var_dump($arrayNo);
					}
				?>
            </div>
        </div>
        <div class="symbol">
            <i class="user icon"></i>
        </div>
    </div>
</body>

</html>