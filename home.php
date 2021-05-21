<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link rel="stylesheet" href="stylesheet.css">
    <title>iDiscuss Forum</title>

  </head>
  <body>

  <?php require 'navbar.php'; ?> 


  <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
  <ol class="carousel-indicators">
    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
  </ol>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img class="d-block w-100" src="https://source.unsplash.com/1800x400/weekly?coding" alt="First slide">
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="https://source.unsplash.com/1800x400/weekly?computers" alt="Second slide">
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="https://source.unsplash.com/1800x400/weekly?programming" alt="Third slide">
    </div>
  </div>
  <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
   
  <div class="container text-center">
      <h1 >iDiscuss Category</h1>
  </div> 

  <!-- Category container starts here --> 
  <div class="container">
      <div class="row"> 

      <!-- PHP Code -->  
  <?php
   
   $serverName = "localhost"; 
   $userName = "root"; 
   $passWord = "";
   $dataBase = "mydatabase"; 

   $conn = mysqli_connect($serverName, $userName, $passWord, $dataBase); 
   if(!$conn)
   echo "<br> Connection not formed <br>";
   $sql = "SELECT * FROM `categories_info`"; 
   $res = mysqli_query($conn, $sql); 

   while($row = mysqli_fetch_assoc($res))
   {
       $id = $row['category_id']; 
       $cat1 = $row['category_name']; 
       $cat2 = $row['category_discription']; 
     echo ' <div class="col-md-4 my-2">
     <div class="card" style="width: 18rem;">
       <img src="https://source.unsplash.com/1600x900/?'.$cat1.',code" class="card-img-top" alt="...">
          <div class="card-body">
            <h5 class="card-title"> <a href="/FORUM/threadlist.php?catid='.$id.'">' .$cat1. '</a> </h5>
             <p class="card-text">'.substr($cat2,0,60).'...</p>
             <a class="btn btn-primary" href="/FORUM/threadlist.php?catid='.$id.'"> Learn More </a>
          </div>
     </div>
   </div>'; 
   } 

  ?>

  </div>
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