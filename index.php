<?php
  $weather = ""; 
  $error = ""; 
  if($_GET['city']){
      $city = str_replace(" ", "",$_GET['city']);
      $file_headers = @get_headers("https://www.weather-forecast.com/locations/".$city."/forecasts/latest"); 
      
      if($file_headers[0] == 'HTTP/1.1 404 Not Found'){
          $error = "that city could not be found"; 
      }
      else{
      $forecastPage  = file_get_contents("https://www.weather-forecast.com/locations/".$city."/forecasts/latest"); 
      $pageArray = explode('<p class="location-summary__text"><span class="phrase">',$forecastPage);
      if(sizeof($pageArray)>1){
      
      $secondPageArray = explode('</span></p></div>',$pageArray[1]);  
    
      if(sizeof($secondPageArray)>1){
      $weather =  $secondPageArray[0]; 
      }
        else {
        $error = "that city could not be found"; 
        }
      
    }else{
    $error = "that city could not be found"; 
    }
}
}
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>Weather Scraper</title>
     
     
      <!-- CSS STYLE-->
    
    <style>
         html{
            background: url(background.jpeg) no-repeat center center fixed; 
            -webkit-background-size: cover; 
            -moz-background-size: cover; 
            -o-background-size: cover; 
            background-size: cover; 
        }
        body{
            background: none; 
        }
        .container{
            text-align:center; 
            margin-top:100px; 
            width:450px; 
        }

        .form-group{
            margin:  20px 0;
        }

        #weather{
            margin-top:15px;
        }
    </style>

  </head>

  
  <body>
  
    <div class="container">
        <h1 class="text-muted bg-warning"> What is the weather?</h1>
       
        <form>
            <div class="form-group">
                <label class="text-dark" for="city">Enter the name of the city:</label>
                <input type="text" class="form-control" name="city" id="city" placeholder="Eg.London, Tokyo" value="<?php echo $_GET['city'];?>" >
                <br>
                <button type="submit" class="btn btn-warning">Submit</button>
             
            </div>
        </form>
        <div id="weather">
                    <?php 
                      if($weather){
                        echo '<div class="alert alert-success" role="alert">'.$weather.'</div>';
                      }else if($error){
                            echo '<div class="alert alert-danger" role="alert">'.$error.'</div>';
                      }
                    ?>
        </div>
    </div>
   
   
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>