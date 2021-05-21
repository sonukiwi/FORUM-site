 
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
 <style>
 </style>
    <title> Question </title>
  </head>
  <body> 

      <?php require 'navbar.php' ?> 

      <div class="container">
      <?php
 error_reporting(0); 
 

$serverName = "localhost"; 
$userName = "root"; 
$passWord = "";
$dataBase = "mydatabase"; 

$conn = mysqli_connect($serverName, $userName, $passWord, $dataBase); 
if(!$conn)
echo "<br> Connection not formed <br>";

    $thread_id = $_GET['thread_id']; 
    $sql = "SELECT * FROM `threads` where `thread_id`=$thread_id"; 
    $res = mysqli_query($conn, $sql); 
    $noRes = true; 

    while($row = mysqli_fetch_assoc($res)) 
    {
    $thread_name = $row['thread_title']; 
    $thread_desc = $row['thread_desc']; 
    $userId = $row['thread_user_id']; 
    $noRes = false; 

    $sql6 = "SELECT * FROM `project_user` where `sno`='$userId'"; 
    $res6 = mysqli_query($conn, $sql6); 

      $row6 = mysqli_fetch_assoc($res6);        
     
       echo ' <div class="jumbotron text-center my-3" id="jumb">
       <h1 class="display-4">'.$thread_name.'</h1>
       <p class="lead">'.$thread_desc.'</p>
       <hr class="my-4">
       <p>It uses utility classes for typography and spacing to space content out within the larger container.</p>
       <p class="lead">
         <a class="btn btn-success btn-lg" href="#" role="button">Learn more</a>
       </p>
       <p>Posted By: <b>'.$row6['user_name'].'</b></p>
     </div>';
    } 
    if($noRes)
    {
        echo '<div class="jumbotron jumbotron-fluid my-2" >
        <div class="container">
          <h2 class="display-4"><b>No Comments Found</b></h2>
          <p class="lead">This is a modified jumbotron that occupies the entire horizontal space of its parent.</p>
        </div>
      </div>';
    } 
    
    $method = $_SERVER['REQUEST_METHOD']; 
    $comment_content = $_POST['comment'];
    $sql1 = "SELECT * FROM `comments` where `comment_content`='$comment_content'"; 
    $res1 = mysqli_query($conn, $sql1); 
    $numOfRows = mysqli_num_rows($res1); 
    $showAlert = false; 
    
    session_start(); 
    if($method=="POST"&&$numOfRows==0)
    {

      $tempUserName = $_SESSION['userName']; 
      $sql5 = "SELECT * FROM `project_user` where `user_name`='$tempUserName'";
      $res5 = mysqli_query($conn, $sql5); 
      $row5 = mysqli_fetch_assoc($res5); 
      $user_id = $row5['sno'];  

        $sql2 = "INSERT INTO `comments`(`comment_content`,
        `thread_id`,`comment_by`,`comment_time`) VALUES('$comment_content',
        '$thread_id','$user_id',current_timestamp())";
        $res2 = mysqli_query($conn, $sql2); 
        if($res2)
         $showAlert=true;
         echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
         <strong>Success!</strong> Comment Inserted Successfully
         <button type="button" class="close" data-dismiss="alert" aria-label="Close">
           <span aria-hidden="true">&times;</span>
         </button>
       </div>';
    }
     
    $url = $_SERVER['REQUEST_URI']; 

    session_start(); 
    if(isset($_SESSION['loggedin'])&&$_SESSION['loggedin']==true) 
    {
    echo "<h2>Post A Comment</h2>";
    $path = $_SERVER['REQUEST_URI']; 
    echo ' <form action="'.$path.'" method="post">
    <div class="form-group">
    <label for="exampleFormControlTextarea1">Type Your Comment:</label>
    <textarea required class="form-control" name="comment" id="exampleFormControlTextarea1" rows="3"></textarea>
    </div>
    <button class="btn btn-success" style="margin-bottom: 2%;">Post Comment</button>
  </form>'; 
    
    $userName = $_SESSION['userName']; 

    $sql8 = "SELECT * from `comments` where `thread_id` = $thread_id"; 
    $res8 = mysqli_query($conn, $sql8); 
    $numOfRows1 = mysqli_num_rows($res8); 
    
   
    }

    else 
    {
      echo '<div class="alert alert-danger" role="alert">
      You Are Not Logged In. Please Login To Comment
    </div>'; 
    }  

    echo '<br>'; 

      ?> 

      <script>
        
        console.log(document.getElementById("comments").text); 

      </script>
        
      <?php

       $sql3 = "SELECT * FROM `comments` where `thread_id`='$thread_id'"; 
       $res3 = mysqli_query($conn, $sql3); 

       $count = 1; 
       while($row1 = mysqli_fetch_assoc($res3))
       {
          $content = $row1['comment_content']; 
          $comment_time = $row1['comment_time']; 
          $comment_by = $row1['comment_by']; 
          $comment_id = $row1['comment_id']; 
          $upvotes = $row1['upVote']; 
          $downvotes = $row1['downVote']; 
          $upVoted_By = $row1['upVoted_By']; 
          $downVoted_By = $row1['downVoted_By']; 
          
          $upVotesCount = 0; 
          $downVotesCount = 0; 
          $plusCountInUpvotes = 0; 
          $plusCountInDownvotes = 0; 

          for($i=0;$i<strlen($upVoted_By);$i++)
          {
              if($upVoted_By[$i] == '+') 
              $plusCountInUpvotes++;  
          } 
          for($i=0;$i<strlen($downVoted_By);$i++)
          {
            if($downVoted_By[$i] == '+') 
            $plusCountInDownvotes++; 
          } 

          if($plusCountInUpvotes == 0)
          {
             if($upVoted_By == "") 
             $upVotesCount = 0; 
             else 
             $upVotesCount = 1; 
          } 
          else 
          {
            $upVotesCount = $plusCountInUpvotes + 1; 
          } 

          if($plusCountInDownvotes == 0)
          {
            if($downVoted_By == "") 
            $downVotesCount = 0; 
            else 
            $downVotesCount = 1; 
          } 
          else 
          {
            $downVotesCount = $plusCountInDownvotes + 1; 
          }
          

          // $sql7 = "SELECT * from `comments` where `comment_id` = $comment_id"; 
          // $res7 = mysqli_query($conn, $sql7); 

          // $row7 = mysqli_fetch_assoc($res7); 
          

          $sql4 = "SELECT * from `project_user` where `sno`='$comment_by'"; 
          $res4 = mysqli_query($conn, $sql4); 
         $row2 = mysqli_fetch_assoc($res4); 
          
          $user_name = $row2['user_name']; 
          $currenPath = $_SERVER['REQUEST_URI']; 
          $currentUser = $_SESSION['userName']; 

          if($count==1) 
          echo '<div class="container col-md-12">  <h2 id="comments">Comments:</h2>  </div>';
        
          echo '<br><div class="media my-2">
          <div class="media-left" id="dir">
            
          </div> 
          <p style="color: black; margin-right: 10px;"> <b>'.$comment_id.'.</b> </p>
          
          <div class="media-body"> 
            <h6 class="media-heading vertical-center" 
            style="font-weight: bold;">'.$user_name.' At '.$comment_time.'</h6>
            <p> '.$content.' </p>

            <div>
            
            <span> <b>'.$upVotesCount.'</b> </span> <span style="color: green;"> Upvotes </span>
            <span> <b>'.$downVotesCount.'</b> </span> <span style="color: red;"> Downvotes </span>

            </div>';
          
            if(isset($_SESSION['loggedin'])&&$_SESSION['loggedin']==true) {
            echo '<div>
            <button type="button" class="btn btn-success">
            <abbr title="This answer is useful" style="border-bottom:none;text-decoration:none;"><a href="/FORUM/handleUpVote.php?user_name='.$currentUser.'&comment_id='.$comment_id.'&url='.$currenPath.'" 
            style="color: white; text-decoration: none;">Upvote</a></abbr></button>
            <button type="button" class="btn btn-danger">
            <abbr title="This answer is not useful" style="border-bottom:none;text-decoration:none;"> <a href="/FORUM/handleDownVote.php?user_name='.$currentUser.'&comment_id='.$comment_id.'&url='.$currenPath.'" 
            style="color: white; text-decoration: none;" >Downvote</a> </abbr> </button>
            </div>';
            }
            
           echo '
          </div>  
        </div>'; 

            $count++; 
       }

      ?> 

</div>  

  


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>