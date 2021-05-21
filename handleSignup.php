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
       $showError = false; 
       $userName = $_POST['userName']; 
       $passWord = $_POST['passWord']; 
       $cPassWord = $_POST['cPassWord']; 

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
       
       $sql1 = "SELECT * FROM `project_user` where `user_name`='$userName'"; 
       $res1 = mysqli_query($conn, $sql1); 
       $numOfRows = mysqli_num_rows($res1); 
       if($numOfRows>0)
       {
          if($containsArg)
            header("location: ".$currentPage."&signup_successful=false"); 
            else 
            header("location: ".$currentPage."?signup_successful=false"); 
       } 
       else 
       {
           if($passWord == $cPassWord)
           {
                $hashOfPassWord = password_hash($passWord, PASSWORD_DEFAULT); 
                $sql2 = "INSERT INTO `project_user`(`user_name`,
                `password`,`date`) VALUES('$userName','$hashOfPassWord',
                current_timestamp())";
                $res2 = mysqli_query($conn, $sql2); 
                if($res2)
                {
                    if($containsArg)
            header("location: ".$currentPage."&signup_successful=true"); 
            else 
            header("location: ".$currentPage."?signup_successful=true"); 
                }
           } 
           else 
           {
               if($containsArg)
            header("location: ".$currentPage."&signup_successful=false"); 
            else 
            header("location: ".$currentPage."?signup_successful=false"); 
           }
      }


   }

?>