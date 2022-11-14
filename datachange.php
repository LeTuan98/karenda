<?php
session_start();
require_once('datebaseconnect.php');
$link=mysqli_connect(SV,US,PASS,DBNAME);
if($link==null)
{
    die("no connect".mysqli_connect_errno());
}
else{
   mysqli_set_charset($link,"utf8");
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>もえちゃん大好き</title>
<link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body>

<div class="wrapper">
	<table>
	    <tr>
	      <th>日付</th>
	      <th>タイプ</th>
	      <th>コメント</th>
	      <th>削除</th>
	    </tr>
		<?php
			$sql="select * from date";
            $re=mysqli_query($link,$sql);
            $num=mysqli_num_rows($re); 
			while($row=mysqli_fetch_array($re,MYSQLI_ASSOC)){
				echo "<tr><td>{$row['date']}</td><td>{$row['type']}</td><td>{$row['coment']}</td>";
                echo "<td><div class=\"delete\"><a href=\"delete.php?date={$row['date']}\">delete</a></div></td></tr>";
            } 
			mysqli_close($link);
			mysqli_free_result($re);    
        ?>
<!-- <% for(Bin_data p:list){
	String str="<tr><td>"+p.getFullDate()+"</td><td>"+p.getType()+"</td><td>"+p.getComent()+"</td>";
	str+="<td><div class=\"delete\"><a href=\"/karenda/delete?date="+p.getFullDate()+"\">delete</a></div></td></tr>";
	out.println(str);
}
list.clear();
%> -->
  </table>
  <form action="toroku.php" method="get" id="form">
  	<div id="select">
  	<h3>＊＊＊＊＊＊＊＊＊＊＊＊＊新登録＊＊＊＊＊＊＊＊＊＊＊＊＊</h3>
		<div class="select" >
			<input type="date" name="date" onchange="change()" id="date">
		</div>
		<div class="select" id="types" >
			  <select id="type" name="type" onchange="change()">
					<option selected disabled>タイプ</option>
					<option value="バイト">バイト</option>
					<option value="学校">学校</option>
					<option value="休み">休み</option>
			  </select>
		</div>
  	</div>
	<div id="coment">Coment:<input type="text" name="coment"></div>
	<div class="datachange" id="sub"><a onclick="sub()">登録</a></div>
	<div id="error"></div>


  </form>
	<div class="datachange"><a href="index.php">カレンダー</a></div>
</div>

</body>
<script type="text/javascript" >
	<?php
	if(empty($_SESSION['error'])==false){
		$mess=$_SESSION['error']; 
		echo "alert('{$mess}');";
		// unset($_SESSION['error']);
	}
	?>
	function sub(){
		var data=date=document.getElementById('date').value;
		var type=document.getElementById('type').value;
		if(date==''){
			document.getElementById("error").innerHTML="日付を選んでください";
		}
		else if(type=="タイプ"){
			document.getElementById("error").innerHTML="タイプを選択してください";
		}else{
		document.getElementById('form').submit();
		}
	}

	function change(){
		document.getElementById("error").innerHTML="";
	}
</script>
</html>