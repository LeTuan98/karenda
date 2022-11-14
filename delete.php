<?php
    $date=$_GET['date'];
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
    $sql="DELETE FROM `date` WHERE date='{$date}'";
    $mess='';
    try{
        $link->multi_query($sql);
    }
    catch(Exception $ex){
        $mess="エラー発生：トゥアンに連絡しなさい";
    }
      $_SESSION['error']=$mess;
      mysqli_close($link);
      header("location: datachange.php");
      
?>