<?php
require('../../vendor/autoload.php');
$dotenv = Dotenv\Dotenv::createImmutable('./../../');
$dotenv->load();

$servername = $_ENV['servername'];
$db_username = $_ENV['db_username'];
$db_password = $_ENV['db_password'];
$db_name = $_ENV['database_name'];

// Create connection
$conn = new mysqli($servername, $db_username, $db_password, $db_name);
   
$table = $_POST['id'];
  
    $query = "SELECT * FROM $table ORDER BY payment_id DESC LIMIT 50 ";
    $result = mysqli_query($conn, $query);
    if(!$result){die('query failed:') . mysqli_error($conn);}

    while($payment_data = mysqli_fetch_assoc($result)){
        $id = $payment_data['payment_id'];
        $date = $payment_data['payment_time'];
        $data = $payment_data['payment_data'];
        $status = $payment_data['payment_status'];
        $amount = $payment_data['payment_amount'];
        $amount = $amount / 100 . "EUR";
      
      
        if($status === "Geslaagd"){
      
          echo '
          
            <div class="col-12 col-sm-6 col-md-4 col-lg-3">
            <center>
            <div class="card text-white bg-success mb-3" style="max-width: 90%; margin: 0 auto;">
              <div class="card-header"><h6>' . $id . " | " . $date . '</div>
                <div class="card-body">
                  <h5 class="card-title">'. $amount . " | " . $status .'</h5>
                  <p class="card-text">' . $data . '</p>
              </div>
            </div>
            </center>
            </div>
            
          
          ';
          
        }elseif($status === "In behandeling"){
          echo '
          
          <div class="col-12 col-sm-6 col-md-4 col-lg-3">
          <center>
          <div class="card text-black bg-warning mb-3" style="max-width: 90%; margin: 0 auto;">
            <div class="card-header"><h6>' . $id . " | " . $date . '</div>
              <div class="card-body">
                <h5 class="card-title">'. $amount . " | " . $status .'</h5>
                <p class="card-text">' . $data . '</p>
            </div>
          </div>
          </center>
          </div>
          
        
        ';
      
        }elseif($status === "Mislukt"){
          echo '
          
          <div class="col-12 col-sm-6 col-md-4 col-lg-3">
          <center>
            <div class="card text-white bg-danger mb-3" style="max-width: 90%; margin: 0 auto;">
              <div class="card-header"><h6>' . $id . " | " . $date . '</div>
                <div class="card-body">
                  <h5 class="card-title">'. $amount . " | " . $status .'</h5>
                  <p class="card-text">' . $data . '</p>
              </div>
            </div>
            
            </div>
            
          ';
      
        }
      
      }
    


?>
