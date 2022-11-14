<?php
    $date=$_GET['date'];
    $type=$_GET['type'];
    $comnet=$_GET['coment'];
    session_start();
    require_once('./datebaseconnect.php');
    $link=mysqli_connect(SV,US,PASS,DBNAME);
    if($link==null)
    {
        die("no connect".mysqli_connect_errno());
    }
    else{
    mysqli_set_charset($link,"utf8");
    }
    // (3) SQL作成
    $sql="INSERT INTO `date`(`date`, `coment`, `type`) VALUES ('{$date}','{$comnet}','{$type}')";
    $mess='';
    
    try{
        $link->multi_query($sql);
    }
    catch(Exception $ex){
        $mess="同じ日付なので登録できない";
    }
      $_SESSION['error']=$mess;
      mysqli_close($link);
      header("location: datachange.php");
      
?>