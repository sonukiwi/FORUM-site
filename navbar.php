
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

  </head>
  <body>

<?php 
  
    session_start();
    $serverName = "localhost"; 
    $userName = "root"; 
    $passWord = ""; 
    $dataBase = "mydatabase"; 

   $conn = mysqli_connect($serverName, $userName, $passWord, $dataBase); 

   if(!$conn)
   echo "<h1> Connection not created </h1>"; 

     $sql = "SELECT * from `categories_info`"; 
     $res = mysqli_query($conn, $sql); 

    if(isset($_SESSION['loggedin'])&&$_SESSION['loggedin']==true)
    {  
       
       
     echo '<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
     <a class="navbar-brand" href="/FORUM/home.php">iDiscuss</a>
     <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
       <span class="navbar-toggler-icon"></span>
     </button> 
   
     <div class="collapse navbar-collapse" id="navbarSupportedContent">
       <ul class="navbar-nav mr-auto">
         <li class="nav-item active">
           <a class="nav-link" href="/FORUM/home.php">Home <span class="sr-only">(current)</span></a>
         </li>
         <li class="nav-item">
           <a class="nav-link" href="/FORUM/about.php">About</a>
         </li>';

        
         echo '<li class="nav-item dropdown">
           <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
             Top Categories
           </a> 
           <div class="dropdown-menu" aria-labelledby="navbarDropdown">'; 
             while($row=mysqli_fetch_assoc($res)) 
             {
             echo '<a class="dropdown-item" href="/FORUM/threadlist.php?catid='.$row['category_id'].'"> '.$row['category_name'].' </a>'; 
             } 
           echo '</div>
         </li>';

        echo '<li class="nav-item">
           <a class="nav-link" href="/FORUM/contact.php">Contact</a>
         </li>
       </ul>
       <form class="form-inline my-2 my-lg-0" action="/FORUM/search.php" method="get">
         <input name="toBeSearched" class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
         <button class="btn btn-success my-2 my-sm-0" type="submit">Search</button>
       </form>
       <button type="button" class="btn btn-outline-success ml-2" data-toggle="modal" 
       data-target="#exampleModal">Logout</button>
     </div>
    </nav>';
    } 

    else 
    {  

      echo '<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <a class="navbar-brand" href="/FORUM/home.php">iDiscuss</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button> 
    
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="nav-link" href="/FORUM/home.php">Home <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/FORUM/about.php">About</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Top Categories
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              ';

              $sql1 = "SELECT * from `categories_info`"; 
              $res1 = mysqli_query($conn, $sql1); 
              while($row1 = mysqli_fetch_assoc($res1))
              {
                $category_name = $row1['category_name']; 
                $category_id = $row1['category_id']; 
                echo '<a class="dropdown-item" href="/FORUM/threadlist.php?
                catid='.$row1['category_id'].'"> '.$row1['category_name'].' </a>'; 
              }

              echo '
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/FORUM/contact.php">Contact</a>
          </li>
        </ul>
        <form class="form-inline my-2 my-lg-0" action="/FORUM/search.php" method="get">
          <input name="toBeSearched" class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-success my-2 my-sm-0" type="submit">Search</button>
        </form>
        <button type="button" class="btn btn-outline-success ml-2" data-toggle="modal" 
        data-target="#exampleModal2">Signup</button>
        <button type="button" class="btn btn-outline-success ml-2" data-toggle="modal" 
        data-target="#exampleModal1">Login</button>
      </div>
     </nav>';
    }

   if(isset($_GET['signup_successful'])&&$_GET['signup_successful']=="true")
   {  
    echo '<div class="alert alert-success alert-dismissible fade show my-2" role="alert">
    <strong>Success!</strong> Account Created Successfully.
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>';
   } 
   else if(isset($_GET['signup_successful'])&&$_GET['signup_successful']=="false")
   {
     echo '<div class="alert alert-danger alert-dismissible fade show my-2" role="alert">
     <strong>Error!</strong> Passwords do not match OR username already exists.
     <button type="button" class="close" data-dismiss="alert" aria-label="Close">
       <span aria-hidden="true">&times;</span>
     </button>
   </div>'; 
   } 
   else if(isset($_GET['login_successful'])&&$_GET['login_successful']=="false")
   {
     echo '<div class="alert alert-danger alert-dismissible fade show my-2" role="alert">
     <strong>Error!</strong> Wrong Password OR account not created.
     <button type="button" class="close" data-dismiss="alert" aria-label="Close">
       <span aria-hidden="true">&times;</span>
     </button>
   </div>';  
   }
   else if(isset($_GET['login_successful'])&&$_GET['login_successful']=="true")
   {
     echo '<div class="alert alert-success alert-dismissible fade show my-2" role="alert">
     <strong>Success!</strong> Logged In Successfully.
     <button type="button" class="close" data-dismiss="alert" aria-label="Close">
       <span aria-hidden="true">&times;</span>
     </button>
   </div>';
   }

?>



<!-- Login Modal -->
 <div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Login: </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <?php
        $currentPath = $_SERVER['REQUEST_URI']; 

  echo '<form action="/FORUM/handleLogin.php" method="post">
  <div class="form-group"> 
    <label for="exampleInputEmail1">Username: </label>
    <input name="userName" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
    <input name="currentPage" type="hidden" value="'.$currentPath.'"> 
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Password: </label>
    <input name="passWord" type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
  </div>
  <button type="submit" class="btn btn-primary">Login</button>
  </form>';
  ?> 
      </div>
    </div>
  </div>
</div>

<!-- Signup Modal -->
<div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Signup: </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <?php
        $currentPath = $_SERVER['REQUEST_URI']; 
      echo '<form action="/FORUM/handleSignup.php" method="post"> 
  <div class="form-group">
    <label for="exampleInputEmail1">Username: </label>
    <input name="userName" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" >
    <input name="currentPage" value="'.$currentPath.'" type="hidden">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Password: </label>
    <input name="passWord" type="password" class="form-control" id="exampleInputPassword1" >
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Confirm Password: </label>
    <input name="cPassWord" type="password" class="form-control" id="exampleInputPassword2" >
  </div>
  <button type="submit" class="btn btn-primary">Signup</button>
 </form>';
 ?> 

      </div>
      
    </div>
  </div>
</div>

<!-- Logout Modal -->
 <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Do you want to logout?</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-light"><a href="/FORUM/logout.php" 
        style="text-decoration:none;color:black;">Logout</a></button>
      </div>
    </div>
  </div>
 </div>


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>