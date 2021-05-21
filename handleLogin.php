<?php
       
if($_SERVER["REQUEST_METHOD"]=="POST") 
{
     
     $serverName = "localhost"; 
     $userName = "root"; 
     $passWord = ""; 
     $dataBase = "mydatabase"; 

    $conn = mysqli_connect($serverName, $userName, $passWord, $dataBase); 

    if(!$conn)
    echo "<h1> Connection not created </h1>"; 
    $userName = $_POST['userName']; 
    $passWord = $_POST['passWord']; 
    $currentPage = $_POST['currentPage'];
    $finalPage = ""; 

    if(strpos($currentPage, "login_successful"))
    {
         $tempPos = strpos($currentPage, "login_successful"); 
         for($i=$tempPos-2;$i>=0;$i--)
         {
             $finalPage = $finalPage . $currentPage[$i]; 
         }
         $finalPage = strrev($finalPage); 
         $currentPage = $finalPage; 
    } 
    else if(strpos($currentPage, "signup_successful"))
    {
        $tempPos = strpos($currentPage, "signup_successful"); 
        for($i=$tempPos-2;$i>=0;$i--)
        {
            $finalPage = $finalPage . $currentPage[$i]; 
        } 
        $finalPage = strrev($finalPage); 
        $currentPage = $finalPage; 
    }

    $containsArg = false; 
    for($j=0;$j<strlen($currentPage);$j++)
    {
        if($currentPage[$j]=='?')
        {
            $containsArg = true; 
            break; 
        }
    }

    $sql = "SELECT * from `project_user` where `user_name`='$userName'";
    $res = mysqli_query($conn, $sql); 
    $numOfRows = mysqli_num_rows($res); 

    if($numOfRows==1)
    {
        $row = mysqli_fetch_assoc($res); 
        if(password_verify($passWord, $row['password'])) 
        {
            session_start(); 
            $_SESSION['loggedin'] = true; 
            $_SESSION['userName'] = $userName; 
            if($containsArg)
            header("location: ".$currentPage."&login_successful=true"); 
            else 
            header("location: ".$currentPage."?login_successful=true"); 
        }       
        else 
        {
            if($containsArg)
            header("location: ".$currentPage."&login_successful=false"); 
            else 
            header("location: ".$currentPage."?login_successful=false"); 
        }
    } 
    else 
    {
        if($containsArg)
            header("location: ".$currentPage."&login_successful=false"); 
            else 
            header("location: ".$currentPage."?login_successful=false"); 
    }

} 

?>