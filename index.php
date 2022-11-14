
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<?php

require_once('./datebaseconnect.php');
$link=mysqli_connect(SV,US,PASS,DBNAME);
if($link==null)
{
    die("no connect".mysqli_connect_errno());
}
else{
   mysqli_set_charset($link,"utf8");
}
?>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>もえちゃん💛💛カレンダー</title>
<link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body>
<div class="wrapper">
    <h1 id="header"></h1>
    <div id="calendar">

    </div>
    <div id="next-prev-button">
        <button id="prev" onclick="prev()">‹</button>
        <button id="next" onclick="next()">›</button>
    </div>
    <div id="foodter">
	    <div class="select" id="lef">
			  <select id="year" onchange="onch()">

			   </select>

		</div>
		<div class="select" id="2" >
			  <select id="month" onchange="onch()">

			   </select>

		</div>
    </div>
	<div class="datachange" id="ca"><a href="datachange.php">もえちゃん</a></div>
</div>
<div class="wrapper" id="haha">
	<h2>説明</h2>
	<div id="setumei">
		<div class="today">本日</div>
		<div class="set">バイト</div>
		<div class="syukin">学校</div>
	</div>
</div>

</body>
<script type="text/javascript" >

	const week = ["日", "月", "火", "水", "木", "金", "土"];
	const today = new Date();
	// 月末だとずれる可能性があるため、1日固定で取得
	var showDate = new Date(today.getFullYear(), today.getMonth(), 1);
	var database=[];	
	<?php
		$sql="select * from date";
		$re=mysqli_query($link,$sql);
		$num=mysqli_num_rows($re); 
		while($row=mysqli_fetch_array($re,MYSQLI_ASSOC)){
			echo "database.push(['{$row['date']}','{$row['type']}','{$row['coment']}']);\n";
		} 
		mysqli_close($link);
		mysqli_free_result($re);    
	?>
</script>
<script type="text/javascript" src="./js.js"></script>
</html>