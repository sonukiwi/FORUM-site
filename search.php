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
    <title>Search Results</title>
  </head>
  <body>
    
    
    <?php require 'toCopy.php'; ?> 
    

    <div class="container">
        <?php
        $serverName = "localhost"; 
        $userName = "root"; 
        $passWord = "";
        $dataBase = "mydatabase"; 
     
        $conn = mysqli_connect($serverName, $userName, $passWord, $dataBase); 
        if(!$conn)
        echo "<br> Connection not formed <br>";
        error_reporting(0); 
          $toBeSearched = $_GET['toBeSearched']; 
          echo '<h2>Showing results for "<em>'.$toBeSearched.'</em>":</h2>';
          $sql = "SELECT * from `threads` where match(`thread_title`, `thread_desc`) against ('$toBeSearched')";
          $res = mysqli_query($conn, $sql); 
          
          $numOfRows = mysqli_num_rows($res); 
          if($numOfRows==0)
          {

        echo '<div class="jumbotron">
            <h1 class="display-4">No Results Found</h1>
            <p class="lead">Please be more specific and check spelling..</p>
            <hr class="my-4">
            
        </div>';

          } 
          else 
          {
              while($row=mysqli_fetch_assoc($res))
              {
                
                $thread_desc = $row['thread_desc']; 
                $thread_title = $row['thread_title']; 
                $thread_id = $row['thread_id']; 

                echo '<div class="media py-3">
                <a href="/FORUM/thread.php?thread_id='.$thread_id.'" style="text-decoration: none; color: black;">
                <div class="media-body">
                  <h5 class="mt-0">'.$thread_title.'</h5>
                  '.$thread_desc.'
                </div>
                </a>
              </div>'; 
              }
          }

        ?>
    </div>

    <!-- Footer -->
    <div class="container-fluid" id="footer" style="background-color: black; color: white;
     position: absolute; bottom:0; ">
      <p class="text-center" id="footer">This is Footer</p> 
    </div>
    
    

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>