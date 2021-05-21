<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <link rel="stylesheet" href="stylesheet.css">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    
    <title>iDiscuss Forum</title>
    <style>
      
      #footerDiv{
   position: fixed;
   left: 0;
   bottom: 0;
   width: 100%;
   color: white;
   text-align: center;
}
    </style>

  </head>
  <body>
     



  <!--Navigation Bar Or Header-->
<?php require 'navbar.php' ?>
   <div class="container my-4 py-3 col-md-8" >
 <?php  
  error_reporting(0); 
  $serverName = "localhost"; 
   $userName = "root"; 
   $passWord = "";
   $dataBase = "mydatabase"; 
   session_start(); 

   $conn = mysqli_connect($serverName, $userName, $passWord, $dataBase); 
   if(!$conn)
   echo "<br> Connection not formed <br>";
   $id = $_GET['catid']; 
   $sql = "SELECT * FROM `categories_info` where `category_id`=$id";
   $res = mysqli_query($conn,$sql); 
   $row = mysqli_fetch_assoc($res); 
   $categoryName = $row['category_name']; 
   $category_desc = $row['category_discription']; 

   $method = $_SERVER['REQUEST_METHOD']; 
   $th_title = $_POST['problem']; 
       $th_desc = $_POST['problem_desc'];
    
    $sql3 = "SELECT * FROM `threads` where `thread_title`='$th_title' AND 
    `thread_desc`='$th_desc'"; 
    $res3 = mysqli_query($conn, $sql3); 
    $numOfRows = mysqli_num_rows($res3);    
   if($method=="POST"&&$numOfRows==0&&$th_title!=""&&$th_desc!="")
   {  

      $tempUserName = $_SESSION['userName']; 
      $sql5 = "SELECT * FROM `project_user` where `user_name`='$tempUserName'";
      $res5 = mysqli_query($conn, $sql5); 
      $row5 = mysqli_fetch_assoc($res5); 
      $user_id = $row5['sno']; 
        
       $sql2 = "INSERT INTO `threads`(`thread_title`,`thread_desc`,`thread_cat_id`,
       `thread_user_id`,`timestamp`) VALUES('$th_title',
       '$th_desc','$id','$user_id',current_timestamp())";
       $res2 = mysqli_query($conn, $sql2); 

       if($res2)
       {
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong> Question added successfully..
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>';
       }

   } 

  echo '<div class="jumbotron" >
  <h1 class="display-4">Welcome To '.$categoryName.' Forum</h1>
  <p class="lead">'.$category_desc.'</p>
  <hr class="my-4"> 
  <p>This is a coding forum. <br> Rules are :</p>
  <p class="my-1">1. No Advertising</p>
  <p class="my-1">2. No Spamming</p>
  <p class="my-1">3. No Use of Abusive Words</p>
  <p class="lead my-3"> 
    <a class="btn btn-success btn-lg" href="#" role="button">Learn more</a>
  </p>
</div>';
   $path = $_SERVER['REQUEST_URI']; 
   session_start(); 
   if(isset($_SESSION['loggedin'])&&$_SESSION['loggedin']==true) {
   echo '<h2>Start A Discussion</h2>';
   echo '<form action="'.$path.'" method="post">
   <div class="form-group">
     <label for="exampleInputEmail1">Problem: </label>
     <input required name="problem" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
   </div>
   <div class="form-group">
     <label for="exampleInputPassword1">Elaborate Your Problem: </label>
     <div class="form-group">
     
     <textarea required name="problem_desc" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
   </div>
   </div>
   <button type="submit" class="btn btn-success">Submit</button>
 </form>
    ';   } 
    else 
    {
      echo '<div class="alert alert-danger" role="alert">
      You Not Logged In. Please Login To Start A Discussion
    </div>'; 
    }
   

   echo '<h3>Browse Questions</h3>'; 
   $id = $_GET['catid']; 
   $sql1 = "SELECT * FROM `threads` where `thread_cat_id`=$id";
   $res1 = mysqli_query($conn, $sql1);
   $printMessage = true;  
   while ($row1 = mysqli_fetch_assoc($res1)){
       $printMessage = false; 
       $id1 = $row1['thread_id']; 
       $timeStamp = $row1['timestamp']; 
       $thread_title = $row1['thread_title']; 
       $thread_desc = $row1['thread_desc']; 
       $thread_user_id = $row1['thread_user_id']; 

       $sql4 = "SELECT * from `project_user` where `sno`='$thread_user_id'"; 
       $res4 = mysqli_query($conn, $sql4); 
       $row2 = mysqli_fetch_assoc($res4); 
       $user_name = $row2['user_name']; 

   echo '<div class="media my-4">
   <img class="mr-3" style="display:inline;" src="default-user.jpg" width="34px" alt="Generic placeholder image">
     <div class="media-body" style="display:inline;">
     <h6 class="media-heading vertical-center"
     style="font-weight: bold; ">'.$user_name.' At '.$timeStamp.'</h6>
       <h5>'.$thread_title.'</h5>
       
        <p> '.$thread_desc.' </p>
        <a href="/FORUM/thread.php?thread_id='.$id1.'">View Comments</a>
     </div>
</div>';

   } 
   if($printMessage)
   {
       echo '<div class="jumbotron jumbotron-fluid my-2" >
       <div class="container">
         <h2 class="display-4"><b>No Questions Found</b></h2>
         <p class="lead">This is a modified jumbotron that occupies the entire horizontal space of its parent.</p>
       </div>
     </div>';
   }
 ?>   
 
   </div> 



     

  <!-- Footer -->
  <div class="container-fluid" id="footerDiv">
   <p class="text-center" id="footer">This is Footer</p> 
  </div>
    
 

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js" integrity="sha384-SR1sx49pcuLnqZUnnPwx6FCym0wLsk5JZuNx2bPPENzswTNFaQU1RDvt3wT4gWFG" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js" integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc" crossorigin="anonymous"></script>
    -->
  </body>
</html>