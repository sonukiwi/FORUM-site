<?php 
 error_reporting(0); 

$serverName = "localhost"; 
$userName = "root"; 
$passWord = ""; 
$dataBase = "mydatabase"; 

$conn = mysqli_connect($serverName, $userName, $passWord, $dataBase);
  
 if(!$conn) 
 echo "Connection not formed"; 

  $url = $_GET['url']; 
  $userName = $_GET['user_name']; 
  $comment_id = $_GET['comment_id']; 

  $sql = "SELECT * from `comments` where `comment_id` = $comment_id"; 
  $res = mysqli_query($conn, $sql); 

  $row = mysqli_fetch_assoc($res); 
  $upVoted_By = $row['upVoted_By']; 
  $downVoted_By = $row['downVoted_By']; 

  $sql1 = "SELECT * from `project_user` where `user_name` = '$userName'";
  $res1 = mysqli_query($conn, $sql1); 

  $row1 = mysqli_fetch_assoc($res1); 
  $user_id = $row1['sno']; 
  $idToBeUsed = (string) $user_id;

  if($upVoted_By == "" && $downVoted_By == "") 
  {
      $upVoted_By = $upVoted_By.$idToBeUsed; 
      $sql2 = "UPDATE `comments` set `downVoted_By` = '$upVoted_By' where `comment_id` = $comment_id"; 
      $res2 = mysqli_query($conn, $sql2); 
      
      echo '<!doctype html>
      <html lang="en">
        <head>
          <!-- Required meta tags -->
          <meta charset="utf-8">
          <meta name="viewport" content="width=device-width, initial-scale=1">
      
          <!-- Bootstrap CSS -->
          <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">
      
          <title> Upvote/Downvote </title> 
      
        </head>
        <body>
          
          <h4 style="color: red; text-align: center; padding: 7px;">You Have Successfully Downvoted</h4>
      
          <div class="container col-md-12 text-center">
           <button type="button" class="btn btn-primary" 
           ><a href="'.$url.'" style="text-decoration:none; color: white;">Okay</a></button>
          </div>
      
          <!-- Optional JavaScript; choose one of the two! -->
      
          <!-- Option 1: Bootstrap Bundle with Popper -->
          <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-p34f1UUtsS3wqzfto5wAAmdvj+osOnFyQFpp4Ua3gs/ZVWx6oOypYoCJhGGScy+8" crossorigin="anonymous"></script>
      
          <!-- Option 2: Separate Popper and Bootstrap JS -->
          <!--
          <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
          <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.min.js" integrity="sha384-lpyLfhYuitXl2zRZ5Bn2fqnhNAKOAaM/0Kr9laMspuaMiZfGmfwRNFh8HlMy49eQ" crossorigin="anonymous"></script>
          -->
        </body>
      </html>'; 

  }   

  else 
  {   
      $len1 = strlen($upVoted_By); 
      $len2 = strlen($downVoted_By); 
      
      if($len1 == 0 && $len2>=1)
      {

          $flag = true; 
          for($i=0;$i<strlen($downVoted_By);$i++)
          {
              if($downVoted_By[$i] == '+') 
              {
                  continue; 
              } 
              else 
              {
                  $j = $i;
                  $tempString = "";  
                  $len = strlen($downVoted_By); 
                  while($j<$len)   
                  {
                      if($downVoted_By[$j] == '+') 
                      break; 
                      $tempString = $tempString.$downVoted_By[$j]; 
                      $j++; 
                  } 
                  if($tempString == $idToBeUsed) 
                  {
                      
                    echo '<!doctype html>
                    <html lang="en">
                      <head>
                        <!-- Required meta tags -->
                        <meta charset="utf-8">
                        <meta name="viewport" content="width=device-width, initial-scale=1">
                    
                        <!-- Bootstrap CSS -->
                        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">
                    
                        <title> Upvote/Downvote </title> 
                    
                      </head>
                      <body>
                        
                        <h4 style="color: red; text-align: center; padding: 7px;">You Have Already Downvoted</h4>
                    
                        <div class="container col-md-12 text-center">
                        <button type="button" class="btn btn-primary" 
           ><a href="'.$url.'" style="text-decoration:none; color: white;">Okay</a></button>
                    </div>
                    
                        <!-- Optional JavaScript; choose one of the two! -->
                    
                        <!-- Option 1: Bootstrap Bundle with Popper -->
                        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-p34f1UUtsS3wqzfto5wAAmdvj+osOnFyQFpp4Ua3gs/ZVWx6oOypYoCJhGGScy+8" crossorigin="anonymous"></script>
                    
                        <!-- Option 2: Separate Popper and Bootstrap JS -->
                        <!--
                        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
                        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.min.js" integrity="sha384-lpyLfhYuitXl2zRZ5Bn2fqnhNAKOAaM/0Kr9laMspuaMiZfGmfwRNFh8HlMy49eQ" crossorigin="anonymous"></script>
                        -->
                      </body>
                    </html>'; 

                      $flag = false; 
                      break; 
                  } 
              }
          } 
          if( $flag == true ) 
          { 
          $upVoted_By = $downVoted_By.'+';
          $upVoted_By = $upVoted_By.$idToBeUsed; 
          $sql3 = "UPDATE `comments` set `downVoted_By` = '$upVoted_By' where `comment_id` = $comment_id"; 
          $res3 = mysqli_query($conn, $sql3); 
          
          echo '<!doctype html>
          <html lang="en">
            <head>
              <!-- Required meta tags -->
              <meta charset="utf-8">
              <meta name="viewport" content="width=device-width, initial-scale=1">
          
              <!-- Bootstrap CSS -->
              <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">
          
              <title> Upvote/Downvote </title> 
          
            </head>
            <body>
              
              <h4 style="color: red; text-align: center; padding: 7px;">You Have Successfully Downvoted</h4>
          
              <div class="container col-md-12 text-center">
              <button type="button" class="btn btn-primary" 
           ><a href="'.$url.'" style="text-decoration:none; color: white;">Okay</a></button>
          </div>
          
              <!-- Optional JavaScript; choose one of the two! -->
          
              <!-- Option 1: Bootstrap Bundle with Popper -->
              <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-p34f1UUtsS3wqzfto5wAAmdvj+osOnFyQFpp4Ua3gs/ZVWx6oOypYoCJhGGScy+8" crossorigin="anonymous"></script>
          
              <!-- Option 2: Separate Popper and Bootstrap JS -->
              <!--
              <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
              <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.min.js" integrity="sha384-lpyLfhYuitXl2zRZ5Bn2fqnhNAKOAaM/0Kr9laMspuaMiZfGmfwRNFh8HlMy49eQ" crossorigin="anonymous"></script>
              -->
            </body>
          </html>'; 

          }
      } 
      else if($len1>=1 && $len2==0)
      {
        $flag = true; 
        for($i=0;$i<strlen($upVoted_By);$i++)
        {
            if($upVoted_By[$i] == '+') 
            {
                continue; 
            } 
            else 
            {
                $j = $i;
                $tempString = "";  
                $len = strlen($upVoted_By); 
                while($j<$len)   
                {
                    if($upVoted_By[$j] == '+') 
                    break; 
                    $tempString = $tempString.$upVoted_By[$j]; 
                    $j++; 
                } 
                if($tempString == $idToBeUsed) 
                {
                    
                    echo '<!doctype html>
                    <html lang="en">
                      <head>
                        <!-- Required meta tags -->
                        <meta charset="utf-8">
                        <meta name="viewport" content="width=device-width, initial-scale=1">
                    
                        <!-- Bootstrap CSS -->
                        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">
                    
                        <title> Upvote/Downvote </title> 
                    
                      </head>
                      <body>
                        
                        <h4 style="color: red; text-align: center; padding: 7px;">You Have Already Upvoted</h4>
                    
                        <div class="container col-md-12 text-center">
                        <button type="button" class="btn btn-primary" 
           ><a href="'.$url.'" style="text-decoration:none; color: white;">Okay</a></button>
                    </div>
                    
                        <!-- Optional JavaScript; choose one of the two! -->
                    
                        <!-- Option 1: Bootstrap Bundle with Popper -->
                        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-p34f1UUtsS3wqzfto5wAAmdvj+osOnFyQFpp4Ua3gs/ZVWx6oOypYoCJhGGScy+8" crossorigin="anonymous"></script>
                    
                        <!-- Option 2: Separate Popper and Bootstrap JS -->
                        <!--
                        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
                        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.min.js" integrity="sha384-lpyLfhYuitXl2zRZ5Bn2fqnhNAKOAaM/0Kr9laMspuaMiZfGmfwRNFh8HlMy49eQ" crossorigin="anonymous"></script>
                        -->
                      </body>
                    </html>'; 
                    
                    $flag = false; 
                    break; 
                } 
            }
        } 
        if( $flag == true ) 
        { 
         $downVoted_By = $downVoted_By.$idToBeUsed; 
        $sql3 = "UPDATE `comments` set `downVoted_By` = '$downVoted_By' where `comment_id` = $comment_id"; 
        $res3 = mysqli_query($conn, $sql3); 
        
        echo '<!doctype html>
        <html lang="en">
          <head>
            <!-- Required meta tags -->
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">
        
            <!-- Bootstrap CSS -->
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">
        
            <title> Upvote/Downvote </title> 
        
          </head>
          <body>
            
            <h4 style="color: red; text-align: center; padding: 7px;">You Have Successfully Downvoted</h4>
        
            <div class="container col-md-12 text-center">
            <button type="button" class="btn btn-primary" 
           ><a href="'.$url.'" style="text-decoration:none; color: white;">Okay</a></button>
        </div>
        
            <!-- Optional JavaScript; choose one of the two! -->
        
            <!-- Option 1: Bootstrap Bundle with Popper -->
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-p34f1UUtsS3wqzfto5wAAmdvj+osOnFyQFpp4Ua3gs/ZVWx6oOypYoCJhGGScy+8" crossorigin="anonymous"></script>
        
            <!-- Option 2: Separate Popper and Bootstrap JS -->
            <!--
            <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.min.js" integrity="sha384-lpyLfhYuitXl2zRZ5Bn2fqnhNAKOAaM/0Kr9laMspuaMiZfGmfwRNFh8HlMy49eQ" crossorigin="anonymous"></script>
            -->
          </body>
        </html>'; 

        }
      } 
      else if($len1>=1 && $len2>=1)
      {
         
        $flag1 = true; 
        for($i=0;$i<strlen($downVoted_By);$i++)
        {
            if($downVoted_By[$i] == '+') 
            {
                continue; 
            } 
            else 
            {
                $j = $i;
                $tempString = "";  
                $len = strlen($downVoted_By); 
                while($j<$len)   
                {
                    if($downVoted_By[$j] == '+') 
                    break; 
                    $tempString = $tempString.$downVoted_By[$j]; 
                    $j++; 
                } 
                if($tempString == $idToBeUsed) 
                {
                    
                    echo '<!doctype html>
                    <html lang="en">
                      <head>
                        <!-- Required meta tags -->
                        <meta charset="utf-8">
                        <meta name="viewport" content="width=device-width, initial-scale=1">
                    
                        <!-- Bootstrap CSS -->
                        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">
                    
                        <title> Upvote/Downvote </title> 
                    
                      </head>
                      <body>
                        
                        <h4 style="color: red; text-align: center; padding: 7px;">You Have Already Downvoted</h4>
                    
                        <div class="container col-md-12 text-center">
                        <button type="button" class="btn btn-primary" 
           ><a href="'.$url.'" style="text-decoration:none; color: white;">Okay</a></button>
                    </div>
                    
                        <!-- Optional JavaScript; choose one of the two! -->
                    
                        <!-- Option 1: Bootstrap Bundle with Popper -->
                        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-p34f1UUtsS3wqzfto5wAAmdvj+osOnFyQFpp4Ua3gs/ZVWx6oOypYoCJhGGScy+8" crossorigin="anonymous"></script>
                    
                        <!-- Option 2: Separate Popper and Bootstrap JS -->
                        <!--
                        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
                        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.min.js" integrity="sha384-lpyLfhYuitXl2zRZ5Bn2fqnhNAKOAaM/0Kr9laMspuaMiZfGmfwRNFh8HlMy49eQ" crossorigin="anonymous"></script>
                        -->
                      </body>
                    </html>'; 

                    $flag1 = false; 
                    break; 
                } 
            }
        } 
        
        $flag2 = true; 
        for($i=0;$i<strlen($upVoted_By);$i++)
        {
            if($upVoted_By[$i] == '+') 
            {
                continue; 
            } 
            else 
            {
                $j = $i;
                $tempString = "";  
                $len = strlen($upVoted_By); 
                while($j<$len)   
                {
                    if($upVoted_By[$j] == '+') 
                    break; 
                    $tempString = $tempString.$upVoted_By[$j]; 
                    $j++; 
                } 
                if($tempString == $idToBeUsed) 
                {
                    
                    echo '<!doctype html>
                    <html lang="en">
                      <head>
                        <!-- Required meta tags -->
                        <meta charset="utf-8">
                        <meta name="viewport" content="width=device-width, initial-scale=1">
                    
                        <!-- Bootstrap CSS -->
                        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">
                    
                        <title> Upvote/Downvote </title> 
                    
                      </head>
                      <body>
                        
                        <h4 style="color: red; text-align: center; padding: 7px;">You Have Already Upvoted</h4>
                    
                        <div class="container col-md-12 text-center">
                        <button type="button" class="btn btn-primary" 
           ><a href="'.$url.'" style="text-decoration:none; color: white;">Okay</a></button>
                    </div>
                    
                        <!-- Optional JavaScript; choose one of the two! -->
                    
                        <!-- Option 1: Bootstrap Bundle with Popper -->
                        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-p34f1UUtsS3wqzfto5wAAmdvj+osOnFyQFpp4Ua3gs/ZVWx6oOypYoCJhGGScy+8" crossorigin="anonymous"></script>
                    
                        <!-- Option 2: Separate Popper and Bootstrap JS -->
                        <!--
                        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
                        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.min.js" integrity="sha384-lpyLfhYuitXl2zRZ5Bn2fqnhNAKOAaM/0Kr9laMspuaMiZfGmfwRNFh8HlMy49eQ" crossorigin="anonymous"></script>
                        -->
                      </body>
                    </html>'; 

                    $flag2 = false; 
                    break; 
                } 
            }
        }

        if($flag1 && $flag2) 
        {
            $newString = $downVoted_By.'+'; 
         $newString = $newString.$idToBeUsed; 
        $sql3 = "UPDATE `comments` set `downVoted_By` = '$newString' where `comment_id` = $comment_id"; 
        $res3 = mysqli_query($conn, $sql3); 
        
        echo '<!doctype html>
        <html lang="en">
          <head>
            <!-- Required meta tags -->
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">
        
            <!-- Bootstrap CSS -->
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">
        
            <title> Upvote/Downvote </title> 
        
          </head>
          <body>
            
            <h4 style="color: red; text-align: center; padding: 7px;">You Have Successfully Downvoted</h4>
        
            <div class="container col-md-12 text-center">
            <button type="button" class="btn btn-primary" 
           ><a href="'.$url.'" style="text-decoration:none; color: white;">Okay</a></button>
        </div>
        
            <!-- Optional JavaScript; choose one of the two! -->
        
            <!-- Option 1: Bootstrap Bundle with Popper -->
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-p34f1UUtsS3wqzfto5wAAmdvj+osOnFyQFpp4Ua3gs/ZVWx6oOypYoCJhGGScy+8" crossorigin="anonymous"></script>
        
            <!-- Option 2: Separate Popper and Bootstrap JS -->
            <!--
            <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.min.js" integrity="sha384-lpyLfhYuitXl2zRZ5Bn2fqnhNAKOAaM/0Kr9laMspuaMiZfGmfwRNFh8HlMy49eQ" crossorigin="anonymous"></script>
            -->
          </body>
        </html>'; 

        }

      }
  }
    

 ?>